@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col bg-grey-100 px-6 pb-5 pt-[95px]">
  <svg viewBox="0 0 128 128" class="mx-auto size-[128px]" aria-hidden="true">
    <circle cx="64" cy="64" r="64" fill="#43B75D"/>
    <g transform="translate(32 32) scale(2.6667)" fill="none" stroke="#fff" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
      <path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/>
    </g>
  </svg>

  <h2 class="mt-5 text-center text-[24px] leading-7 font-extrabold text-grey-800">Request Submitted</h2>
  <p class="mt-5 px-3 text-center text-[16px] leading-6 font-normal text-grey-600">
    Your room booking is currently <span class="font-semibold text-grey-800">Pending</span> Review. You will be notified once the administrator approves your request.
  </p>

  <x-activity_timeline class="mt-6 px-5" :items="[
    ['icon' => 'check',          'state' => 'done',    'title' => 'Application Received', 'desc' => 'System verified submission.'],
    ['icon' => 'hourglass',      'state' => 'current', 'title' => 'Pending Review',       'desc' => 'Awaiting TU/Sarpras Admin approval.'],
    ['icon' => 'calendar-check', 'state' => 'todo',    'title' => 'Confirmation',         'desc' => 'Final schedule locked.'],
  ]" />

  <div class="mt-10 flex flex-col gap-2">
    <x-button :href="url('/bookings/'.$id)" variant="secondary" size="large" iconRight="arrow-right" class="w-full">View Booking Details</x-button>
    <x-button :href="url('/menu-utama')" variant="primary" size="large" iconLeft="home" class="w-full">Back to Home</x-button>
  </div>
</div>
@endsection
