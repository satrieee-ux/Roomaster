@extends('layouts.app', ['title' => 'Report Submitted · Roomaster'])

@section('content')
<div class="flex h-full flex-col bg-grey-100 px-xl pb-[106px] pt-12">

    <div class="flex flex-1 flex-col items-center text-center">
        <x-success-badge />

        <h1 class="mt-lg text-h4 text-grey-900">Report Submitted</h1>
        <p class="mt-sm px-xs text-b1 text-grey-600">
            Your facility report has been successfully logged into the system.
            A maintenance team will review the details shortly.
        </p>

        <x-stepper class="mt-xl w-full px-lg" :steps="[
            ['title' => 'Report Submitted', 'desc' => 'Just Now', 'state' => 'done'],
            ['title' => 'Pending Review', 'desc' => 'Awaiting TU/Sarpras Admin approval.', 'state' => 'current'],
            ['title' => 'Confirmation', 'desc' => 'Taken action for report', 'state' => 'upcoming'],
        ]" />
    </div>

    <div class="space-y-xs">
        <x-button variant="secondary" size="lg" class="w-full" icon-right="arrow-right">View Report Details</x-button>
        <x-button size="lg" class="w-full" icon-left="house" href="{{ route('home') }}">Back to Home</x-button>
    </div>

</div>
@endsection
