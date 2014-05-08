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
         base: '{{ url('/') }}',
         current: '{{ URL::current() }}',
         full: '{{ URL::full() }}',
         admin: '{{ url(Config::get('site.admin_url')) }}'
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
              @if ($authUser->hasAnyAccess(array('pages.create', 'pages.delete', 'pages.edit', 'pages.list')))
                <li @if(Request::is($adminUrl . '/pages*')) class="active" @endif>
                  <a href="{{ route($adminUrl . '.pages.index') }}"><span class="fa fa-file"></span> Pages</a>
                </li>
              @endif
              <li class="dropdown @if(Request::is($adminUrl . '/communities*')) active @endif">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="fa fa-map-marker"></span> Communities <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route($adminUrl . '.communities.index') }}">Manage Communities</a></li>
                  @if ($communityRevisions && $authUser->hasAccess('revisions.list'))
                    <li><a href="{{ url($adminUrl . '/communities/revisions') }}"> Revisions <span class="revision-label label pull-right label-danger">{{ $communityRevisions }}</span></a></li>
                  @endif
                </ul>
              </li>
              <li class="dropdown @if(Request::is($adminUrl . '/specials*')) active @endif">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="fa fa-asterisk"></span> Specials <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route($adminUrl . '.specials.index') }}">Manage Specials</a></li>
                  @if ($specialsRevisions && $authUser->hasAccess('revisions.list'))
                    <li><a href="{{ url($adminUrl . '/specials/revisions') }}"> Revisions <span class="revision-label label pull-right label-danger">{{ $specialsRevisions }}</span></a></li>
                  @endif
                </ul>
              </li>
              @if ($authUser->hasAnyAccess(array('jobs.create', 'jobs.delete', 'jobs.edit', 'jobs.list')))
                <li @if(Request::is($adminUrl . '/jobs*')) class="active" @endif>
                  <a href="{{ route($adminUrl . '.jobs.index') }}"><span class="fa fa-briefcase"></span> Jobs</a>
                </li>
              @endif
              @if ($authUser->hasAnyAccess(array('users.create', 'users.delete', 'users.edit', 'users.list')))
                <li @if(Request::is($adminUrl . '/users*')) class="active" @endif>
                  <a href="{{ route($adminUrl . '.users.index') }}"><span class="fa fa-users"></span> Users</a>
                </li>
              @endif
            </ul>
            <ul class="nav navbar-nav navbar-right system-nav">
              @if ($authUser->hasAccess('settings'))
                <li @if(Request::is($adminUrl . '/settings')) class="active" @endif>
                  <a href="{{ url($adminUrl . '/settings') }}" title="Settings"><span class="fa fa-gears"></span> <span class="visible-xs">Settings</span></a>
                </li>
              @endif
              <li><a href="{{ url('/') }}" title="Preview"><span class="fa fa-home"></span> <span class="visible-xs">Preview</span></a></li>
              <li><a href="{{ url($adminUrl . '/auth/logout') }}" title="Logout"><span class="fa fa-sign-out"></span> <span class="visible-xs">Logout</span></a></li>
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
      <div class="container-wide clearfix">
        @yield('wide-content')
      </div>
    </div>
    <div id="footer" class="clearfix">
        <span class="pull-left text-muted">{{ Config::get('site.title') }}</span>
        <span class="pull-right text-muted"><a href="http://adstreaminc.com">Adstream</a> Admin Version {{ Config::get('site.version') }}</span>
    </div>
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
    {{ HTML::script(asset('assets/admin/js/app.min.js')) }}
    @yield('scripts')
  </body>
</html>