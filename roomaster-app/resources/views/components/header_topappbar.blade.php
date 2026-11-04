{{-- Header putih Mobile TopAppBar: back + judul + home. Sticky, tinggi 112px.
     Pakai: <x-header_topappbar title="Chats" :back="url('/menu-utama')" /> --}}
@props([
  'title' => '',
  'back' => null,
  'homeUrl' => '/menu-utama',
  'showHome' => true,
])

<header {{ $attributes->class(['sticky top-0 z-20 flex h-[112px] shrink-0 items-center justify-between rounded-b-3xl bg-white px-10 pb-3 pt-14 shadow-card']) }}>
  <a href="{{ $back ?? 'javascript:history.back()' }}" aria-label="Kembali"
     class="flex size-6 items-center justify-center text-grey-800">
    <x-icon name="arrow-left" :size="24" />
  </a>

  <h1 class="text-[16px] leading-6 font-semibold text-grey-800">{{ $title }}</h1>

  @if($showHome)
    <a href="{{ $homeUrl }}" aria-label="Beranda" class="flex size-6 items-center justify-center text-grey-800">
      <x-icon name="home" :size="24" />
    </a>
  @else
    <span class="size-6"></span>
  @endif
</header>
