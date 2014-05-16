@extends('frontend.template.base.base')

@section('title', 'Page Not Found')

@section('main')
  <div class="container">
    <div class="well">
      <div class="jumbotron flush-bottom">
        <h1>Page Not Found</h1>
        <p>The page you have requested may have been moved or renamed.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Go back home</a>
        <a href="{{ url('contact') }}" class="btn btn-primary">Contact us</a>
      </div>
    </div>
  </div>
@stop