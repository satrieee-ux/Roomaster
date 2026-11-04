@extends('layouts.app')

@section('content')
<x-rooms_page :active="1">
  <x-room_section title="TW-2" :rooms="$tw2" seeAllUrl="/rooms/skpb" />
  <x-room_section title="UPBG" :rooms="$upbg" seeAllUrl="/rooms/skpb" />
  <x-room_section title="Recommended" layout="stack" :rooms="$recommended" />
</x-rooms_page>
@endsection
