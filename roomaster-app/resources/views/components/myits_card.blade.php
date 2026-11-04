{{-- Kartu putih di tengah layar untuk alur myITS SSO. Latar: public/images/bg/myits.jpg --}}
<div class="flex min-h-full items-center justify-center bg-[#0B3A6B] bg-cover bg-center px-8 py-10"
     style="background-image: url('{{ asset('images/bg/myits.jpg') }}')">
  <div class="w-full rounded-3xl bg-white p-6">
    <div class="flex items-center gap-2">
      <span class="text-[18px] leading-6 font-extrabold tracking-tight text-[#1E4E9B]">my<span class="text-[#1E4E9B]">ITS</span></span>
      <span class="text-[16px] leading-6 font-medium text-grey-800">Single Sign-On</span>
    </div>
    {{ $slot }}
  </div>
</div>
