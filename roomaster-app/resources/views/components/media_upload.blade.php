{{-- Area unggah foto: kartu kamera 320px + 2 kotak 96px (thumbnail, tambah). --}}
@props(['name' => 'photos', 'text' => 'Tap to activate camera or select media'])

<div class="flex flex-col gap-4">
  <label class="relative flex h-[320px] cursor-pointer flex-col items-center justify-center gap-2 overflow-hidden rounded-xl bg-white shadow-card">
    <svg class="absolute inset-0 size-full text-grey-200" preserveAspectRatio="none" aria-hidden="true">
      <line x1="0" y1="0" x2="100%" y2="100%" stroke="currentColor" />
      <line x1="100%" y1="0" x2="0" y2="100%" stroke="currentColor" />
    </svg>
    <x-icon name="camera-plus" :size="40" class="relative text-grey-600" />
    <span class="relative text-[14px] leading-5 font-medium text-grey-600">{{ $text }}</span>
    <input type="file" name="{{ $name }}[]" accept="image/*" capture="environment" class="sr-only">
  </label>

  <div class="flex gap-3">
    <div class="flex size-24 items-center justify-center rounded-lg border border-grey-400 bg-white text-grey-400">
      <x-icon name="image" :size="20" />
    </div>
    <label class="flex size-24 cursor-pointer items-center justify-center rounded-lg border border-dashed border-grey-400 bg-grey-100 text-grey-500">
      <x-icon name="plus" :size="20" />
      <input type="file" name="{{ $name }}[]" accept="image/*" multiple class="sr-only">
    </label>
  </div>
</div>
