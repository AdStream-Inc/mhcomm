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
        </div>
    </section>
@stop

@section('main')
    <div class="container">
        <section role="content">
            <div class="row">
                <div class="col-md-8">
                	Map
                </div>
                <div class="col-md-4">
                    <div class="well">
                        <h2>About Us</h2>
                        <p>We are your source to find your next home. Please take some time to browse through our member communities. If you have any questions don’t hesitate to call the community office, they are ready to help you.</p>
                    </div>
                    <a class="btn btn-primary btn-large col-xs-12 push-bottom">Pay Online</a>
                    <div class="toll-free-line text-center">
                        <p class="flush-bottom">Toll Free Information Line:</p>
                        <span class="phone">1-866-9MHCOMM</span>
                    </div>
                </div>
            </div>
    		<p class="alert alert-info current-special"><i class="fa fa-gift"></i>Current Special:</strong> Apply Online and Receive One Month’s Site Rent FREE or Double your Down Payment!* (We will match any down payment on a home that is over $1,000 and up to a maximum of $2,500)*</p>
            <div class="row featured-communities">
    			<h2 class="text-center">Featured Communities</h2>
            	<div class="col-sm-6 col-xs-12">
                	<div class="well">
                        <h3><a href="#">Deluxe Lake Estates</a></h3>
                        <p>Deluxe Lake Estates is a beautifal tree lined community located on a private stocked lake in Northern Illinois. It offers a playground, Large Lots and the conveniance of off-street parking. There are a number of community events throughout the year. It is also near a casino and within 10 miles of down town Peoria.</p>
                        <div class="contact">
                        	<span class="phone"><i class="fa fa-phone"></i> 309-697-4736</span>
                            <span class="address"><i class="fa fa-map-marker"></i> 338 N. Amy Drive, Bellevue, IL 12345</span>
                        </div>
                    </div>
                </div>
            	<div class="col-sm-6 col-xs-12">
                	<div class="well">
                        <h3><a href="#">Deluxe Lake Estates</a></h3>
                        <p>Deluxe Lake Estates is a beautifal tree lined community located on a private stocked lake in Northern Illinois. It offers a playground, Large Lots and the conveniance of off-street parking. There are a number of community events throughout the year. It is also near a casino and within 10 miles of down town Peoria.</p>
                        <div class="contact">
                        	<span class="phone"><i class="fa fa-phone"></i> 309-697-4736</span>
                            <span class="address"><i class="fa fa-map-marker"></i> 338 N. Amy Drive, Bellevue, IL 12345</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop