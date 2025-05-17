<?php

namespace App\Livewire\Student;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('My Orders')]
class Orders extends Component
{
    use WithPagination;
    
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
    
    public function render()
    {
        // Get years for the filter dropdown
        $years = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('yearbook_platforms', 'order_items.yearbook_platform_id', '=', 'yearbook_platforms.id')
            ->where('orders.user_id', auth()->id())
            ->selectRaw('distinct yearbook_platforms.year')
            ->orderBy('yearbook_platforms.year', 'desc')
            ->pluck('year')
            ->toArray();
            
        // Build the query with filters
        $query = Order::with(['items.yearbookPlatform', 'processor', 'claimProcessor'])
            ->where('user_id', auth()->id());
            
        // Apply status filter
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }
        
        // Apply year filter (need to join with order_items and yearbook_platforms)
        if ($this->yearFilter) {
            $query->whereHas('items.yearbookPlatform', function($q) {
                $q->where('year', $this->yearFilter);
            });
        }
        
        // Apply search filter (search in order number)
        if ($this->search) {
            $query->where('order_number', 'like', '%' . $this->search . '%');
        }
        
        // Get the filtered orders
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('livewire.student.orders', [
            'orders' => $orders,
            'years' => $years
        ]);
    }
} 