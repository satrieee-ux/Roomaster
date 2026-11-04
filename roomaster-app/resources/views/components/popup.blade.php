{{-- Dasar popup. Buka: elemen apa pun dengan data-popup-open="ID". Tutup: data-popup-close, atau klik latar gelap.
     Slot: default (isi), body (pesan kaya/HTML), actions (tombol). stack=true → tombol bertumpuk. --}}
@props([
  'id' => null, 'title' => '', 'message' => null, 'icon' => null, 'tone' => 'primary',
  'open' => true, 'sheet' => false, 'stack' => false,
])
@php
$tones = [
  'primary'   => 'bg-primary-50 text-primary-500',
  'danger'    => 'bg-danger-50 text-danger-500',
  'success'   => 'bg-success-50 text-success-500',
  'secondary' => 'bg-secondary-50 text-secondary-500',
];
$hasSlot = trim((string) $slot) !== '';
@endphp
<div @if($id) id="{{ $id }}" @endif data-popup role="dialog" aria-modal="true"
     @class(['fixed inset-0 z-50 flex justify-center bg-black/50', 'items-end' => $sheet, 'items-center px-5' => ! $sheet, 'hidden' => ! $open])>
  <div @class([
    'w-full bg-grey-50 shadow-card',
    'max-w-[390px] rounded-t-3xl p-6' => $sheet,
    'max-w-[350px] rounded-2xl border border-grey-200 p-6' => ! $sheet,
  ])>
    @if($icon)
      <div class="mx-auto mb-4 flex size-14 items-center justify-center rounded-full {{ $tones[$tone] ?? $tones['primary'] }}">
        <x-icon :name="$icon" :size="28" />
      </div>
    @endif
    @if($title)<h2 class="text-center text-[16px] leading-6 font-semibold text-grey-800">{{ $title }}</h2>@endif
    @if($message)<p class="mt-0.5 text-center text-[14px] leading-5 font-normal text-grey-500">{{ $message }}</p>@endif
    @isset($body)<div class="mt-0.5 text-center text-[14px] leading-5 font-normal text-grey-500">{{ $body }}</div>@endisset
    @if($hasSlot)<div class="{{ ($title || $message || isset($body)) ? 'mt-5' : '' }}">{{ $slot }}</div>@endif
    @isset($actions)
      <div @class(['mt-5 flex', 'flex-col gap-2' => $stack, 'gap-3' => ! $stack])>{{ $actions }}</div>
    @endisset
  </div>
</div>

@once
<script>
  document.addEventListener('click', function (e) {
    var o = e.target.closest('[data-popup-open]');
    if (o) { e.preventDefault(); var p = document.getElementById(o.dataset.popupOpen); if (p) p.classList.remove('hidden'); return; }
    var c = e.target.closest('[data-popup-close]');
    if (c) { e.preventDefault(); var q = c.closest('[data-popup]'); if (q) q.classList.add('hidden'); return; }
    if (e.target.hasAttribute && e.target.hasAttribute('data-popup')) e.target.classList.add('hidden');
  });
</script>
@endonce
