@props([
    'variant' => 'primary', // primary, secondary, outline, ghost
    'size' => 'md',        // giant, lg, md, sm, tiny
    'iconLeft' => null,
    'iconRight' => null,
])

@php
$baseClasses = "inline-flex items-center justify-center font-semibold rounded-full transition-all focus:outline-none cursor-pointer";

$sizes = [
    'giant' => 'px-6 py-3.5 text-lg gap-3',
    'lg'    => 'px-5 py-3 text-base gap-2.5',
    'md'    => 'px-4 py-2.5 text-sm gap-2',
    'sm'    => 'px-3.5 py-2 text-xs gap-1.5',
    'tiny'  => 'px-2.5 py-1 text-[10px] gap-1',
];

$variants = [
    'primary'   => 'bg-grey-800 text-white hover:bg-grey-700 active:bg-grey-900',
    'secondary' => 'bg-secondary-500 text-white hover:bg-secondary-600 active:bg-secondary-700',
    'outline'   => 'border border-primary-500 text-primary-500 hover:bg-primary-50 active:bg-primary-100',
    'ghost'     => 'bg-grey-100 text-grey-700 hover:bg-grey-200 active:bg-grey-300',
];

$classes = $baseClasses . ' ' . ($sizes[$size] ?? $sizes['md']) . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    @if($iconLeft)
        <i data-lucide="{{ $iconLeft }}" class="w-4 h-4"></i>
    @endif
    
    <span>{{ $slot }}</span>

    @if($iconRight)
        <i data-lucide="{{ $iconRight }}" class="w-4 h-4"></i>
    @endif
</button>