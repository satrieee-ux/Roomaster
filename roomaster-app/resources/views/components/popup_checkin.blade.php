{{-- Pop-up Check-In. --}}
@props(['room' => '', 'id' => 'popup-checkin', 'open' => true, 'confirmUrl' => '#', 'closeUrl' => '#'])
<x-popup :id="$id" :open="$open" icon="door-open" tone="secondary" title="Check-In Sekarang?"
         :message="'Sesi '.($room ?: 'peminjaman').' akan dimulai setelah Anda check-in.'">
  <x-slot:actions>
    <x-button :href="$closeUrl" variant="outline" class="flex-1">Cancel</x-button>
    <x-button :href="$confirmUrl" class="flex-1">Check-In</x-button>
  </x-slot:actions>
</x-popup>
