@extends('frontend.layouts.master')

@section('title', 'Blog Details ||')


@section('content')
   @include('frontend.blog_details.sections.blogpagedetails')

      @include('frontend.blog_details.sections.blogsdetailscontent')

@endsection
