{{-- Card ruangan. layout: vertical (kecil, di grid) | vertical_large (lebar penuh) | horizontal (list kecil).
     Tautan otomatis ke /rooms/{id} bila id diisi; href manual menimpa.
     <x-card_room layout="vertical" :id="1" title="SI-4202" department="Departemen Sistem Informasi" :capacity="20" image="..." /> --}}
@props([
  'layout' => 'vertical',
  'id' => null,
  'title' => '',
  'department' => '',
  'capacity' => 0,
  'image' => null,
  'favorite' => false,
  'href' => '#',
])
@php
$link  = $href !== '#' ? $href : ($id ? url('/rooms/'.$id) : '#');
$heart = $favorite ? 'fill-current text-danger-500' : 'text-primary-500';
$cap   = is_numeric($capacity) ? $capacity.' Orang' : $capacity;
@endphp

@if($layout === 'horizontal')
  <a href="{{ $link }}" {{ $attributes->class(['flex items-center gap-4 rounded-3xl bg-white p-3 shadow-card']) }}>
    <img src="{{ $image ? asset($image) : '' }}" alt="{{ $title }}" class="size-[100px] shrink-0 rounded-2xl object-cover">
    <div class="min-w-0 flex-1">
      <h4 class="truncate text-[18px] leading-7 font-semibold text-grey-800">{{ $title }}</h4>
      <p class="mt-1 flex items-center gap-1.5 text-[12px] leading-4 font-medium text-grey-800"><x-icon name="map-pin" :size="14" />{{ $department }}</p>
      <p class="mt-0.5 flex items-center gap-1.5 text-[12px] leading-4 font-medium text-grey-800"><x-icon name="users" :size="14" />{{ $cap }}</p>
    </div>
    <button type="button" aria-label="Favorit" class="flex size-8 shrink-0 items-center justify-center rounded-full bg-primary-50/40">
      <x-icon name="heart" :size="18" class="{{ $heart }}" />
    </button>
  </a>
@else
  @php $large = $layout === 'vertical_large'; @endphp
  <div {{ $attributes->class(['rounded-3xl bg-white p-3 shadow-card', $large ? 'w-full' : 'w-[200px]']) }}>
    <a href="{{ $link }}">
      <img src="{{ $image ? asset($image) : '' }}" alt="{{ $title }}" class="w-full rounded-2xl object-cover {{ $large ? 'h-[200px]' : 'h-[120px]' }}">
    </a>
    <div class="mt-3 flex items-center justify-between">
      <h4 class="text-[18px] leading-7 font-semibold text-grey-800">{{ $title }}</h4>
      <button type="button" aria-label="Favorit" class="flex size-8 items-center justify-center rounded-full bg-primary-50/40">
        <x-icon name="heart" :size="18" class="{{ $heart }}" />
      </button>
    </div>
    <p class="mt-2 flex items-center gap-1.5 text-[12px] leading-4 font-medium text-grey-800"><x-icon name="map-pin" :size="14" />{{ $department }}</p>
    <p class="mt-1 flex items-center gap-1.5 text-[12px] leading-4 font-medium text-grey-800"><x-icon name="users" :size="14" />{{ $cap }}</p>
    <x-button :href="$link" size="medium" class="mt-3 w-full">Book Now</x-button>
  </div>
@endif
