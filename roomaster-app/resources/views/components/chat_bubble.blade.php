{{-- Gelembung chat. side: in (masuk, abu) | out (keluar, gelap). Boleh teks, gambar, atau keduanya. --}}
@props(['side' => 'in', 'text' => null, 'time' => '', 'image' => null, 'avatar' => null])
@php $out = $side === 'out'; @endphp

<div @class(['flex items-end gap-3 px-5', 'flex-row-reverse' => $out])>
  <span class="relative size-8 shrink-0">
    <img src="{{ asset($avatar ?? 'images/avatar.jpg') }}" alt="" class="size-8 rounded-full bg-primary-100 object-cover">
    <span class="absolute -bottom-px -right-px size-2.5 rounded-full border-2 border-grey-50 bg-success-500"></span>
  </span>

  <div @class(['flex min-w-0 flex-col gap-1', 'items-end' => $out, 'items-start' => ! $out])>
    @if($image)
      <img src="{{ asset($image) }}" alt="Lampiran" class="h-[160px] w-[240px] rounded-2xl border-4 border-grey-300 object-cover">
    @endif
    @if($text)
      <p @class([
        'max-w-[220px] rounded-2xl p-4 text-[16px] leading-6 font-normal',
        'bg-grey-200 text-grey-800' => ! $out,
        'bg-primary-900 text-white' => $out,
      ])>{{ $text }}</p>
    @endif
    <span class="text-[12px] leading-4 font-medium text-grey-800/70">{{ $time }}</span>
  </div>
</div>
