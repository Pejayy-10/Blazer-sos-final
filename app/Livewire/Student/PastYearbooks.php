<?php

namespace App\Livewire\Student;

use App\Models\YearbookPlatform;
use App\Models\CartItem;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Past Yearbooks')]
class PastYearbooks extends Component
{
    public function render()
    {
        $yearbooks = YearbookPlatform::with('stock')
            ->where('year', '<', now()->year)
            ->orderBy('year', 'desc')
            ->get();

        return view('livewire.student.past-yearbooks', [
            'yearbooks' => $yearbooks
        ]);
    }

    public function addToCart($yearbookId)
    {
        $yearbook = YearbookPlatform::with('stock')->findOrFail($yearbookId);

        // Check if there's available stock
        if (!$yearbook->stock || $yearbook->stock->available_stock <= 0) {
            $this->dispatch('error', 'This yearbook is out of stock.');
            return;
        }

        // Get the price from the stock record
        $price = $yearbook->stock->price ?? 2500.00;

        // Check if the yearbook is already in cart
        $existingItem = CartItem::where('user_id', auth()->id())
            ->where('yearbook_platform_id', $yearbookId)
            ->first();

        if ($existingItem) {
            // Update quantity if already in cart
            $existingItem->update([
                'quantity' => $existingItem->quantity + 1
            ]);
        } else {
            // Add new item to cart
            CartItem::create([
                'user_id' => auth()->id(),
                'yearbook_platform_id' => $yearbookId,
                'quantity' => 1,
                'unit_price' => $price // Use the price from the stock record
            ]);
        }

        $this->dispatch('cart-updated');
        $this->dispatch('success', 'Added to cart successfully.');
    }
} 