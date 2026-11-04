{{-- Card ruangan. layout: vertical (kecil 200px) | vertical_large (lebar penuh) | horizontal (list kecil).
     Vertical: gambar full-bleed menempel ke tepi atas kartu (sudut atas ikut lengkung kartu, sudut bawah lurus).
     Tautan otomatis ke /rooms/{id} bila id diisi; href manual menimpa. --}}
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
$src   = $image ? asset($image) : '';
@endphp

@if($layout === 'horizontal')
  <a href="{{ $link }}" {{ $attributes->class(['flex items-center gap-4 rounded-3xl bg-white p-3 shadow-card']) }}>
    <img src="{{ $src }}" alt="{{ $title }}" class="size-[100px] shrink-0 rounded-2xl object-cover">
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
  <div {{ $attributes->class(['overflow-hidden rounded-3xl bg-white shadow-card', $large ? 'w-full' : 'w-[200px]']) }}>
    {{-- Gambar: selebar kartu, menempel ke atas, sudut bawah lurus --}}
    <a href="{{ $link }}" class="block">
      <img src="{{ $src }}" alt="{{ $title }}" class="block w-full object-cover {{ $large ? 'h-[208px]' : 'h-[120px]' }}">
    </a>

    <div class="p-3">
      <div class="flex items-center justify-between gap-2">
        <h4 @class([
          'min-w-0 truncate font-semibold text-grey-800',
          'text-[18px] leading-7' => $large,
          'text-[16px] leading-6' => ! $large,
        ])>{{ $title }}</h4>
        <button type="button" aria-label="Favorit" @class([
          'flex shrink-0 items-center justify-center rounded-full bg-primary-50/40',
          'size-7' => $large,
          'size-6' => ! $large,
        ])>
          <x-icon name="heart" :size="$large ? 16 : 14" class="{{ $heart }}" />
        </button>
      </div>

      <p @class([
        'flex items-center gap-1.5 text-[12px] leading-4 font-medium text-grey-800',
        'mt-2' => $large,
        'mt-1' => ! $large,
      ])><x-icon name="map-pin" :size="14" />{{ $department }}</p>
      <p class="flex items-center gap-1.5 text-[12px] leading-4 font-medium text-grey-800"><x-icon name="users" :size="14" />{{ $cap }}</p>

      <x-button :href="$link" size="tiny" class="mt-3 w-full">Book Now</x-button>
    </div>
  </div>
@endif
