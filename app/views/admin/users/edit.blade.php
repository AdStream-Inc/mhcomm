@extends('admin.template.base')

@section('content')
  <h1>Editing User <small>{{ $user->present()->fullName }}</small></h1>
  <div class="panel panel-default">
    {{ Form::model($user, array('route' => array($adminUrl . '.users.update', $user->id), 'class' => 'panel-body', 'method' => 'PUT')) }}
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
        {{ Form::bootwrapped('user_group', 'Group', function($name) use($groups, $userGroups){
            return Form::select($name, $groups, $userGroups, array('class' => 'form-control'));
          })
        }}
      </div>
      <hr />
      {{ Form::submit('Update User', array('class' => 'btn btn-success pull-right')) }}
    {{ Form::close() }}
  </div>
@stop
