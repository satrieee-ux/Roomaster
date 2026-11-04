@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col bg-grey-100">
  <x-header_topappbar title="Check-In" :back="url('/menu-utama')" :showHome="false" />

  <main class="flex flex-1 flex-col gap-4 px-6 pb-5 pt-5">
    <h2 class="text-[24px] leading-7 font-extrabold text-grey-800">Check-In Process</h2>

    {{-- Booking Details --}}
    <section class="rounded-xl border border-grey-300 bg-grey-50 px-5 py-4 shadow-card">
      <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Booking Details</h3>
      <div class="mt-2 flex flex-col">
        <div class="flex min-h-10 items-center justify-between">
          <span class="text-[14px] leading-5 font-normal text-grey-500">Guest Name</span>
          <span class="text-[14px] leading-5 font-semibold text-grey-800">{{ $booking['guest'] }}</span>
        </div>
        <div class="flex min-h-10 items-center justify-between border-t border-grey-200">
          <span class="text-[14px] leading-5 font-normal text-grey-500">Room Booked</span>
          <span class="text-[18px] leading-7 font-semibold text-grey-800">{{ $booking['room'] }}</span>
        </div>
        <div class="flex min-h-10 items-center justify-between border-t border-grey-200">
          <span class="text-[14px] leading-5 font-normal text-grey-500">Check-In Date</span>
          <span class="text-[14px] leading-5 font-medium text-grey-800">{{ $booking['date'] }}</span>
        </div>
        <div class="flex min-h-10 items-center justify-between border-t border-grey-200">
          <span class="text-[14px] leading-5 font-normal text-grey-500">Reservation ID</span>
          <span class="text-[14px] leading-5 font-medium text-grey-800">{{ $booking['reservation'] }}</span>
        </div>
      </div>
    </section>

    {{-- Standard Procedure --}}
    <section class="flex gap-3 rounded-xl border border-grey-300 bg-grey-50 p-4 shadow-card">
      <x-icon name="alert-circle" :size="24" class="mt-px shrink-0 text-warning-500" />
      <div class="flex flex-col">
        <h3 class="text-[16px] leading-6 font-medium text-grey-800">Standard Procedure</h3>
        <p class="text-[14px] leading-5 font-normal text-grey-600">
          Please document the initial state of the room before using the room. Any form of failure of compliance will be handled according Roomaster's
          <a href="#" class="font-semibold text-primary-500 underline">user Terms &amp; Conditions.</a>
        </p>
      </div>
    </section>

    <hr class="border-grey-300">

    <h3 class="text-[18px] leading-7 font-semibold text-grey-800">Initial Condition Documentation</h3>
    <x-media_upload />

    <hr class="border-grey-300">

    <div class="flex flex-col gap-2">
      <label for="notes" class="text-[14px] leading-5 font-semibold text-grey-800">Additional Notes</label>
      <textarea id="notes" rows="4" placeholder="Note any existing damages, odors, or missing items here..."
        class="h-[120px] w-full resize-none rounded-lg border border-grey-600 bg-white px-4 py-3 text-[14px] leading-5 font-normal text-grey-800 outline-none placeholder:text-grey-400"></textarea>
    </div>
  </main>

  {{-- Bar bawah sticky --}}
  <div class="sticky bottom-0 z-30 bg-grey-100 px-6 pb-5">
    <div class="flex flex-col gap-3 border-t border-grey-300 pt-4">
      <x-button type="button" variant="primary" size="large" class="w-full" data-popup-open="popup-checkin">Check In</x-button>
      <p class="text-center text-[12px] leading-4 font-normal text-grey-600">By checking in, you agree to the facility usage terms and conditions.</p>
    </div>
  </div>

  <x-popup_checkin :confirmUrl="url('/checkin/'.$booking['id'].'/success')" />
</div>
@endsection
