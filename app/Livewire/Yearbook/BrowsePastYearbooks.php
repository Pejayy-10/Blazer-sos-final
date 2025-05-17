<?php

namespace App\Livewire\Yearbook;

use App\Models\Cart;
use App\Models\YearbookPlatform;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BrowsePastYearbooks extends Component
{
    public $yearbooks;
    public $showSuccessMessage = false;
    public $successMessage = '';

    public function mount()
    {
        $this->loadPastYearbooks();
    }

    protected function loadPastYearbooks()
    {
        // Get past yearbooks with available stock
        $this->yearbooks = YearbookPlatform::where('year', '<', now()->year)
            ->where('status', 'archived')
            ->whereHas('stock', function ($query) {
                $query->where('available_stock', '>', 0);
            })
            ->with('stock')
            ->orderByDesc('year')
            ->get();
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

            // Check if it's a past yearbook
            if ($platform->year >= now()->year) {
                session()->flash('error', 'This is not a past yearbook.');
                return;
            }

            // Check stock
            if (!$platform->stock || $platform->stock->available_stock < $quantity) {
                session()->flash('error', 'Insufficient stock available.');
                return;
            }

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
        return view('livewire.yearbook.browse-past-yearbooks');
    }
} 