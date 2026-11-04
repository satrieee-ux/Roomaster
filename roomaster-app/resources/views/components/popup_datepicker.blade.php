{{-- Pop-up Choose Date (bottom sheet). Kalender dibuat dari bulan/tahun lewat Carbon (dummy dulu).
     prevUrl/nextUrl = link ganti bulan (mis. ?month=1&year=2026). selected = tanggal terpilih (angka).
     Contoh: <x-popup_datepicker :month="2" :year="2025" :selected="14" /> --}}
@props([
  'id' => 'popup-datepicker',
  'open' => true,
  'month' => 2,
  'year' => 2025,
  'selected' => null,
  'prevUrl' => '#',
  'nextUrl' => '#',
  'submitUrl' => '#',
  'closeUrl' => '#',
])
@php
use Carbon\Carbon;
$first = Carbon::create($year, $month, 1);
$start = $first->copy()->startOfWeek(Carbon::SUNDAY);
$end = $first->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY);
$days = [];
for ($d = $start->copy(); $d->lte($end); $d->addDay()) {
  $days[] = ['n' => $d->day, 'current' => $d->month === (int) $month];
}
@endphp
<x-popup :id="$id" :open="$open" :sheet="true">
  <div class="-mt-5">
    <div class="flex items-center justify-between">
      <x-icon name="calendar" :size="24" class="text-primary-500" />
      <h4 class="text-[16px] leading-6 font-semibold font-semibold text-grey-900">Choose Date</h4>
      <a href="{{ $closeUrl }}" aria-label="Tutup" class="text-primary-500"><x-icon name="x" :size="24" /></a>
    </div>
    <hr class="mt-3 border-grey-200">

    <div class="mt-4 flex items-center justify-between px-1">
      <a href="{{ $prevUrl }}" aria-label="Bulan sebelumnya" class="text-primary-500"><x-icon name="chevron-left" :size="20" /></a>
      <span class="text-b2 font-semibold text-grey-900">{{ $first->translatedFormat('F') }}</span>
      <a href="{{ $nextUrl }}" aria-label="Bulan berikutnya" class="text-primary-500"><x-icon name="chevron-right" :size="20" /></a>
    </div>

    <div class="mt-3 grid grid-cols-7 text-center text-[14px] leading-5 font-semibold font-semibold text-primary-500">
      @foreach(['S','M','T','W','T','F','S'] as $w)<span class="py-2">{{ $w }}</span>@endforeach
    </div>
    <div class="grid grid-cols-7 text-center">
      @foreach($days as $day)
        @if($day['current'])
          <a href="{{ $submitUrl }}?date={{ $first->format('Y-m') }}-{{ str_pad($day['n'], 2, '0', STR_PAD_LEFT) }}" @class([
            'mx-auto flex size-10 items-center justify-center rounded-full text-[14px] leading-5 font-semibold font-semibold',
            'bg-primary-800 text-white' => $selected === $day['n'],
            'text-grey-900 hover:bg-grey-100' => $selected !== $day['n'],
          ])>{{ $day['n'] }}</a>
        @else
          <span class="mx-auto flex size-10 items-center justify-center text-[14px] leading-5 font-semibold font-semibold text-grey-400">{{ $day['n'] }}</span>
        @endif
      @endforeach
    </div>

    <x-button :href="$submitUrl" size="giant" class="mt-4 w-full">Apply</x-button>
  </div>
</x-popup>
