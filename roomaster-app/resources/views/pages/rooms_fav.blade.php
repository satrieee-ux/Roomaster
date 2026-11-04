@extends('layouts.app')

@section('content')
<x-rooms_page :active="3">
  <x-room_section title="Your Favorites" layout="stack" :seeAll="false" :rooms="$favorites" />
</x-rooms_page>
@endsection
