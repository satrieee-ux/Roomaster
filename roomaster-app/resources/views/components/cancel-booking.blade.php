@props(['id' => 'cancel-booking', 'action' => null])

<x-popup :id="$id" title="Cancel Booking?" layout="stack">
    <x-button size="lg" class="w-full" :href="$action" data-popup-close>Yes</x-button>
    <x-button variant="outline" size="lg" class="w-full" data-popup-close>No</x-button>
</x-popup>
