@extends('admin.template.base')

@section('content')
  <h1>Editing Special <small>{{ $special->name }}</small></h1>
  <div class="panel panel-default">
    {{ Form::model($special, array('route' => array($adminUrl . '.specials.update', $special->id), 'method' => 'PUT', 'class' => 'panel-body')) }}
      {{ Form::bootwrapped('name', 'Name', function($name){
          return Form::text($name, null, array('class' => 'form-control'));
        })
      }}
      <div class="row">
        <div class="col-md-6">
          {{ Form::bootwrapped('community_id', 'Community', function($name) use($communities) {
              return Form::select($name, $communities, null, array('class' => 'form-control'));
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
          return Form::textarea($name, null, array('class' => 'form-control wysiwyg-special', 'rows' => '4'));
        })
      }}
      <hr />
      {{ Form::submit('Update Special', array('class' => 'btn btn-success pull-right')) }}
    {{ Form::close() }}
  </div>
@stop
