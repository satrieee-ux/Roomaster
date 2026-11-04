{{-- Kartu berkas terunggah. removable=false untuk menyembunyikan tombol hapus. --}}
@props(['name' => '', 'size' => '', 'removable' => true])

<div {{ $attributes->class(['flex items-center gap-4 rounded-xl border border-grey-300 bg-grey-50 p-4']) }}>
  <span class="flex size-10 shrink-0 items-center justify-center rounded-lg border border-grey-300 bg-grey-100 text-grey-600">
    <x-icon name="file-text" :size="20" />
  </span>
  <div class="flex min-w-0 flex-1 flex-col">
    <span data-doc-name class="truncate text-[14px] leading-5 font-medium text-grey-800">{{ $name }}</span>
    <span class="text-[12px] leading-4 font-medium text-grey-500"><span data-doc-size>{{ $size }}</span> • Upload complete</span>
  </div>
  @if($removable)
    <button type="button" data-doc-remove aria-label="Hapus berkas" class="shrink-0 text-grey-800">
      <x-icon name="trash-2" :size="20" />
    </button>
  @endif
</div>
