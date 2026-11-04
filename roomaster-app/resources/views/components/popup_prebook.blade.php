{{-- Pop-up preBook: konfirmasi sebelum mengirim pengajuan. Proceed → proceedUrl, Cancel → tutup. --}}
@props(['id' => 'popup-prebook', 'open' => false, 'proceedUrl' => null, 'confirmUrl' => '#', 'termsUrl' => '#'])
<x-popup :id="$id" :open="$open" title="Are you sure?" :stack="true">
  <x-slot:body>Before proceeding, make sure that your booking is aligned with Roomasters’ <a href="{{ $termsUrl }}" class="font-semibold text-primary-500 underline">Terms and Conditions.</a></x-slot:body>
  <x-slot:actions>
    <x-button :href="$proceedUrl ?? $confirmUrl" variant="primary" size="large" class="w-full">Proceed</x-button>
    <x-button href="#" variant="outline" size="large" class="w-full" data-popup-close>Cancel</x-button>
  </x-slot:actions>
</x-popup>
