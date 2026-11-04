@extends('layouts.app')

@section('content')
@php
$card = 'rounded-xl border border-grey-300 bg-grey-50 px-5 pb-5 pt-4 shadow-card';
$k = 'text-[14px] leading-5 font-medium text-grey-500';
@endphp

<div class="flex min-h-full flex-col bg-grey-100">
  <x-header_topappbar title="Booking" endIcon="x" :endUrl="url('/rooms/'.$id)" />

  <main class="flex flex-1 flex-col px-6 pb-5 pt-5">
    <x-booking_stepper :step="3" />

    <div class="mt-4 flex items-end justify-between">
      <h2 class="text-[24px] leading-7 font-extrabold text-grey-800">Room Details</h2>
      <span class="pb-1 text-[10px] leading-[14px] font-medium text-grey-500">Booking #{{ $booking['code'] }}</span>
    </div>

    <div class="mt-4 flex flex-col gap-4">
      {{-- Facility Information --}}
      <section class="{{ $card }}">
        <h3 class="text-[16px] leading-6 font-medium text-grey-800">Facility Information</h3>
        <div class="mt-4 flex flex-col gap-4">
          <div class="flex flex-col gap-2">
            <span class="{{ $k }}">Room Name</span>
            <span class="text-[16px] leading-6 font-semibold text-grey-800">{{ $booking['room'] }}</span>
          </div>
          <div class="flex flex-col gap-2">
            <span class="{{ $k }}">Location</span>
            <span class="text-[14px] leading-5 font-medium text-grey-800">{{ $booking['location'] }}</span>
          </div>
          <div class="flex flex-col gap-2">
            <span class="{{ $k }}">Capacity</span>
            <span class="flex items-center gap-2 text-[14px] leading-5 font-medium text-grey-800"><x-icon name="users" :size="20" /> {{ $booking['capacity'] }}</span>
          </div>
          <div class="flex flex-col gap-2">
            <span class="{{ $k }}">Facilities Included</span>
            <div class="grid grid-cols-2 gap-4">
              @foreach($booking['facilities'] as $f)
                <span class="flex items-center gap-2 text-[14px] leading-5 font-medium text-grey-800"><x-icon :name="$f['icon']" :size="20" /> {{ $f['label'] }}</span>
              @endforeach
            </div>
          </div>
        </div>
      </section>

      {{-- Schedule --}}
      <section class="{{ $card }}">
        <h3 class="text-[18px] leading-7 font-medium text-grey-800">Schedule</h3>
        <div class="mt-4 flex flex-col gap-4">
          <div class="flex flex-col gap-2">
            <span class="{{ $k }}">Date</span>
            <span class="text-[16px] leading-6 font-semibold text-grey-800">{{ $booking['date'] }}</span>
          </div>
          <div class="flex flex-col gap-2">
            <span class="{{ $k }}">Time</span>
            <span class="text-[16px] leading-6 font-semibold text-grey-800">{{ $booking['time'] }}</span>
          </div>
        </div>
      </section>

      {{-- Activity Details --}}
      <section class="{{ $card }}">
        <h3 class="text-[18px] leading-7 font-medium text-grey-800">Activity Details</h3>
        <div class="mt-4 flex flex-col gap-4">
          <div class="flex flex-col gap-2">
            <span class="{{ $k }}">Activity Name</span>
            <span class="text-[16px] leading-6 font-semibold text-grey-800">{{ $booking['activity_name'] }}</span>
          </div>
          <div class="flex flex-col gap-2">
            <span class="{{ $k }}">Description</span>
            <p class="text-[14px] leading-5 font-normal text-grey-800">{{ $booking['description'] }}</p>
          </div>
        </div>
      </section>

      {{-- Supporting Documents --}}
      <section class="{{ $card }}">
        <div class="flex items-center justify-between">
          <h3 class="text-[18px] leading-7 font-medium text-grey-800">Supporting Documents</h3>
          <a href="{{ url('/booking/'.$id.'/dokumen/terunggah') }}" aria-label="Ubah dokumen" class="text-grey-800"><x-icon name="pencil" :size="20" /></a>
        </div>
        <div class="mt-4 flex flex-col gap-4">
          @foreach($booking['documents'] as $doc)
            <x-file_card :name="$doc['name']" :size="$doc['size']" />
          @endforeach
        </div>
      </section>
    </div>

    <div class="mt-4 border-t border-grey-200 pt-4">
      <div class="flex flex-col gap-2">
        <x-button type="button" variant="primary" size="large" class="w-full" data-popup-open="popup-prebook">Finish Booking</x-button>
        <x-button type="button" variant="secondary" size="large" class="w-full" data-popup-open="popup-cancelbooking">Cancel</x-button>
      </div>
      <p class="mt-3 px-6 text-center text-[12px] leading-4 font-medium text-grey-500">By submitting, you agree to the facility usage terms and conditions.</p>
    </div>
  </main>

  <x-popup_prebook :open="false" :proceedUrl="url('/booking/'.$id.'/berhasil')" />
  <x-popup_cancelbooking :open="false" :yesUrl="url('/rooms/'.$id)" />
</div>
@endsection
