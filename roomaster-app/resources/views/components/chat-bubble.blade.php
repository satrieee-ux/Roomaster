{{--
    from  : me (gelap, kanan) | them (abu, kiri)
    photo : true = placeholder, atau URL gambar (bubble foto)
    Contoh: <x-chat-bubble from="them" time="10:42 AM" :avatar="$url" name="Fauzan Azura">Teks</x-chat-bubble>
--}}
@props(['from' => 'me', 'time' => null, 'avatar' => null, 'name' => '', 'photo' => null])

@php($me = $from === 'me')

<div class="flex items-end gap-xs {{ $me ? 'justify-end' : 'justify-start' }}">
    @unless($me)
        <x-avatar :src="$avatar" :name="$name" size="h-8 w-8" online />
    @endunless

    <div class="flex max-w-[78%] flex-col gap-1 {{ $me ? 'items-end' : 'items-start' }}">
        @if($photo)
            @if(is_string($photo))
                <img src="{{ $photo }}" alt="Foto" class="w-60 rounded-lg border-4 border-grey-300 object-cover">
            @else
                <div class="flex h-40 w-60 items-center justify-center rounded-lg border-4 border-grey-300 bg-grey-200 text-grey-400">
                    <i data-lucide="image" class="h-8 w-8"></i>
                </div>
            @endif
        @else
            <div class="rounded-xl px-md py-sm text-b1 {{ $me ? 'rounded-br-xxs bg-primary-800 text-white' : 'rounded-bl-xxs bg-grey-200 text-grey-900' }}">
                {{ $slot }}
            </div>
        @endif

        @if($time)
            <span class="text-c2 text-grey-700">{{ $time }}</span>
        @endif
    </div>

    @if($me)
        <x-avatar :src="$avatar" :name="$name" size="h-8 w-8" online />
    @endif
</div>
