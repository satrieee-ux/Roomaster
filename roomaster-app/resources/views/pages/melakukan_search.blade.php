@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col bg-grey-100">
  <x-header_search :back="url('/rooms')" />

  <main class="flex flex-1 flex-col gap-4 pb-5 pt-5">
    <x-room_section title="Recently Searched" :rooms="$recent" layout="row" :seeAll="false" />
    <x-room_section title="For You" :rooms="$forYou" layout="list" :seeAll="false" />
  </main>

  <x-popup_filter :action="url('/search/results')" />
  <x-popup_datepicker :action="url('/search/results')" />
</div>
@endsection
