{{-- Pop-up Check-Out. --}}
@props(['room' => '', 'id' => 'popup-checkout', 'open' => true, 'confirmUrl' => '#', 'closeUrl' => '#'])
<x-popup :id="$id" :open="$open" icon="door-open" tone="primary" title="Check-Out Sekarang?"
         :message="'Pastikan '.($room ?: 'ruangan').' sudah rapi dan barang Anda tidak tertinggal.'">
  <x-slot:actions>
    <x-button :href="$closeUrl" variant="outline" class="flex-1">Cancel</x-button>
    <x-button :href="$confirmUrl" class="flex-1">Check-Out</x-button>
  </x-slot:actions>
</x-popup>
