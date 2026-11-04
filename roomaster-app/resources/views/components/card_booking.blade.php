{{-- Card booking (daftar booking). status: upcoming|draft|pending|approved|rejected|completed|action_required.
     Tombol utama muncul sesuai status: upcoming => Check-In. Spec: 342x156, pad 12/16, radius 12. --}}
@props([
  'title' => '',
  'date' => '',
  'time' => '',
  'department' => '',
  'image' => null,
  'status' => 'upcoming',
  'href' => '#',
  'primaryHref' => '#',
])
@php
$primary = ['upcoming' => 'Check-In', 'draft' => 'Continue', 'action_required' => 'Revise'][$status] ?? null;
@endphp
<div {{ $attributes->class(['rounded-xl bg-white px-4 py-3 shadow-card']) }}>
  <div class="flex h-[100px] gap-3">
    <img src="{{ $image ? asset($image) : '' }}" alt="" class="size-[72px] shrink-0 rounded-lg bg-grey-200 object-cover">
    <div class="min-w-0 flex-1">
      <div class="flex items-center justify-between gap-2.5">
        <h4 class="truncate text-[16px] leading-6 font-semibold text-grey-800">{{ $title }}</h4>
        <x-status_pill :status="$status" class="shrink-0" />
      </div>
      <ul class="mt-1 space-y-1 text-[10px] leading-[14px] font-medium text-grey-800">
        <li class="flex items-start gap-1"><x-icon name="calendar" :size="12" class="mt-px" /><span class="min-w-0 flex-1">{{ $date }}</span></li>
        <li class="flex items-start gap-1"><x-icon name="clock" :size="12" class="mt-px" /><span class="min-w-0 flex-1">{{ $time }}</span></li>
        <li class="flex items-start gap-1"><x-icon name="map-pin" :size="12" class="mt-px" /><span class="min-w-0 flex-1">{{ $department }}</span></li>
      </ul>
    </div>
  </div>
  <div class="mt-2 flex gap-2.5">
    @if($primary)
      <x-button :href="$primaryHref" size="tiny" class="flex-1">{{ $primary }}</x-button>
    @endif
    <x-button :href="$href" variant="soft" size="tiny" class="flex-1">Details</x-button>
  </div>
</div>
