{{-- Pop-up konfirmasi laporan kerusakan. --}}
@props(['id' => 'popup-reportconfirm', 'open' => true, 'confirmUrl' => '#', 'closeUrl' => '#'])
<x-popup :id="$id" :open="$open" icon="alert-circle" tone="secondary" title="Kirim Laporan?"
         message="Laporan kerusakan akan dikirim ke admin dan tidak dapat diubah setelah dikirim.">
  <x-slot:actions>
    <x-button :href="$closeUrl" variant="outline" class="flex-1">Back</x-button>
    <x-button :href="$confirmUrl" class="flex-1">Submit</x-button>
  </x-slot:actions>
</x-popup>
