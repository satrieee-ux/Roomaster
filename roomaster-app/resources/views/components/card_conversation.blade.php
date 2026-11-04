{{-- Item daftar percakapan: avatar, nama, cuplikan 2 baris, jam, badge belum dibaca. --}}
@props(['name', 'preview', 'time', 'unread' => 0, 'href' => '#', 'avatar' => null])

<a href="{{ $href }}" {{ $attributes->class(['flex items-center gap-3 rounded-xl bg-grey-100 px-4 py-3 shadow-card']) }}>
  <span class="relative size-12 shrink-0">
    <img src="{{ asset($avatar ?? 'images/avatar.jpg') }}" alt="{{ $name }}" class="size-12 rounded-full bg-primary-100 object-cover">
    <span class="absolute bottom-0 right-0 size-3 rounded-full border-2 border-grey-100 bg-success-500"></span>
  </span>

  <div class="flex min-w-0 flex-1 flex-col">
    <span class="truncate text-[16px] leading-6 font-semibold text-grey-800">{{ $name }}</span>
    <span class="mt-1 line-clamp-2 text-[12px] leading-4 font-normal text-grey-800/80">{{ $preview }}</span>
  </div>

  <div class="flex shrink-0 flex-col items-end justify-between gap-3 self-stretch">
    <span class="text-[10px] leading-[14px] font-medium text-grey-500">{{ $time }}</span>
    @if($unread > 0)
      <span class="flex size-6 items-center justify-center rounded-full bg-primary-900 text-[12px] leading-4 font-semibold text-white">{{ $unread }}</span>
    @endif
  </div>
</a>
