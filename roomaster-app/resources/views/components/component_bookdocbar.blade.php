{{-- BookDocBar: bar bawah dengan satu tombol Continue. active=false → abu-abu.
     submit=true → mengirim form; selain itu pakai href. JS di doc_upload menukar tombol otomatis. --}}
@props(['active' => false, 'href' => '#', 'label' => 'Continue', 'submit' => false])

<div {{ $attributes->class(['sticky bottom-0 z-30 flex h-[100px] w-full shrink-0 items-start rounded-t-[32px] bg-primary-900 px-6 pt-5']) }}>
  @if($submit)
    <x-button type="submit" variant="secondary" size="medium" :class="'w-full '.($active ? '' : 'hidden')" data-docbar-on>{{ $label }}</x-button>
  @else
    <x-button :href="$href" variant="secondary" size="medium" :class="'w-full '.($active ? '' : 'hidden')" data-docbar-on>{{ $label }}</x-button>
  @endif
  <x-button type="button" variant="disabled" size="medium" :class="'w-full '.($active ? 'hidden' : '')" data-docbar-off>{{ $label }}</x-button>
</div>
