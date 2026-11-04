@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col bg-grey-100">
  <x-header_search :back="url('/search')" :filters="$filters" />

  <main class="flex flex-1 flex-col gap-4 pb-5 pt-4">
    <x-room_section title="Search Results" :rooms="$results" layout="stack" :seeAll="false" />
    <x-room_section title="More For You" :rooms="$more" layout="row" :seeAll="false" />
  </main>

  <x-popup_filter :action="url('/search/results')" />
  <x-popup_datepicker :action="url('/search/results')" />
</div>
@endsection
