{{-- Kerangka Login/Sign Up: latar statis (tidak ikut scroll), logo, judul, tab Log In|Sign Up, kartu putih (slot).
     padBottom = kelas padding bawah kartu, mis. padBottom="pb-14". Latar: public/images/bg/auth.jpg --}}
@props(['active' => 'login', 'padBottom' => 'pb-8'])

<div class="relative flex min-h-full flex-col bg-primary-900">
  {{-- Latar statis: tinggi sama dengan area layar (h-dvh / md:h-[844px] di layouts/app) --}}
  <div class="sticky top-0 z-0 h-0">
    <div class="absolute left-0 top-0 h-dvh w-full bg-primary-900 bg-cover bg-center md:h-[844px]"
         style="background-image: url('{{ asset('images/bg/auth.jpg') }}')">
      <div class="absolute inset-0 bg-gradient-to-b from-primary-900/80 via-primary-900/30 to-transparent"></div>
    </div>
  </div>

  <div class="relative z-10 flex flex-1 flex-col pt-[95px]">
    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="mx-auto h-[53px]">
    <h1 class="mt-3.5 text-center text-[24px] leading-7 font-extrabold text-white">Get Started Now</h1>
    <p class="mt-1 text-center text-[14px] leading-5 font-normal text-white">Create an account or log in.</p>

    <div class="mx-10 mt-4 flex rounded-xl bg-white/10 p-1">
      @foreach(['login' => ['Log In', '/login'], 'signup' => ['Sign Up', '/signup']] as $key => [$label, $url])
        <a href="{{ url($url) }}" @class([
          'flex h-8 flex-1 items-center justify-center rounded-lg text-[14px] leading-5 font-medium',
          'bg-white text-grey-800 shadow-card' => $active === $key,
          'text-white' => $active !== $key,
        ])>{{ $label }}</a>
      @endforeach
    </div>

    <div class="mx-8 mt-4 flex flex-1 flex-col rounded-t-3xl bg-white p-6 {{ $padBottom }}">
      {{ $slot }}
    </div>
  </div>
</div>
