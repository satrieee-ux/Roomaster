{{-- Kartu riwayat laporan. issues: [['icon'=>'air-vent','label'=>'Faulty AC'], ...]. Draft → tombol Continue + Details. --}}
@props(['title', 'date', 'department', 'status' => 'pending', 'issues' => [], 'href' => '#', 'continueUrl' => '#'])

<div {{ $attributes->class(['flex flex-col rounded-xl bg-grey-50 px-5 py-4 shadow-card']) }}>
  <div class="flex h-7 items-center justify-between gap-2">
    <h3 class="truncate text-[18px] leading-7 font-semibold text-grey-800">{{ $title }}</h3>
    <x-status_pill :status="$status" class="shrink-0" />
  </div>

  <div class="mt-1 flex flex-col gap-1 text-[10px] leading-[14px] font-medium text-grey-800">
    <div class="flex items-start gap-1"><x-icon name="calendar" :size="12" class="mt-px shrink-0" /><span>{{ $date }}</span></div>
    <div class="flex items-start gap-1"><x-icon name="map-pin" :size="12" class="mt-px shrink-0" /><span>{{ $department }}</span></div>
  </div>

  <div class="mt-3 flex items-center gap-4">
    @foreach($issues as $i)
      <span class="flex items-center gap-2 text-[14px] leading-5 font-normal text-grey-800">
        <x-icon :name="$i['icon']" :size="24" class="text-grey-600" /> {{ $i['label'] }}
      </span>
    @endforeach
  </div>

  <div class="mt-4 flex gap-4">
    @if($status === 'draft')
      <x-button :href="$continueUrl" variant="primary" size="tiny" class="flex-1">Continue</x-button>
    @endif
    <x-button :href="$href" variant="soft" size="tiny" class="flex-1">Details</x-button>
  </div>
</div>
