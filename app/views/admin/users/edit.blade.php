@extends('admin.template.base')

@section('content')
  <div id="confirm-delete-modal" class="modal fade">
    {{ Form::open(array('route' => array($adminUrl . '.users.destroy', $user->id), 'method' => 'DELETE')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Confirm Action</h4>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this user?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
        </div>
      </div>
    </div>
    {{ Form::close() }}
  </div>

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
      @if ($isAdmin || $isAdstream)
        <button class="btn btn-danger pull-right push-right" type="button" data-toggle="modal" data-target="#confirm-delete-modal">Delete User</button>
      @endif
    {{ Form::close() }}
  </div>
@stop
