@extends('layouts.app')

@section('content')
<x-myits_card>
  <h2 class="mt-5 text-[18px] leading-7 font-semibold text-grey-800">Sign In</h2>

  <form action="{{ url('/login-its/password') }}" method="GET" class="mt-3 flex flex-col">
    <x-form_field label="Email ITS" name="email" type="email" value="5026241065@student.its.ac.id" />
    <a href="#" class="mt-3 text-[14px] leading-5 font-semibold text-[#3B9BEB]">Forgot Password ?</a>
    <x-button type="submit" variant="primary" size="medium" class="mt-5 w-full !bg-[#0A91FF]">Next</x-button>

    <x-social_login />

    <p class="mt-6 text-center text-[14px] leading-5 font-normal text-grey-500">
      Don't have an account? <a href="#" class="font-semibold text-[#3B9BEB] underline">Sign Up</a>
    </p>

    <div class="mt-5 border-t border-grey-100 pt-4">
      <x-button :href="url('/login-its/accounts')" variant="soft" size="medium" iconLeft="key-round" class="w-full">Sign-in Options</x-button>
    </div>
  </form>
</x-myits_card>
@endsection
