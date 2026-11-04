{{-- Dasar semua popup/modal. Overlay menutupi frame 390x844.
     Buka/tutup: tambahkan atribut id, lalu pakai <a href="#id"> atau JS toggle class "hidden".
     Contoh: <x-popup id="cancel" title="Cancel Booking?" icon="alert-circle" tone="danger"> ... </x-popup> --}}
@props([
  'id' => null,
  'title' => '',
  'message' => null,
  'icon' => null,
  'tone' => 'primary',   {{-- primary | danger | success | secondary --}}
  'open' => true,
  'sheet' => false,      {{-- true = muncul dari bawah (bottom sheet) --}}
])
@php
$tones = [
  'primary'   => 'bg-primary-50 text-primary-500',
  'danger'    => 'bg-danger-50 text-danger-500',
  'success'   => 'bg-success-50 text-success-500',
  'secondary' => 'bg-secondary-50 text-secondary-500',
];
@endphp
<div @if($id) id="{{ $id }}" @endif @class(['fixed inset-0 z-50 flex justify-center bg-black/50 px-6', 'items-end px-0' => $sheet, 'items-center' => ! $sheet, 'hidden' => ! $open])
     role="dialog" aria-modal="true">
  <div @class(['w-full max-w-[390px] bg-white p-6 shadow-card', 'rounded-t-3xl' => $sheet, 'rounded-3xl' => ! $sheet])>
    @if($icon)
      <div class="mx-auto mb-4 flex size-14 items-center justify-center rounded-full {{ $tones[$tone] ?? $tones['primary'] }}">
        <x-icon :name="$icon" :size="28" />
      </div>
    @endif
    @if($title)<h4 class="text-center text-[18px] leading-7 font-semibold font-extrabold text-grey-900">{{ $title }}</h4>@endif
    @if($message)<p class="mt-2 text-center text-[14px] leading-5 font-normal text-grey-600">{{ $message }}</p>@endif
    <div class="{{ ($title || $message) ? 'mt-5' : '' }}">{{ $slot }}</div>
    @isset($actions)
      <div class="mt-6 flex gap-3">{{ $actions }}</div>
    @endisset
  </div>
</div>
