<div class="max-w-7xl mx-auto" x-data="{ showGuide: true }">
    <!-- Admin Guide -->
    <div x-show="showGuide" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="bg-gradient-to-r from-[#5F0104] to-[#9A382F] text-white p-6 rounded-lg shadow-lg mb-6 relative">
        <button @click="showGuide = false" class="absolute top-4 right-4 text-white hover:text-gray-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <h3 class="text-xl font-bold mb-2">Order Management Dashboard</h3>
        <p class="mb-4">This dashboard allows you to process and manage all student orders efficiently.</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white/10 p-3 rounded-lg">
                <h4 class="font-semibold mb-1">Pending Orders</h4>
                <p class="text-sm">Check payment proofs and mark orders as "Ready for Claim" when verified.</p>
            </div>
            <div class="bg-white/10 p-3 rounded-lg">
                <h4 class="font-semibold mb-1">Ready for Claim</h4>
                <p class="text-sm">Students have been notified and will come to claim these orders.</p>
            </div>
            <div class="bg-white/10 p-3 rounded-lg">
                <h4 class="font-semibold mb-1">Claimed Orders</h4>
                <p class="text-sm">Successfully delivered orders that have been claimed by students.</p>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Manage Orders</h2>
                
                <!-- Order Statistics -->
                <div class="grid grid-cols-3 gap-2">
                    <div class="px-3 py-1 bg-yellow-50 border border-yellow-200 rounded-md text-center">
                        <span class="text-xs text-yellow-800 block">Pending</span>
                        <span class="font-bold text-yellow-800">{{ $orders->where('status', 'pending')->count() }}</span>
                    </div>
                    <div class="px-3 py-1 bg-green-50 border border-green-200 rounded-md text-center">
                        <span class="text-xs text-green-800 block">Ready</span>
                        <span class="font-bold text-green-800">{{ $orders->where('status', 'ready_for_claim')->count() }}</span>
                    </div>
                    <div class="px-3 py-1 bg-blue-50 border border-blue-200 rounded-md text-center">
                        <span class="text-xs text-blue-800 block">Claimed</span>
                        <span class="font-bold text-blue-800">{{ $orders->where('status', 'claimed')->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="mb-6 flex flex-wrap gap-4 p-4 bg-gray-50 rounded-lg shadow-sm">
                <div class="flex-1 min-w-[200px]">
                    <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select wire:model.live="statusFilter" id="statusFilter" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#5F0104] focus:ring focus:ring-[#5F0104] focus:ring-opacity-50">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="ready_for_claim">Ready for Claim</option>
                        <option value="claimed">Claimed</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="yearFilter" class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                    <select wire:model.live="yearFilter" id="yearFilter" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#5F0104] focus:ring focus:ring-[#5F0104] focus:ring-opacity-50">
                        <option value="">All Years</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <div class="relative">
                        <input wire:model.live.debounce.300ms="search" type="text" id="search" placeholder="Search by order # or student name..." class="w-full border-gray-300 rounded-md pl-10 shadow-sm focus:border-[#5F0104] focus:ring focus:ring-[#5F0104] focus:ring-opacity-50">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
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
                        <p class="text-gray-500">No orders to process at the moment.</p>
                    @endif
                </div>
            @else
                <!-- Data Table -->
                <div class="overflow-hidden overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($orders as $order)
                                <tr class="hover:bg-gray-50 @if($order->status === 'pending') bg-yellow-50 @elseif($order->status === 'ready_for_claim') bg-green-50 @endif" wire:key="order-{{ $order->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $order->user->first_name }} {{ $order->user->last_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
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
                                            class="text-[#5F0104] hover:text-[#9A382F] hover:underline">
                                            Process Order
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
                
                <!-- Order Processing Modal -->
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
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                            <div class="flex justify-between items-center mb-4">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                    Process Order #{{ $order->order_number }}
                                                </h3>
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($order->status === 'ready_for_claim') bg-green-100 text-green-800
                                                    @else bg-blue-100 text-blue-800
                                                    @endif">
                                                    {{ str_replace('_', ' ', ucfirst($order->status)) }}
                                                </span>
                                            </div>
                                            
                                            <div class="bg-gray-50 p-3 rounded-md mb-4">
                                                <div class="flex justify-between">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-700">
                                                            Student: {{ $order->user->first_name }} {{ $order->user->last_name }}
                                                        </p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $order->user->email }}
                                                        </p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="text-sm text-gray-500">
                                                            Placed on: {{ $order->created_at->format('M d, Y h:ia') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Order Items -->
                                            <h4 class="font-medium text-gray-900 mb-2">Order Items</h4>
                                            <div class="overflow-hidden overflow-x-auto border border-gray-200 rounded-md mb-4">
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead class="bg-gray-50">
                                                        <tr>
                                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Yearbook</th>
                                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Year</th>
                                                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">Quantity</th>
                                                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($order->items as $item)
                                                            <tr class="border-t border-gray-200">
                                                                <td class="px-4 py-2 text-sm">{{ $item->yearbookPlatform->name }}</td>
                                                                <td class="px-4 py-2 text-sm text-gray-500">{{ $item->yearbookPlatform->year }}</td>
                                                                <td class="px-4 py-2 text-sm text-gray-500 text-right">{{ $item->quantity }}</td>
                                                                <td class="px-4 py-2 text-sm font-medium text-right">₱{{ number_format($item->total, 2) }}</td>
                                                            </tr>
                                                        @endforeach
                                                        <tr class="border-t border-gray-200 bg-gray-50">
                                                            <td colspan="3" class="px-4 py-2 text-right text-sm font-medium">Total:</td>
                                                            <td class="px-4 py-2 text-right text-sm font-bold">₱{{ number_format($order->total_amount, 2) }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- Proofs -->
                                            <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Payment Proof</h4>
                                                    <a href="{{ Storage::url($order->payment_proof) }}" target="_blank"
                                                       class="inline-flex items-center px-4 py-2 bg-gray-100 rounded text-sm text-gray-700 hover:bg-gray-200 transition-colors">
                                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        View Payment Proof
                                                    </a>
                                                </div>
                                                <div>
                                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Student ID</h4>
                                                    <a href="{{ Storage::url($order->student_id_proof) }}" target="_blank"
                                                       class="inline-flex items-center px-4 py-2 bg-gray-100 rounded text-sm text-gray-700 hover:bg-gray-200 transition-colors">
                                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        View Student ID
                                                    </a>
                                                </div>
                                            </div>

                                            <!-- Order Actions -->
                                            @if($order->status === 'pending')
                                                <div class="mt-6 border-t border-gray-200 pt-6">
                                                    <h4 class="text-sm font-medium text-gray-700 mb-3">Process Order</h4>
                                                    <div class="mb-4">
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Admin Notes (Optional)
                                                        </label>
                                                        <textarea wire:model="adminNotes"
                                                                  class="w-full rounded-md shadow-sm border-gray-300 focus:border-[#5F0104] focus:ring focus:ring-[#5F0104] focus:ring-opacity-50"
                                                                  rows="2"
                                                                  placeholder="Add any notes for the student..."></textarea>
                                                    </div>
                                                    <button wire:click="markAsReadyForClaim({{ $order->id }})"
                                                            class="bg-[#5F0104] text-white px-4 py-2 rounded hover:bg-[#9A382F] transition-colors flex items-center">
                                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Mark as Ready for Claim
                                                    </button>
                                                </div>
                                            @elseif($order->status === 'ready_for_claim')
                                                <div class="mt-6 border-t border-gray-200 pt-6">
                                                    <button wire:click="markAsClaimed({{ $order->id }})"
                                                            class="bg-[#5F0104] text-white px-4 py-2 rounded hover:bg-[#9A382F] transition-colors flex items-center">
                                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Mark as Claimed
                                                    </button>
                                                </div>
                                            @endif

                                            <!-- Processing History -->
                                            @if($order->processor || $order->claimProcessor)
                                                <div class="mt-6 border-t border-gray-200 pt-6">
                                                    <h4 class="text-sm font-medium text-gray-700 mb-3">Processing History</h4>
                                                    <ul class="space-y-2">
                                                        @if($order->processor)
                                                            <li class="text-sm text-gray-600 flex items-center">
                                                                <svg class="h-4 w-4 text-green-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                Processed by: {{ $order->processor->first_name }} {{ $order->processor->last_name }}
                                                                on {{ $order->processed_at->format('M d, Y h:ia') }}
                                                            </li>
                                                        @endif
                                                        @if($order->claimProcessor)
                                                            <li class="text-sm text-gray-600 flex items-center">
                                                                <svg class="h-4 w-4 text-blue-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                Claimed processed by: {{ $order->claimProcessor->first_name }} {{ $order->claimProcessor->last_name }}
                                                                on {{ $order->claimed_at->format('M d, Y h:ia') }}
                                                            </li>
                                                        @endif
                                                    </ul>
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