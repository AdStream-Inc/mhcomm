@extends('admin.template.base')

@section('content')
  <h1>Editing User <small>{{ $user->present()->fullName }}</small></h1>
  <div class="well clearfix">
    {{ Form::model($user, array('route' => array($adminUrl . '.users.update', $user->id), 'method' => 'PUT')) }}
      {{ Form::bootwrapped('first_name', 'First Name', function($name){
          return Form::text($name, null, array('class' => 'form-control'));
        })
      }}
      {{ Form::bootwrapped('last_name', 'Last Name', function($name){
          return Form::text($name, null, array('class' => 'form-control'));
        })
      }}
      {{ Form::bootwrapped('email', 'Email', function($name){
          return Form::text($name, null, array('class' => 'form-control'));
        })
      }}
      {{ Form::bootwrapped('user_group', 'Group', function($name) use($groups, $userGroups){
          return Form::select($name, $groups, $userGroups, array('class' => 'form-control'));
        })
      }}
      <hr />
      {{ Form::submit('Update User', array('class' => 'btn btn-success pull-right')) }}
    {{ Form::close() }}
  </div>
@stop
