<!-- Modern Current Yearbook Display -->
<div class="relative overflow-hidden min-h-screen bg-primary">
    <!-- Background Blobs for Aesthetic Effect -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <!-- Page Header -->
    <header class="py-12 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-white mb-4 animate-fade-in">Current Yearbook Collection</h1>
            <p class="mt-2 text-xl text-white/80 max-w-2xl mx-auto animate-fade-in-up animate-delay-100">
                Purchase the latest yearbook for the current academic year
            </p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="mb-6 p-4 rounded-md bg-green-600 text-white">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Error Message -->
        @if (session()->has('error'))
            <div class="mb-6 p-4 rounded-md bg-red-600 text-white">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Yearbooks Display -->
        @if ($yearbooks->isEmpty())
            <x-ui.card animate="true" animateDelay="200" class="p-10 text-center">
                <svg class="mx-auto h-16 w-16 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <h3 class="mt-4 text-xl font-medium text-white">No yearbooks available</h3>
                <p class="mt-1 text-white/80">Check back later for the current yearbook.</p>
            </x-ui.card>
        @else
            <!-- Featured Current Yearbook -->
            @if($currentYearbook)
                <x-ui.card animate="true" animateDelay="200" class="mb-16 shadow-lg">
                    <div class="grid grid-cols-1 lg:grid-cols-2">
                        <!-- Yearbook Image -->
                        <div class="aspect-[4/3] relative overflow-hidden border-r border-primary-light/30">
                            @if ($currentYearbook->cover_image)
                                <img src="{{ Storage::disk('public')->url($currentYearbook->cover_image) }}" alt="{{ $currentYearbook->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-primary-light/20">
                                    <div class="text-center p-4">
                                        <span class="block text-5xl font-extrabold text-white">{{ $currentYearbook->year }}</span>
                                        <span class="block text-xl font-medium text-white/80 mt-2">{{ $currentYearbook->name }}</span>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Year Badge -->
                            <div class="absolute top-4 left-4 bg-white text-primary px-5 py-2 rounded-md text-xl font-bold shadow-md">
                                {{ $currentYearbook->year }}
                            </div>
                        </div>
                        
                        <!-- Yearbook Details -->
                        <div class="p-10 lg:p-12 flex flex-col">
                            <div class="mb-8">
                                <h2 class="text-3xl font-bold text-white mb-3">{{ $currentYearbook->name }}</h2>
                                <p class="text-white/80 text-lg mb-6">
                                    {{ $currentYearbook->description ?? 'Capture the memories of this academic year with our beautifully designed yearbook.' }}
                                </p>

                                <div class="mb-5">
                                    <span class="text-4xl font-extrabold text-white">
                                        ₱{{ number_format($currentYearbook->stock->price ?? 2500, 2) }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-wrap gap-3 mb-4">
                                    <x-ui.badge class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Official Edition
                                    </x-ui.badge>
                                    
                                    <x-ui.badge class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Premium Quality
                                    </x-ui.badge>
                                    
                                    <x-ui.badge class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Limited Edition
                                    </x-ui.badge>
                                </div>
                            </div>
                            
                            <!-- Stock Status -->
                            <div class="mb-6">
                                @if ($currentYearbook->stock && $currentYearbook->stock->available_stock > 10)
                                    <div class="flex items-center text-green-400 mb-2">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="font-medium">In Stock and Ready to Ship</span>
                                    </div>
                                @elseif ($currentYearbook->stock && $currentYearbook->stock->available_stock > 0)
                                    <div class="flex items-center text-yellow-300 mb-2">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <span class="font-medium">Limited Stock (Only {{ $currentYearbook->stock->available_stock }} left)</span>
                                    </div>
                                @else
                                    <div class="flex items-center text-red-400 mb-2">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        <span class="font-medium">Out of Stock</span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Call to Action -->
                            <div class="mt-auto w-full">
                                <x-ui.button 
                                    wire:click="addToCart({{ $currentYearbook->id }})"
                                    class="w-full py-4 px-8 text-lg font-bold shadow-md"
                                    @if (!$currentYearbook->stock || $currentYearbook->stock->available_stock <= 0) disabled @endif
                                >
                                    <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Add to Cart
                                </x-ui.button>
                                
                                <p class="text-center text-white/80 mt-4 text-sm">
                                    Secure payment and fast delivery available
                                </p>
                            </div>
                        </div>
                    </div>
                </x-ui.card>
            @endif

            <!-- Past Yearbooks Grid -->
            @if(!$pastYearbooks->isEmpty())
                <div class="mt-12 mb-6">
                    <h2 class="text-2xl font-bold text-white mb-2">Also Available</h2>
                    <p class="text-white/80">Other editions you might be interested in</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in-up animate-delay-300">
                    @foreach ($pastYearbooks as $yearbook)
                        <x-ui.card class="card-hover relative">
                            <!-- Yearbook Image -->
                            <div class="h-48 relative">
                                @if ($yearbook->cover_image)
                                    <img src="{{ Storage::disk('public')->url($yearbook->cover_image) }}" alt="{{ $yearbook->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-primary-light/20">
                                        <div class="text-center p-4">
                                            <span class="block text-3xl font-bold text-white">{{ $yearbook->year }}</span>
                                            <span class="block text-white/80">{{ $yearbook->name }}</span>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Year Badge -->
                                <div class="absolute top-3 left-3 bg-white text-primary px-3 py-1 rounded-md text-sm font-bold shadow-sm">
                                    {{ $yearbook->year }}
                                </div>
                            </div>
                            
                            <!-- Yearbook Info -->
                            <div class="p-5">
                                <h3 class="text-xl font-semibold text-white mb-1">{{ $yearbook->name }}</h3>
                                <p class="text-white/80 mb-4 text-sm line-clamp-2">
                                    {{ $yearbook->description ?? 'Archive edition of the school yearbook.' }}
                                </p>
                                
                                <div class="flex justify-between items-center">
                                    <div class="text-white">
                                        <span class="text-lg font-bold">₱{{ number_format($yearbook->stock->price ?? 2000, 2) }}</span>
                                    </div>
                                    
                                    @if ($yearbook->stock && $yearbook->stock->available_stock > 0)
                                        <x-ui.button 
                                            wire:click="addToCart({{ $yearbook->id }})" 
                                            size="sm"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Add
                                        </x-ui.button>
                                    @else
                                        <x-ui.badge variant="danger">Sold Out</x-ui.badge>
                                    @endif
                                </div>
                            </div>
                        </x-ui.card>
                    @endforeach
                </div>
            @endif
            
            <!-- Browse Past Yearbooks Link -->
            <div class="text-center mt-12">
                <x-ui.button 
                    href="{{ route('yearbooks.past') }}" 
                    variant="secondary"
                    size="lg"
                    class="group"
                >
                    <span>Browse All Past Yearbooks</span>
                    <svg class="ml-2 h-5 w-5 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </x-ui.button>
            </div>
        @endif
    </div>
</div> 