<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($orders->isEmpty())
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No orders found</h3>
                            <p class="mt-1 text-sm text-gray-500">You haven't placed any orders yet.</p>
                            <div class="mt-6">
                                <a href="{{ route('yearbooks.browse') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-burgundy-600 hover:bg-burgundy-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-burgundy-500">
                                    Browse Yearbooks
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col">
                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                    <div class="overflow-hidden">
                                        <table class="min-w-full text-left text-sm font-light">
                                            <thead class="border-b font-medium">
                                                <tr>
                                                    <th scope="col" class="px-6 py-4">Order #</th>
                                                    <th scope="col" class="px-6 py-4">Date</th>
                                                    <th scope="col" class="px-6 py-4">Total</th>
                                                    <th scope="col" class="px-6 py-4">Status</th>
                                                    <th scope="col" class="px-6 py-4">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                    <tr class="border-b hover:bg-gray-50">
                                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $order->order_reference }}</td>
                                                        <td class="whitespace-nowrap px-6 py-4">{{ $order->created_at->format('M d, Y') }}</td>
                                                        <td class="whitespace-nowrap px-6 py-4">₱{{ number_format($order->total_amount, 2) }}</td>
                                                        <td class="whitespace-nowrap px-6 py-4">
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                                @if($order->status === 'completed') bg-green-100 text-green-800
                                                                @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                                                @else bg-gray-100 text-gray-800 @endif">
                                                                {{ ucfirst($order->status) }}
                                                            </span>
                                                        </td>
                                                        <td class="whitespace-nowrap px-6 py-4">
                                                            <a href="{{ route('orders.show', $order) }}" class="text-burgundy-600 hover:text-burgundy-900">
                                                                View Details
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 