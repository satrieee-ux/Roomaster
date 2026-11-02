@props(['icon' => 'circle-check'])

<div {{ $attributes->merge(['class' => 'flex h-[132px] w-[132px] shrink-0 items-center justify-center rounded-full bg-green-500 text-white']) }}>
    <i data-lucide="{{ $icon }}" class="h-16 w-16"></i>
</div>
