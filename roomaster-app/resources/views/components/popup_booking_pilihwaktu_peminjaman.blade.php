{{-- Pop-up Choose Time (bottom sheet). Slot Available (abu), Selected (biru gelap), Booked (oranye, tidak bisa dipilih).
     booked/selected = array jam (angka). Contoh:
     <x-popup_booking_pilihwaktu_peminjaman room="SI-4202" date="20 May 2026" :booked="[9,11,13,14,19]" :selected="[8]" /> --}}
@props([
  'id' => 'popup-pilihwaktu',
  'open' => true,
  'room' => '',
  'date' => '',
  'booked' => [],
  'selected' => [],
  'submitUrl' => '#',
  'closeUrl' => '#',
])
@php
$groups = [
  'Morning'   => ['sunrise', [8, 9, 10, 11]],
  'Afternoon' => ['sun',     [12, 13, 14, 15]],
  'Evening'   => ['moon',    [16, 17, 18, 19]],
];
@endphp
<x-popup :id="$id" :open="$open" :sheet="true">
  <form action="{{ $submitUrl }}" method="GET" class="-mt-5">
    <div class="flex items-center justify-between">
      <span class="size-6"></span>
      <h4 class="text-[16px] leading-6 font-semibold font-semibold text-grey-900">Choose Time</h4>
      <a href="{{ $closeUrl }}" aria-label="Tutup" class="text-primary-500"><x-icon name="x" :size="24" /></a>
    </div>
    <hr class="mt-3 border-grey-200">

    <h4 class="mt-4 text-[24px] leading-7 font-extrabold font-extrabold text-grey-900">{{ $room }}</h4>
    <p class="text-[12px] leading-4 font-medium font-medium text-grey-600">{{ $date }}</p>

    <div class="mt-3 flex items-center gap-4 text-c1 text-grey-600">
      <span class="flex items-center gap-1.5"><i class="size-3.5 rounded-[3px] border border-grey-300 bg-grey-100"></i>Available</span>
      <span class="flex items-center gap-1.5"><i class="size-3.5 rounded-[3px] bg-primary-800"></i>Selected</span>
      <span class="flex items-center gap-1.5"><i class="size-3.5 rounded-[3px] bg-secondary-500"></i>Booked</span>
    </div>

    @foreach($groups as $label => [$icon, $hours])
      <div class="mt-5 flex items-center gap-2 text-grey-500">
        <x-icon :name="$icon" :size="18" />
        <span class="text-[12px] leading-4 font-medium font-medium uppercase tracking-wide">{{ $label }}</span>
        <span class="h-px flex-1 bg-grey-200"></span>
      </div>
      <div class="mt-3 grid grid-cols-2 gap-3">
        @foreach($hours as $h)
          @php $isBooked = in_array($h, $booked); @endphp
          <label class="{{ $isBooked ? 'cursor-not-allowed' : 'cursor-pointer' }}">
            <input type="checkbox" name="time[]" value="{{ $h }}" class="peer sr-only"
              @checked(in_array($h, $selected)) @disabled($isBooked)>
            <span @class([
              'flex h-12 items-center justify-center rounded-full text-[14px] leading-5 font-semibold font-semibold',
              'bg-secondary-500 text-white' => $isBooked,
              'bg-grey-200 text-grey-900 peer-checked:bg-primary-800 peer-checked:text-white' => ! $isBooked,
            ])>{{ $h }}:00</span>
          </label>
        @endforeach
      </div>
    @endforeach

    <x-button type="submit" size="large" class="mt-5 w-full">Apply</x-button>
  </form>
</x-popup>
