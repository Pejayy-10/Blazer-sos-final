<!-- Modern Cart Page with Solid Theme -->
<div class="relative overflow-hidden min-h-screen bg-primary">
    <!-- Background Blobs for Aesthetic Effect -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <!-- Page Header -->
    <header class="py-12 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-white mb-4 animate-fade-in">Your Shopping Cart</h1>
            <p class="mt-2 text-xl text-white/80 max-w-2xl mx-auto animate-fade-in-up animate-delay-100">
                Review your items before proceeding to checkout
            </p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Flash Messages -->
        @if (session()->has('error'))
            <div class="bg-danger text-white p-4 mb-6 rounded-md shadow-md">
                <div class="flex items-center">
                    <div class="py-1">
                        <svg class="h-6 w-6 text-white mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Error</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Empty Cart State -->
        @if (empty($cartItems) || count($cartItems) === 0)
            <div class="solid-card rounded-lg p-10 text-center animate-fade-in-up animate-delay-200">
                <svg class="mx-auto h-16 w-16 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                <h3 class="mt-4 text-xl font-medium text-white">Your cart is empty</h3>
                <p class="mt-1 text-white/80">Looks like you haven't added any yearbooks to your cart yet.</p>
                
                <div class="mt-8">
                    <a href="{{ route('yearbooks.browse') }}" class="inline-flex items-center px-6 py-3 bg-white text-primary rounded-md shadow-md font-medium hover:bg-accent/90 transition-all duration-300">
                        <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Browse Yearbooks
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items (Left 2/3) -->
                <div class="lg:col-span-2">
                    <div class="solid-card rounded-lg overflow-hidden shadow-lg animate-fade-in-up animate-delay-200">
                        <div class="p-6 border-b border-primary-light/20">
                            <h2 class="text-xl font-bold text-white">Items in Your Cart ({{ count($cartItems) }})</h2>
                        </div>
                        
                        <ul class="divide-y divide-primary-light/20">
                            @foreach($cartItems as $item)
                                <li class="px-6 py-5 flex flex-col sm:flex-row items-start sm:items-center gap-4 @if(isset($giftItems[$item->id])) bg-primary-light/10 @endif">
                                    <!-- Item Image -->
                                    <div class="w-24 h-24 rounded-lg overflow-hidden flex-shrink-0 bg-primary-light/20">
                                        @if ($item->yearbookPlatform->cover_image)
                                            <img src="{{ Storage::disk('public')->url($item->yearbookPlatform->cover_image) }}" alt="{{ $item->yearbookPlatform->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-primary-light/30">
                                                <span class="text-xl font-bold text-white">{{ $item->yearbookPlatform->year }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Item Details -->
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <h3 class="text-lg font-semibold text-white">{{ $item->yearbookPlatform->name }}</h3>
                                            <p class="text-white font-bold">₱{{ number_format($item->unit_price, 2) }}</p>
                                        </div>
                                        
                                        <p class="text-sm text-white/80 mb-2">{{ $item->yearbookPlatform->year }} Edition</p>
                                        
                                        <!-- Quantity Controls -->
                                        <div class="flex items-center mt-2">
                                            <span class="text-white/80 mr-3">Qty:</span>
                                            <div class="flex items-center">
                                                <button type="button" wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})" class="text-white hover:text-white/80 bg-white/10 hover:bg-white/20 rounded-l-md p-2">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                    </svg>
                                                </button>
                                                <span class="px-4 py-1 bg-white/10 text-white">{{ $item->quantity }}</span>
                                                <button type="button" wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})" class="text-white hover:text-white/80 bg-white/10 hover:bg-white/20 rounded-r-md p-2">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- Gift Information (if this is a gift) -->
                                        @if($item->is_gift)
                                            <div class="mt-3 p-3 bg-primary-light/10 rounded-md">
                                                <div class="flex items-start justify-between">
                                                    <div>
                                                        <div class="flex items-center">
                                                            <svg class="h-5 w-5 text-pink-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                                            </svg>
                                                            <span class="text-white font-medium">Gift for: {{ optional($item->recipient)->first_name }} {{ optional($item->recipient)->last_name }}</span>
                                                        </div>
                                                        @if($item->gift_message)
                                                            <p class="text-white/80 text-sm mt-1">Message: "{{ $item->gift_message }}"</p>
                                                        @endif
                                                    </div>
                                                    
                                                    <button type="button" wire:click="removeGift({{ $item->id }})" class="text-white/80 hover:text-white">
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <!-- Gift Form (if adding a gift) -->
                                        @if(isset($giftItems[$item->id]))
                                            <div class="mt-3 p-4 bg-primary-light/10 rounded-md">
                                                <h4 class="text-white font-medium mb-3">Make this a gift</h4>
                                                
                                                <div class="mb-4">
                                                    <label for="recipient-{{ $item->id }}" class="block text-white/80 text-sm mb-1">Select Recipient</label>
                                                    <select 
                                                        id="recipient-{{ $item->id }}" 
                                                        wire:model="giftItems.{{ $item->id }}.recipient_id" 
                                                        class="w-full bg-primary-dark border border-white/20 rounded-md px-3 py-2 text-white"
                                                    >
                                                        <option value="">Select a recipient...</option>
                                                        @foreach($recipients as $recipient)
                                                            <option value="{{ $recipient['id'] }}">{{ $recipient['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                <div class="mb-4">
                                                    <label for="message-{{ $item->id }}" class="block text-white/80 text-sm mb-1">Gift Message (Optional)</label>
                                                    <textarea 
                                                        id="message-{{ $item->id }}" 
                                                        wire:model="giftItems.{{ $item->id }}.gift_message" 
                                                        class="w-full bg-primary-dark border border-white/20 rounded-md px-3 py-2 text-white"
                                                        rows="2"
                                                        placeholder="Add a personal message..."
                                                    ></textarea>
                                                </div>
                                                
                                                <div class="flex justify-end space-x-3">
                                                    <button type="button" wire:click="cancelGift({{ $item->id }})" class="px-3 py-1 text-white">
                                                        Cancel
                                                    </button>
                                                    <button type="button" wire:click="saveGift({{ $item->id }})" class="px-4 py-1 bg-white text-primary rounded-md font-medium">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="flex flex-col items-center space-y-2">
                                        <button type="button" wire:click="removeItem({{ $item->id }})" class="text-white/80 hover:text-white p-1.5 rounded-full hover:bg-primary-light/20">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                        
                                        @if(!$item->is_gift && !isset($giftItems[$item->id]))
                                            <button type="button" wire:click="makeGift({{ $item->id }})" class="text-white/80 hover:text-white p-1.5 rounded-full hover:bg-primary-light/20">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        
                        <div class="p-6 border-t border-primary-light/20">
                            <a href="{{ route('yearbooks.browse') }}" class="inline-flex items-center text-white/80 hover:text-white">
                                <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                                </svg>
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary (Right 1/3) -->
                <div class="lg:col-span-1">
                    <div class="solid-card rounded-lg overflow-hidden shadow-lg sticky top-20 animate-fade-in-up animate-delay-300">
                        <div class="p-6 border-b border-primary-light/20">
                            <h2 class="text-xl font-bold text-white">Order Summary</h2>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between text-white/80">
                                <span>Subtotal</span>
                                <span>₱{{ number_format($totalAmount, 2) }}</span>
                            </div>
                            
                            <div class="flex justify-between text-white/80">
                                <span>Shipping</span>
                                <span>Free</span>
                            </div>
                            
                            <div class="border-t border-primary-light/20 pt-4 flex justify-between font-bold text-white">
                                <span>Total</span>
                                <span>₱{{ number_format($totalAmount, 2) }}</span>
                            </div>
                            
                            <button 
                                type="button" 
                                wire:click="checkout"
                                class="w-full py-4 px-6 bg-white text-primary rounded-md text-lg font-bold hover:bg-accent/90 hover:text-primary-dark transition-all duration-300 flex items-center justify-center mt-6 shadow-md"
                            >
                                <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                                Proceed to Checkout
                            </button>
                            
                            <p class="text-center text-white/80 text-sm mt-4">
                                Secure checkout with multiple payment options available
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div> 