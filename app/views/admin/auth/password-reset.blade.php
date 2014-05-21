@extends('admin.template.login')

@section('content')
  <h1 class="text-center">Reset password</h1>

  <div class="well">
    {{ Form::open() }}
      {{ Form::hidden('token', $token) }}
      {{ Form::bootwrapped('email', 'Email', function($name){
          return Form::text($name, null, array('class' => 'form-control'));
        })
      }}
      {{ Form::bootwrapped('password', 'Password', function($name){
          return Form::password($name, array('class' => 'form-control'));
        })
      }}
      {{ Form::bootwrapped('password_confirmation', 'Confirm Password', function($name){
          return Form::password($name, array('class' => 'form-control'));
        })
      }}
      {{ Form::submit('Reset Password', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
@stop