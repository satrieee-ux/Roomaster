@extends('layouts.app')

@section('content')
@php
  $tabs = [
    ['label' => 'All',      'href' => url('/bookings')],
    ['label' => 'Active',   'href' => url('/bookings/active')],
    ['label' => 'Approved', 'href' => url('/bookings/approved')],
    ['label' => 'Pending',  'href' => url('/bookings/pending')],
  ];
@endphp

<div class="flex min-h-full flex-col bg-grey-100">
  <x-header_compact />

  <main class="flex flex-1 flex-col pb-5">
    <div class="flex items-center justify-between px-6 pt-5">
      <h2 class="text-[24px] leading-7 font-extrabold text-primary-800">Your Bookings</h2>
      <button type="button" aria-label="Urutkan" class="flex size-6 items-center justify-center text-primary-500">
        <x-icon name="sort" :size="20" />
      </button>
    </div>

    <x-tabs :items="$tabs" :active="$active" class="mt-3 px-6" />

    <div class="mt-4 flex flex-col gap-4 px-6">
      @foreach($bookings as $b)
        <x-card_booking_history
          :title="$b['title']" :status="$b['status']" :date="$b['date']" :time="$b['time']"
          :department="$b['department']" :image="$b['image']"
          :href="route('bookings.show', $b['id'])" />
      @endforeach
    </div>
  </main>

  <x-component_navbar active="scheduled" />
</div>
@endsection
