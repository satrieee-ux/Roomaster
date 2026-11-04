@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col bg-grey-100">
  <x-header_topappbar title="Reporting" :back="url('/qreporting')" endIcon="x" :endUrl="url('/qreporting')" />

  <form id="report-form" action="{{ url('/qreporting/submitted') }}" method="GET" class="flex flex-1 flex-col">
    <main class="flex flex-1 flex-col gap-5 px-6 pb-5 pt-5">
      <div class="flex flex-col gap-1">
        <h2 class="text-[24px] leading-7 font-extrabold text-grey-800">Damage Report</h2>
        <p class="text-[16px] leading-6 font-normal text-grey-600">Please provide details about the issue to help our maintenance team resolve it quickly.</p>
      </div>

      {{-- Room Location --}}
      <div class="flex flex-col gap-2">
        <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Room Location</h3>
        <div class="flex items-center gap-3 rounded-xl border border-grey-300 bg-grey-50 p-4">
          <x-icon name="map-pin" :size="24" class="shrink-0 text-grey-800" />
          <div class="flex min-w-0 flex-1 flex-col">
            <span class="text-[14px] leading-5 font-semibold text-grey-800">{{ $location['room'] }}</span>
            <span class="text-[10px] leading-[14px] font-medium text-grey-600">{{ $location['address'] }}</span>
          </div>
          <button type="button" aria-label="Ubah lokasi" class="shrink-0 text-grey-600"><x-icon name="pencil" :size="24" /></button>
        </div>
      </div>

      {{-- Categories --}}
      <div class="flex flex-col gap-2.5">
        <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Categories</h3>
        <div class="flex flex-wrap gap-3">
          @foreach($categories as $c)
            <label class="cursor-pointer">
              <input type="checkbox" name="categories[]" value="{{ $c['label'] }}" class="peer sr-only">
              <span class="inline-flex h-10 items-center gap-2 rounded-full bg-grey-200 pl-3 pr-4 text-[12px] leading-4 font-medium text-primary-500 peer-checked:bg-primary-800 peer-checked:text-white">
                <x-icon :name="$c['icon']" :size="24" /> {{ $c['label'] }}
              </span>
            </label>
          @endforeach
          <button type="button" aria-label="Kategori lain" class="flex size-10 items-center justify-center rounded-full bg-grey-200 text-primary-500">
            <x-icon name="ellipsis" :size="24" />
          </button>
        </div>
      </div>

      <hr class="border-grey-300">

      {{-- Issue Description --}}
      <div class="flex flex-col gap-2.5">
        <label for="issue" class="text-[14px] leading-5 font-semibold text-grey-800">Issue Description</label>
        <textarea id="issue" name="issue" placeholder="Briefly describe the issue"
          class="h-[106px] w-full resize-none rounded-xl border border-grey-200 bg-grey-50 p-3 text-[14px] leading-5 font-normal text-grey-800 outline-none placeholder:text-grey-500"></textarea>
      </div>

      {{-- Evidence --}}
      <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-1">
          <h3 class="text-[16px] leading-6 font-semibold text-grey-800">Evidence</h3>
          <p class="text-[14px] leading-5 font-normal text-grey-600">Upload photos or videos of the damage.</p>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <label class="flex h-[140px] cursor-pointer flex-col items-center justify-center gap-2 rounded-xl border border-dashed border-grey-400 bg-grey-100 text-grey-600">
            <x-icon name="image-plus" :size="24" />
            <span class="text-[14px] leading-5 font-medium">Add Media</span>
            <input type="file" name="evidence[]" accept="image/*,video/*" multiple class="sr-only">
          </label>
          <div class="flex h-[140px] items-center justify-center rounded-xl border border-grey-800 bg-white text-grey-400">
            <x-icon name="mountain" :size="32" />
          </div>
        </div>
      </div>
    </main>

    <x-component_reportbar />
  </form>

  {{-- Cancel → simpan draft? | Send → konfirmasi kirim --}}
  <x-popup_reportconfirm :yesUrl="url('/qreporting/history')" :noUrl="url('/qreporting')" />
  <x-popup id="popup-reportsend" :open="false" title="Kirim Laporan?" :stack="true">
    <x-slot:body>Laporan kerusakan akan dikirim ke admin dan tidak dapat diubah setelah dikirim.</x-slot:body>
    <x-slot:actions>
      <x-button type="submit" form="report-form" variant="primary" size="large" class="w-full">Submit</x-button>
      <x-button href="#" variant="outline" size="large" class="w-full" data-popup-close>Back</x-button>
    </x-slot:actions>
  </x-popup>
</div>
@endsection
