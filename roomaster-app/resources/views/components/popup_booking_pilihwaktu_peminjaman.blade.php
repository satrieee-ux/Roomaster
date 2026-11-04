{{-- Sheet Choose Time. booked/selected = array jam (8–19). submit=true → setelah Apply, form #booking-form dikirim.
     Dibuka dengan atribut data-popup-open="popup-waktu". --}}
@props(['id' => 'popup-waktu', 'room' => 'SI-4202', 'dateLabel' => '—', 'booked' => [9, 11, 13, 14, 19], 'selected' => [], 'submit' => false, 'open' => false])
@php
$groups = [
  ['Morning',   'sunrise', [8, 9, 10, 11]],
  ['Afternoon', 'sun',     [12, 13, 14, 15]],
  ['Evening',   'moon',    [16, 17, 18, 19]],
];
@endphp

@once
<style>
  @keyframes sheet-up   { from { transform: translateY(100%); } to { transform: translateY(0); } }
  @keyframes sheet-fade { from { opacity: 0; } to { opacity: 1; } }
  #popup-tanggal, #popup-waktu, [role="dialog"].items-end { animation: sheet-fade .2s ease-out; }
  #popup-tanggal > div:last-child, #popup-waktu > div:last-child, [role="dialog"].items-end > div:last-child {
    animation: sheet-up .3s cubic-bezier(.22, 1, .36, 1);
  }
</style>
@endonce

<x-popup :id="$id" :open="$open" :sheet="true">
  <div id="{{ $id }}-body" data-submit="{{ $submit ? 1 : 0 }}" class="max-h-[calc(100dvh-80px)] overflow-y-auto overflow-x-hidden pb-2 no-scrollbar">
    <div class="relative flex items-center justify-center border-b border-grey-200 pb-3">
      <span class="text-[14px] leading-5 font-medium text-grey-800">Choose Time</span>
      <button type="button" data-popup-close aria-label="Tutup" class="absolute right-0 text-primary-500"><x-icon name="x" :size="24" /></button>
    </div>

    <h3 class="mt-4 text-[24px] leading-7 font-extrabold text-grey-800">{{ $room }}</h3>
    <p data-date-label class="text-[12px] leading-4 font-semibold text-grey-600">{{ $dateLabel }}</p>

    <div class="mt-5 flex items-center gap-4 text-[14px] leading-5 font-normal text-grey-600">
      <span class="flex items-center gap-2"><span class="size-4 rounded border border-grey-300 bg-grey-100"></span>Available</span>
      <span class="flex items-center gap-2"><span class="size-4 rounded bg-primary-900"></span>Selected</span>
      <span class="flex items-center gap-2"><span class="size-4 rounded bg-secondary-500"></span>Booked</span>
    </div>

    @foreach($groups as [$title, $icon, $hours])
      <div @class(['flex items-center gap-2 text-grey-600', 'mt-6' => $loop->first, 'mt-7' => ! $loop->first])>
        <x-icon :name="$icon" :size="20" />
        <span class="text-[12px] leading-4 font-medium uppercase tracking-wider">{{ $title }}</span>
        <span class="h-px flex-1 bg-grey-200"></span>
      </div>
      <div class="mt-3 grid grid-cols-2 gap-x-2 gap-y-4">
        @foreach($hours as $h)
          @php $isBooked = in_array($h, $booked); @endphp
          <label @class(['block', 'cursor-pointer' => ! $isBooked, 'cursor-not-allowed' => $isBooked])>
            <input type="checkbox" class="peer sr-only" data-hour="{{ $h }}" @disabled($isBooked) @checked(in_array($h, $selected))>
            <span @class([
              'flex h-12 items-center justify-center rounded-full text-[16px] leading-6 font-medium',
              'bg-secondary-500 text-white' => $isBooked,
              'bg-grey-200 text-grey-800 peer-checked:bg-primary-900 peer-checked:text-white' => ! $isBooked,
            ])>{{ $h }}:00</span>
          </label>
        @endforeach
      </div>
    @endforeach

    <x-button type="button" variant="primary" size="medium" class="mt-8 w-full" data-time-apply>Apply</x-button>
  </div>
</x-popup>

<script>
  (function () {
    var root = document.getElementById('{{ $id }}');
    if (!root) return;
    var pad = function (h) { return (h < 10 ? '0' : '') + h + ':00'; };
    root.querySelector('[data-time-apply]').addEventListener('click', function () {
      var hs = [].slice.call(root.querySelectorAll('input[data-hour]:checked')).map(function (i) { return +i.dataset.hour; });
      if (!hs.length) return;
      var v = pad(Math.min.apply(null, hs)) + ' - ' + pad(Math.max.apply(null, hs) + 1);
      document.querySelectorAll('input[name=time]').forEach(function (i) { i.value = v; });
      document.querySelectorAll('[data-time-label]').forEach(function (e) { e.textContent = v; });
      root.classList.add('hidden');
      if (document.getElementById('{{ $id }}-body').dataset.submit === '1') {
        document.getElementById('booking-form').submit();
      }
    });
  })();
</script>
