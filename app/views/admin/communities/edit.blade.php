@extends('admin.template.base')

@section('content')
  <h1>Editing Community <small>{{ $job->name }}</small></h1>
  <div class="panel panel-default">
    {{ Form::model($community, array('route' => array($adminUrl . '.community.update', $community->id), 'class' => 'panel-body', 'method' => 'PUT')) }}
      <div class="form-group">
        {{ Form::bootwrapped('name', 'Name', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('description', 'Description', function($name){
            return Form::textarea($name, null, array('class' => 'form-control', 'rows' => '4'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('qualifications', 'Qualifications', function($name){
            return Form::textarea($name, null, array('class' => 'form-control', 'rows' => '4'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('enabled', 'Available?', function($name){
            return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
          })
        }}
      </div>
      <hr />
      {{ Form::submit('Update Community', array('class' => 'btn btn-success pull-right')) }}
    {{ Form::close() }}
  </div>
@stop
