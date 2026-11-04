@extends('layouts.app')

@section('content')
<x-booking_form :id="$id" :room="$room" state="time" :date="$date" :time="$time"
                :activity="$activity" :purpose="$purpose" :department="$department" />
@endsection
