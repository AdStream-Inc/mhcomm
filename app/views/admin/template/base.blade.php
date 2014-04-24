<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') Adstream CMS</title>

    <!-- Bootstrap -->
    {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.1.1-1/css/flatly/bootstrap.min.css') }}
    {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css') }}
    {{ HTML::style(asset('assets/admin/css/app.min.css')) }}
    @yield('styles')

    <script>
       var URL = {
         'base' : '{{ URL::to('/') }}',
         'current' : '{{ URL::current() }}',
         'full' : '{{ URL::full() }}'
       };
    </script>
  </head>
  <body>
    @yield('nav.append')
    <div id="main">
      <div class="container">
          @yield('main.prepend')
          @yield('content')
          @yield('main.append')
      </div>
    </div>
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js') }}
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js') }}
    @yield('scripts')
  </body>
</html>