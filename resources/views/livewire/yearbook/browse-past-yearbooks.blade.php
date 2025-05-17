<div>
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-burgundy-800 to-burgundy-900 py-8 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-white">
                    Past Yearbooks Collection
                </h1>
                <p class="mt-2 text-lg text-burgundy-100">
                    Browse and purchase yearbooks from previous years
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Success Message -->
        @if ($showSuccessMessage)
            <div class="fixed top-20 right-4 z-50 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-md transition-opacity duration-500 ease-in-out">
                <div class="flex items-center">
                    <div class="py-1">
                        <svg class="h-6 w-6 text-green-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Success!</p>
                        <p class="text-sm">{{ $successMessage }}</p>
                    </div>
                    <button wire:click="hideMessage" class="ml-auto text-green-700 hover:text-green-900">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Flash Messages -->
        @if (session()->has('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow-md">
                <div class="flex items-center">
                    <div class="py-1">
                        <svg class="h-6 w-6 text-red-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

        <!-- Yearbooks Grid -->
        @if ($yearbooks->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No past yearbooks available</h3>
                <p class="mt-1 text-gray-500">Check back later for archived yearbooks.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($yearbooks as $yearbook)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-200 relative">
                        <!-- Stock Indicator -->
                        <div class="absolute top-2 right-2 bg-white px-2 py-1 rounded-full text-xs font-medium shadow-sm">
                            @if ($yearbook->stock && $yearbook->stock->available_stock > 10)
                                <span class="text-green-600">In Stock</span>
                            @elseif ($yearbook->stock && $yearbook->stock->available_stock > 0)
                                <span class="text-yellow-600">Limited Stock ({{ $yearbook->stock->available_stock }} left)</span>
                            @else
                                <span class="text-red-600">Out of Stock</span>
                            @endif
                        </div>

                        <!-- Yearbook Image -->
                        <div class="h-48 bg-gray-200 flex items-center justify-center relative">
                            @if ($yearbook->cover_image)
                                <img src="{{ Storage::disk('public')->url($yearbook->cover_image) }}" alt="{{ $yearbook->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-burgundy-100">
                                    <div class="text-center p-4">
                                        <span class="block text-2xl font-bold text-burgundy-800">{{ $yearbook->year }}</span>
                                        <span class="block text-burgundy-600">{{ $yearbook->name }}</span>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Year Badge -->
                            <div class="absolute bottom-2 left-2 bg-burgundy-700 text-white px-4 py-1 rounded-full text-sm font-bold">
                                {{ $yearbook->year }}
                            </div>
                        </div>

                        <!-- Yearbook Details -->
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $yearbook->name }}</h3>
                            
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-burgundy-700 font-bold text-xl">
                                    ₱{{ number_format($yearbook->stock->price ?? 2300, 2) }}
                                </span>
                                
                                <span class="text-sm text-gray-500">
                                    {{ $yearbook->year }} Edition
                                </span>
                            </div>
                            
                            <div class="mt-4 space-y-2">
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    {{ $yearbook->description ?? 'Experience the memories from the '.$yearbook->year.' academic year.' }}
                                </p>
                                
                                <div class="flex space-x-2 text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-burgundy-100 text-burgundy-800">
                                        Archived
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-gray-100 text-gray-800">
                                        Limited Edition
                                    </span>
                                </div>
                            </div>

                            <!-- Call to Action -->
                            <div class="mt-6">
                                <button 
                                    wire:click="addToCart({{ $yearbook->id }})"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-burgundy-600 hover:bg-burgundy-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-burgundy-500"
                                    @if (!$yearbook->stock || $yearbook->stock->available_stock <= 0) disabled @endif
                                >
                                    <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div> 