<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(10);
            
        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Check if the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $order->load(['orderItems.yearbookPlatform', 'orderItems.recipient', 'shippingAddress']);
        
        return view('orders.show', compact('order'));
    }

    /**
     * Display the order confirmation page.
     */
    public function confirmation($order_id)
    {
        $order = Order::where('id', $order_id)
            ->where('user_id', Auth::id())
            ->with([
                'orderItems.yearbookPlatform', 
                'orderItems.recipient',
                'shippingAddress'
            ])
            ->firstOrFail();
            
        return view('orders.confirmation', compact('order'));
    }
} 