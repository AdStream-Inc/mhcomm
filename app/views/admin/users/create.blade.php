@extends('admin.template.base')

@section('main.prepend')
  @foreach (Alert::all() as $alert)
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ $alert }}
    </div>
  @endforeach
@stop

@section('content')
  <h1>Create a User</h1>
  <div class="panel panel-default">
    {{ Form::open(array('route' => $adminUrl . '.users.store', 'class' => 'panel-body')) }}
      <div class="form-group">
        {{ Form::bootwrapped('first_name', 'First Name', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('last_name', 'Last Name', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('email', 'Email', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('password', 'Password', function($name){
            return Form::password($name, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('user_group', 'Group', function($name) use($groups){
            return Form::select($name, $groups, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <hr />
      {{ Form::submit('Add User', array('class' => 'btn btn-success pull-right')) }}
    {{ Form::close() }}
  </div>
@stop
