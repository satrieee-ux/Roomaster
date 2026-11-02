@props(['steps' => []])

<ol {{ $attributes->merge(['class' => 'text-left']) }}>
    @foreach($steps as $s)
        @php
            $state = $s['state'] ?? 'upcoming';   // done | current | upcoming
            $last  = $loop->last;
            $dot   = [
                'done'     => 'bg-primary-800 text-white',
                'current'  => 'border border-grey-800 bg-white text-grey-700',
                'upcoming' => 'bg-grey-200 text-grey-400',
            ][$state];
            $icon  = $s['icon'] ?? ['done' => 'check', 'current' => 'hourglass', 'upcoming' => 'calendar-check'][$state];
        @endphp
        <li class="relative flex items-center gap-md {{ $last ? '' : 'pb-8' }}">
            @unless($last)
                <span class="absolute left-6 top-12 bottom-0 w-px -translate-x-1/2 bg-grey-300"></span>
            @endunless
            <span class="z-10 flex h-12 w-12 shrink-0 items-center justify-center rounded-full {{ $dot }}">
                <i data-lucide="{{ $icon }}" class="h-5 w-5"></i>
            </span>
            <div>
                <p class="text-b4 {{ $state === 'upcoming' ? 'text-grey-500' : 'text-grey-900' }}">{{ $s['title'] }}</p>
                <p class="text-c1 {{ $state === 'upcoming' ? 'text-grey-500' : 'text-grey-700' }}">{{ $s['desc'] ?? '' }}</p>
            </div>
        </li>
    @endforeach
</ol>
