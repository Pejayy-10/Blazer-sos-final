<x-app-layout>
<!-- Modern Checkout Page with Solid Theme -->
<div class="relative overflow-hidden min-h-screen bg-primary">
    <!-- Background Blobs for Aesthetic Effect -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <!-- Page Header -->
    <header class="py-12 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-white mb-4 animate-fade-in">Checkout</h1>
            <p class="mt-2 text-xl text-white/80 max-w-2xl mx-auto animate-fade-in-up animate-delay-100">
                Complete your order
            </p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Alert Messages -->
        @if (session()->has('error'))
            <div class="mb-6 p-4 rounded-md bg-red-600 text-white">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($cart && count($cart['items']) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Order Summary (Left Side) -->
                <div class="lg:col-span-8">
                    <x-ui.card class="animate-fade-in-up animate-delay-200">
                        <div class="mb-6 border-b border-primary-light/20 pb-6">
                            <h2 class="text-xl font-bold text-white mb-4">Order Summary</h2>
                            
                            <div class="space-y-4">
                                @foreach($cart['items'] as $itemId => $item)
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 p-4 bg-primary-light/10 rounded-md">
                                        <div class="w-20 h-20 bg-primary-light/20 rounded-md overflow-hidden flex-shrink-0">
                                            @if(isset($item['image']) && $item['image'])
                                                <img src="{{ Storage::disk('public')->url($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <span class="text-xl font-bold text-white">{{ $item['year'] ?? '2023' }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-white">{{ $item['name'] }}</h3>
                                            <p class="text-white/80 mb-2">
                                                @if($item['type'] === 'current_yearbook')
                                                    Current Yearbook ({{ $item['year'] ?? '2023' }})
                                                @else
                                                    Past Yearbook ({{ $item['year'] ?? '' }})
                                                @endif
                                            </p>
                                            
                                            @if(isset($item['is_gift']) && $item['is_gift'])
                                                <div class="mt-1">
                                                    <x-ui.badge variant="info">Gift</x-ui.badge>
                                                    <span class="ml-2 text-sm text-white/80">For: {{ $item['recipient_name'] }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="flex flex-col items-end">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-white/80">Qty:</span>
                                                <select 
                                                    wire:model="cart.items.{{ $itemId }}.quantity" 
                                                    wire:change="updateCartItem('{{ $itemId }}')"
                                                    class="bg-primary-dark border border-primary-light/30 text-white rounded-md px-2 py-1 text-sm"
                                                >
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="mt-2 text-right">
                                                <span class="font-bold text-white text-lg">
                                                    ₱{{ number_format($item['price'] * $item['quantity'], 2) }}
                                                </span>
                                            </div>
                                            <div class="mt-2">
                                                <button 
                                                    wire:click="removeFromCart('{{ $itemId }}')"
                                                    class="text-sm text-white/70 hover:text-white flex items-center"
                                                >
                                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </x-ui.card>
                </div>

                <!-- Payment Info (Right Side) -->
                <div class="lg:col-span-4">
                    <div class="space-y-6">
                        <!-- Order Total Card -->
                        <x-ui.card class="animate-fade-in-up animate-delay-300">
                            <h2 class="text-xl font-bold text-white mb-4">Order Total</h2>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between py-2 border-b border-primary-light/20">
                                    <span class="text-white/80">Subtotal</span>
                                    <span class="text-white font-semibold">₱{{ number_format($cart['total'], 2) }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-primary-light/20">
                                    <span class="text-white/80">Shipping</span>
                                    <span class="text-white font-semibold">Free</span>
                                </div>
                                
                                <div class="flex justify-between pt-2">
                                    <span class="text-lg text-white font-bold">Total</span>
                                    <span class="text-lg text-white font-bold">₱{{ number_format($cart['total'], 2) }}</span>
                                </div>
                            </div>
                        </x-ui.card>

                        <!-- Payment Method Card -->
                        <x-ui.card variant="dark" class="animate-fade-in-up animate-delay-400">
                            <h2 class="text-xl font-bold text-white mb-4">Payment Method</h2>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input type="radio" wire:model="paymentMethod" value="cash" class="form-radio h-5 w-5 text-primary" checked>
                                        <span class="text-white">Cash on Delivery</span>
                                    </label>
                                    <p class="mt-1 ml-8 text-sm text-white/70">Pay when you receive your yearbook</p>
                                </div>
                                
                                <div>
                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input type="radio" wire:model="paymentMethod" value="bank_transfer" class="form-radio h-5 w-5 text-primary">
                                        <span class="text-white">Bank Transfer</span>
                                    </label>
                                    <p class="mt-1 ml-8 text-sm text-white/70">Transfer to our bank account</p>
                                </div>
                                
                                @if($paymentMethod === 'bank_transfer')
                                    <div class="mt-4 bg-primary-light/10 p-4 rounded-md">
                                        <h3 class="font-semibold text-white mb-2">Bank Account Details:</h3>
                                        <ul class="space-y-1 text-sm text-white/80">
                                            <li><span class="font-medium text-white">Bank:</span> BDO</li>
                                            <li><span class="font-medium text-white">Account Name:</span> Blazer SOS Yearbook</li>
                                            <li><span class="font-medium text-white">Account Number:</span> 123456789012</li>
                                            <li><span class="font-medium text-white">Reference:</span> YB-{{ auth()->id() }}</li>
                                        </ul>
                                        <div class="mt-3">
                                            <label for="paymentReference" class="block text-sm font-medium text-white">Payment Reference Number</label>
                                            <input type="text" id="paymentReference" wire:model="paymentReference" placeholder="Enter your payment reference" 
                                                class="mt-1 block w-full bg-primary-dark border border-primary-light/30 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </x-ui.card>
                        
                        <!-- Shipping Method Card -->
                        <x-ui.card variant="dark" class="animate-fade-in-up animate-delay-500">
                            <h2 class="text-xl font-bold text-white mb-4">Shipping Method</h2>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input type="radio" wire:model="shippingMethod" value="pickup" class="form-radio h-5 w-5 text-primary" checked>
                                        <span class="text-white">School Pick-up</span>
                                    </label>
                                    <p class="mt-1 ml-8 text-sm text-white/70">Pick up your yearbook at school (Free)</p>
                                </div>
                                
                                <div>
                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input type="radio" wire:model="shippingMethod" value="delivery" class="form-radio h-5 w-5 text-primary">
                                        <span class="text-white">Home Delivery</span>
                                    </label>
                                    <p class="mt-1 ml-8 text-sm text-white/70">Deliver to your address (Free for now)</p>
                                </div>
                            </div>
                            
                            @if($shippingMethod === 'delivery')
                                <div class="mt-6 bg-primary-light/10 p-4 rounded-md">
                                    <h3 class="font-semibold text-white mb-2">Shipping Address:</h3>
                                    
                                    <div class="space-y-3 mt-3">
                                        <div>
                                            <label for="streetAddress" class="block text-sm font-medium text-white">Street Address</label>
                                            <input type="text" id="streetAddress" wire:model="shippingAddress.street_address" placeholder="Enter your street address" 
                                                class="mt-1 block w-full bg-primary-dark border border-primary-light/30 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary">
                                        </div>
                                        
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label for="city" class="block text-sm font-medium text-white">City</label>
                                                <input type="text" id="city" wire:model="shippingAddress.city" placeholder="City" 
                                                    class="mt-1 block w-full bg-primary-dark border border-primary-light/30 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary">
                                            </div>
                                            <div>
                                                <label for="provinceState" class="block text-sm font-medium text-white">Province/State</label>
                                                <input type="text" id="provinceState" wire:model="shippingAddress.province_state" placeholder="Province/State" 
                                                    class="mt-1 block w-full bg-primary-dark border border-primary-light/30 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary">
                                            </div>
                                        </div>
                                        
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label for="zipCode" class="block text-sm font-medium text-white">ZIP Code</label>
                                                <input type="text" id="zipCode" wire:model="shippingAddress.zip_code" placeholder="ZIP Code" 
                                                    class="mt-1 block w-full bg-primary-dark border border-primary-light/30 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary">
                                            </div>
                                            <div>
                                                <label for="country" class="block text-sm font-medium text-white">Country</label>
                                                <select id="country" wire:model="shippingAddress.country" 
                                                    class="mt-1 block w-full bg-primary-dark border border-primary-light/30 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary">
                                                    <option value="Philippines">Philippines</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        @if($shippingAddress['country'] === 'Other')
                                            <div>
                                                <label for="otherCountry" class="block text-sm font-medium text-white">Specify Country</label>
                                                <input type="text" id="otherCountry" wire:model="shippingAddress.other_country" placeholder="Enter country name" 
                                                    class="mt-1 block w-full bg-primary-dark border border-primary-light/30 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </x-ui.card>
                        
                        <!-- Place Order Button -->
                        <div class="mt-8 animate-fade-in-up animate-delay-600">
                            <x-ui.button wire:click="placeOrder" class="w-full py-4 text-lg font-bold" wire:loading.attr="disabled">
                                <span wire:loading.remove>Place Order</span>
                                <span wire:loading>Processing...</span>
                            </x-ui.button>
                        </div>
                        
                        <!-- Return to Cart -->
                        <div class="text-center text-white/80">
                            <a href="{{ route('cart') }}" wire:navigate class="inline-flex items-center hover:text-white transition-colors duration-150">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Return to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart Message -->
            <x-ui.card class="p-8 text-center animate-fade-in-up">
                <svg class="mx-auto h-16 w-16 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-4 text-xl font-medium text-white">Your cart is empty</h3>
                <p class="mt-1 text-white/80">Add some yearbooks to your cart before proceeding to checkout.</p>
                
                <div class="mt-8">
                    <x-ui.button href="{{ route('yearbooks.browse') }}" wire:navigate>
                        Browse Yearbooks
                    </x-ui.button>
                </div>
            </x-ui.card>
        @endif
    </div>
</div>
</x-app-layout> 