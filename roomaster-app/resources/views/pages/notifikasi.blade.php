@extends('layouts.app')

@section('content')
@php
  $tabs = [
    ['label' => 'All',     'href' => url('/notifikasi')],
    ['label' => 'Actions', 'href' => url('/notifikasi?filter=actions')],
    ['label' => 'Updates', 'href' => url('/notifikasi?filter=updates')],
    ['label' => 'System',  'href' => url('/notifikasi?filter=system')],
  ];
@endphp

<div class="flex min-h-full flex-col bg-grey-100">
  <x-header_topappbar title="Notifications" :back="url('/menu-utama')" />

  <main class="flex flex-1 flex-col pb-5 pt-5">
    <x-tabs variant="pill" :items="$tabs" :active="$active" />

    <div class="mt-6 flex flex-col gap-4 px-6">
      @forelse($notifications as $n)
        <x-card_notification :type="$n['type']" :title="$n['title']" :time="$n['time']"
                             :message="$n['message']" :actions="$n['actions']" />
      @empty
        <p class="py-10 text-center text-[14px] leading-5 font-normal text-grey-500">Belum ada notifikasi.</p>
      @endforelse
    </div>
  </main>
</div>
@endsection
