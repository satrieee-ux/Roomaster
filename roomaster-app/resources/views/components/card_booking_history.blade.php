{{-- Kartu riwayat booking: foto 80, judul + status_pill, 3 baris info, tombol Details penuh. --}}
@props(['title', 'date', 'time', 'department', 'image', 'status' => 'pending', 'href' => '#'])

<div {{ $attributes->class(['flex flex-col gap-2 rounded-xl bg-white px-4 py-3 shadow-card']) }}>
  <div class="flex h-[100px] gap-3">
    <img src="{{ asset($image) }}" alt="{{ $title }}" class="size-20 shrink-0 rounded-xl object-cover">

    <div class="flex min-w-0 flex-1 flex-col">
      <div class="flex h-6 items-center justify-between gap-2">
        <h3 class="truncate text-[16px] leading-6 font-semibold text-grey-800">{{ $title }}</h3>
        <x-status_pill :status="$status" class="shrink-0" />
      </div>

      <div class="mt-1 flex flex-col gap-1 text-[10px] leading-[14px] font-medium text-grey-800">
        <div class="flex items-start gap-1"><x-icon name="calendar" :size="12" class="mt-px shrink-0" /><span>{{ $date }}</span></div>
        <div class="flex items-start gap-1"><x-icon name="clock" :size="12" class="mt-px shrink-0" /><span>{{ $time }}</span></div>
        <div class="flex items-start gap-1"><x-icon name="map-pin" :size="12" class="mt-px shrink-0" /><span>{{ $department }}</span></div>
      </div>
    </div>
  </div>

  <x-button :href="$href" variant="soft" size="tiny" class="w-full">Details</x-button>
</div>
