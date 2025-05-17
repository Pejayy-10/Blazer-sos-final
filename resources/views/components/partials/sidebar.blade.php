<!-- Sidebar Container -->
<div class="flex h-full flex-col overflow-y-auto bg-gradient-to-b from-[#5F0104] to-[#7A1518] text-white">
    <!-- Sidebar Header (Logo) -->
    <div class="flex h-16 shrink-0 items-center border-b border-white/10 px-6">
        <a href="{{ route('app.dashboard') }}" wire:navigate class="flex items-center gap-2">
            <img src="{{ asset('images/placeholder-logo.png') }}" alt="Blazer SOS Logo" class="h-8 w-auto">
            <span class="text-xl font-semibold text-white">Blazer SOS</span>
        </a>
    </div>
    
    <!-- Sidebar Navigation -->
    <nav class="flex-1 space-y-1 px-4 py-4">
        @auth
            <!-- Dashboard Link (Always Visible) -->
            <a href="{{ route('app.dashboard') }}" wire:navigate
                class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('app.dashboard') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                Dashboard
            </a>

            <!-- Shop Section -->
            <div class="pt-4">
                <p class="px-3 pb-1 text-xs font-semibold uppercase tracking-wider text-white/50">
                    Shop
                </p>
                <a href="{{ route('yearbooks.browse') }}" wire:navigate
                    class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('yearbooks.browse') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                    </svg>
                    Current Yearbook
                </a>
                <a href="{{ route('yearbooks.past') }}" wire:navigate
                    class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('yearbooks.past') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" clip-rule="evenodd" />
                    </svg>
                    Past Yearbooks
                </a>
                <a href="{{ route('cart') }}" wire:navigate
                    class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('cart') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                    </svg>
                    Cart
                </a>
                <a href="{{ route('orders.index') }}" wire:navigate
                    class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('orders.index') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H3zm11 2H6v12h8V5z" clip-rule="evenodd" />
                    </svg>
                    My Orders
                </a>
            </div>

            <!-- Student Role Section -->
            @if(Auth::user()->role === 'student')
                <div class="pt-4">
                    <p class="px-3 pb-1 text-xs font-semibold uppercase tracking-wider text-white/50">
                        My Yearbook
                    </p>
                    <a href="{{ route('student.academic') }}" wire:navigate
                        class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('student.academic') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.496 2.132a1 1 0 00-.992 0l-7 4A1 1 0 003 7v10a1 1 0 00.252.658l4 3a1 1 0 001.496 0l4-3A.998.998 0 0013 17V7a1 1 0 00-.496-.868l-7-4z" clip-rule="evenodd" />
                        </svg>
                        Academic Area
                    </a>
                    <a href="{{ route('student.profile.edit') }}" wire:navigate
                        class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('student.profile.edit') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm12 4a1 1 0 100-2H4a1 1 0 100 2h12zM4 10a1 1 0 100 2h12a1 1 0 100-2H4z" clip-rule="evenodd" />
                        </svg>
                        Yearbook Profile
                    </a>
                    <a href="{{ route('student.photos') }}" wire:navigate
                        class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('student.photos') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                        </svg>
                        Photos
                    </a>
                    <a href="{{ route('student.subscription.status') }}" wire:navigate
                        class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('student.subscription.status') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Subscription Status
                    </a>
                </div>
            @endif

            <!-- Admin Role Section -->
            @if(in_array(Auth::user()->role, ['admin', 'superadmin']))
                <div class="pt-4">
                    <p class="px-3 pb-1 text-xs font-semibold uppercase tracking-wider text-white/50">
                        Admin Tools
                    </p>
                    <a href="{{ route('admin.platforms.index') }}" wire:navigate
                        class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.platforms.index') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.566.379-1.566 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.566 2.6 1.566 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.566-.379 1.566-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                        Yearbook Platforms
                    </a>
                    <a href="{{ route('admin.academic-structure.index') }}" wire:navigate
                        class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.academic-structure.index') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.998.998 0 011.07.019l3.398 2.017a.998.998 0 01.264 1.408l-1.206 2.035a.998.998 0 00.447 1.391l3.086 1.833a1 1 0 001.18-.001l3.086-1.833a.998.998 0 00.447-1.391l-1.206-2.035a.998.998 0 01.264-1.408l3.398-2.017a.998.998 0 011.07-.019L19.5 6.92a1 1 0 000-1.84l-7-3z" />
                        </svg>
                        Academic Structure
                    </a>
                    <a href="{{ route('admin.subscriptions.index') }}" wire:navigate
                        class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.subscriptions.index') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                        </svg>
                        Subscriptions
                    </a>
                    <a href="{{ route('admin.repository.index') }}" wire:navigate
                        class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.repository.index') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                            <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                        Yearbook Repository
                    </a>
                    <a href="{{ route('admin.orders.index') }}" wire:navigate
                        class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.orders.index') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                        </svg>
                        Order Management
                    </a>
                </div>
            @endif

            <!-- Superadmin Only Section -->
            @if(Auth::user()->role === 'superadmin')
                <div class="pt-4">
                    <p class="px-3 pb-1 text-xs font-semibold uppercase tracking-wider text-white/50">
                        System Configuration
                    </p>
                    <a href="{{ route('superadmin.users.index') }}" wire:navigate
                        class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('superadmin.users.index') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015.5-4.96A5 5 0 0111 16v1H1v-1a5 5 0 015-5z" />
                        </svg>
                        User Management
                    </a>
                    <a href="{{ route('superadmin.roles.index') }}" wire:navigate
                        class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('superadmin.roles.index') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5a.997.997 0 01.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                        Manage Role Names
                    </a>
                </div>
            @endif
            
        @else
            <!-- Links for non-authenticated users -->
            <a href="{{ route('login') }}" wire:navigate
                class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('login') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Login
            </a>
            <a href="{{ route('register') }}" wire:navigate
                class="flex items-center rounded-md px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('register') ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                </svg>
                Register
            </a>
        @endauth
    </nav>
    
    <!-- User Info Footer -->
    @auth
        <div class="border-t border-white/10 p-4">
            <div class="flex items-center rounded-md bg-white/5 p-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10">
                    <span class="text-sm font-medium uppercase text-white">
                        {{ substr(Auth::user()->first_name, 0, 1) }}{{ substr(Auth::user()->last_name, 0, 1) }}
                    </span>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-white">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                    <p class="text-xs text-white/60">
                        @php
                            $displayRole = (Auth::user()->role === 'admin' && !empty(Auth::user()->role_name))
                                ? Auth::user()->role_name 
                                : ucfirst(Auth::user()->role);
                        @endphp
                        {{ $displayRole }}
                    </p>
                </div>
            </div>
        </div>
    @endauth
</div> 