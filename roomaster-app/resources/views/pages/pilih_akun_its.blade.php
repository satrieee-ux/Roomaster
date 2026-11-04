@extends('layouts.app')

@section('content')
<x-myits_card>
  <h2 class="mt-4 text-[18px] leading-7 font-semibold text-grey-800">Sign In Options</h2>

  <div class="mt-3 flex flex-col gap-2">
    @foreach($accounts as $a)
      <a href="{{ url('/login-its/email') }}" @class([
        'flex items-center gap-3 rounded-xl px-3 py-2.5',
        'border border-grey-100 bg-white shadow-[0_1px_2px_rgba(20,26,40,0.06)]' => $a['type'] === 'student',
        'bg-grey-50' => $a['type'] !== 'student',
      ])>
        <x-icon :name="$a['type'] === 'student' ? 'user' : 'user-round-check'" :size="20" class="shrink-0 text-grey-500" />
        <span class="flex min-w-0 flex-col">
          <span class="truncate text-[14px] leading-5 font-medium text-grey-800">{{ $a['email'] }}</span>
          <span class="text-[12px] leading-4 font-normal text-grey-500">{{ $a['label'] }}</span>
        </span>
      </a>
    @endforeach
  </div>

  <div class="mt-3 border-t border-grey-100 pt-3">
    <x-button :href="url('/login')" variant="soft" size="medium" class="w-full">Back</x-button>
  </div>
</x-myits_card>
@endsection
