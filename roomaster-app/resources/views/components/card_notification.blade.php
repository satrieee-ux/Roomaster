{{-- Kartu notifikasi. type: action | approved | timelimit | unfinished | system.
     actions: [['label'=>'Update','href'=>'#'], ['label'=>'Details','href'=>'#']] (pertama primary, kedua soft) --}}
@props(['type' => 'system', 'title', 'time', 'message', 'actions' => []])
@php
$map = [
  'action'     => ['alert-circle', 'bg-secondary-100 text-secondary-500'],
  'approved'   => ['check-circle', 'bg-success-100 text-success-500'],
  'timelimit'  => ['clock',        'bg-warning-100 text-warning-500'],
  'unfinished' => ['file',         'bg-primary-100 text-primary-500'],
  'system'     => ['bell',         'bg-grey-200 text-grey-500'],
];
[$icon, $cls] = $map[$type] ?? $map['system'];
@endphp

<div {{ $attributes->class(['flex gap-2.5 rounded-xl bg-grey-50 px-5 py-4 shadow-card']) }}>
  <span class="flex size-12 shrink-0 items-center justify-center rounded-full {{ $cls }}">
    <x-icon :name="$icon" :size="24" />
  </span>

  <div class="flex min-w-0 flex-1 flex-col">
    <div class="flex items-center justify-between gap-2">
      <h3 class="truncate text-[16px] leading-6 font-semibold text-grey-800">{{ $title }}</h3>
      <span class="shrink-0 text-[12px] leading-4 font-normal text-grey-800/80">{{ $time }}</span>
    </div>
    <p class="mt-0.5 text-[12px] leading-4 font-normal text-grey-800/80">{{ $message }}</p>

    @if(count($actions))
      <div class="mt-4 flex gap-3">
        @foreach($actions as $a)
          <x-button :href="$a['href'] ?? '#'" :variant="$loop->first ? 'primary' : 'soft'" size="tiny" class="flex-1">{{ $a['label'] }}</x-button>
        @endforeach
      </div>
    @endif
  </div>
</div>
