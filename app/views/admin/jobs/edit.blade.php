@extends('admin.template.base')

@section('content')
  <div id="confirm-delete-modal" class="modal fade">
    {{ Form::open(array('route' => array($adminUrl . '.jobs.destroy', $job->id), 'method' => 'DELETE')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Confirm Action</h4>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this job?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
        </div>
      </div>
    </div>
    {{ Form::close() }}
  </div>

  <h1>Editing Job <small>{{ $job->name }}</small></h1>
  <div class="well clearfix">
    {{ Form::model($job, array('route' => array($adminUrl . '.jobs.update', $job->id), 'method' => 'PUT')) }}
      {{ Form::bootwrapped('name', 'Name', function($name){
          return Form::text($name, null, array('class' => 'form-control'));
        })
      }}
      {{ Form::bootwrapped('description', 'Description', function($name){
          return Form::textarea($name, null, array('class' => 'form-control wysiwyg', 'rows' => '4'));
        })
      }}
      {{ Form::bootwrapped('qualifications', 'Qualifications', function($name){
          return Form::textarea($name, null, array('class' => 'form-control wysiwyg', 'rows' => '4'));
        })
      }}
      {{ Form::bootwrapped('enabled', 'Available?', function($name){
          return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
        })
      }}
      <hr />
      {{ Form::submit('Update Job', array('class' => 'btn btn-success pull-right')) }}
      @if ($isAdmin || $isAdstream)
        <button class="btn btn-danger pull-right push-right" type="button" data-toggle="modal" data-target="#confirm-delete-modal">Delete Job</button>
      @endif
    {{ Form::close() }}
  </div>
@stop
