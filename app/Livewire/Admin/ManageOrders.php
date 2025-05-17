<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;
use App\Mail\OrderReady;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Manage Orders')]
class ManageOrders extends Component
{
    use WithPagination;
    
    public $selectedOrder;
    public $adminNotes;
    
    // Filter properties
    public $statusFilter = '';
    public $yearFilter = '';
    public $search = '';
    
    // Reset pagination when filters change
    public function updatedStatusFilter()
    {
        $this->resetPage();
    }
    
    public function updatedYearFilter()
    {
        $this->resetPage();
    }
    
    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function mount()
    {
        $this->adminNotes = '';
    }
    
    public function render()
    {
        // Get years for the filter dropdown
        $years = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('yearbook_platforms', 'order_items.yearbook_platform_id', '=', 'yearbook_platforms.id')
            ->selectRaw('distinct yearbook_platforms.year')
            ->orderBy('yearbook_platforms.year', 'desc')
            ->pluck('year')
            ->toArray();
            
        // Build the query with filters
        $query = Order::with(['user', 'items.yearbookPlatform', 'processor', 'claimProcessor']);
            
        // Apply status filter
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }
        
        // Apply year filter
        if ($this->yearFilter) {
            $query->whereHas('items.yearbookPlatform', function($q) {
                $q->where('year', $this->yearFilter);
            });
        }
        
        // Apply search filter (search in order number or student name/email)
        if ($this->search) {
            $query->where(function($q) {
                $q->where('order_number', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('first_name', 'like', '%' . $this->search . '%')
                               ->orWhere('last_name', 'like', '%' . $this->search . '%')
                               ->orWhere('email', 'like', '%' . $this->search . '%');
                  });
            });
        }
        
        // Get the filtered orders
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('livewire.admin.manage-orders', [
            'orders' => $orders,
            'years' => $years
        ]);
    }

    public function markAsReadyForClaim($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->status !== 'pending') {
            $this->dispatch('error', 'Order is not in pending status.');
            return;
        }

        $order->update([
            'status' => 'ready_for_claim',
            'processed_by' => auth()->id(),
            'processed_at' => now(),
            'admin_notes' => $this->adminNotes
        ]);

        // Send email notification
        Mail::to($order->user->email)->send(new OrderReady($order));

        $this->adminNotes = '';
        $this->dispatch('success', 'Order marked as ready for claim.');
    }

    public function markAsClaimed($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->status !== 'ready_for_claim') {
            $this->dispatch('error', 'Order is not ready for claim.');
            return;
        }

        $order->update([
            'status' => 'claimed',
            'claimed_processed_by' => auth()->id(),
            'claimed_at' => now()
        ]);

        $this->dispatch('success', 'Order marked as claimed.');
    }
} 