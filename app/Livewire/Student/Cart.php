<?php

namespace App\Livewire\Student;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('My Cart')]
class Cart extends Component
{
    use WithFileUploads;

    public $paymentProof;
    public $studentIdProof;
    
    protected $rules = [
        'paymentProof' => 'required|image|max:2048',
        'studentIdProof' => 'required|image|max:2048'
    ];

    public function updateQuantity($itemId, $change)
    {
        $item = CartItem::findOrFail($itemId);
        
        $newQuantity = $item->quantity + $change;
        
        if ($newQuantity <= 0) {
            $item->delete();
        } else {
            // Check stock availability
            if ($change > 0 && (!$item->yearbookPlatform->stock || $item->yearbookPlatform->stock->available_stock < $newQuantity)) {
                $this->dispatch('error', 'Not enough stock available.');
                return;
            }
            
            $item->update(['quantity' => $newQuantity]);
        }

        $this->dispatch('cart-updated');
    }
    
    public function removeItem($itemId)
    {
        CartItem::findOrFail($itemId)->delete();
        $this->dispatch('cart-updated');
    }
    
    public function checkout()
    {
        $this->validate();

        $cartItems = CartItem::with('yearbookPlatform')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            $this->dispatch('error', 'Your cart is empty.');
            return;
        }

        // Store uploaded files
        $paymentProofPath = $this->paymentProof->store('payment-proofs', 'public');
        $studentIdProofPath = $this->studentIdProof->store('student-ids', 'public');

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . Str::random(10),
            'total_amount' => $cartItems->sum('total'),
            'payment_proof' => $paymentProofPath,
            'student_id_proof' => $studentIdProofPath,
            'status' => 'pending'
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'yearbook_platform_id' => $item->yearbook_platform_id,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price
            ]);
        }

        // Clear cart
        CartItem::where('user_id', auth()->id())->delete();

        $this->dispatch('success', 'Order placed successfully!');
        $this->redirect(route('student.orders'));
    }
    
    public function render()
    {
        return view('livewire.student.cart', [
            'cartItems' => CartItem::with('yearbookPlatform')
                ->where('user_id', auth()->id())
                ->get()
        ]);
    }

    public function getCartItemProperty($itemId)
    {
        return CartItem::find($itemId);
    }
} 