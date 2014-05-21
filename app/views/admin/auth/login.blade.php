@extends('admin.template.login')

@section('content')
  <h1 class="text-center">Login</h1>

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
      <div class="clearfix">
        <div class="form-group checkbox pull-left">
          <label for="remember_me">
            {{ Form::checkbox('remember_me', null, null, array('id' => 'remember_me')) }} Remember Me?
          </label>
        </div>
        <a href="{{ url('password/remind') }}" class="pull-right well-sm">Forgot password?</a>
      </div>
      <hr />
      {{ Form::submit('Login', array('class' => 'btn btn-primary btn-block')) }}
    {{ Form::close() }}
  </div>
@stop