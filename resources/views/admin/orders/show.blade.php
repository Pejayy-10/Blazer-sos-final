<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Order Details') }} #{{ $order->order_reference }}
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-burgundy-700 bg-burgundy-100 hover:bg-burgundy-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-burgundy-500">
                &larr; Back to Orders
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
                    {{ session('error') }}
                </div>
            @endif
            
            <!-- Order Summary -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Order Information</h3>
                            <p class="text-sm text-gray-500">ID: {{ $order->id }}</p>
                            <p class="text-sm text-gray-500">Reference: {{ $order->order_reference }}</p>
                            <p class="text-sm text-gray-500">Placed on: {{ $order->created_at->format('F d, Y h:i A') }}</p>
                            <p class="text-sm text-gray-500">Payment Method: {{ ucfirst($order->payment_method ?? 'Not specified') }}</p>
                            @if($order->payment_reference)
                                <p class="text-sm text-gray-500">Payment Reference: {{ $order->payment_reference }}</p>
                            @endif
                        </div>
                        
                        <div class="mt-4 md:mt-0">
                            <div class="flex flex-col items-start md:items-end">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mb-3
                                    @if($order->status === 'completed') bg-green-100 text-green-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                    @elseif($order->status === 'refunded') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                                
                                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="mt-2">
                                    @csrf
                                    <div class="flex items-center">
                                        <select name="status" class="rounded-l-md border-gray-300 shadow-sm focus:border-burgundy-300 focus:ring focus:ring-burgundy-200 focus:ring-opacity-50">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="refunded" {{ $order->status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                        </select>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-r-md text-white bg-burgundy-600 hover:bg-burgundy-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-burgundy-500">
                                            Update Status
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Customer Information</h3>
                        <p class="text-sm text-gray-800">Name: {{ $order->user->first_name }} {{ $order->user->last_name }}</p>
                        <p class="text-sm text-gray-800">Email: {{ $order->user->email }}</p>
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
                                                    <p class="text-sm text-gray-500">Type: {{ $item->isPastYearbook() ? 'Past Yearbook' : 'Current Yearbook' }}</p>
                                                    
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
                                            
                                            <!-- Associated Subscriptions -->
                                            @if($item->yearbook_subscriptions->isNotEmpty())
                                                <div class="mt-3 pt-3 border-t border-gray-200">
                                                    <h5 class="text-sm font-medium text-gray-700 mb-1">Associated Subscriptions:</h5>
                                                    <div class="space-y-1">
                                                        @foreach($item->yearbook_subscriptions as $subscription)
                                                            <div class="flex justify-between text-xs">
                                                                <span>ID: {{ $subscription->id }} - {{ $subscription->is_gift ? 'Gift' : 'Regular' }}</span>
                                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                                                    @if($subscription->payment_status === 'paid') bg-green-100 text-green-800
                                                                    @elseif($subscription->payment_status === 'pending') bg-yellow-100 text-yellow-800
                                                                    @else bg-gray-100 text-gray-800 @endif">
                                                                    {{ ucfirst($subscription->payment_status) }}
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
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
                            
                            @if($order->billingAddress && $order->billingAddress->id !== $order->shippingAddress?->id)
                                <div class="mt-4 pt-4 border-t">
                                    <h4 class="font-medium text-gray-900 mb-2">Billing Address</h4>
                                    <address class="not-italic text-gray-600">
                                        <p>{{ $order->billingAddress->street_address }}</p>
                                        <p>{{ $order->billingAddress->city }}, {{ $order->billingAddress->province_state }} {{ $order->billingAddress->zip_code }}</p>
                                        <p>{{ $order->billingAddress->country }}</p>
                                    </address>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 