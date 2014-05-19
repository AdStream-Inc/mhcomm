@extends('frontend.template.base.base')

@section('title', 'Thanks!')

@section('main')
  <div class="container">
    <div class="well">
      <div class="jumbotron flush-bottom">
        <h1>Thanks for contacting us!</h1>
        <p>We will be in contact with you as soon as possible.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Go back home</a>
      </div>
    </div>
  </div>
@stop