@extends('admin.template.base')

@section('content')
  <h1>Create a Job</h1>
  <div class="well clearfix">
    {{ Form::open(array('route' => $adminUrl . '.jobs.store')) }}
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
      {{ Form::submit('Add Job', array('class' => 'btn btn-success pull-right')) }}
    {{ Form::close() }}
  </div>
@stop
