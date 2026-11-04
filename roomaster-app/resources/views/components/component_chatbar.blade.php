{{-- ChatBar: bar pengetik sticky bawah (sudut atas 32px, tinggi 100px). --}}
@props(['action' => '#', 'placeholder' => 'Type a message...'])

<form action="{{ $action }}" method="POST"
      {{ $attributes->class(['sticky bottom-0 z-30 flex h-[100px] w-full shrink-0 items-start gap-4 rounded-t-[32px] bg-primary-900 px-6 pt-5']) }}>
  @csrf
  <label class="flex h-10 min-w-0 flex-1 items-center gap-3 rounded-full bg-grey-200 px-4">
    <button type="button" aria-label="Lampirkan" class="shrink-0 text-primary-500"><x-icon name="paperclip" :size="24" /></button>
    <input type="text" name="message" placeholder="{{ $placeholder }}" autocomplete="off"
           class="min-w-0 flex-1 bg-transparent text-[14px] leading-5 font-normal text-grey-800 outline-none placeholder:text-grey-400">
  </label>
  <button type="submit" aria-label="Kirim"
          class="flex h-10 w-14 shrink-0 items-center justify-center rounded-full bg-secondary-500 text-white">
    <x-icon name="send" :size="24" />
  </button>
</form>
