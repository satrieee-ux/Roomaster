@extends('layouts.app')

@section('content')
<x-rooms_page :active="2">
  <x-room_section title="FTEIC" :rooms="$fteic" seeAllUrl="/rooms/departemen" />
  <x-room_section title="FTIRS" :rooms="$ftirs" seeAllUrl="/rooms/departemen" />
  <x-room_section title="Recommended" layout="stack" :rooms="$recommended" />
</x-rooms_page>
@endsection
