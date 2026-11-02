{{--
    Modal dasar: overlay hitam 50% + panel di tengah frame.
    Buka : data-popup-open="id"   Tutup: data-popup-close / klik overlay / Esc
    Warna panel diberikan lewat class, mis. <x-modal id="x" class="bg-white p-md">
--}}
@props(['id', 'labelledby' => null])

<div id="{{ $id }}" data-popup hidden role="dialog" aria-modal="true"
     @if($labelledby) aria-labelledby="{{ $labelledby }}" @endif
     class="absolute inset-0 z-50 items-center justify-center bg-black/50 px-xl [&:not([hidden])]:flex">
    <div {{ $attributes->merge(['class' => 'w-full rounded-xl shadow-popup']) }}>
        {{ $slot }}
    </div>
</div>
