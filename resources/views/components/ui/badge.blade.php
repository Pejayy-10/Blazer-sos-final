@props([
    'variant' => 'default', // default, success, warning, danger, info
])

@php
    $baseClasses = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium';
    
    $variantClasses = match($variant) {
        'success' => 'bg-green-500/20 text-green-400',
        'warning' => 'bg-yellow-500/20 text-yellow-400',
        'danger' => 'bg-red-500/20 text-red-400',
        'info' => 'bg-blue-500/20 text-blue-400',
        default => 'bg-white/20 text-white'
    };
@endphp

<span {{ $attributes->merge(['class' => "$baseClasses $variantClasses"]) }}>
    {{ $slot }}
</span> 