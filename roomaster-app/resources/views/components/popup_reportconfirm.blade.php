{{-- Pop-up "Save as Draft?" saat Cancel di form laporan. Yes = simpan draft, No = buang. --}}
@props(['id' => 'popup-reportconfirm', 'open' => false, 'yesUrl' => '#', 'noUrl' => '#'])
<x-popup :id="$id" :open="$open" title="Save as Draft?" :stack="true">
  <x-slot:body>Draft your reports before cancelling to continue right where you left off.</x-slot:body>
  <x-slot:actions>
    <x-button :href="$yesUrl" variant="primary" size="large" class="w-full">Yes</x-button>
    <x-button :href="$noUrl" variant="outline" size="large" class="w-full">No</x-button>
  </x-slot:actions>
</x-popup>
