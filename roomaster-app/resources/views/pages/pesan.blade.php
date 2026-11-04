@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col bg-grey-50">
  <x-header_chat :name="$admin['name']" :status="$admin['status']" :back="url('/chat')" />

  <main class="flex flex-1 flex-col gap-6 pb-5 pt-4">
    <span class="self-center rounded-full bg-grey-800 px-3 py-1 text-[12px] leading-4 font-medium text-white">{{ $date }}</span>

    @foreach($messages as $m)
      <x-chat_bubble :side="$m['side']" :text="$m['text'] ?? null" :image="$m['image'] ?? null" :time="$m['time']" />
    @endforeach
  </main>

  <x-component_chatbar :action="url('/chat/'.$admin['id'])" />
</div>

<script>
  // buka percakapan di pesan terbaru
  (function () { var m = document.querySelector('main'); if (m) m.scrollTop = m.scrollHeight; })();
</script>
@endsection
