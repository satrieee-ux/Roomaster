{{-- Kolom input berlabel. type=password otomatis dapat tombol mata. icon: ikon kanan. Slot "prefix": isi kiri (mis. kode negara). --}}
@props(['label' => null, 'name', 'type' => 'text', 'placeholder' => '', 'value' => null, 'icon' => null])

<label {{ $attributes->class(['flex flex-col gap-1']) }}>
  @if($label)<span class="text-[14px] leading-5 font-normal text-grey-500">{{ $label }}</span>@endif
  <span class="flex h-[46px] items-center gap-3 rounded-xl border border-grey-100 bg-grey-50 px-3 shadow-[0_1px_2px_rgba(20,26,40,0.06)] focus-within:border-primary-500">
    @isset($prefix){{ $prefix }}@endisset
    <input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" @if($value !== null) value="{{ $value }}" @endif
           class="min-w-0 flex-1 bg-transparent text-[14px] leading-5 font-medium text-grey-800 outline-none placeholder:text-grey-500">
    @if($type === 'password')
      <button type="button" aria-label="Tampilkan password" class="shrink-0 text-grey-500"
        onclick="var i=this.closest('label').querySelector('input');i.type=i.type==='password'?'text':'password';this.querySelectorAll('svg').forEach(function(s){s.classList.toggle('hidden')})">
        <x-icon name="eye-off" :size="20" />
        <x-icon name="eye" :size="20" class="hidden" />
      </button>
    @elseif($icon)
      <x-icon :name="$icon" :size="20" class="shrink-0 text-grey-500" />
    @endif
  </span>
</label>
