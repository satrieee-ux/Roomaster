@extends('layouts.app')

@section('content')
<x-rooms_page :active="0">
  <x-room_section title="Frequently Booked" :rooms="$frequent" seeAllUrl="/rooms" />
  <x-room_section title="Recommended" layout="stack" :rooms="$recommended" />
</x-rooms_page>
@endsection
