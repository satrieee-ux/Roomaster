@props(['id' => 'popup-cancelbooking', 'open' => true, 'yesUrl' => null, 'confirmUrl' => '#', 'room' => null, 'closeUrl' => null])
<x-popup :id="$id" :open="$open" title="Cancel Booking?" :stack="true">
  <x-slot:actions>
    <x-button :href="$yesUrl ?? $confirmUrl" variant="primary" size="large" class="w-full">Yes</x-button>
    <x-button href="#" variant="outline" size="large" class="w-full" data-popup-close>No</x-button>
  </x-slot:actions>
</x-popup>
