<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-center mb-8">
                        <div class="mb-4">
                            <svg class="mx-auto h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Thank You For Your Order!</h2>
                        <p class="mt-2 text-sm text-gray-600">
                            Your order has been placed and is being processed.
                        </p>
                        <p class="text-md font-medium text-gray-800 mt-2">
                            Order #{{ $order->order_reference }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h3>
                        
                        <div class="space-y-4">
                            @foreach($order->orderItems as $item)
                                <div class="flex items-start p-4 bg-white border rounded-lg">
                                    <div class="flex-shrink-0 h-16 w-16 bg-gray-200 rounded-md overflow-hidden">
                                        @if($item->yearbookPlatform->cover_image)
                                            <img src="{{ Storage::disk('public')->url($item->yearbookPlatform->cover_image) }}" alt="Yearbook Cover" class="h-full w-full object-cover">
                                        @else
                                            <div class="flex items-center justify-center h-full w-full bg-gray-200 text-gray-500">
                                                No Image
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="ml-4 flex-1">
                                        <div class="flex justify-between">
                                            <div>
                                                <h4 class="text-md font-medium text-gray-900">{{ $item->yearbookPlatform->name }}</h4>
                                                <p class="text-sm text-gray-500">{{ $item->yearbookPlatform->year }}</p>
                                                
                                                @if($item->is_gift)
                                                    <div class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                                        Gift for {{ $item->recipient->first_name }} {{ $item->recipient->last_name }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="text-right">
                                                <p class="text-md font-medium text-gray-900">₱{{ number_format($item->price, 2) }}</p>
                                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-6 pt-4 border-t">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">₱{{ number_format($order->total_amount, 2) }}</span>
                            </div>
                            <div class="flex justify-between mt-2">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-medium">₱0.00</span>
                            </div>
                            <div class="flex justify-between mt-4 pt-4 border-t">
                                <span class="text-lg font-medium text-gray-900">Total</span>
                                <span class="text-lg font-bold text-burgundy-600">₱{{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Information</h3>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment Method</span>
                                <span class="font-medium">{{ ucfirst($order->payment_method) }}</span>
                            </div>
                            @if($order->payment_reference)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Reference Number</span>
                                <span class="font-medium">{{ $order->payment_reference }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status</span>
                                <span class="font-medium">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                        
                        @if($order->payment_method === 'cash')
                            <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
                                <p class="text-sm text-yellow-800">
                                    <strong>Important:</strong> Please pay in cash at the school office and provide your reference number. Your order will be processed once payment is confirmed.
                                </p>
                            </div>
                        @endif
                    </div>
                    
                    @if($order->shippingAddress)
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Shipping Information</h3>
                            
                            <address class="not-italic text-gray-600">
                                <p>{{ $order->shippingAddress->street_address }}</p>
                                <p>{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->province_state }} {{ $order->shippingAddress->zip_code }}</p>
                                <p>{{ $order->shippingAddress->country }}</p>
                            </address>
                        </div>
                    @endif
                    
                    <div class="mt-8 text-center">
                        <a href="{{ route('orders.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-burgundy-600 hover:bg-burgundy-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-burgundy-500">
                            View My Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 