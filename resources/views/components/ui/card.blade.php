@props([
    'variant' => 'default', // default, dark, light
    'withHeader' => false, 
    'withFooter' => false,
    'animate' => false,
    'animateDelay' => 0
])

@php
    $classes = match($variant) {
        'dark' => 'solid-card-dark',
        'light' => 'solid-card-light',
        default => 'solid-card'
    };
    
    if ($animate) {
        $classes .= ' animate-fade-in-up';
        if ($animateDelay > 0) {
            $classes .= ' animate-delay-' . $animateDelay;
        }
    }
@endphp

<div {{ $attributes->merge(['class' => "$classes rounded-md overflow-hidden shadow-md"]) }}>
    @if($withHeader)
        <div class="p-6 border-b border-primary-light/20">
            {{ $header }}
        </div>
    @endif
    
    <div class="p-6">
        {{ $slot }}
    </div>
    
    @if($withFooter)
        <div class="p-6 border-t border-primary-light/20">
            {{ $footer }}
        </div>
    @endif
</div> 