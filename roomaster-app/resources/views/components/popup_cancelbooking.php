{{-- Pop-up Cancel Booking. <x-popup_cancelbooking room="SI-4202" /> --}}
@props(['room' => '', 'id' => 'popup-cancelbooking', 'open' => true, 'confirmUrl' => '#', 'closeUrl' => '#'])
<x-popup :id="$id" :open="$open" icon="alert-circle" tone="danger" title="Cancel Booking?"
         :message="'Peminjaman '.($room ?: 'ruangan ini').' akan dibatalkan dan tidak dapat dikembalikan.'">
  <x-slot:actions>
    <x-button :href="$closeUrl" variant="outline" class="flex-1">Keep</x-button>
    <x-button :href="$confirmUrl" class="flex-1 !bg-danger-500 hover:!bg-danger-700">Cancel Booking</x-button>
  </x-slot:actions>
</x-popup>
