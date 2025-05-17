@props([
    'variant' => 'primary', // primary, secondary, danger, success
    'size' => 'md',  // sm, md, lg
    'href' => null,
    'type' => 'button',
    'disabled' => false
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium transition-all duration-200 focus:outline-none';
    
    $variantClasses = match($variant) {
        'primary' => 'bg-white text-primary hover:bg-accent/90 hover:text-primary-dark',
        'secondary' => 'solid-card-dark text-white hover:bg-primary-dark',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
        'success' => 'bg-green-600 text-white hover:bg-green-700',
        default => 'bg-white text-primary hover:bg-accent/90'
    };
    
    $sizeClasses = match($size) {
        'sm' => 'px-3 py-1.5 text-xs rounded-md',
        'lg' => 'px-6 py-3 text-base rounded-md',
        default => 'px-4 py-2 text-sm rounded-md'
    };
    
    $disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed' : '';
    
    $classes = $baseClasses . ' ' . $variantClasses . ' ' . $sizeClasses . ' ' . $disabledClasses;

    // Determine the type of element to render based on presence of href
    $isLink = $href !== null && $href !== '';
@endphp

@if($isLink)
    <a href="{{ $disabled ? '#' : $href }}" {{ $attributes->merge(['class' => $classes]) }} @if($disabled) aria-disabled="true" tabindex="-1" @endif>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes, 'type' => $type, 'disabled' => $disabled]) }}>
        {{ $slot }}
    </button>
@endif 