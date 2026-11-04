{{-- BookBar: bar bawah sticky halaman Room Detail. Book Now (oranye) + tombol favorit bulat.
     <x-component_bookbar :href="url('/booking/1')" /> --}}
@props(['href' => '#', 'favorite' => false])

<div {{ $attributes->class(['sticky bottom-0 z-30 flex h-[100px] w-full shrink-0 items-start gap-4 rounded-t-[32px] bg-primary-900 px-6 pt-5']) }}>
  <x-button :href="$href" variant="secondary" size="medium" class="flex-1">Book Now</x-button>
  <button type="button" aria-label="Favorit"
          class="flex size-10 shrink-0 items-center justify-center rounded-full bg-grey-50 text-primary-500">
    <x-icon name="heart" :size="20" @class(['fill-current' => $favorite]) />
  </button>
</div>
