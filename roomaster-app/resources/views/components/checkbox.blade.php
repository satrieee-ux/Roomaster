{{-- Checkbox kotak 24px. side: left (kotak di kiri) | right (kotak di kanan). muted: teks abu (checklist). --}}
@props(['name' => null, 'value' => null, 'label' => '', 'checked' => false, 'side' => 'left', 'muted' => false])

<label {{ $attributes->class(['flex cursor-pointer items-center', 'gap-4' => $side === 'left', 'flex-row-reverse justify-between' => $side === 'right']) }}>
  <input type="checkbox" @if($name) name="{{ $name }}" @endif @if($value !== null) value="{{ $value }}" @endif @checked($checked) class="peer sr-only">
  <span class="flex size-6 shrink-0 items-center justify-center rounded-md border-[1.5px] border-primary-500 bg-white text-white peer-checked:bg-primary-500 peer-focus-visible:ring-2 peer-focus-visible:ring-primary-100 [&>svg]:opacity-0 peer-checked:[&>svg]:opacity-100">
    <x-icon name="check" :size="16" :stroke="3" />
  </span>
  <span @class(['text-[14px] leading-5', 'font-medium text-grey-800' => ! $muted, 'font-normal text-grey-600' => $muted])>{{ $label }}</span>
</label>
