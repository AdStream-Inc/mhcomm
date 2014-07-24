<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | MHCOMM</title>
    <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/frontend/images/favicon.ico') }}" type="image/x-icon">

    {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') }}
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
                <div class="col-xs-12 col-sm-3">
                    <span class="copyright">© 2014 <span>mhcomm</span></span>
                </div>
                <div class="col-xs-12 col-sm-9">
                    <ul class="list-inline flush-bottom">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('privacy-policy.html') }}">Privacy Policy</a></li>
                        <li><a href="{{ url('faqs.html') }}">FAQs</a></li>
                        <li><a href="{{ url('jobs') }}">Jobs</a></li>
                        <li><a href="{{ url('communities') }}">Communities</a></li>
                        <li><a href="{{ url('contact') }}">Contact Us</a></li>
                        <li><a href="{{ url('apply') }}">Apply</a></li>
                        <li><a href="{{ url('https://www.paylease.com/index_out.php?pm_id=4849579') }}">Pay Online</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-1161632-1', 'auto');
      ga('send', 'pageview');

    </script>
    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js') }}
    {{ HTML::script(asset('assets/frontend/js/app.min.js')) }}
    @yield('scripts')
  </body>
</html>