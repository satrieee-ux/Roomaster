{{-- Pop-up Check-Out: "Are you sure?". --}}
@props(['id' => 'popup-checkout', 'open' => false, 'confirmUrl' => '#'])
<x-popup :id="$id" :open="$open" title="Are you sure?" :stack="true">
  <x-slot:body>
    Before proceeding, make sure that your check-out is aligned with Roomasters’
    <a href="#" class="font-semibold text-primary-500 underline">Terms and Conditions.</a>
  </x-slot:body>
  <x-slot:actions>
    <x-button :href="$confirmUrl" variant="primary" size="large" class="w-full">Proceed</x-button>
    <x-button href="#" variant="outline" size="large" class="w-full" data-popup-close>Cancel</x-button>
  </x-slot:actions>
</x-popup>
