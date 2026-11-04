{{-- "Or login with" + (opsional) tombol MyITS + Google & Apple. myits="MyITS Account" untuk menampilkan tombol MyITS. --}}
@props(['myits' => null])

<div class="mt-6 flex items-center gap-3 text-[14px] leading-5 font-normal text-grey-500">
  <span class="h-px flex-1 bg-grey-100"></span>Or login with<span class="h-px flex-1 bg-grey-100"></span>
</div>

@if($myits)
  <a href="{{ url('/login-its/accounts') }}"
     class="mt-2 flex h-[38px] items-center justify-center gap-2 rounded-full bg-[#00589F] text-[14px] leading-5 font-medium text-white">
    <img src="{{ asset('images/logo-its.svg') }}" alt="ITS" class="size-6">{{ $myits }}
  </a>
@endif

<div class="mt-2.5 flex gap-2">
  <a href="#" class="flex h-[38px] flex-1 items-center justify-center gap-2 rounded-full border border-grey-200 bg-white text-[14px] leading-5 font-medium text-grey-800">
    <svg viewBox="0 0 24 24" class="size-5" aria-hidden="true">
      <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.27-4.74 3.27-8.1z"/>
      <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A11 11 0 0 0 12 23z"/>
      <path fill="#FBBC05" d="M5.84 14.1a6.6 6.6 0 0 1 0-4.2V7.07H2.18a11 11 0 0 0 0 9.86l3.66-2.83z"/>
      <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1A11 11 0 0 0 2.18 7.07l3.66 2.84C6.71 7.31 9.14 5.38 12 5.38z"/>
    </svg>Google
  </a>
  <a href="#" class="flex h-[38px] flex-1 items-center justify-center gap-2 rounded-full border border-grey-200 bg-white text-[14px] leading-5 font-medium text-grey-800">
    <svg viewBox="0 0 24 24" class="size-5" fill="currentColor" aria-hidden="true">
      <path d="M16.365 1.43c0 1.14-.493 2.27-1.177 3.08-.744.9-1.99 1.57-2.987 1.57-.12 0-.23-.02-.3-.03-.01-.06-.04-.22-.04-.39 0-1.15.572-2.27 1.206-2.98.804-.94 2.142-1.64 3.248-1.68.03.13.05.28.05.43zm4.565 15.71c-.03.07-.463 1.58-1.518 3.12-.945 1.34-1.94 2.71-3.43 2.71-1.517 0-1.9-.88-3.63-.88-1.698 0-2.302.91-3.67.91-1.377 0-2.332-1.26-3.428-2.8-1.287-1.82-2.323-4.63-2.323-7.28 0-4.28 2.797-6.55 5.552-6.55 1.448 0 2.675.95 3.6.95.865 0 2.222-1.01 3.902-1.01.613 0 2.886.06 4.374 2.19-.13.09-2.383 1.37-2.383 4.19 0 3.26 2.854 4.42 2.955 4.45z"/>
    </svg>Apple
  </a>
</div>
