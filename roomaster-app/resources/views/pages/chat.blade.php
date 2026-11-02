@extends('layouts.app', ['title' => 'Chat · Roomaster'])

@php
    // Dummy data. Nanti diganti data dari controller / database.
    $contact = ['name' => 'Fauzan Azura', 'role' => 'ITS Student', 'avatar' => null];
    $admin   = ['name' => 'Admin Sarpras', 'avatar' => null];

    $messages = [
        ['from' => 'me',   'time' => '10:44 AM', 'text' => 'Hello! I am the administrator for Campus A Sarpras. How can I assist you today regarding your room booking?'],
        ['from' => 'them', 'time' => '10:42 AM', 'text' => "Hi, I'm having trouble with the projector in Room 302. It keeps flickering and showing 'No Signal'."],
        ['from' => 'me',   'time' => '10:44 AM', 'text' => "I see. Could you please send a photo of the cable connection? I'll check if a maintenance staff is nearby."],
        ['from' => 'them', 'time' => '10:45 AM', 'photo' => true],
    ];
@endphp

@section('content')
<div class="flex h-full flex-col bg-grey-50">

    {{-- Header --}}
    <header class="relative z-10 flex items-center justify-between rounded-b-xl bg-white px-md pb-md pt-lg shadow-card">
        <a href="{{ url()->previous() }}" aria-label="Kembali" class="text-grey-800">
            <i data-lucide="arrow-left" class="h-6 w-6"></i>
        </a>
        <div class="flex items-center gap-sm">
            <x-avatar :src="$contact['avatar']" :name="$contact['name']" size="h-10 w-10" online />
            <div>
                <p class="text-s1 leading-5 text-grey-900">{{ $contact['name'] }}</p>
                <p class="text-c3 text-grey-500">{{ $contact['role'] }}</p>
            </div>
        </div>
        <button type="button" aria-label="Menu" class="text-grey-800">
            <i data-lucide="ellipsis-vertical" class="h-6 w-6"></i>
        </button>
    </header>

    {{-- Pesan --}}
    <div id="chat-scroll" class="flex-1 space-y-md overflow-y-auto px-md py-md [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
        <div class="mx-auto w-fit rounded-full bg-grey-700 px-sm py-1 text-c2 text-white">Monday, Oct 23</div>

        @foreach($messages as $m)
            @php($isMe = $m['from'] === 'me')
            <x-chat-bubble
                :from="$m['from']"
                :time="$m['time'] ?? null"
                :photo="$m['photo'] ?? null"
                :avatar="$isMe ? $admin['avatar'] : $contact['avatar']"
                :name="$isMe ? $admin['name'] : $contact['name']"
            >{{ $m['text'] ?? '' }}</x-chat-bubble>
        @endforeach
    </div>

    {{-- Input --}}
    <form action="#" method="post" class="flex items-center gap-sm rounded-t-[40px] bg-primary-900 px-xl py-lg">
        <div class="flex h-12 flex-1 items-center gap-sm rounded-full bg-grey-200 px-md">
            <button type="button" aria-label="Lampirkan file" class="text-primary-500">
                <i data-lucide="paperclip" class="h-6 w-6"></i>
            </button>
            <input type="text" name="message" placeholder="Type a message..." autocomplete="off"
                   class="min-w-0 flex-1 bg-transparent text-b3 text-grey-900 outline-none placeholder:text-grey-400">
        </div>
        <x-button variant="secondary" size="lg" icon="send" type="submit" aria-label="Kirim" class="!w-14" />
    </form>

</div>
@endsection

@push('scripts')
<script>
    const chat = document.getElementById('chat-scroll');
    chat.scrollTop = chat.scrollHeight;
</script>
@endpush
