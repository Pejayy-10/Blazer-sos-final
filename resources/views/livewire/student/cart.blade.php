<div class="max-w-7xl mx-auto">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-semibold mb-6">My Cart</h2>

            @if($cartItems->isNotEmpty())
                <div class="space-y-6">
                    <!-- Cart Items -->
                    <div class="border rounded-lg overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Yearbook</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->yearbookPlatform->name }}</div>
                                            <div class="text-sm text-gray-500">Year: {{ $item->yearbookPlatform->year }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            ₱{{ number_format($item->unit_price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center space-x-2">
                                                <button wire:click="updateQuantity({{ $item->id }}, -1)"
                                                        class="text-gray-500 hover:text-gray-700">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                    </svg>
                                                </button>
                                                <span class="text-gray-700">{{ $item->quantity }}</span>
                                                <button wire:click="updateQuantity({{ $item->id }}, 1)"
                                                        class="text-gray-500 hover:text-gray-700">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            ₱{{ number_format($item->total, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button wire:click="removeItem({{ $item->id }})"
                                                    class="text-red-600 hover:text-red-900">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Checkout Form -->
                    <div class="mt-8 bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-medium mb-4">Checkout</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Payment Proof (Screenshot)
                                </label>
                                <input type="file" wire:model="paymentProof"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#5F0104] file:text-white hover:file:bg-[#9A382F]">
                                @error('paymentProof') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Student ID
                                </label>
                                <input type="file" wire:model="studentIdProof"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#5F0104] file:text-white hover:file:bg-[#9A382F]">
                                @error('studentIdProof') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-6 text-right">
                            <div class="text-lg font-semibold mb-4">
                                Total: ₱{{ number_format($cartItems->sum('total'), 2) }}
                            </div>
                            <button wire:click="checkout"
                                    class="bg-[#5F0104] text-white px-6 py-2 rounded hover:bg-[#9A382F] transition">
                                Place Order
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 mb-4">Your cart is empty</p>
                    <a href="{{ route('student.past-yearbooks') }}"
                       class="inline-block bg-[#5F0104] text-white px-6 py-2 rounded hover:bg-[#9A382F] transition">
                        Browse Past Yearbooks
                    </a>
                </div>
            @endif
        </div>
    </div>
</div> 