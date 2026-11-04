@props(['src' => null, 'name' => '', 'size' => 'h-10 w-10', 'online' => false])

<span {{ $attributes->merge(['class' => "relative inline-flex shrink-0 $size"]) }}>
    <span class="flex h-full w-full items-center justify-center overflow-hidden rounded-full bg-primary-50 text-[12px] leading-4 font-medium text-primary-700">
        @if($src)
            <img src="{{ asset($src) }}" alt="{{ $name }}" class="h-full w-full object-cover">
        @else
            {{ \Illuminate\Support\Str::of($name)->explode(' ')->map(fn ($w) => mb_substr($w, 0, 1))->take(2)->join('') }}
        @endif
    </span>
    @if($online)
        <span class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-green-500"></span>
    @endif
</span>
