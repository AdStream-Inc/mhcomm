@extends('admin.template.login')

@section('content')
  <h1 class="text-center">Reset password</h1>

  <div class="well">
    {{ Form::open() }}
      {{ Form::bootwrapped('email', 'Email', function($name){
          return Form::text($name, null, array('class' => 'form-control'));
        })
      }}
      <a href="{{ url($adminUrl . '/auth/login') }}" class="btn btn-default">Go Back</a>
      {{ Form::submit('Send Reminder', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
  </div>
@stop