@extends('layouts.app', ['title' => 'Check-Out Success · Roomaster'])

@section('content')
<div class="flex h-full flex-col bg-grey-100 px-xl pb-[200px] pt-12">

    <div class="flex flex-1 flex-col items-center text-center">
        <x-success-badge />

        <h1 class="mt-lg text-h4 text-grey-900">Check-Out Success</h1>
        <p class="mt-sm text-b1 text-grey-600">
            Your room booking check-out process has been completed. If there are any faulty
            equipment, please report accordingly as stated in Roomaster’s
            <a href="#" class="text-primary-500 underline underline-offset-2">user Terms &amp; Conditions.</a>
        </p>
    </div>

    <div class="space-y-xs">
        <x-button size="lg" class="w-full" icon-left="house" href="{{ route('home') }}">Back to Home</x-button>
        <x-button variant="secondary" size="lg" class="w-full">Review Room</x-button>
    </div>

</div>
@endsection
