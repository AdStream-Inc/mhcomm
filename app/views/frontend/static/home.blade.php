@extends('frontend.template.base.base')

@section('body_class', 'home')

@section('title', 'Your Source For Community Living')

@section('logo_url', asset('assets/frontend/images/logo-white.png'))

@section('header')
    @parent
    <section role="hero" class="hero">
        <img class="hero-image" src="{{ asset('assets/frontend/images/home/home-hero.png') }}" />
        <div class="hero-inner">
            <h1 class="hero-title">Your Source for Community Living</h1>
            <!-- <a href="{{ url('communities') }}" class="btn btn-lg btn-info">Find Your Community!</a> -->
        </div>
    </section>
@stop

@section('main')
    <div class="container">
        <section role="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="well">
                        <div class="flexible-container push-bottom">
                    	   <div id="map-canvas"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well">
                        <h2>About Us</h2>
                        <p>We are your source to find your next home. Please take some time to browse through our member communities. If you have any questions don’t hesitate to call the community office, they are ready to help you.</p>
                    </div>
                    <a href="{{ url('https://www.paylease.com/index_out.php?pm_id=4849579') }}" class="btn btn-primary btn-large col-xs-12 push-bottom">Pay Online</a>
                    <div class="toll-free-line text-center">
                        <p class="flush-bottom">Toll Free Information Line:</p>
                        <span class="phone">1-866-9MHCOMM</span>
                    </div>
                </div>
            </div>
    		<p class="alert alert-info current-special"><i class="fa fa-gift"></i><strong>Current Special:</strong> Apply Online and Receive One Month’s Site Rent FREE or Double your Down Payment!* (We will match any down payment on a home that is over $1,000 and up to a maximum of $2,500)*</p>
            @if ($featured)
                <h2 class="text-center">Featured Communities</h2>
                <div class="row featured-communities">
                @foreach ($featured as $community)
                	<div class="col-sm-6 col-xs-12">
                    	<div class="well">
                            <h3><a href="{{ url('communities/' . $community->slug) . '.html' }}">{{ $community->name }}</a></h3>
                            <p>{{ $community->description }}</p>
                            <div class="contact">
                            	<span class="phone"><i class="fa fa-phone"></i> {{ $community->phone }}</span>
                                <span class="address"><i class="fa fa-map-marker"></i> {{ $community->address }}, {{ $community->city }}, {{ $community->state }} {{ $community->zip }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @endif
        </section>
    </div>
@stop

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script>
    <script>
        new HomeMap();
    </script>
@stop