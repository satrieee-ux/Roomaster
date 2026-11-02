@extends('layouts.app')

@section('content')
<div class="w-full h-full flex flex-col justify-between p-6 pt-10 relative overflow-hidden">

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col items-center justify-center text-center px-2">

        <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mb-6 shadow-lg shadow-green-500/20">
            <i data-lucide="check" class="w-12 h-12 text-white stroke-[3]"></i>
        </div>

        {{-- H1 Headline (ExtraBold 800) --}}
        <h1 class="text-2xl font-extrabold text-grey-800 mb-3">Report Submitted</h1>

        {{-- Body text (Regular 400) --}}
        <p class="text-xs font-normal text-grey-500 leading-relaxed max-w-[310px] mb-8">
            Your facility report has been successfully logged into the system. A maintenance team will review the details shortly.
        </p>

        {{-- Stepper --}}
        <div class="w-full max-w-[310px] text-left space-y-0 relative">
            <div class="flex items-start gap-4 relative pb-6">
                <div class="absolute left-5 top-10 bottom-0 w-[2px] bg-grey-300"></div>
                <div class="w-10 h-10 rounded-full bg-grey-800 text-white flex items-center justify-center z-10 shrink-0">
                    <i data-lucide="check" class="w-5 h-5"></i>
                </div>
                <div class="pt-1">
                    <h4 class="text-sm font-semibold text-grey-800">Report Submitted</h4>
                    <p class="text-xs font-normal text-grey-400">Just Now</p>
                </div>
            </div>

            <div class="flex items-start gap-4 relative pb-6">
                <div class="absolute left-5 top-10 bottom-0 w-[2px] bg-grey-200"></div>
                <div class="w-10 h-10 rounded-full bg-white border-2 border-grey-300 text-grey-600 flex items-center justify-center z-10 shrink-0">
                    <i data-lucide="hourglass" class="w-4 h-4"></i>
                </div>
                <div class="pt-1">
                    <h4 class="text-sm font-semibold text-grey-800">Pending Review</h4>
                    <p class="text-xs font-normal text-grey-400">Awaiting TU/Sarpras Admin approval.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 relative">
                <div class="w-10 h-10 rounded-full bg-grey-200 text-grey-400 flex items-center justify-center z-10 shrink-0">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                </div>
                <div class="pt-1">
                    <h4 class="text-sm font-semibold text-grey-400">Confirmation</h4>
                    <p class="text-xs font-normal text-grey-400">Taken action for report</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Bottom Action Buttons --}}
    <div class="w-full space-y-3 pb-2">
        <x-button variant="secondary" size="lg" class="w-full" iconRight="arrow-right">
            View Report Details
        </x-button>

        <x-button variant="primary" size="lg" class="w-full" iconLeft="home">
            Back to Home
        </x-button>
    </div>

    {{-- Home Indicator --}}
    <div class="w-32 h-1 bg-grey-800 rounded-full mx-auto"></div>

</div>
@endsection
