@php
    // Initialize tab component
    $tabs = ['current', 'past'];
    $defaultTab = 'current';
@endphp

<div>
    <div x-data="{ activeTab: 'current' }" class="space-y-6">

        @if(session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif
        
        @if(session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            {{-- Header with Tabs --}}
            <div class="border-b border-gray-200 dark:border-gray-700">
                <div class="px-4 pt-5 sm:px-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                        My Yearbook Subscriptions
                    </h2>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                        Manage your yearbook subscriptions for current and past years.
                    </p>
                </div>
            </div>

            {{-- Current Year Subscription Status --}}
            <div class="px-4 py-5 sm:p-6">
                {{-- Status Card --}}
                <div class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Current Yearbook Status</h3>
                    
                    @if($activePlatform)
                        <div class="mt-4 text-gray-700 dark:text-gray-300">
                            <h4 class="text-xl font-semibold">{{ $activePlatform->name }} ({{ $activePlatform->year }})</h4>
                            
                            <div class="mt-2 space-y-1">
                                <p><span class="font-medium">Overall Status:</span> {{ $overallStatusMessage }}</p>
                                <p><span class="font-medium">Next Step:</span> {{ $nextStepMessage }}</p>
                                <p><span class="font-medium">Submitted Profile:</span> 
                                    @if($hasSubmittedProfile) 
                                        <span class="text-green-600 dark:text-green-400">Yes</span> 
                                    @else 
                                        <span class="text-red-600 dark:text-red-400">No</span> 
                                    @endif
                                </p>
                                <p><span class="font-medium">Payment Status:</span> 
                                    @switch($paymentStatus)
                                        @case('paid')
                                            <span class="text-green-600 dark:text-green-400">Paid</span>
                                            @break
                                        @case('pending')
                                            <span class="text-yellow-600 dark:text-yellow-400">Pending</span>
                                            @break
                                        @case('not_started')
                                            <span class="text-gray-500">Not Started</span>
                                            @break
                                        @default
                                            <span class="text-gray-500">{{ ucfirst($paymentStatus) }}</span>
                                    @endswitch
                                </p>
                            </div>
                            
                            @if(!$hasSubmittedProfile)
                                <div class="mt-4">
                                    <a href="{{ route('student.profile.edit') }}" class="btn-primary">
                                        Complete Your Profile
                                    </a>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="mt-4 text-gray-600 dark:text-gray-400">
                            There is no active yearbook platform available at this time.
                        </p>
                    @endif
                </div>
                
                {{-- All Your Subscriptions Section --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">All Your Subscriptions</h3>
                    
                    @if($userSubscriptions->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Yearbook</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Year</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subscription Type</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                                    @foreach($userSubscriptions as $subscription)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $subscription->yearbookPlatform->name ?? 'Unknown Platform' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $subscription->yearbookPlatform->year ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if($subscription->payment_status === 'paid')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100">
                                                        Paid
                                                    </span>
                                                @elseif($subscription->payment_status === 'pending')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-100">
                                                        Pending
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                                                        {{ ucfirst($subscription->payment_status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ ucwords(str_replace('_', ' ', $subscription->subscription_type)) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                @if($subscription->payment_status === 'pending')
                                                    <button wire:click="cancelSubscription({{ $subscription->id }})" 
                                                            class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300"
                                                            onclick="return confirm('Are you sure you want to cancel this subscription?')">
                                                        Cancel
                                                    </button>
                                                @elseif($subscription->payment_status === 'paid')
                                                    <span class="text-green-600 dark:text-green-400">Completed</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-600 dark:text-gray-400">
                            You don't have any yearbook subscriptions yet.
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('student.past-yearbooks') }}" class="btn-primary">
                                Browse Past Yearbooks
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Add these classes if not already in your CSS */
        .btn-primary {
            @apply inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500;
        }
        
        .btn-secondary {
            @apply inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500;
        }
    </style>
</div>