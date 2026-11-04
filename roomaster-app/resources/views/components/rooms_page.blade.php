@props(['active' => 0])

@php
  $tabs = [
    ['label' => 'All',        'href' => url('/rooms')],
    ['label' => 'SKPB',       'href' => url('/rooms/skpb')],
    ['label' => 'Departemen', 'href' => url('/rooms/departemen')],
    ['label' => 'Favorites',  'href' => url('/rooms/favorit'), 'icon' => 'heart'],
  ];
@endphp

<div class="flex min-h-full flex-col bg-grey-100">

  {{-- Bagian atas sticky: header + tab. Hanya kartu di bawahnya yang menggulir --}}
  <div class="sticky top-0 z-20 bg-grey-100">
    <x-header variant="home" heading="Let’s book your room." />
    <div class="pb-4 pt-6">
      <x-tabs variant="pill" :items="$tabs" :active="$active" />
    </div>
  </div>

  <main class="flex flex-1 flex-col gap-4 pb-5">
    {{ $slot }}
  </main>

  <x-component_navbar active="rooms" />
</div>
