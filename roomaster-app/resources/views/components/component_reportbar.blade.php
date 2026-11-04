{{-- ReportBar: bar bawah sticky form laporan (Cancel + Send). Sudut atas 32px, tinggi 100px. --}}
<div {{ $attributes->class(['sticky bottom-0 z-30 flex h-[100px] w-full shrink-0 items-start gap-4 rounded-t-[32px] bg-primary-900 px-6 pt-5']) }}>
  <x-button type="button" variant="soft" size="medium" class="flex-1" data-popup-open="popup-reportconfirm">Cancel</x-button>
  <x-button type="button" variant="secondary" size="medium" class="flex-1" data-popup-open="popup-reportsend">Send</x-button>
</div>
