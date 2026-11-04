@props([
  'title',
  'rooms' => [],
  'layout' => 'row',      {{-- row | stack | list --}}
  'seeAll' => true,
  'seeAllUrl' => '#',
])

<section class="flex flex-col gap-3">
  <div class="flex h-7 items-center justify-between px-6">
    <h2 class="text-[18px] leading-7 font-semibold text-primary-800">{{ $title }}</h2>
    @if($seeAll)
      <x-button :href="$seeAllUrl" variant="soft" size="tiny" iconRight="chevron-right">See All</x-button>
    @endif
  </div>

    @if($layout === 'stack')
    <div class="flex flex-col gap-3 px-6">
      @foreach($rooms as $r)
        <x-card_room layout="vertical_large" :id="$r['id']"
          :title="$r['title']" :department="$r['department']"
          :capacity="$r['capacity']" :image="$r['image']" :favorite="$r['favorite']" />
      @endforeach
    </div>
  @elseif($layout === 'list')
    <div class="flex flex-col gap-3 px-6">
      @foreach($rooms as $r)
        <x-card_room layout="horizontal" :id="$r['id']"
          :title="$r['title']" :department="$r['department']"
          :capacity="$r['capacity']" :image="$r['image']" :favorite="$r['favorite']" />
      @endforeach
    </div>
  @else
    <div class="no-scrollbar -mb-4 flex items-start gap-3 overflow-x-auto px-6 pb-4">
      @foreach($rooms as $r)
        <x-card_room layout="vertical" class="shrink-0" :id="$r['id']"
          :title="$r['title']" :department="$r['department']"
          :capacity="$r['capacity']" :image="$r['image']" :favorite="$r['favorite']" />
      @endforeach
    </div>
  @endif
</section>
