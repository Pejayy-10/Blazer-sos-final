<?php

namespace App\Livewire\Yearbook;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CartComponent extends Component
{
    public $cart;
    public $cartItems = [];
    public $totalAmount = 0;
    
    // Gift options
    public $giftItems = [];
    public $recipients = [];
    public $selectedRecipient = null;
    public $giftMessage = '';
    
    // Shipping details
    public $shipToSchool = true;
    
    protected $listeners = [
        'cart-updated' => 'loadCart',
    ];

    public function mount()
    {
        $this->loadCart();
        
        // Load potential gift recipients (classmates)
        if (Auth::check()) {
            // Get students that are not the current user
            $this->recipients = User::where('id', '!=', Auth::id())
                ->where('role', 'student')
                ->orderBy('first_name')
                ->get(['id', 'first_name', 'last_name', 'email'])
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->first_name . ' ' . $user->last_name,
                        'email' => $user->email,
                    ];
                });
        }
    }

    protected function loadCart()
    {
        if (Auth::check()) {
            $this->cart = Cart::where('user_id', Auth::id())
                ->where('status', 'active')
                ->with(['cartItems.yearbookPlatform.stock', 'cartItems.recipient'])
                ->first();

            if ($this->cart) {
                $this->cartItems = $this->cart->cartItems;
                $this->totalAmount = $this->cart->total_amount;
            } else {
                $this->cartItems = [];
                $this->totalAmount = 0;
            }
        }
    }

    public function removeItem($itemId)
    {
        $item = CartItem::find($itemId);
        if ($item && $item->cart->user_id === Auth::id()) {
            $item->delete();
            $this->cart->calculateTotal();
            $this->loadCart();
        }
    }

    public function updateQuantity($itemId, $newQuantity)
    {
        $newQuantity = max(1, $newQuantity); // Ensure quantity is at least 1
        
        $item = CartItem::find($itemId);
        if ($item && $item->cart->user_id === Auth::id()) {
            // Check if it's a past yearbook and ensure sufficient stock
            if ($item->isPastYearbook()) {
                $platform = $item->yearbookPlatform;
                if ($platform->stock && $platform->stock->available_stock < $newQuantity) {
                    session()->flash('error', "Sorry, only {$platform->stock->available_stock} copies available");
                    return;
                }
            }
            
            $item->quantity = $newQuantity;
            $item->save();
            $this->cart->calculateTotal();
            $this->loadCart();
        }
    }

    public function makeGift($itemId)
    {
        $item = CartItem::find($itemId);
        if (!$item || $item->cart->user_id !== Auth::id()) {
            return;
        }
        
        $this->giftItems[$itemId] = [
            'id' => $itemId,
            'recipient_id' => null,
            'gift_message' => '',
        ];
    }
    
    public function cancelGift($itemId)
    {
        unset($this->giftItems[$itemId]);
    }
    
    public function saveGift($itemId)
    {
        $this->validate([
            "giftItems.{$itemId}.recipient_id" => 'required|exists:users,id',
            "giftItems.{$itemId}.gift_message" => 'nullable|string|max:255',
        ]);
        
        $item = CartItem::find($itemId);
        if (!$item || $item->cart->user_id !== Auth::id()) {
            return;
        }
        
        $item->is_gift = true;
        $item->recipient_id = $this->giftItems[$itemId]['recipient_id'];
        $item->gift_message = $this->giftItems[$itemId]['gift_message'];
        $item->save();
        
        unset($this->giftItems[$itemId]);
        $this->loadCart();
    }
    
    public function removeGift($itemId)
    {
        $item = CartItem::find($itemId);
        if (!$item || $item->cart->user_id !== Auth::id()) {
            return;
        }
        
        $item->is_gift = false;
        $item->recipient_id = null;
        $item->gift_message = null;
        $item->save();
        
        $this->loadCart();
    }

    public function checkout()
    {
        // Validation
        if (!$this->cart || $this->cart->cartItems->isEmpty()) {
            session()->flash('error', 'Your cart is empty');
            return;
        }
        
        try {
            DB::beginTransaction();
            
            // Convert cart to order
            $order = $this->cart->convertToOrder();
            
            DB::commit();
            
            // Redirect to checkout page
            return redirect()->route('checkout', ['order_id' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred during checkout: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.yearbook.cart-component');
    }
} 