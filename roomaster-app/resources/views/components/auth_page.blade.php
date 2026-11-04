{{-- Kerangka Login/Sign Up: logo, judul, tab Log In|Sign Up, kartu putih (slot).
     GANTI latar: bg-primary-900 → bg-[url('/images/bg/auth.jpg')] bg-cover bg-center saat foto sudah ada. --}}
@props(['active' => 'login'])

<div class="flex min-h-full flex-col bg-primary-900 pt-[95px]">
  <img src="{{ asset('logo.svg') }}" alt="Roomaster" class="mx-auto h-[53px]">
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

  <div class="mx-8 mt-4 flex flex-1 flex-col rounded-t-3xl bg-white p-6 pb-8">
    {{ $slot }}
  </div>
</div>
