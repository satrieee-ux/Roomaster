@extends('layouts.app')

@section('content')
<x-booking_form :id="$id" :room="$room" state="date" :date="$date" />
@endsection
