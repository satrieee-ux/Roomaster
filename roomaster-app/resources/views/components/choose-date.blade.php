{{--
    Date picker. Tanggal terpilih disimpan di <input name="date"> dan dikirim lewat
    event 'date-selected' (detail.value = 'YYYY-MM-DD') saat Apply ditekan.
--}}
@props(['id' => 'choose-date', 'name' => 'date', 'value' => null])

@php($start = $value ? \Illuminate\Support\Carbon::parse($value) : now())

<x-modal :id="$id" :labelledby="$id.'-title'" class="bg-white p-md">
    <div data-calendar data-year="{{ $start->year }}" data-month="{{ $start->month }}" @if($value) data-value="{{ $start->toDateString() }}" @endif>

        <div class="flex items-center justify-between border-b border-grey-200 pb-sm">
            <i data-lucide="calendar-days" class="h-6 w-6 text-primary-500"></i>
            <h2 id="{{ $id }}-title" class="text-b4 text-grey-900">Choose Date</h2>
            <button type="button" data-popup-close aria-label="Close" class="text-primary-500">
                <i data-lucide="x" class="h-6 w-6"></i>
            </button>
        </div>

        <div class="mt-md flex items-center justify-between px-xs">
            <button type="button" data-cal-prev aria-label="Previous month" class="text-primary-500">
                <i data-lucide="chevron-left" class="h-5 w-5"></i>
            </button>
            <span data-cal-title class="text-b3 text-grey-900"></span>
            <button type="button" data-cal-next aria-label="Next month" class="text-primary-500">
                <i data-lucide="chevron-right" class="h-5 w-5"></i>
            </button>
        </div>

        <div class="mt-sm grid grid-cols-7 text-center text-c2 text-primary-500">
            @foreach(['S','M','T','W','T','F','S'] as $d)<span>{{ $d }}</span>@endforeach
        </div>

        <div data-cal-grid class="mt-xs grid grid-cols-7 gap-y-1 text-center"></div>

        <input type="hidden" name="{{ $name }}" data-cal-input value="{{ $value ? $start->toDateString() : '' }}">

        <x-button size="md" class="mt-md w-full" data-popup-close data-cal-apply>Apply</x-button>
    </div>
</x-modal>
