{{-- Modal Filter (bottom sheet): kapasitas, fasilitas, tipe ruangan. --}}
@props(['id' => 'popup-filter', 'open' => false, 'action' => '#'])
<x-popup :id="$id" :open="$open" :sheet="true">
  <form action="{{ $action }}" method="GET">
    <div class="flex items-center justify-between text-primary-500">
      <x-icon name="list-filter" :size="24" />
      <span class="text-[16px] leading-6 font-semibold text-grey-800">Filter</span>
      <button type="button" data-popup-close aria-label="Tutup"><x-icon name="x" :size="24" /></button>
    </div>

    <section class="mt-3.5">
      <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Select Capacity</h3>
      @foreach(['0-19', '20-49', '50-99', '100+'] as $c)
        <x-checkbox name="capacity[]" :value="$c" :label="$c" class="h-10" />
      @endforeach
    </section>

    <section class="mt-4 border-t border-grey-200 pt-6">
      <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Facilities</h3>
      <div class="grid grid-cols-2">
        <x-checkbox name="facilities[]" value="ac" label="Full AC" class="h-10" />
        <x-checkbox name="facilities[]" value="projector" label="Video Projector" class="h-10" />
      </div>
    </section>

    <section class="mt-4 border-t border-grey-200 pt-6">
      <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Room Type</h3>
      <div class="mt-3 flex gap-3">
        @foreach(['skpb' => 'SKPB', 'dept' => 'Departemen'] as $v => $l)
          <label class="flex-1 cursor-pointer">
            <input type="checkbox" name="type[]" value="{{ $v }}" class="peer sr-only">
            <span class="flex h-8 items-center justify-center rounded-full bg-grey-200 text-[12px] leading-4 font-medium text-primary-500 peer-checked:bg-primary-800 peer-checked:text-white">{{ $l }}</span>
          </label>
        @endforeach
      </div>
    </section>

    <div class="mt-4 border-t border-grey-200 pt-4">
      <x-button type="submit" variant="primary" size="large" class="w-full">Apply</x-button>
    </div>
  </form>
</x-popup>
