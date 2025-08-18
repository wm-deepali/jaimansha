@extends('frontend.layouts.master')

@section('title', 'Event Details ||')


@section('content')


   @include('frontend.events_details.sections.eventspageheader')

   @include('frontend.events_details.sections.eventsdetails')
@endsection

