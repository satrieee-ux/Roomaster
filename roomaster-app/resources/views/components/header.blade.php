{{-- Header screen. variant: topbar (back + judul + home, lihat "Notifications") | home (gelap, sapaan + search).
     Home: tinggi 224 = navbar atas 108 + sapaan 28 + gap 12 + search 50 + bawah 26.
     Teks sapaan (urutan prioritas):
       1) prop heading="..." (paling menang)
       2) otomatis dari route yang dibuka, lihat $headings di bawah
       3) default "Welcome Back, {name}!"
     Judul screen maksimal H4 (aturan Text Hierarchy). --}}
@props([
  'variant' => 'topbar',
  'title' => '',
  'heading' => null,
  'back' => null,
  'homeUrl' => '/menu-utama',
  'name' => 'Zenkko',
  'avatar' => null,
  'searchUrl' => '#',
  'chatUrl' => '#',
  'notifUrl' => '#',
])
@php
// Tambah halaman baru di sini: pola route => teks sapaan.
$headings = [
  'rooms*' => 'Let’s book your room.',
];
if ($heading === null) {
  foreach ($headings as $pattern => $text) {
    if (request()->routeIs($pattern)) { $heading = $text; break; }
  }
}
$heading ??= 'Welcome Back, '.$name.'!';
@endphp
@if($variant === 'home')
  <header {{ $attributes->class(['shrink-0 rounded-b-[32px] bg-primary-900 pb-[26px] text-white']) }}>
    <div class="flex h-[108px] items-end justify-between px-2 pb-4">
      <span class="flex px-4">
        <span class="relative size-8">
          <img src="{{ $avatar }}" alt="" class="size-8 rounded-full bg-primary-100 object-cover">
          <span class="absolute bottom-0 right-0 size-2.5 rounded-full border-2 border-primary-900 bg-success-500"></span>
        </span>
      </span>
      <div class="flex">
        <a href="{{ $chatUrl }}" aria-label="Chat" class="flex h-11 w-12 items-center justify-center"><x-icon name="message-square" :size="24" /></a>
        <a href="{{ $notifUrl }}" aria-label="Notifikasi" class="flex h-11 w-12 items-center justify-center"><x-icon name="bell" :size="24" /></a>
      </div>
    </div>
    <div class="px-6">
      <h4 class="text-[24px] leading-7 font-extrabold">{{ $heading }}</h4>
      <a href="{{ $searchUrl }}" class="mt-3 flex h-[50px] items-center gap-3 rounded-xl bg-grey-100 p-3 text-[16px] leading-6 font-normal text-grey-500">
        <x-icon name="search" :size="24" /> Search
      </a>
    </div>
  </header>
@else
  <header {{ $attributes->class(['flex h-16 shrink-0 items-center justify-between rounded-b-3xl bg-white px-6 shadow-card']) }}>
    <a href="{{ $back ?? 'javascript:history.back()' }}" aria-label="Kembali" class="text-grey-900"><x-icon name="arrow-left" :size="24" /></a>
    <h1 class="text-[16px] leading-6 font-semibold text-grey-900">{{ $title }}</h1>
    <a href="{{ $homeUrl }}" aria-label="Beranda" class="text-grey-900"><x-icon name="home" :size="24" /></a>
  </header>
@endif
