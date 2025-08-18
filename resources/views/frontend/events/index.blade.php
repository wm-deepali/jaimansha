@extends('frontend.layouts.master')

@section('title', 'Events ||')


@section('content')
 
   @include('frontend.events.sections.eventsSection')

   @include('frontend.events.sections.eventsContent')
@endsection

