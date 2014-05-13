@extends('frontend.template.base')

@section('body_class')
community
@stop

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
          <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('assets/frontend/images/logo-community.png') }}" /></a>
        </div>
        <div class="collapse navbar-collapse" id="main-navbar-collapse">
          <div class="navbar-form navbar-right">
          	<div class="contact">
                <span class="address"><i class="fa fa-map-marker"></i>{{ $community->address . ', ' . $community->city . ', ' . $community->state . ' ' . $community->zip }}</span>
                <span class="telephone"><i class="fa fa-phone"></i>{{ $community->phone }}</span>
            </div>
            <a class="btn btn-primary" href="#">Apply Now</a>
          </div>
        </div>
      </div>
    </div>
@stop

@section('footer')
	<div class="container">
        <span class="copyright navbar-left">© 2014 <span>mhcomm</span></span>
        <ul class="navbar-nav navbar-right">
			<li><a href="#">Privacy Policy</a></li>
			<li><a href="#">FAQs</a></li>
			<li><a href="#">Jobs</a></li>
			<li><a href="#">Communities</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Apply</a></li>
			<li><a href="#">Pay Online</a></li>
        </ul>
    </div>
@stop