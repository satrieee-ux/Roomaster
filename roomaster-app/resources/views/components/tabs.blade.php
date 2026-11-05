{{-- Tabs. variant: line (garis bawah, sesuai Tab 5 Tabs) | pill (chip, boleh ada ikon).
     items: array label atau [['label'=>'All','href'=>'/rooms','icon'=>'heart'], ...]; active: index aktif.
     Contoh: <x-tabs variant="pill" :items="['All','SKPB','Dept']" :active="0" /> --}}
@props(['items' => [], 'active' => 0, 'variant' => 'line'])
@php
$items = collect($items)->map(fn ($i) => is_array($i) ? $i : ['label' => $i, 'href' => '#'])->values();
@endphp
@if($variant === 'pill')
  <nav {{ $attributes->class(['no-scrollbar -my-1 flex items-center gap-2 overflow-x-auto px-6 py-1']) }}>
    @foreach($items as $i => $item)
      @php $icon = $item['icon'] ?? null; @endphp
      <a href="{{ $item['href'] ?? '#' }}" @class([
        'inline-flex shrink-0 items-center whitespace-nowrap rounded-full text-[12px] leading-4 font-medium',
        'h-8 gap-1.5 px-4' => $icon,
        'h-8 px-4' => ! $icon,
        'bg-primary-800 text-white shadow-[0_0_12px_rgba(59,123,160,0.5)]' => $i === $active,
        'bg-grey-200 text-primary-500' => $i !== $active,
      ])>
        @if($icon)<x-icon :name="$icon" :size="16" />@endif
        {{ $item['label'] }}
      </a>
    @endforeach
  </nav>
@else
  <nav {{ $attributes->class(['flex border-b border-grey-300']) }}>
    @foreach($items as $i => $item)
      <a href="{{ $item['href'] ?? '#' }}" @class([
        'relative flex h-10 flex-1 items-center justify-center text-[14px] leading-5 font-semibold',
        'text-grey-900' => $i === $active,
        'text-grey-400' => $i !== $active,
      ])>
        {{ $item['label'] }}
        @if($i === $active)<span class="absolute inset-x-0 -bottom-px h-[3px] rounded-t-full bg-primary-800"></span>@endif
      </a>
    @endforeach
  </nav>
@endif
