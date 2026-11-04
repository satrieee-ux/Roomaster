@extends('layouts.app')

@section('content')
<x-auth_page active="signup" padBottom="pb-14">
  <form action="{{ url('/signup') }}" method="POST" class="flex flex-col">
    @csrf
    <div class="flex flex-col gap-4">
      <div class="grid grid-cols-2 gap-4">
        <x-form_field label="First Name" name="first_name" value="Lois" />
        <x-form_field label="Last Name" name="last_name" value="Becket" />
      </div>
      <x-form_field label="Email" name="email" type="email" value="radityaprazenko@gmail.com" />
      <x-form_field label="Birth of date" name="birth" type="text" value="18/03/2024" icon="calendar" />

      <x-form_field label="Phone Number" name="phone" type="tel" value="(454) 726-0592">
        <x-slot:prefix>
          <span class="flex shrink-0 items-center gap-1 border-r border-grey-100 pr-3 text-[14px]">🇮🇩 <x-icon name="chevron-down" :size="16" class="text-grey-600" /></span>
        </x-slot:prefix>
      </x-form_field>

      <x-form_field label="Set Password" name="password" type="password" value="1234567" />
    </div>

    <x-button type="submit" variant="primary" size="medium" class="mt-6 w-full">Sign Up</x-button>

    <x-social_login myits="Masuk dengan MyITS" />
  </form>
</x-auth_page>
@endsection
