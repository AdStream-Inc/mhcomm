<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login &middot; Adstream CMS</title>

    <!-- Bootstrap -->
    {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.1.1-1/css/flatly/bootstrap.min.css') }}
    {{ HTML::style(asset('assets/admin/css/app.min.css')) }}
  </head>
  <body>
    <div id="login">
      @if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
        <strong>Error: </strong>
        {{ $message }}
      </div>
      @endif

      @if ($message = Session::get('status'))
      <div class="alert alert-success alert-block">
        <strong>Success: </strong> {{ $message }}
      </div>
      @endif

      @foreach (Alert::all() as $alert)
        <div class="alert alert-danger">
          {{ $alert }}
        </div>
      @endforeach

      @yield('content')
    </div>
  </body>
</html>