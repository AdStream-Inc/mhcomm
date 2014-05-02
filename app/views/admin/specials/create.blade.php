@extends('admin.template.base')

@section('content')
  <h1>Create a Special</h1>
  <div class="well clearfix">
    {{ Form::open(array('route' => $adminUrl . '.specials.store')) }}
      {{ Form::bootwrapped('name', 'Name', function($name){
          return Form::text($name, null, array('class' => 'form-control'));
        })
      }}
      <div class="row">
        <div class="col-md-6">
          {{ Form::bootwrapped('communities[]', 'Community', function($name) use($communities) {
              return Form::select($name, $communities, null, array('class' => 'form-control', 'multiple'));
            })
          }}
        </div>
        <div class="col-md-6">
          {{ Form::bootwrapped('enabled', 'Enabled', function($name){
              return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
            })
          }}
        </div>
      </div>
      {{ Form::bootwrapped('content', 'Content', function($name){
          return Form::textarea($name, null, array('class' => 'form-control wysiwyg-image', 'rows' => '4'));
        })
      }}
      <hr />
      {{ Form::submit('Add Special', array('class' => 'btn btn-success pull-right')) }}
    {{ Form::close() }}
  </div>
@stop
