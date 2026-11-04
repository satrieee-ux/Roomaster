{{-- Pop-up Filter (bottom sheet). Kapasitas = pilih banyak (checkbox), Fasilitas = checkbox, Room Type = chip toggle.
     Contoh: <x-popup_filter submitUrl="/rooms/search" /> --}}
@props(['id' => 'popup-filter', 'open' => true, 'submitUrl' => '#', 'closeUrl' => '#'])
@php
$capacities = ['0-19', '20-49', '50-99', '100+'];
$facilities = ['Full AC', 'Video Projector'];
$types = ['SKPB', 'Departemen'];
$box = 'flex size-6 shrink-0 items-center justify-center rounded-md border-[1.5px] border-primary-500 bg-white text-transparent peer-checked:border-primary-800 peer-checked:bg-primary-800 peer-checked:text-white';
@endphp
<x-popup :id="$id" :open="$open" :sheet="true" class="!p-0">
  <form action="{{ $submitUrl }}" method="GET" class="-mx-6 -mb-6 -mt-5 px-6 pb-8 pt-1">
    <div class="flex items-center justify-between">
      <x-icon name="filter" :size="24" class="text-primary-500" />
      <h4 class="text-[16px] leading-6 font-semibold font-semibold text-grey-900">Filter</h4>
      <a href="{{ $closeUrl }}" aria-label="Tutup" class="text-primary-500"><x-icon name="x" :size="24" /></a>
    </div>

    <h5 class="mt-4 text-[16px] leading-6 font-semibold font-semibold text-grey-900">Select Capacity</h5>
    <div class="mt-3 space-y-3">
      @foreach($capacities as $c)
        <label class="flex cursor-pointer items-center gap-4">
          <input type="checkbox" name="capacity[]" value="{{ $c }}" class="peer sr-only">
          <span class="{{ $box }}"><x-icon name="check" :size="16" :stroke="3" /></span>
          <span class="text-[14px] leading-5 font-semibold font-semibold text-grey-900">{{ $c }}</span>
        </label>
      @endforeach
    </div>

    <hr class="my-5 border-grey-200">
    <h5 class="text-[16px] leading-6 font-semibold font-semibold text-grey-900">Facilities</h5>
    <div class="mt-3 grid grid-cols-2 gap-3">
      @foreach($facilities as $f)
        <label class="flex cursor-pointer items-center gap-4">
          <input type="checkbox" name="facilities[]" value="{{ $f }}" class="peer sr-only">
          <span class="{{ $box }}"><x-icon name="check" :size="16" :stroke="3" /></span>
          <span class="text-[14px] leading-5 font-semibold font-semibold text-grey-900">{{ $f }}</span>
        </label>
      @endforeach
    </div>

    <hr class="my-5 border-grey-200">
    <h5 class="text-[16px] leading-6 font-semibold font-semibold text-grey-900">Room Type</h5>
    <div class="mt-3 grid grid-cols-2 gap-3">
      @foreach($types as $t)
        <label class="cursor-pointer">
          <input type="checkbox" name="type[]" value="{{ $t }}" class="peer sr-only">
          <span class="flex h-8 items-center justify-center rounded-full bg-grey-200 text-[12px] font-semibold text-primary-500 peer-checked:bg-primary-800 peer-checked:text-white">{{ $t }}</span>
        </label>
      @endforeach
    </div>

    <hr class="my-5 border-grey-200">
    <x-button type="submit" size="giant" class="w-full">Apply</x-button>
  </form>
</x-popup>
