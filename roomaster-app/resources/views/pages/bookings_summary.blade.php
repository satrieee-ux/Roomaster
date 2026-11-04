@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col bg-grey-100">
  <x-header_topappbar title="Booking Summary" :back="url('/bookings')" />

  <main class="flex flex-1 flex-col gap-4 px-6 pb-5 pt-5">

    <x-status_banner :status="$booking['status']" :updated="$booking['updated']" />

    {{-- Facility Information --}}
    <section class="rounded-xl border border-grey-200 bg-grey-50 p-5">
      <div class="flex items-center justify-between">
        <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Facility Information</h3>
        <span class="text-[10px] leading-[14px] font-medium text-grey-500">Booking #{{ $booking['code'] }}</span>
      </div>
      <div class="mt-4 flex flex-col gap-5">
        <div class="flex flex-col gap-1">
          <span class="text-[14px] leading-5 font-semibold text-grey-500">Room Name</span>
          <span class="text-[18px] leading-7 font-semibold text-grey-800">{{ $booking['room'] }}</span>
        </div>
        <div class="flex flex-col gap-1">
          <span class="text-[14px] leading-5 font-semibold text-grey-500">Location</span>
          <span class="text-[14px] leading-5 font-normal text-grey-800">{{ $booking['location'] }}</span>
        </div>
        <div class="flex flex-col gap-1">
          <span class="text-[14px] leading-5 font-semibold text-grey-500">Capacity</span>
          <span class="flex items-center gap-2 text-[14px] leading-5 font-normal text-grey-800">
            <x-icon name="users" :size="20" /> {{ $booking['capacity'] }}
          </span>
        </div>
        <div class="flex flex-col gap-1">
          <span class="text-[14px] leading-5 font-semibold text-grey-500">Facilities Included</span>
          <div class="grid grid-cols-2 gap-2">
            @foreach($booking['facilities'] as $f)
              <span class="flex h-6 items-center gap-2 text-[14px] leading-5 font-normal text-grey-800">
                <x-icon :name="$f['icon']" :size="20" /> {{ $f['label'] }}
              </span>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    {{-- Schedule --}}
    <section class="rounded-xl border border-grey-200 bg-grey-50 p-5">
      <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Schedule</h3>
      <div class="mt-4 flex flex-col gap-5">
        <div class="flex flex-col gap-1">
          <span class="text-[14px] leading-5 font-semibold text-grey-500">Date</span>
          <span class="text-[16px] leading-6 font-normal text-grey-800">{{ $booking['date'] }}</span>
        </div>
        <div class="flex flex-col gap-1">
          <span class="text-[14px] leading-5 font-semibold text-grey-500">Time</span>
          <span class="text-[16px] leading-6 font-normal text-grey-800">{{ $booking['time'] }}</span>
        </div>
      </div>
    </section>

    {{-- Recent Activity --}}
    <section class="rounded-xl border border-grey-200 bg-grey-50 p-5">
      <h3 class="text-[18px] leading-7 font-semibold text-grey-800">Recent Activity</h3>
      <div class="mt-4 flex flex-col">
        @foreach($booking['activity'] as $a)
          <div @class(['relative flex items-center gap-3', 'pb-8' => ! $loop->last])>
            <span @class([
              'z-10 flex size-12 shrink-0 items-center justify-center rounded-full',
              'bg-primary-900 text-white' => $a['done'],
              'border border-grey-300 bg-grey-50 text-grey-500' => ! $a['done'],
            ])>
              <x-icon :name="$a['icon']" :size="20" />
            </span>
            @unless($loop->last)
              <span class="absolute left-6 top-12 h-8 w-0.5 -translate-x-1/2 bg-grey-300"></span>
            @endunless
            <div class="flex min-w-0 flex-col">
              <span class="text-[14px] leading-5 font-semibold text-grey-800">{{ $a['title'] }}</span>
              <span class="text-[12px] leading-4 font-medium text-grey-500">{{ $a['desc'] }}</span>
            </div>
          </div>
        @endforeach
      </div>
    </section>

    {{-- Activity Details --}}
    <section class="rounded-xl border border-grey-200 bg-grey-50 p-5">
      <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Activity Details</h3>
      <div class="mt-4 flex flex-col gap-5">
        <div class="flex flex-col gap-1">
          <span class="text-[14px] leading-5 font-semibold text-grey-500">Activity Name</span>
          <span class="text-[16px] leading-6 font-semibold text-grey-800">{{ $booking['activity_name'] }}</span>
        </div>
        <div class="flex flex-col gap-1">
          <span class="text-[14px] leading-5 font-semibold text-grey-500">Description</span>
          <p class="text-[14px] leading-5 font-normal text-grey-800">{{ $booking['description'] }}</p>
        </div>
      </div>
    </section>

    {{-- Supporting Documents --}}
    <section class="rounded-xl border border-grey-200 bg-grey-50 p-5">
      <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Supporting Documents</h3>
      <div class="mt-4 flex flex-col gap-4">
        @foreach($booking['documents'] as $d)
          <div class="flex items-center gap-3 rounded-xl border border-grey-300 bg-grey-50 p-3">
            <span class="flex size-12 shrink-0 items-center justify-center rounded-lg border border-grey-300 bg-grey-100 text-grey-500">
              <x-icon name="file-text" :size="24" />
            </span>
            <div class="flex min-w-0 flex-col">
              <span class="truncate text-[14px] leading-5 font-medium text-grey-800">{{ $d['name'] }}</span>
              <span class="text-[12px] leading-4 font-normal text-grey-500">{{ $d['size'] }} • Upload complete</span>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  </main>

  {{-- Bar bawah sticky --}}
  <div class="sticky bottom-0 z-30 flex flex-col gap-3 border-t border-grey-200 bg-grey-50 px-6 pb-5 pt-4">
    <x-button :href="url('/bookings')" variant="primary" size="large" class="w-full">Done</x-button>
    <x-button href="#" variant="secondary" size="large" class="w-full">Review Room</x-button>
    <p class="text-center text-[12px] leading-4 font-normal text-grey-500">
      All Bookings are managed according to the facility usage terms and conditions.
    </p>
  </div>
</div>
@endsection
