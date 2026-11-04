{{-- Tombol. variant: primary|secondary|outline|soft|disabled. size: giant|large|medium|small|tiny.
     iconOnly = tombol bulat berisi satu ikon. Contoh:
     <x-button variant="primary" size="small" iconRight="arrow-right">Book Now</x-button> --}}
@props([
  'variant' => 'primary',
  'size' => 'large',
  'href' => null,
  'iconLeft' => null,
  'iconRight' => null,
  'iconOnly' => null,
  'type' => 'button',
])
@php
$variants = [
  'primary'   => 'bg-primary-800 text-white hover:bg-primary-500 active:bg-primary-700 focus-visible:ring-2 focus-visible:ring-primary-100',
  'secondary' => 'bg-secondary-500 text-white hover:bg-secondary-800 active:bg-secondary-900 focus-visible:ring-2 focus-visible:ring-secondary-200',
  'outline'   => 'bg-white text-primary-500 border border-primary-500 hover:bg-primary-50 active:bg-primary-100 focus-visible:ring-2 focus-visible:ring-primary-50',
  'soft'      => 'bg-grey-100 text-primary-500 hover:bg-primary-50 active:bg-primary-100 focus-visible:ring-2 focus-visible:ring-primary-50',
  'disabled'  => 'bg-grey-300 text-grey-500 cursor-not-allowed pointer-events-none',
];
$sizes = [ // [tinggi/teks, ukuran ikon, gap]
  'giant'  => ['h-[52px] px-6 text-[18px] leading-6', 24, 'gap-2'],
  'large'  => ['h-11 px-5 text-[16px] leading-5', 20, 'gap-2'],
  'medium' => ['h-[38px] px-4 text-[14px] leading-4', 18, 'gap-1.5'],
  'small'  => ['h-8 px-3 text-[12px] leading-4', 20, 'gap-1'],
  'tiny'   => ['h-6 px-2 text-[10px] leading-3', 16, 'gap-0.5'],
];
$iconBox = ['giant' => 'size-[52px]', 'large' => 'size-11', 'medium' => 'size-[38px]', 'small' => 'size-8', 'tiny' => 'size-6'];
[$sizeCls, $iconPx, $gap] = $sizes[$size] ?? $sizes['large'];
$base = 'inline-flex items-center justify-center rounded-full font-semibold transition-colors outline-none select-none';
$cls = $base.' '.($variants[$variant] ?? $variants['primary']).' '.($iconOnly ? ($iconBox[$size] ?? 'size-11') : $sizeCls.' '.$gap);
$tag = $href && $variant !== 'disabled' ? 'a' : 'button';
@endphp
<{{ $tag }} @if($tag === 'a') href="{{ $href }}" @else type="{{ $type }}" @disabled($variant === 'disabled') @endif {{ $attributes->class([$cls]) }}>
  @if($iconOnly)
    <x-icon :name="$iconOnly" :size="$iconPx" />
  @else
    @if($iconLeft)<x-icon :name="$iconLeft" :size="$iconPx" />@endif
    <span>{{ $slot }}</span>
    @if($iconRight)<x-icon :name="$iconRight" :size="$iconPx" />@endif
  @endif
</{{ $tag }}>
