{{-- Kerangka halaman Rooms: header gelap + chip filter + isi + navbar (Rooms aktif).
     active: 0 All | 1 SKPB | 2 Departemen | 3 Favorites. --}}
@props(['active' => 0])
@php
$tabs = [
  ['label' => 'All',        'href' => '/rooms'],
  ['label' => 'SKPB',       'href' => '/rooms/skpb'],
  ['label' => 'Departemen', 'href' => '/rooms/departemen'],
  ['label' => 'Favorites',  'href' => '/rooms/favorit', 'icon' => 'heart'],
];
@endphp
<div class="flex min-h-full flex-col bg-grey-100">
  <x-header variant="home" heading="Let’s book your room." :avatar="asset('images/avatar.jpg')"
            searchUrl="/search" chatUrl="/percakapan" notifUrl="/notifikasi" />

  {{-- Header ke konten 24, antar section 16, ujung scroll 20px di atas navbar sticky. --}}
  <main class="flex flex-1 flex-col gap-4 pb-5 pt-6">
    <x-tabs variant="pill" :items="$tabs" :active="$active" />
    {{ $slot }}
  </main>

  <x-component_navbar active="rooms" />
</div>
