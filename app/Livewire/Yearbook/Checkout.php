<?php

namespace App\Livewire\Yearbook;

use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Checkout extends Component
{
    public $order;
    public $orderItems = [];
    public $paymentMethod = 'cash';
    
    // Shipping address
    public $shippingAddressId;
    public $addresses = [];
    public $newAddress = false;
    
    public $street;
    public $city;
    public $province;
    public $zipCode;
    public $country = 'Philippines';
    
    // Billing same as shipping
    public $billingAddressId;
    public $billingSameAsShipping = true;
    
    public function mount($order_id)
    {
        $this->order = Order::where('id', $order_id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->with([
                'orderItems.yearbookPlatform.stock', 
                'orderItems.recipient',
                'shippingAddress',
                'billingAddress'
            ])
            ->firstOrFail();
        
        $this->orderItems = $this->order->orderItems;
        
        // Load user addresses
        $this->addresses = Address::where('user_id', Auth::id())->get();
        
        // Set default address if available
        if ($this->addresses->isNotEmpty()) {
            $this->shippingAddressId = $this->addresses->first()->id;
            $this->billingAddressId = $this->addresses->first()->id;
        }
    }
    
    public function toggleNewAddress($value)
    {
        $this->newAddress = $value;
        if ($value) {
            $this->shippingAddressId = null;
        } else {
            // Reset form fields
            $this->street = '';
            $this->city = '';
            $this->province = '';
            $this->zipCode = '';
        }
    }
    
    public function toggleBillingSameAsShipping($value)
    {
        $this->billingSameAsShipping = $value;
    }

    public function placeOrder()
    {
        // Handle shipping address
        $shippingAddressId = null;
        
        if ($this->newAddress) {
            // Validate and create new address
            $this->validate([
                'street' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'province' => 'required|string|max:100',
                'zipCode' => 'required|string|max:20',
                'country' => 'required|string|max:100',
            ]);
            
            // Create new address
            $address = Address::create([
                'user_id' => Auth::id(),
                'street_address' => $this->street,
                'city' => $this->city,
                'province_state' => $this->province,
                'zip_code' => $this->zipCode,
                'country' => $this->country,
                'is_default' => $this->addresses->isEmpty(), // Make default if first address
            ]);
            
            $shippingAddressId = $address->id;
        } else {
            // Use existing address
            $this->validate([
                'shippingAddressId' => 'required|exists:addresses,id',
            ]);
            
            $shippingAddressId = $this->shippingAddressId;
        }
        
        // Handle billing address
        $billingAddressId = $this->billingSameAsShipping 
            ? $shippingAddressId 
            : $this->billingAddressId;
        
        try {
            DB::beginTransaction();
            
            // Update order with payment and shipping details
            $this->order->update([
                'status' => 'processing',
                'payment_method' => $this->paymentMethod,
                'shipping_address_id' => $shippingAddressId,
                'billing_address_id' => $billingAddressId,
            ]);
            
            // For cash payment (school admin will mark as paid later)
            if ($this->paymentMethod === 'cash') {
                // Generate reference number
                $this->order->payment_reference = 'CASH-' . strtoupper(substr(md5($this->order->id . time()), 0, 10));
                $this->order->save();
            }
            
            // For bank transfer (this would typically redirect to a bank page or show details)
            // Additional payment methods can be added as needed
            
            DB::commit();
            
            // Redirect to confirmation page
            return redirect()->route('order.confirmation', ['order_id' => $this->order->id]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while processing your order: ' . $e->getMessage());
        }
    }
    
    public function render()
    {
        return view('livewire.yearbook.checkout');
    }
} 