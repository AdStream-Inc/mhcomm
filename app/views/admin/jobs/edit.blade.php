@extends('admin.template.base')

@section('content')
  <h1>Editing Job <small>{{ $job->name }}</small></h1>
  <div class="well clearfix">
    {{ Form::model($job, array('route' => array($adminUrl . '.jobs.update', $job->id), 'method' => 'PUT')) }}
      {{ Form::bootwrapped('name', 'Name', function($name){
          return Form::text($name, null, array('class' => 'form-control'));
        })
      }}
      {{ Form::bootwrapped('description', 'Description', function($name){
          return Form::textarea($name, null, array('class' => 'form-control', 'rows' => '4'));
        })
      }}
      {{ Form::bootwrapped('qualifications', 'Qualifications', function($name){
          return Form::textarea($name, null, array('class' => 'form-control', 'rows' => '4'));
        })
      }}
      {{ Form::bootwrapped('enabled', 'Available?', function($name){
          return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
        })
      }}
      <hr />
      {{ Form::submit('Update Job', array('class' => 'btn btn-success pull-right')) }}
    {{ Form::close() }}
  </div>
@stop
