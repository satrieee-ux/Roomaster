{{-- Header gelap ringkas (tanpa sapaan & search). Dipakai: Your Bookings. Sticky. --}}
@props(['name' => 'Zenkko', 'avatar' => null, 'chatUrl' => '/chat', 'notifUrl' => '/notifikasi'])

<header {{ $attributes->class(['sticky top-0 z-20 shrink-0 rounded-b-[32px] bg-primary-900 text-white']) }}>
  <div class="flex h-[108px] items-end justify-between px-2 pb-4">
    <span class="relative mb-1.5 ml-4 size-8">
      <img src="{{ $avatar ?? asset('images/avatar.jpg') }}" alt="{{ $name }}" class="size-8 rounded-full bg-primary-100 object-cover">
      <span class="absolute -bottom-0.5 -right-0.5 size-2.5 rounded-full border-2 border-primary-900 bg-success-500"></span>
    </span>
    <div class="flex items-center">
      <a href="#" aria-label="Cari" class="flex h-11 w-12 items-center justify-center"><x-icon name="search" :size="24" /></a>
      <a href="{{ $chatUrl }}" aria-label="Chat" class="flex h-11 w-12 items-center justify-center"><x-icon name="message-square" :size="24" /></a>
      <a href="{{ $notifUrl }}" aria-label="Notifikasi" class="flex h-11 w-12 items-center justify-center"><x-icon name="bell" :size="24" /></a>
    </div>
  </div>
</header>
