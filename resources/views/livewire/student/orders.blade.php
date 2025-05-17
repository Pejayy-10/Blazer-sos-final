<div class="max-w-7xl mx-auto" x-data="{ showGuide: true }">
    <!-- User Guide/Welcome Message -->
    <div x-show="showGuide" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="bg-gradient-to-r from-[#9A382F] to-[#5F0104] text-white p-6 rounded-lg shadow-lg mb-6 relative">
        <button @click="showGuide = false" class="absolute top-4 right-4 text-white hover:text-gray-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <h3 class="text-xl font-bold mb-2">Welcome to Your Orders</h3>
        <p class="mb-4">Here you can track all your yearbook orders and their current status.</p>
        <ul class="list-disc list-inside space-y-1 text-sm">
            <li>Use the <span class="font-semibold">filters</span> to quickly find specific orders</li>
            <li><span class="font-semibold">Pending</span> orders are being processed</li>
            <li><span class="font-semibold">Ready for claim</span> orders can be picked up</li>
            <li><span class="font-semibold">Claimed</span> orders have been delivered</li>
        </ul>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">My Orders</h2>
                <a href="{{ route('student.past-yearbooks') }}" class="inline-flex items-center px-4 py-2 bg-[#5F0104] text-white rounded-md hover:bg-[#9A382F] transition-all duration-300 transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                    </svg>
                    Buy Yearbooks
                </a>
            </div>

            <!-- Filters -->
            <div class="mb-6 flex flex-wrap gap-4 p-4 bg-gray-50 rounded-lg shadow-sm">
                <div class="flex-1 min-w-[200px]">
                    <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select wire:model.live="statusFilter" id="statusFilter" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#9A382F] focus:ring focus:ring-[#9A382F] focus:ring-opacity-50">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="ready_for_claim">Ready for Claim</option>
                        <option value="claimed">Claimed</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="yearFilter" class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                    <select wire:model.live="yearFilter" id="yearFilter" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#9A382F] focus:ring focus:ring-[#9A382F] focus:ring-opacity-50">
                        <option value="">All Years</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search Order #</label>
                    <div class="relative">
                        <input wire:model.live.debounce.300ms="search" type="text" id="search" placeholder="Search by order number..." class="w-full border-gray-300 rounded-md pl-10 shadow-sm focus:border-[#9A382F] focus:ring focus:ring-[#9A382F] focus:ring-opacity-50">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if($orders->isEmpty())
                <div class="text-center py-12 bg-white rounded-lg shadow-sm border border-gray-100 animate-fade-in">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 text-gray-400 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 mb-4">No orders found matching your filters</p>
                    @if($statusFilter || $yearFilter || $search)
                        <button wire:click="$set('statusFilter', ''); $set('yearFilter', ''); $set('search', '');" 
                                class="inline-flex items-center px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                            </svg>
                            Clear all filters
                        </button>
                    @else
                        <a href="{{ route('student.past-yearbooks') }}"
                           class="inline-flex items-center px-6 py-2 rounded-md bg-[#5F0104] text-white hover:bg-[#9A382F] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z"></path>
                            </svg>
                            Browse Past Yearbooks
                        </a>
                    @endif
                </div>
            @else
                <!-- Data Table -->
                <div class="overflow-hidden overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($orders as $order)
                                <tr class="hover:bg-gray-50" wire:key="order-{{ $order->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $order->created_at->format('M d, Y') }}<br>
                                        <span class="text-xs">{{ $order->created_at->format('h:ia') }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $order->items->count() }} item(s)
                                        <span class="block text-xs text-gray-400">{{ $order->items->pluck('yearbookPlatform.year')->implode(', ') }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        ₱{{ number_format($order->total_amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($order->status === 'ready_for_claim') bg-green-100 text-green-800
                                            @else bg-blue-100 text-blue-800
                                            @endif">
                                            {{ str_replace('_', ' ', ucfirst($order->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button 
                                            type="button" 
                                            x-data="" 
                                            x-on:click="window.dispatchEvent(new CustomEvent('open-modal', { detail: { id: '{{ $order->id }}' } }))"
                                            class="text-[#9A382F] hover:text-[#5F0104] hover:underline">
                                            View Details
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
                
                <!-- Order Details Modal -->
                @foreach($orders as $order)
                    <div
                        x-data="{ show: false, order: '{{ $order->id }}' }"
                        x-show="show"
                        x-on:open-modal.window="if ($event.detail.id === order) { show = true }"
                        x-on:keydown.escape.window="show = false"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        class="fixed inset-0 z-50 overflow-y-auto" 
                        style="display: none;"
                    >
                        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" aria-hidden="true">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>

                            <!-- Modal panel -->
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                            <div class="flex justify-between items-center mb-4">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                    Order #{{ $order->order_number }}
                                                </h3>
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($order->status === 'ready_for_claim') bg-green-100 text-green-800
                                                    @else bg-blue-100 text-blue-800
                                                    @endif">
                                                    {{ str_replace('_', ' ', ucfirst($order->status)) }}
                                                </span>
                                            </div>
                                            
                                            <p class="text-sm text-gray-500 mb-4">
                                                Placed on {{ $order->created_at->format('F d, Y h:ia') }}
                                            </p>
                                            
                                            <div class="border-t border-gray-200 pt-4">
                                                <h4 class="font-medium text-gray-900 mb-2">Order Items</h4>
                                                <div class="divide-y divide-gray-200">
                                                    @foreach($order->items as $item)
                                                        <div class="py-3 flex justify-between">
                                                            <div>
                                                                <p class="font-medium">{{ $item->yearbookPlatform->name }}</p>
                                                                <p class="text-sm text-gray-500">Year: {{ $item->yearbookPlatform->year }}</p>
                                                                <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                                            </div>
                                                            <div class="text-right">
                                                                <p class="font-medium">₱{{ number_format($item->total, 2) }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            
                                            <!-- Order Total -->
                                            <div class="mt-4 pt-4 border-t border-gray-200">
                                                <div class="flex justify-between">
                                                    <span class="font-medium">Total Amount:</span>
                                                    <span class="font-medium">₱{{ number_format($order->total_amount, 2) }}</span>
                                                </div>
                                            </div>

                                            <!-- Order Status Details -->
                                            @if($order->status === 'ready_for_claim')
                                                <div class="mt-4 p-4 bg-green-50 rounded-lg">
                                                    <p class="text-green-700">Your order is ready for claim! Please bring a valid ID when claiming.</p>
                                                    @if($order->admin_notes)
                                                        <p class="mt-2 text-sm text-green-600">
                                                            <strong>Admin Notes:</strong> {{ $order->admin_notes }}
                                                        </p>
                                                    @endif
                                                </div>
                                            @elseif($order->status === 'claimed')
                                                <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                                    <p class="text-blue-700">
                                                        Order claimed on {{ $order->claimed_at->format('M d, Y h:ia') }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="button" @click="show = false" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#5F0104] text-base font-medium text-white hover:bg-[#9A382F] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#9A382F] sm:ml-3 sm:w-auto sm:text-sm">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<script>
    // Animation for row appearance
    document.addEventListener('livewire:initialized', () => {
        // Fade in table rows with staggered delay
        document.querySelectorAll('tbody tr').forEach((row, index) => {
            row.style.opacity = "0";
            row.style.transform = "translateY(10px)";
            row.style.transition = "opacity 0.3s ease, transform 0.3s ease";
            
            setTimeout(() => {
                row.style.opacity = "1";
                row.style.transform = "translateY(0)";
            }, 100 + (index * 50));
        });
    });
</script> 