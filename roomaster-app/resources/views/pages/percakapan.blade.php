@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col bg-grey-50">
  <x-header_topappbar title="Chats" :back="url('/menu-utama')" />

  <main class="flex flex-1 flex-col gap-8 px-4 pb-5 pt-5">
    <label class="flex h-[50px] items-center gap-3 rounded-xl border border-grey-300 bg-grey-50 px-3">
      <x-icon name="search" :size="20" class="shrink-0 text-grey-500" />
      <input type="search" placeholder="Search conversations..."
             class="min-w-0 flex-1 bg-transparent text-[16px] leading-6 font-normal text-grey-800 outline-none placeholder:text-grey-500">
    </label>

    @foreach($conversations as $c)
      <x-card_conversation :name="$c['name']" :preview="$c['preview']" :time="$c['time']"
                           :unread="$c['unread']" :href="url('/chat/'.$c['id'])" />
    @endforeach

    <div class="flex h-[413px] flex-col items-center justify-center gap-1 rounded-xl border border-dashed border-grey-400 px-4 text-center">
      <x-icon name="messages-square" :size="32" class="text-grey-500" />
      <h3 class="mt-3 text-[16px] leading-6 font-semibold text-grey-800">Start a new conversation?</h3>
      <p class="text-[14px] leading-5 font-normal text-grey-500">Contact administrators for facility requests.</p>
      <x-button href="#" variant="primary" size="medium" class="mt-3">New Message</x-button>
    </div>
  </main>
</div>
@endsection
