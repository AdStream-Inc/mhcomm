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
          <a class="navbar-brand" href="{{ url('/') }}"><img src="@yield('logo_url', asset('assets/frontend/images/logo-black.png'))" /></a>
        </div>
        <div class="collapse navbar-collapse" id="main-navbar-collapse">
          <div class="navbar-form navbar-right">
            <a class="btn btn-primary" href="{{ url('apply-now') }}">Apply Now</a>
          </div>
          <ul class="nav navbar-nav navbar-right">
            <li @if(Request::is('communities*')) class="active" @endif><a href="{{ url('communities') }}">Communities</a></li>
            <li @if(Request::is('jobs*')) class="active" @endif><a href="{{ url('jobs') }}">Jobs</a></li>
            <li @if(Request::is('contact*')) class="active" @endif><a href="{{ url('contact') }}">Contact</a></li>
          </ul>
        </div>
      </div>
    </div>
@stop