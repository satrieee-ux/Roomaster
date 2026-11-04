{{-- Kartu putih di tengah layar untuk alur myITS SSO. GANTI latar bg-[#0B3A6B] dengan foto/pola nanti. --}}
<div class="flex min-h-full items-center justify-center bg-[#0B3A6B] px-8 py-10">
  <div class="w-full rounded-3xl bg-white p-6">
    <div class="flex items-center gap-2">
      <span class="text-[18px] leading-6 font-extrabold tracking-tight text-[#1E4E9B]">my<span class="text-[#1E4E9B]">ITS</span></span>
      <span class="text-[16px] leading-6 font-medium text-grey-800">Single Sign-On</span>
    </div>
    {{ $slot }}
  </div>
</div>
