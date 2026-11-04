@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col bg-grey-100">
  <x-header_topappbar title="Report Summary" :back="url('/qreporting/history')" />

  <main class="flex flex-1 flex-col gap-4 px-6 pb-5 pt-5">
    <x-status_banner :status="$report['status']" :updated="$report['updated']" />

    {{-- Facility Information --}}
    <section class="rounded-xl border border-grey-200 bg-grey-50 p-5">
      <div class="flex items-center justify-between">
        <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Facility Information</h3>
        <span class="text-[10px] leading-[14px] font-medium text-grey-500">Report #{{ $report['code'] }}</span>
      </div>
      <div class="mt-4 flex flex-col gap-5">
        <div class="flex flex-col gap-1">
          <span class="text-[14px] leading-5 font-semibold text-grey-500">Room Name</span>
          <span class="text-[18px] leading-7 font-semibold text-grey-800">{{ $report['room'] }}</span>
        </div>
        <div class="flex flex-col gap-1">
          <span class="text-[14px] leading-5 font-semibold text-grey-500">Location</span>
          <span class="text-[14px] leading-5 font-normal text-grey-800">{{ $report['location'] }}</span>
        </div>
        <div class="flex flex-col gap-1">
          <span class="text-[14px] leading-5 font-semibold text-grey-500">Date of Report</span>
          <span class="text-[16px] leading-6 font-semibold text-grey-800">{{ $report['date'] }}</span>
        </div>
        <div class="flex flex-col gap-1">
          <span class="text-[14px] leading-5 font-semibold text-grey-500">Issue Reported</span>
          <div class="flex flex-wrap gap-x-4 gap-y-2">
            @foreach($report['issues'] as $i)
              <span class="flex h-6 items-center gap-2 text-[14px] leading-5 font-normal text-grey-800">
                <x-icon :name="$i['icon']" :size="20" /> {{ $i['label'] }}
              </span>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    {{-- Issue Description --}}
    <section class="rounded-xl border border-grey-200 bg-grey-50 p-5">
      <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Issue Description</h3>
      <p class="mt-2 text-[14px] leading-5 font-normal text-grey-800">{{ $report['description'] }}</p>
    </section>

    {{-- Recent Activity --}}
    <section class="rounded-xl border border-grey-200 bg-grey-50 p-5">
      <h3 class="text-[18px] leading-7 font-semibold text-grey-800">Recent Activity</h3>
      <x-activity_timeline class="mt-4" :items="[
        ['icon' => 'check',          'state' => 'done',    'title' => 'Report Submitted', 'desc' => 'Just Now'],
        ['icon' => 'hourglass',      'state' => 'current', 'title' => 'Pending Review',   'desc' => 'Awaiting TU/Sarpras Admin approval.'],
        ['icon' => 'calendar-check', 'state' => 'todo',    'title' => 'Confirmation',     'desc' => 'Taken action for report'],
      ]" />
    </section>

    {{-- Evidence --}}
    <section class="flex flex-col gap-3">
      <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Evidence</h3>
      <div class="grid grid-cols-2 gap-4">
        @foreach($report['evidence'] as $img)
          <img src="{{ asset($img) }}" alt="Bukti kerusakan" class="h-[146px] w-full rounded-xl object-cover">
        @endforeach
      </div>
    </section>
  </main>

  {{-- Bar bawah sticky --}}
  <div class="sticky bottom-0 z-30 flex flex-col gap-3 border-t border-grey-200 bg-grey-50 px-6 pb-5 pt-4">
    <x-button :href="url('/qreporting/history')" variant="primary" size="large" class="w-full">Done</x-button>
    <x-button :href="url('/qreporting')" variant="secondary" size="large" class="w-full">Report another</x-button>
    <p class="text-center text-[12px] leading-4 font-normal text-grey-500">All Reports are managed according to the facility usage terms and conditions.</p>
  </div>
</div>
@endsection
