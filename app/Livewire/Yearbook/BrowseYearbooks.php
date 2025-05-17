<?php

namespace App\Livewire\Yearbook;

use App\Models\Cart;
use App\Models\YearbookPlatform;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BrowseYearbooks extends Component
{
    public $yearbooks;
    public $currentYearbook;
    public $pastYearbooks;
    public $showSuccessMessage = false;
    public $successMessage = '';

    public function mount()
    {
        $this->loadYearbooks();
    }

    protected function loadYearbooks()
    {
        // Get current active yearbook
        $this->currentYearbook = YearbookPlatform::where('is_active', true)
            ->where('year', now()->year)
            ->with('stock')
            ->first();

        // Get past yearbooks with available stock
        $this->pastYearbooks = YearbookPlatform::where('year', '<', now()->year)
            ->where('status', 'archived')
            ->whereHas('stock', function ($query) {
                $query->where('available_stock', '>', 0);
            })
            ->with('stock')
            ->orderByDesc('year')
            ->get();

        // Combine current and past yearbooks for display
        $this->yearbooks = collect([$this->currentYearbook])
            ->filter()
            ->concat($this->pastYearbooks);
    }

    public function addToCart($yearbookId, $quantity = 1)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        try {
            // Get the yearbook platform
            $platform = YearbookPlatform::findOrFail($yearbookId);

            // Get or create cart
            $cart = Cart::getOrCreateCart(Auth::id());

            // Add yearbook to cart
            $cart->addYearbookToCart($platform, $quantity);

            // Show success message
            $this->showSuccessMessage = true;
            $this->successMessage = "{$platform->name} ({$platform->year}) added to your cart.";

            // Emit cart updated event
            $this->dispatch('cart-updated');

            // Auto-hide message after 3 seconds
            $this->dispatch('hideMessage')->self();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function hideMessage()
    {
        $this->showSuccessMessage = false;
    }

    public function render()
    {
        return view('livewire.yearbook.browse-yearbooks');
    }
} 