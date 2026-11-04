{{-- Header putih Mobile TopAppBar: back + judul + ikon kanan (default home). Sticky, tinggi 112px.
     <x-header_topappbar title="Reporting" endIcon="x" :endUrl="url('/qreporting')" /> --}}
@props([
  'title' => '',
  'back' => null,
  'homeUrl' => '/menu-utama',
  'showHome' => true,
  'endIcon' => 'home',
  'endUrl' => null,
])

<header {{ $attributes->class(['sticky top-0 z-20 flex h-[112px] shrink-0 items-center justify-between rounded-b-3xl bg-white px-10 pb-3 pt-14 shadow-card']) }}>
  <a href="{{ $back ?? 'javascript:history.back()' }}" aria-label="Kembali"
     class="flex size-6 items-center justify-center text-grey-800">
    <x-icon name="arrow-left" :size="24" />
  </a>

  <h1 class="text-[16px] leading-6 font-semibold text-grey-800">{{ $title }}</h1>

  @if($showHome)
    <a href="{{ $endUrl ?? $homeUrl }}" aria-label="{{ $endIcon === 'x' ? 'Tutup' : 'Beranda' }}"
       class="flex size-6 items-center justify-center text-grey-800">
      <x-icon :name="$endIcon" :size="24" />
    </a>
  @else
    <span class="size-6"></span>
  @endif
</header>
