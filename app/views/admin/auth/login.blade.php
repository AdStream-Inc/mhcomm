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
      <h1 class="text-center">Login</h1>

      @foreach (Alert::all() as $alert)
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{ $alert }}
        </div>
      @endforeach

      <div class="well">
        {{ Form::open() }}
          <div class="form-group @if($errors->has('email')) has-error @endif">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', null, array('class' => 'form-control')) }}
          </div>
          <div class="form-group @if($errors->has('password')) has-error @endif">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', array('class' => 'form-control')) }}
          </div>
          <div class="form-group checkbox">
            <label for="remember_me">
              {{ Form::checkbox('remember_me', null, null, array('id' => 'remember_me')) }} Remember Me?
            </label>
          </div>
          {{ Form::submit('Login', array('class' => 'btn btn-success btn-block')) }}
        {{ Form::close() }}
      </div>
    </div>
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js') }}
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js') }}
  </body>
</html>