@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col bg-grey-100">
  <header class="sticky top-0 z-20 flex h-[112px] shrink-0 items-center justify-between bg-grey-100 px-4 pt-14">
    <a href="{{ url('/menu-utama') }}" aria-label="Kembali" class="flex size-6 items-center justify-center text-grey-800"><x-icon name="arrow-left" :size="24" /></a>
    <h1 class="text-[16px] leading-6 font-semibold text-grey-800">QReporting</h1>
    <span class="size-6"></span>
  </header>

  <main class="flex flex-1 flex-col px-6 pb-5 pt-2">
    {{-- Tampilan kamera 342x595 --}}
    <div class="relative h-[595px] overflow-hidden rounded-3xl bg-grey-800">
      <video id="qr-video" autoplay playsinline muted class="size-full object-cover"></video>

      {{-- Bingkai pemindai: ketuk = anggap QR terbaca → form laporan --}}
      <a href="{{ url('/qreporting/report') }}" aria-label="Pindai QR" class="absolute left-1/2 top-[153px] size-[230px] -translate-x-1/2">
        <span class="absolute left-0 top-0 size-10 rounded-tl-2xl border-l-[3px] border-t-[3px] border-white"></span>
        <span class="absolute right-0 top-0 size-10 rounded-tr-2xl border-r-[3px] border-t-[3px] border-white"></span>
        <span class="absolute bottom-0 left-0 size-10 rounded-bl-2xl border-b-[3px] border-l-[3px] border-white"></span>
        <span class="absolute bottom-0 right-0 size-10 rounded-br-2xl border-b-[3px] border-r-[3px] border-white"></span>
      </a>

      <label class="absolute bottom-9 left-5 flex size-[72px] cursor-pointer items-center justify-center rounded-full bg-white text-primary-500" aria-label="Unggah gambar QR">
        <x-icon name="image" :size="28" />
        <input type="file" accept="image/*" class="sr-only">
      </label>
      <a href="{{ url('/qreporting/history') }}" aria-label="Riwayat laporan"
         class="absolute bottom-9 right-5 flex size-[72px] items-center justify-center rounded-full bg-white text-primary-500">
        <x-icon name="history" :size="28" />
      </a>
    </div>

    <p class="mt-6 px-4 text-center text-[14px] leading-5 font-normal text-grey-600">Scan or Upload Designated QR from rooms to make a report.</p>
  </main>
</div>

<script>
  (function () {
    var v = document.getElementById('qr-video');
    if (!v || !navigator.mediaDevices) return;
    navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
      .then(function (s) { v.srcObject = s; }).catch(function () {});
  })();
</script>
@endsection
