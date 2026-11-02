@extends('layouts.app', ['title' => 'Modal Preview · Roomaster'])

@section('content')
<div class="flex h-full flex-col items-center justify-center gap-sm bg-grey-100 px-xl">
    <x-button size="lg" class="w-full" data-popup-open="cancel-booking">Cancel Booking</x-button>
    <x-button variant="outline" size="lg" class="w-full" data-popup-open="choose-date">Choose Date</x-button>
    <p id="picked-date" class="text-b3 text-grey-500"></p>
</div>

<x-modals.cancel-booking />
<x-modals.choose-date />
@endsection

@push('scripts')
<script>
    document.addEventListener('date-selected', (e) => {
        document.getElementById('picked-date').textContent = 'Tanggal dipilih: ' + (e.detail.value || '-');
    });
</script>
@endpush
