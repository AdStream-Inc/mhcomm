<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Installer &middot; Adstream CMS</title>

    <!-- Bootstrap -->
    {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.1.1-1/css/flatly/bootstrap.min.css') }}
    {{ HTML::style(asset('assets/admin/css/app.min.css')) }}
  </head>
  <body>
    <div id="installer">
      <h1 class="text-center">Install</h1>
      @if ($errors->has())
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{ $error }}
        </div>
      @endforeach
      @endif
      <div class="well">
        {{ Form::open() }}
          <div class="form-group @if($errors->has('title')) has-error @endif">
            {{ Form::label('title', 'Site Title') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}
          </div>
          <div class="form-group @if($errors->has('admin_url')) has-error @endif">
            {{ Form::label('admin_url', 'Admin Url') }}
            {{ Form::text('admin_url', null, array('class' => 'form-control')) }}
          </div>
          <div class="form-group @if($errors->has('first_name')) has-error @endif">
            {{ Form::label('first_name', 'First Name') }}
            {{ Form::text('first_name', null, array('class' => 'form-control')) }}
          </div>
          <div class="form-group @if($errors->has('last_name')) has-error @endif">
            {{ Form::label('last_name', 'Last Name') }}
            {{ Form::text('last_name', null, array('class' => 'form-control')) }}
          </div>
          <div class="form-group @if($errors->has('email')) has-error @endif">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', null, array('class' => 'form-control')) }}
          </div>
          <div class="form-group @if($errors->has('password')) has-error @endif">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', array('class' => 'form-control')) }}
          </div>
          {{ Form::submit('Install', array('class' => 'btn btn-success btn-block')) }}
        {{ Form::close() }}
      </div>
    </div>
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js') }}
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js') }}
  </body>
</html>