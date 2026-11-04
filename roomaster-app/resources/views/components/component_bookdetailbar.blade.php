{{-- BookDetailBar: bar bawah form Details. active=false → Check Availability abu-abu (nonaktif).
     JS di booking_form menukar tombol saat tanggal terisi. --}}
@props(['active' => false])

<div {{ $attributes->class(['sticky bottom-0 z-30 flex h-[100px] w-full shrink-0 items-start gap-4 rounded-t-[32px] bg-primary-900 px-6 pt-5']) }}>
  <span class="flex size-10 shrink-0 items-center justify-center rounded-full bg-primary-500 text-white">
    <x-icon name="shopping-cart" :size="20" />
  </span>

  <x-button type="button" variant="soft" size="medium" class="w-[101px] shrink-0" data-popup-open="popup-cancelbooking">Cancel</x-button>

  <x-button type="button" variant="secondary" size="medium" :class="'flex-1 '.($active ? '' : 'hidden')"
            data-ca-on data-popup-open="popup-waktu">Check Availability</x-button>
  <x-button type="button" variant="disabled" size="medium" :class="'flex-1 '.($active ? 'hidden' : '')"
            data-ca-off>Check Availability</x-button>
</div>
