<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Order Details') }}
            </h2>
            <a href="{{ route('orders.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-burgundy-700 bg-burgundy-100 hover:bg-burgundy-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-burgundy-500">
                &larr; Back to Orders
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Order Summary -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Order #{{ $order->order_reference }}</h3>
                            <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('F d, Y') }}</p>
                        </div>
                        <div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                @if($order->status === 'completed') bg-green-100 text-green-800
                                @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Order Items -->
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Order Items</h3>
                            
                            <div class="space-y-4">
                                @foreach($order->orderItems as $item)
                                    <div class="flex items-start p-4 border rounded-lg">
                                        <div class="flex-shrink-0 h-20 w-20 bg-gray-200 rounded-md overflow-hidden">
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
                                                        
                                                        @if($item->gift_message)
                                                            <p class="mt-2 text-sm italic text-gray-600">"{{ $item->gift_message }}"</p>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-md font-medium text-gray-900">₱{{ number_format($item->price, 2) }}</p>
                                                    <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                                    <p class="text-sm font-medium text-gray-900 mt-1">
                                                        Subtotal: ₱{{ number_format($item->price * $item->quantity, 2) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Info -->
                <div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h3>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-medium">₱{{ number_format($order->total_amount, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Shipping</span>
                                    <span class="font-medium">₱0.00</span>
                                </div>
                                <div class="border-t pt-3 mt-3 flex justify-between">
                                    <span class="text-lg font-medium text-gray-900">Total</span>
                                    <span class="text-lg font-bold text-burgundy-600">₱{{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Shipping Information</h3>
                            
                            @if($order->shippingAddress)
                                <address class="not-italic text-gray-600">
                                    <p>{{ $order->shippingAddress->street_address }}</p>
                                    <p>{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->province_state }} {{ $order->shippingAddress->zip_code }}</p>
                                    <p>{{ $order->shippingAddress->country }}</p>
                                </address>
                            @else
                                <p class="text-gray-500">No shipping information available.</p>
                            @endif
                            
                            <div class="mt-4 pt-4 border-t">
                                <h4 class="font-medium text-gray-900 mb-2">Payment Method</h4>
                                <p class="text-gray-600">{{ ucfirst($order->payment_method ?? 'Not specified') }}</p>
                                
                                @if($order->payment_reference)
                                    <p class="text-gray-600 mt-1">Reference: {{ $order->payment_reference }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 