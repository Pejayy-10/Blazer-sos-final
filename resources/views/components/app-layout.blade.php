{{-- app-layout component to use the consistent layout structure --}}
<x-layouts.app :title="$title ?? null">
    {{ $slot }}
</x-layouts.app> 