{{-- Pop-up preBook: konfirmasi sebelum pengajuan dikirim. --}}
@props(['id' => 'popup-prebook', 'open' => true, 'confirmUrl' => '#', 'closeUrl' => '#'])
<x-popup :id="$id" :open="$open" icon="calendar-check" tone="primary" title="Ajukan Peminjaman?"
         message="Pastikan tanggal, waktu, dan dokumen sudah benar sebelum pengajuan dikirim ke admin.">
  <x-slot:actions>
    <x-button :href="$closeUrl" variant="outline" class="flex-1">Back</x-button>
    <x-button :href="$confirmUrl" class="flex-1">Proceed</x-button>
  </x-slot:actions>
</x-popup>
