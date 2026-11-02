@props([
    'image',
    'title',
    'location',
    'capacity',
    'bookable' => true
])

<div class="bg-white rounded-xl shadow-sm border border-grey-100 overflow-hidden p-3 hover:shadow-md transition-shadow">
    <div class="relative w-full h-40 rounded-lg overflow-hidden mb-3">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover">
    </div>
    
    <div class="flex items-center justify-between mb-1">
        <h3 class="text-lg font-semibold text-grey-800">{{ $title }}</h3>
        <button class="p-2 rounded-full hover:bg-grey-100 text-grey-400 hover:text-primary-500 transition-colors">
            <i data-lucide="heart" class="w-5 h-5"></i>
        </button>
    </div>

    <div class="space-y-1 text-xs text-grey-500 mb-4">
        <div class="flex items-center gap-1.5">
            <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
            <span>{{ $location }}</span>
        </div>
        <div class="flex items-center gap-1.5">
            <i data-lucide="users" class="w-3.5 h-3.5"></i>
            <span>{{ $capacity }} Orang</span>
        </div>
    </div>

    @if($bookable)
        <x-button variant="primary" size="md" class="w-full">Book Now</x-button>
    @endif
</div>