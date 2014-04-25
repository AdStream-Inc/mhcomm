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
    <div id="header">
      <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url($adminUrl) }}">{{ $siteTitle }}</a>
          </div>

          <div class="collapse navbar-collapse" id="main-nav-collapse">
            <ul class="nav navbar-nav">
              <li><a href="#"><span class="fa fa-map-marker"></span> Communities</a></li>
              <li><a href="#"><span class="fa fa-file"></span> Pages</a></li>
              <li @if(Request::is($adminUrl . '/jobs*')) class="active" @endif>
                <a href="{{ route($adminUrl . '.jobs.index') }}"><span class="fa fa-briefcase"></span> Jobs</a>
              </li>
              @if ($user->hasAnyAccess(array('users.create', 'users.delete')))
                <li @if(Request::is($adminUrl . '/users*')) class="active" @endif>
                  <a href="{{ route($adminUrl . '.users.index') }}"><span class="fa fa-users"></span> Users</a>
                </li>
              @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
              @if ($user->hasAccess('settings'))
                <li @if(Request::is($adminUrl . '/settings')) class="active" @endif>
                  <a href="{{ url($adminUrl . '/settings') }}"><span class="fa fa-gears"></span> Settings</a>
                </li>
              @endif
              <li><a href="{{ url('/') }}"><span class="fa fa-home"></span> Preview</a></li>
              <li><a href="{{ url($adminUrl . '/auth/logout') }}"><span class="fa fa-sign-out"></span> Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
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