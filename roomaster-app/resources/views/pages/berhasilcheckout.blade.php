@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col bg-grey-100 px-6 pb-5 pt-[131px]">
  <svg viewBox="0 0 128 128" class="mx-auto size-[128px]" aria-hidden="true">
    <circle cx="64" cy="64" r="64" fill="#43B75D"/>
    <path d="M38 66l17 17 35-37" fill="none" stroke="#fff" stroke-width="9" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>

  <h2 class="mt-4 text-center text-[24px] leading-7 font-extrabold text-grey-800">Check-Out Success</h2>
  <p class="mt-5 text-center text-[16px] leading-6 font-normal text-grey-600">
    Your room booking check-out process has been completed. If there are any faulty equipment, please report accordingly as stated in Roomaster’s
    <a href="#" class="font-semibold text-primary-500 underline">user Terms &amp; Conditions.</a>
  </p>

  <div class="mt-24 flex flex-col gap-2">
    <x-button :href="url('/menu-utama')" variant="primary" size="large" iconLeft="home" class="w-full">Back to Home</x-button>
    <x-button type="button" variant="secondary" size="large" class="w-full" data-popup-open="popup-buatreview">Review Room</x-button>
  </div>

  <x-popup_buatreview :submitUrl="url('/menu-utama')" />
</div>
@endsection
