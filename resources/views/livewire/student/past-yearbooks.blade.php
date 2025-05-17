<div class="max-w-7xl mx-auto">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-semibold mb-6">Past Yearbooks</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($yearbooks as $yearbook)
                    <div class="bg-white border rounded-lg shadow-sm overflow-hidden">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $yearbook->name }}</h3>
                            <p class="text-gray-600">Year: {{ $yearbook->year }}</p>
                            <p class="text-gray-600">Price: ₱{{ number_format($yearbook->price, 2) }}</p>
                            @if($yearbook->stock && $yearbook->stock->available_stock > 0)
                                <p class="text-sm text-gray-500 mt-1">
                                    Available Stock: {{ $yearbook->stock->available_stock }}
                                </p>
                                <button wire:click="addToCart({{ $yearbook->id }})"
                                        class="mt-4 w-full bg-[#5F0104] text-white px-4 py-2 rounded hover:bg-[#9A382F] transition">
                                    Add to Cart
                                </button>
                            @else
                                <p class="mt-4 text-red-600 text-center py-2 bg-red-50 rounded">Out of Stock</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8 text-gray-500">
                        No past yearbooks available at the moment.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div> 