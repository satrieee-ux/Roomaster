{{-- BookBar: bar bawah sticky di Room Detail (Book Now + favorit).
     Sudut atas membulat 32px (sama dengan header). Tinggi 100px.
     Pakai: <x-component_bookbar :href="url('/booking')" :favorite="false" /> --}}
@props(['href' => '#', 'favorite' => false, 'favUrl' => '#'])

<div {{ $attributes->class(['sticky bottom-0 z-30 flex h-[100px] w-full shrink-0 items-start gap-4 rounded-t-[32px] bg-primary-900 px-6 pt-5']) }}>
  <x-button :href="$href" variant="secondary" size="medium" class="flex-1">Book Now</x-button>

  <a href="{{ $favUrl }}" aria-label="Favorit" aria-pressed="{{ $favorite ? 'true' : 'false' }}"
     class="flex size-10 shrink-0 items-center justify-center rounded-full bg-grey-50 text-primary-500">
    <x-icon name="heart" :size="20" :class="$favorite ? 'fill-current' : ''" />
  </a>
</div>
