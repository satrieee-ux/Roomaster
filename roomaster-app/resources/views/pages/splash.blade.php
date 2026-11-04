@extends('layouts.app')

@section('content')
{{-- GANTI latar bg-grey-50 dengan foto blur nanti --}}
<div class="flex min-h-full flex-col items-center bg-grey-50 px-14 pb-8 pt-[278px]">
  <img src="{{ asset('logo.svg') }}" alt="Roomaster" class="h-[52px]">
  <h1 class="mt-3 text-center text-[24px] leading-7 font-extrabold text-primary-900">Welcome to<br>Roomaster.</h1>
  <p class="mt-1 text-center text-[14px] leading-5 font-normal text-grey-800">Pinjam Ruangan Langsung Beres,<br>Lapor Kerusakan Anti Stres.</p>

  <div class="mt-14 flex w-full flex-col gap-3">
    <x-button :href="url('/signup')" variant="primary" size="medium" class="w-full">Get Started</x-button>
    <x-button :href="url('/login')" variant="primary" size="medium" class="w-full !bg-white !text-grey-800 shadow-card">Log In</x-button>
  </div>
</div>
@endsection
