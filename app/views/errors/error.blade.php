@extends('frontend.template.base.base')

@section('title', 'Page Not Found')

@section('main')
  <div class="container">
    <div class="well">
      <div class="jumbotron flush-bottom">
        <h1>Error</h1>
        <p>There was an error processing your request. Please try again later.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Go back home</a>
        <a href="{{ url('contact') }}" class="btn btn-primary">Contact us</a>
      </div>
    </div>
  </div>
@stop