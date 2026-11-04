{{-- Card ruangan. layout: vertical (200px, gambar 119) | vertical_large (penuh, gambar 203) | horizontal (list kecil).
     capacity: angka (jadi "20 Orang") atau teks bebas (mis. "Up to 50 Person (M)").
     Spec: radius 12, gambar penuh tanpa padding, konten pad 12 gap 12.
     Contoh: <x-card_room layout="vertical" title="SI-4202" department="Departemen Sistem Informasi" :capacity="20" image="..." :favorite="false" /> --}}
@props([
  'layout' => 'vertical',
  'title' => '',
  'department' => '',
  'capacity' => 0,
  'image' => null,
  'favorite' => false,
  'href' => '#',
])
@php
$heart = $favorite ? 'text-danger-500 fill-danger-500' : 'text-primary-500';
$capText = is_numeric($capacity) ? $capacity.' Orang' : $capacity;
@endphp

@if($layout === 'horizontal')
  <a href="{{ $href }}" {{ $attributes->class(['flex items-center gap-4 rounded-xl bg-white p-3 shadow-card']) }}>
    <img src="{{ $image }}" alt="" class="size-[100px] shrink-0 rounded-lg bg-grey-200 object-cover">
    <div class="min-w-0 flex-1">
      <h4 class="truncate text-[16px] leading-6 font-semibold text-grey-800">{{ $title }}</h4>
      <div class="mt-1 space-y-1 text-[10px] leading-[14px] font-medium text-grey-800">
        <p class="flex items-start gap-1"><x-icon name="map-pin" :size="12" class="mt-px" /><span class="min-w-0 flex-1">{{ $department }}</span></p>
        <p class="flex items-start gap-1"><x-icon name="users" :size="12" class="mt-px" /><span>{{ $capText }}</span></p>
      </div>
    </div>
    <button type="button" aria-label="Favorit" class="flex size-6 shrink-0 items-center justify-center rounded-full bg-grey-100">
      <x-icon name="heart" :size="16" class="{{ $heart }}" />
    </button>
  </a>
@else
  @php $large = $layout === 'vertical_large'; @endphp
  <div {{ $attributes->class(['overflow-hidden rounded-xl bg-white shadow-card', $large ? 'w-full' : 'w-[200px]']) }}>
    <a href="{{ $href }}" class="block">
      <img src="{{ $image }}" alt="" class="w-full bg-grey-200 object-cover {{ $large ? 'h-[203px]' : 'h-[119px]' }}">
    </a>
    <div class="flex flex-col gap-3 p-3">
      <div class="flex flex-col gap-1">
        <div class="flex items-center justify-between gap-2.5">
          <h4 class="truncate text-[16px] leading-6 font-semibold text-grey-800">{{ $title }}</h4>
          <button type="button" aria-label="Favorit" class="flex size-6 shrink-0 items-center justify-center rounded-full bg-grey-100">
            <x-icon name="heart" :size="16" class="{{ $heart }}" />
          </button>
        </div>
        <div class="flex flex-col gap-1 text-[10px] leading-[14px] font-medium text-grey-800">
          <p class="flex items-start gap-1"><x-icon name="map-pin" :size="12" class="mt-px" /><span class="min-w-0 flex-1">{{ $department }}</span></p>
          <p class="flex items-start gap-1"><x-icon name="users" :size="12" class="mt-px" /><span>{{ $capText }}</span></p>
        </div>
      </div>
      <x-button href="{{ $href }}" size="small" class="w-full">Book Now</x-button>
    </div>
  </div>
@endif
