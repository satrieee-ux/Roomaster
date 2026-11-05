@extends('layouts.app')

@section('content')
@php
  $quickBook = [
    ['Academic',    'globe'],
    ['Meetings',    'user-round'],
    ['Events',      'users-round'],
    ['Group Study', 'lightbulb'],
    ['Creativity',  'palette'],
  ];
@endphp

<div class="flex min-h-full flex-col bg-grey-100">
  <x-header variant="home" name="Zenkko" :avatar="asset('images/avatar.jpg')"
            searchUrl="/search" chatUrl="/percakapan" notifUrl="/notifikasi" />

  {{-- Jarak header ke konten 24, antar section 16, ujung scroll 20px di atas navbar sticky. --}}
  <main class="flex flex-1 flex-col gap-4 pb-5 pt-6">

    {{-- Upcoming Bookings --}}
    <section class="flex flex-col gap-3 px-6">
      <div class="flex h-6 items-center justify-between">
        <h2 class="text-[18px] leading-7 font-semibold text-primary-800">Upcoming Bookings</h2>
        <x-button href="/bookings" variant="soft" size="tiny" iconRight="chevron-right" class="shrink-0 whitespace-nowrap">See All</x-button>
      </div>
      <x-card_booking
        :title="$upcoming['title']" :date="$upcoming['date']" :time="$upcoming['time']"
        :department="$upcoming['department']" :image="asset($upcoming['image'])"
        status="upcoming" href="/bookings/{{ $upcoming['id'] }}" primaryHref="/checkin/{{ $upcoming['id'] }}" />
    </section>

    {{-- Quick Book: item 88px tanpa gap, scroll horizontal, padding kiri 24px --}}
    <section>
      <h2 class="px-6 text-[18px] leading-7 font-semibold text-primary-800">Quick Book</h2>
      <div class="no-scrollbar flex overflow-x-auto px-6">
        @foreach($quickBook as [$label, $icon])
          <a href="/rooms?category={{ urlencode($label) }}" class="flex w-[88px] shrink-0 flex-col items-center gap-2.5 py-2">
            <span class="flex size-[72px] items-center justify-center rounded-3xl bg-grey-200 text-primary-500">
              <x-icon :name="$icon" :size="36" :stroke="1.5" />
            </span>
            <span class="whitespace-nowrap text-[14px] leading-5 font-medium text-grey-800">{{ $label }}</span>
          </a>
        @endforeach
      </div>
    </section>

    {{-- Recently Booked: card kecil 200px, scroll horizontal --}}
    <section class="flex flex-col gap-3">
      <div class="flex h-6 items-center justify-between px-6">
        <h2 class="text-[16px] leading-6 font-semibold text-primary-800">Recently Booked</h2>
        <x-button href="/rooms" variant="soft" size="tiny" iconRight="chevron-right" class="shrink-0 whitespace-nowrap">See All</x-button>
      </div>
      <div class="no-scrollbar -mb-4 flex items-stretch gap-3 overflow-x-auto px-6 pb-4">
        @foreach($recent as $room)
          <x-card_room class="shrink-0" layout="vertical"
            :title="$room['title']" :department="$room['department']" :capacity="$room['capacity']"
            :image="asset($room['image'])" :favorite="$room['favorite']" href="/rooms/{{ $room['id'] }}" />
        @endforeach
      </div>
    </section>

    {{-- Recommended: card lebar penuh (342) bertumpuk --}}
    <section class="flex flex-col gap-3 px-6">
      <div class="flex h-7 items-center justify-between">
        <h2 class="text-[18px] leading-7 font-semibold text-primary-800">Recommended</h2>
        <x-button href="/rooms" variant="soft" size="tiny" iconRight="chevron-right" class="shrink-0 whitespace-nowrap">See All</x-button>
      </div>
      @foreach($recommended as $room)
        <x-card_room layout="vertical_large"
          :title="$room['title']" :department="$room['department']" :capacity="$room['capacity']"
          :image="asset($room['image'])" :favorite="$room['favorite']" href="/rooms/{{ $room['id'] }}" />
      @endforeach
    </section>
  </main>

  <x-component_navbar active="home" />
</div>
@endsection
