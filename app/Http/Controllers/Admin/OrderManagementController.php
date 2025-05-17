<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\YearbookSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderManagementController extends Controller
{
    /**
     * Display a listing of orders
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderItems.yearbookPlatform']);
        
        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('payment_reference', 'like', "%{$search}%")
                  ->orWhereHas('user', function($subQ) use ($search) {
                      $subQ->where('first_name', 'like', "%{$search}%")
                           ->orWhere('last_name', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        
        $orders = $query->orderByDesc('created_at')->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }
    
    /**
     * Display order details
     */
    public function show(Order $order)
    {
        $order->load([
            'user', 
            'orderItems.yearbookPlatform', 
            'orderItems.recipient', 
            'orderItems.yearbook_subscriptions',
            'shippingAddress', 
            'billingAddress'
        ]);
        
        return view('admin.orders.show', compact('order'));
    }
    
    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled,refunded',
        ]);
        
        $previousStatus = $order->status;
        $newStatus = $request->status;
        
        DB::beginTransaction();
        try {
            // Update order status
            $order->status = $newStatus;
            $order->save();
            
            // If marking as completed, also mark all subscriptions as paid
            if ($newStatus === 'completed' && $previousStatus !== 'completed') {
                $order->markAsCompleted();
            }
            
            // If cancelling an order that was previously completed, restore stock
            if ($newStatus === 'cancelled' && $previousStatus === 'completed') {
                foreach ($order->orderItems as $item) {
                    if ($item->isPastYearbook() && $item->yearbookPlatform->stock) {
                        $item->yearbookPlatform->stock->available_stock += $item->quantity;
                        $item->yearbookPlatform->stock->save();
                    }
                    
                    // Update subscriptions
                    foreach ($item->yearbook_subscriptions as $subscription) {
                        $subscription->payment_status = 'cancelled';
                        $subscription->save();
                    }
                }
            }
            
            DB::commit();
            return redirect()->route('admin.orders.show', $order)
                ->with('success', "Order status updated to {$newStatus}");
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update order status: ' . $e->getMessage());
        }
    }
} 