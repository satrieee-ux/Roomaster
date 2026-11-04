{{-- Satu section daftar ruangan: judul (+ See All) lalu card.
     layout: row (card kecil, scroll horizontal) | stack (card lebar penuh bertumpuk).
     seeAll=false untuk menyembunyikan tombol See All (mis. "Your Favorites").
     rooms: array [id,title,department,capacity,image,favorite]. --}}
@props(['title' => '', 'rooms' => [], 'layout' => 'row', 'seeAll' => true, 'seeAllUrl' => '/rooms'])
<section class="flex flex-col gap-3">
  <div class="flex h-7 items-center justify-between px-6">
    <h2 class="text-[18px] leading-7 font-semibold text-primary-800">{{ $title }}</h2>
    @if($seeAll)
      <x-button :href="$seeAllUrl" variant="soft" size="tiny" iconRight="chevron-right" class="shrink-0 whitespace-nowrap">See All</x-button>
    @endif
  </div>

  @if($layout === 'stack')
    <div class="flex flex-col gap-3 px-6">
      @foreach($rooms as $room)
        <x-card_room layout="vertical_large"
          :title="$room['title']" :department="$room['department']" :capacity="$room['capacity']"
          :image="asset($room['image'])" :favorite="$room['favorite'] ?? false" href="/rooms/{{ $room['id'] }}" />
      @endforeach
    </div>
  @else
    <div class="no-scrollbar -mb-4 flex items-start gap-3 overflow-x-auto px-6 pb-4">
      @foreach($rooms as $room)
        <x-card_room class="shrink-0" layout="vertical"
          :title="$room['title']" :department="$room['department']" :capacity="$room['capacity']"
          :image="asset($room['image'])" :favorite="$room['favorite'] ?? false" href="/rooms/{{ $room['id'] }}" />
      @endforeach
    </div>
  @endif
</section>
