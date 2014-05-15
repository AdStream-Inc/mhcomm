@extends('frontend.template.base.base')

@section('body_class', 'home')

@section('title', 'Your Source For Community Living')

@section('logo_url', asset('assets/frontend/images/logo-white.png'))

@section('body_start')
    <section role="hero">
    	<div class="img">
        	<img src="{{ asset('assets/frontend/images/home/hero.jpg') }}" />
            <h1>Your Source for Community Living</h1>
		</div>
    </section>
@stop

@section('main')
    
    <div class="container">
        <div class="row">
            <section role="content">
            	<div class="row">
                    <div class="col-md-4 pull-right">
                        <div class="well">
                        	<h2>About Us</h2>
                            <p>We are your source to find your next home. Please take some time to browse through our member communities. If you have any questions don’t hesitate to call the community office, they are ready to help you.</p>
                        </div>
                        <a class="btn btn-primary btn-large col-xs-12">Pay Online</a>
                        <div class="col-xs-12 toll-free-line">
                        	Toll Free Information Line:<br>
                            <span class="phone">1-866-9MHCOMM</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                    	Map
                    </div>
                </div>
				<p class="bg-info current-special"><i class="fa fa-gift"></i>Current Special:</strong> Apply Online and Receive One Month’s Site Rent FREE or Double your Down Payment!* (We will match any down payment on a home that is over $1,000 and up to a maximum of $2,500)*</p>
                
                <div class="row featured-communities">
                
					<h2>Featured Communities</h2>
                
                	<div class="col-sm-6 col-xs-12">
                    	<div class="well">
                            <h3>Deluxe Lake Estates</h3>
                            <p>Deluxe Lake Estates is a beautifal tree lined community located on a private stocked lake in Northern Illinois. It offers a playground, Large Lots and the conveniance of off-street parking. There are a number of community events throughout the year. It is also near a casino and within 10 miles of down town Peoria.</p>
                            <div class="contact">
                            	<span class="phone"><i class="fa fa-phone"></i> 309-697-4736</span>
                                <span class="address"><i class="fa fa-map-marker"></i> 338 N. Amy Drive, Bellevue, IL 12345</span>
                            </div>
                        </div>
                    </div>
                	<div class="col-sm-6 col-xs-12">
                    	<div class="well">
                            <h3>Deluxe Lake Estates</h3>
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
    </div>
	
@stop