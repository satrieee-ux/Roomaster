{{-- Navbar bawah (sticky). 5 item: Home, Rooms, QReport, Scheduled, Profile.
     active: home|rooms|qreport|scheduled|profile. Tinggi 77px (pad bawah 8) sesuai spec. --}}
@props(['active' => 'home'])
@php
$items = [
  'home'      => ['Home',      'home',           '/menu-utama'],
  'rooms'     => ['Rooms',     'door-open',      '/rooms'],
  'qreport'   => ['QReport',   'scan-qr',        '/qreporting'],
  'scheduled' => ['Scheduled', 'calendar-check', '/bookings'],
  'profile'   => ['Profile',   'user',           '/profile'],
];
@endphp
<nav {{ $attributes->class(['sticky bottom-0 z-30 flex h-[77px] w-full shrink-0 items-center justify-around border-t border-grey-200 bg-grey-50 pb-2']) }}>
  @foreach($items as $key => [$label, $icon, $url])
    <a href="{{ $url }}" @class([
      'flex flex-1 flex-col items-center gap-1 text-[10px] leading-[14px] font-medium',
      'text-grey-900' => $active === $key,
      'text-grey-400' => $active !== $key,
    ])>
      <x-icon :name="$icon" :size="24" :stroke="$active === $key ? 2.25 : 1.75" />
      {{ $label }}
    </a>
  @endforeach
</nav>
