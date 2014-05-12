@extends('frontend.template.base')

@section('header')
    <div class="navbar main-navbar" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('assets/frontend/images/logo-black.png') }}" /></a>
        </div>
        <div class="collapse navbar-collapse" id="main-navbar-collapse">
          <div class="navbar-form navbar-right">
          	<span class="phone">Phone: {{ $community->phone }}</span>
            <a class="btn btn-primary" href="#">Apply Now</a>
          </div>
        </div>
      </div>
    </div>
@stop

@section('footer')
@stop