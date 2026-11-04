@extends('layouts.app')

@section('content')
@php
  $tabs = [
    ['label' => 'About',   'href' => url('/rooms/'.$room['id'])],
    ['label' => 'Reviews', 'href' => url('/rooms/'.$room['id'].'/reviews')],
  ];
@endphp

<div class="flex min-h-full flex-col bg-grey-100">

  {{-- Tombol back & share (sticky, melayang di atas foto) --}}
  <div class="sticky top-0 z-20 h-0">
    <div class="flex items-center justify-between px-6 pt-14">
      <a href="{{ url('/rooms') }}" aria-label="Kembali"
         class="flex size-8 items-center justify-center rounded-full bg-white text-grey-800 shadow-card">
        <x-icon name="arrow-left" :size="20" />
      </a>
      <button type="button" aria-label="Bagikan"
         class="flex size-8 items-center justify-center rounded-full bg-white text-grey-800 shadow-card">
        <x-icon name="share-2" :size="20" />
      </button>
    </div>
  </div>

  {{-- Foto utama + galeri --}}
  <div class="relative h-[359px] shrink-0">
    <img src="{{ asset($room['image']) }}" alt="{{ $room['title'] }}" class="size-full rounded-b-[32px] object-cover">
    <div class="absolute inset-x-5 bottom-5 flex gap-2 rounded-2xl bg-white p-2">
      @foreach($room['gallery'] as $img)
        <div class="relative h-[70px] flex-1 overflow-hidden rounded-lg">
          <img src="{{ asset($img) }}" alt="" class="size-full object-cover">
          @if($loop->last && $room['more'] > 0)
            <span class="absolute inset-0 flex items-center justify-center bg-black/40 text-[12px] leading-4 font-semibold text-white">+{{ $room['more'] }}</span>
          @endif
        </div>
      @endforeach
    </div>
  </div>

  {{-- pb-6 = jarak 24px antara isi terbawah dan tepi atas BookBar saat scroll maksimal --}}
  <main class="flex flex-1 flex-col pb-6">

    {{-- Info ruangan --}}
    <div class="flex flex-col px-6 pt-6">
      <div class="flex items-center justify-between">
        <span class="text-[10px] leading-[14px] font-medium text-primary-500">{{ $room['department'] }}</span>
        <span class="flex items-center gap-2 text-[12px] leading-4 font-medium text-grey-800">
          <x-icon name="star" :size="20" class="fill-current text-secondary-300" />
          {{ $room['rating'] }} ({{ $room['review_count'] }} Reviews)
        </span>
      </div>

      <h1 class="mt-4 text-[24px] leading-7 font-extrabold text-grey-800">{{ $room['title'] }}</h1>

      <div class="mt-1 flex items-center justify-between gap-3">
        <div class="flex items-start gap-1 text-[12px] leading-[18px] font-normal text-grey-800">
          <x-icon name="map-pin" :size="12" class="mt-[3px] shrink-0" />
          <span>{{ $room['address'] }}</span>
        </div>
        <a href="#" aria-label="Petunjuk arah"
           class="flex size-10 shrink-0 items-center justify-center rounded-full bg-primary-900 text-white">
          <x-icon name="navigation" :size="20" />
        </a>
      </div>

      <span class="mt-2 inline-flex w-fit items-center gap-1 rounded-[20px] bg-success-50 px-2 py-1 text-[10px] leading-[14px] font-medium text-success-500">
        <x-icon name="check-circle" :size="12" /> Now Available
      </span>
    </div>

    <x-tabs :items="$tabs" :active="$tab" class="mt-5 px-6" />

    {{-- ====== TAB ABOUT ====== --}}
    @if($tab === 0)
      <div class="mt-4 flex flex-col gap-4 px-6">
        <section class="flex flex-col gap-2">
          <h2 class="text-[18px] leading-7 font-semibold text-primary-800">Facilities</h2>
          <div class="grid grid-cols-3 gap-2.5">
            @foreach($room['facilities'] as $f)
              <div class="flex h-14 flex-col items-center justify-center gap-1 rounded-xl bg-grey-50 text-grey-800">
                <x-icon :name="$f['icon']" :size="20" />
                <span class="text-[12px] leading-4 font-semibold">{{ $f['label'] }}</span>
              </div>
            @endforeach
          </div>
        </section>

        <section class="flex flex-col gap-2">
          <h2 class="text-[18px] leading-7 font-semibold text-primary-800">Description</h2>
          <p class="text-[12px] leading-[18px] font-normal text-grey-800">{{ $room['description'] }}</p>
        </section>

        <div class="flex items-center justify-between gap-3">
          <div class="flex items-center gap-3">
            <span class="relative size-10 shrink-0">
              <img src="{{ asset('images/avatar.jpg') }}" alt="{{ $room['cs']['name'] }}" class="size-10 rounded-full bg-primary-100 object-cover">
              <span class="absolute -bottom-px -right-px size-2.5 rounded-full border-2 border-grey-100 bg-success-500"></span>
            </span>
            <div class="flex flex-col">
              <span class="text-[16px] leading-6 font-semibold text-grey-800">{{ $room['cs']['name'] }}</span>
              <span class="text-[10px] leading-[14px] font-medium text-grey-500">Response Time: {{ $room['cs']['response'] }}</span>
            </div>
          </div>
          <a href="#" aria-label="Chat CS"
             class="flex size-10 shrink-0 items-center justify-center rounded-full bg-grey-100 text-primary-500">
            <x-icon name="message-square" :size="20" />
          </a>
        </div>
      </div>

    {{-- ====== TAB REVIEWS ====== --}}
    @else
      <div class="mt-4 flex flex-col gap-4">
        <section class="flex flex-col gap-2">
          <h2 class="px-6 text-[18px] leading-7 font-semibold text-primary-800">Top Reviews</h2>
          <div class="no-scrollbar -mb-4 flex gap-2 overflow-x-auto px-6 pb-4">
            @foreach($reviews['top'] as $r)
              <x-card_review class="w-[240px] shrink-0"
                :name="$r['name']" :date="$r['date']" :rating="$r['rating']" :comment="$r['comment']" />
            @endforeach
          </div>
        </section>

        <section class="flex flex-col gap-2 px-6">
          <div class="flex items-center justify-between">
            <h2 class="text-[18px] leading-7 font-semibold text-primary-800">Reviews</h2>
            <a href="#" class="flex items-center text-[10px] leading-3 font-semibold text-primary-500">
              See All <x-icon name="chevron-right" :size="16" />
            </a>
          </div>
          <div class="flex flex-col gap-2">
            @foreach($reviews['all'] as $r)
              <x-card_review
                :name="$r['name']" :date="$r['date']" :rating="$r['rating']" :comment="$r['comment']" />
            @endforeach
          </div>
        </section>
      </div>
    @endif
  </main>

  {{-- BookBar: sticky bawah, sudut atas membulat --}}
  <x-component_bookbar :href="url('/booking/'.$room['id'])" />
</div>
@endsection
