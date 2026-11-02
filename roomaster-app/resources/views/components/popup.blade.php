@props([
    'id',
    'title' => '',
])

<div id="{{ $id }}" class="fixed inset-0 z-50 hidden bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-xl p-6 max-w-sm w-full text-center shadow-xl transform transition-all">
        @if($title)
            <h3 class="text-lg font-bold text-grey-800 mb-2">{{ $title }}</h3>
        @endif
        
        <p class="text-sm text-grey-500 mb-6">
            {{ $slot }}
        </p>

        <div class="flex items-center justify-center gap-3">
            <x-button variant="primary" size="md" class="w-full">Button</x-button>
            <x-button variant="outline" size="md" class="w-full">Button</x-button>
        </div>
    </div>
</div>