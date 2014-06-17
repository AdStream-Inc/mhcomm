<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | MHCOMM</title>
    <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/frontend/images/favicon.ico') }}" type="image/x-icon">

    {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css') }}
    {{ HTML::style(asset('assets/frontend/css/app.min.css')) }}
    @yield('styles')

    <script>
       var URL = {
         base: '{{ url('/') }}',
         current: '{{ URL::current() }}',
         full: '{{ URL::full() }}'
       };
    </script>
  </head>
  <body class="@yield('body_class')">
  	@yield('body_start')
    <div class="page">
        <section role="header">
            @yield('header')
        </section>
        <section role="breadcrumbs">
        	<div class="container">
	        	@yield('breadcrumbs')
            </div>
        </section>
        <section role="main">
            @yield('main')
        </section>
        <div class="push"></div>
    </div>
    <section role="footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 pull-right">
                    <ul class="navbar-nav pull-right">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('privacy-policy.html') }}">Privacy Policy</a></li>
                        <li><a href="{{ url('faqs.html') }}">FAQs</a></li>
                        <li><a href="{{ url('jobs') }}">Jobs</a></li>
                        <li><a href="{{ url('communities') }}">Communities</a></li>
                        <li><a href="{{ url('contact') }}">Contact</a></li>
                        <li><a href="{{ url('apply') }}">Apply</a></li>
                        <li><a href="{{ url('https://www.paylease.com/index_out.php?pm_id=4849579') }}">Pay Online</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <span class="copyright navbar-left">© 2014 <span>mhcomm</span></span>
                </div>
            </div>
        </div>
    </section>

    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
    {{ HTML::script(asset('assets/frontend/js/app.min.js')) }}
    @yield('scripts')
  </body>
</html>