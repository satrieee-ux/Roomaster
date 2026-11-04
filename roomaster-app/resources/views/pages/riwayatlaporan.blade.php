@extends('layouts.app')

@section('content')
@php
  $tabs = [
    ['label' => 'All',      'href' => url('/qreporting/history')],
    ['label' => 'Active',   'href' => url('/qreporting/history?filter=active')],
    ['label' => 'Approved', 'href' => url('/qreporting/history?filter=approved')],
    ['label' => 'Pending',  'href' => url('/qreporting/history?filter=pending')],
  ];
@endphp

<div class="flex min-h-full flex-col bg-grey-100">
  {{-- Header + tab sticky; hanya kartu yang menggulir --}}
  <div class="sticky top-0 z-20 bg-grey-100">
    <x-header_topappbar title="Reports History" :back="url('/qreporting')" />
    <x-tabs :items="$tabs" :active="$active" class="mt-5 px-6" />
  </div>

  <main class="flex flex-1 flex-col pb-5">
    <div class="mt-4 flex flex-col gap-4 px-6">
      @forelse($reports as $r)
        <x-card_report :title="$r['title']" :date="$r['date']" :department="$r['department']"
                       :status="$r['status']" :issues="$r['issues']"
                       :href="url('/qreporting/summary/'.$r['id'])" continueUrl="{{ url('/qreporting/report') }}" />
      @empty
        <p class="py-10 text-center text-[14px] leading-5 font-normal text-grey-500">Belum ada laporan.</p>
      @endforelse
    </div>
  </main>
</div>
@endsection
