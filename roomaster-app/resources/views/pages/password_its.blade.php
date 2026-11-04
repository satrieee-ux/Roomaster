@extends('layouts.app')

@section('content')
<x-myits_card>
  <a href="{{ url('/login-its/email') }}" class="mt-4 flex items-center gap-2 text-[14px] leading-5 font-normal text-grey-500">
    <x-icon name="arrow-left" :size="20" /> {{ $email }}
  </a>
  <h2 class="mt-2 text-[18px] leading-7 font-semibold text-grey-800">Enter Password</h2>

  <form action="{{ url('/login-its') }}" method="POST" class="mt-3 flex flex-col">
    @csrf
    <x-form_field name="password" type="password" value="12345678901" />

    <div class="mt-3 flex items-center justify-between text-[14px] leading-5">
      <a href="#" class="font-semibold text-[#3B9BEB]">Forgot Password ?</a>
      <label class="flex items-center gap-2 font-normal text-grey-500">
        <input type="checkbox" name="remember" class="size-4 rounded border border-grey-500 accent-primary-800"> Remember me
      </label>
    </div>

    <x-button type="submit" variant="primary" size="medium" class="mt-5 w-full !bg-[#0A91FF]">Log In</x-button>
  </form>
</x-myits_card>
@endsection
