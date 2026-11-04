{{-- Header pencarian (gelap, sticky). filters kosong = kolom Search; berisi = kotak chip filter.
     filters: [['icon'=>'users','label'=>'50-99'], ['label'=>'Departemen'], ['icon'=>'air-vent'], ['icon'=>'x','href'=>'/search']] --}}
@props(['back' => null, 'placeholder' => 'Search', 'filters' => [], 'filterId' => 'popup-filter', 'dateId' => 'popup-datepicker'])
@php $back = $back ?? 'javascript:history.back()'; @endphp

<header {{ $attributes->class(['sticky top-0 z-20 shrink-0 rounded-b-[32px] bg-primary-900 pb-5 pt-[66px] text-white']) }}>
  <div class="flex items-center gap-3 px-6">
    @if(count($filters) === 0)
      <label class="flex h-12 min-w-0 flex-1 items-center gap-3 rounded-xl bg-grey-100 px-3 text-grey-500">
        <a href="{{ $back }}" aria-label="Kembali" class="shrink-0"><x-icon name="arrow-left" :size="24" /></a>
        <input type="search" placeholder="{{ $placeholder }}"
               class="min-w-0 flex-1 bg-transparent text-[16px] leading-6 font-normal text-grey-800 outline-none placeholder:text-grey-500">
      </label>
    @else
      <div class="flex min-w-0 flex-1 items-center gap-3 rounded-xl bg-grey-100 p-3">
        <a href="{{ $back }}" aria-label="Kembali" class="shrink-0 text-grey-400"><x-icon name="arrow-left" :size="24" /></a>
        <div class="flex flex-wrap items-center gap-2">
          @foreach($filters as $f)
            @php
              $icon = $f['icon'] ?? null; $lbl = $f['label'] ?? null;
              $cls = ! $lbl ? 'size-10 justify-center' : ($icon ? 'h-10 gap-2 pl-3 pr-4' : 'h-8 px-4');
            @endphp
            <a href="{{ $f['href'] ?? '#' }}" class="inline-flex shrink-0 items-center rounded-full bg-grey-200 text-[12px] leading-4 font-medium text-primary-500 {{ $cls }}">
              @if($icon)<x-icon :name="$icon" :size="24" />@endif
              @if($lbl)<span>{{ $lbl }}</span>@endif
            </a>
          @endforeach
        </div>
      </div>
    @endif

    <div class="flex shrink-0 items-center gap-3">
      <button type="button" data-popup-open="{{ $filterId }}" aria-label="Filter"><x-icon name="list-filter" :size="24" /></button>
      <button type="button" data-popup-open="{{ $dateId }}" aria-label="Pilih tanggal"><x-icon name="calendar" :size="24" /></button>
    </div>
  </div>
</header>
