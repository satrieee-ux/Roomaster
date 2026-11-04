{{-- Header ruang chat: back + avatar + nama + status respon + menu. Sticky, tinggi 124px. --}}
@props(['name', 'avatar' => null, 'status' => 'Average Response: 2h', 'back' => null])

<header {{ $attributes->class(['sticky top-0 z-20 flex h-[124px] shrink-0 items-center gap-3 rounded-b-3xl bg-white px-10 pb-5 pt-16 shadow-card']) }}>
  <a href="{{ $back ?? 'javascript:history.back()' }}" aria-label="Kembali"
     class="mr-0.5 flex size-6 shrink-0 items-center justify-center text-grey-800">
    <x-icon name="arrow-left" :size="24" />
  </a>

  <span class="relative size-10 shrink-0">
    <img src="{{ asset($avatar ?? 'images/avatar.jpg') }}" alt="{{ $name }}" class="size-10 rounded-full bg-primary-100 object-cover">
    <span class="absolute -bottom-px -right-px size-2.5 rounded-full border-2 border-white bg-success-500"></span>
  </span>

  <div class="flex min-w-0 flex-1 flex-col text-center">
    <span class="truncate text-[16px] leading-6 font-semibold text-grey-800">{{ $name }}</span>
    <span class="text-[10px] leading-[14px] font-medium text-grey-500">{{ $status }}</span>
  </div>

  <button type="button" aria-label="Menu" class="flex size-6 shrink-0 items-center justify-center text-grey-800">
    <x-icon name="ellipsis-vertical" :size="24" />
  </button>
</header>
