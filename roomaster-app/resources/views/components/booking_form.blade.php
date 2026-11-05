{{-- Form Booking langkah 1 (Details). state: empty (tanggal kosong) | date (tanggal terisi) | time (tanggal + waktu).
     <x-booking_form :id="1" room="SI-4202" state="date" date="2026-05-20" /> --}}
@props(['id' => 1, 'room' => 'SI-4202', 'state' => 'empty', 'date' => null, 'time' => null,
        'activity' => null, 'purpose' => null, 'department' => null])
@php
$showTime = $state === 'time';
$d        = $date ? \Illuminate\Support\Carbon::parse($date) : null;
$hasDate  = (bool) $d;
$short    = $d?->format('d/m/y');
$long     = $d?->format('j F Y') ?? '—';
$time     = $time ?: ($showTime ? '15:00 - 17:00' : null);
$timeSel  = [];
if ($time && preg_match('/(\d{1,2}):00\s*-\s*(\d{1,2}):00/', $time, $m)) {
  $timeSel = range((int) $m[1], (int) $m[2] - 1);
}
$departments = ['Departemen Sistem Informasi', 'Departemen Teknik Informatika', 'Departemen Teknik Elektro', 'Departemen Teknik Mesin', 'Departemen Perencanaan Wilayah dan Kota'];
$field = 'rounded-xl border border-grey-200 bg-grey-50 px-3 shadow-[0_1px_2px_rgba(20,26,40,0.04)] outline-none focus:border-primary-500';
$label = 'text-[14px] leading-5 font-semibold text-grey-800';
@endphp

<div class="flex min-h-full flex-col bg-grey-100">
  <x-header_topappbar title="Booking" endIcon="x" :endUrl="url('/rooms/'.$id)" />

  <form id="booking-form" method="GET" class="flex flex-1 flex-col"
        action="{{ $showTime ? url('/booking/'.$id.'/dokumen') : url('/booking/'.$id.'/waktu') }}">
    <main class="flex flex-1 flex-col px-6 pb-5 pt-[22px]">
      <h2 class="text-[24px] leading-7 font-extrabold text-grey-800">Details</h2>
      <x-booking_stepper :step="1" class="mt-4" />

      <div class="mt-8 flex flex-col gap-2.5">
        <label for="activity" class="{{ $label }}">Activity Name</label>
        <input id="activity" name="activity" type="text" value="{{ $activity }}" placeholder="e.g. Weekly Meeting"
               class="h-[42px] w-full {{ $field }} text-[14px] leading-5 font-normal text-grey-800 placeholder:text-grey-500">

        <label for="purpose" class="{{ $label }}">Purpose</label>
        <textarea id="purpose" name="purpose" placeholder="Briefly describe the purpose of the booking"
                  class="h-[106px] w-full resize-none {{ $field }} py-3 text-[14px] leading-5 font-normal text-grey-800 placeholder:text-grey-500">{{ $purpose }}</textarea>

        <span class="{{ $label }}">Department</span>
        <x-dropdown_departemen name="department" :value="$department" />

        <span class="{{ $label }}">Date</span>
        <button type="button" data-date-open data-popup-open="popup-tanggal" class="flex h-[46px] items-center gap-3 text-left {{ $field }}">
          <x-icon name="calendar" :size="24" class="shrink-0 text-grey-500" />
          <span data-date-text @class(['text-[16px] leading-6 font-normal', 'text-grey-800' => $hasDate, 'text-grey-500' => ! $hasDate])>{{ $short ?? 'DD/MM/YY' }}</span>
        </button>
        <input type="hidden" name="date" value="{{ $d?->format('Y-m-d') }}">

        <input type="hidden" name="time" value="{{ $time }}">
        @if($showTime)
          <span class="{{ $label }}">Time</span>
          <button type="button" data-popup-open="popup-waktu" class="flex h-[46px] items-center gap-3 text-left {{ $field }}">
            <x-icon name="clock" :size="24" class="shrink-0 text-grey-500" />
            <span data-time-label class="text-[16px] leading-6 font-normal text-grey-800">{{ $time }}</span>
          </button>
        @endif
      </div>

      @unless($showTime)
        <div class="mt-8 flex gap-3 rounded-xl border border-grey-300 bg-grey-50 p-4 shadow-card">
          <x-icon name="info" :size="20" class="mt-0.5 shrink-0 text-warning-500" />
          <div class="flex flex-col">
            <span class="text-[16px] leading-6 font-medium text-grey-800">Availability Status</span>
            <span class="text-[14px] leading-5 font-normal text-grey-600">Please fill in the date above to</span>
            <button type="button" data-avail-link class="w-fit text-left text-[14px] leading-5 font-semibold text-primary-500 underline">check room availability.</button>
          </div>
        </div>
      @endunless
    </main>

    @if($showTime)
      <x-component_bookdocbar :active="true" :submit="true" />
    @else
      <x-component_bookdetailbar :active="$hasDate" />
    @endif
  </form>

  <x-popup_booking_pilihtanggal :value="$d?->format('Y-m-d')" />
  <x-popup_booking_pilihwaktu_peminjaman :room="$room" :dateLabel="$long" :selected="$timeSel" :submit="! $showTime" />
  <x-popup_cancelbooking :open="false" :yesUrl="url('/rooms/'.$id)" />
</div>

<script>
  (function () {
    var f = document.getElementById('booking-form');
    var link = f && f.querySelector('[data-avail-link]');
    if (!link) return;
    link.addEventListener('click', function () {
      var hasDate = f.querySelector('input[name=date]').value;
      var target = hasDate ? f.querySelector('[data-ca-on]') : f.querySelector('[data-date-open]');
      if (target) target.click();
    });
  })();
</script>
