@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col bg-grey-100">
  <x-header_topappbar title="Booking" endIcon="x" :endUrl="url('/rooms/'.$id)" />

  <main class="flex flex-1 flex-col px-6 pb-5 pt-5">
    <x-booking_stepper :step="2" />

    <h2 class="mt-8 text-[24px] leading-7 font-extrabold text-grey-800">Supporting Documents</h2>
    <p class="mt-0.5 text-[16px] leading-6 font-normal text-grey-500">
      Please upload any required identification, permits, or supporting letters for your reservation.
    </p>

    <h3 class="mt-7 text-[18px] leading-7 font-medium text-grey-800">Uploaded Files</h3>

    <div class="mt-4 flex flex-col gap-[18px]">
      @foreach($docs as $d)
        <x-doc_upload :label="$d['label']" :name="$d['name']" :file="$d['file']" />
      @endforeach
    </div>
  </main>

  <x-component_bookdocbar :active="$allUploaded" :href="url('/booking/'.$id.'/ringkasan')" />
</div>
@endsection
