@extends('admin.template.base')

@section('content')
  <h1>Editing Special <small>{{ $special->name }}</small></h1>
  <div class="well clearfix">
    {{ Form::model($special, array('route' => array($adminUrl . '.specials.update', $special->id), 'method' => 'PUT')) }}
      {{ Form::bootwrapped('name', 'Name', function($name){
          return Form::text($name, null, array('class' => 'form-control'));
        })
      }}
      <div class="row">
        @if (!$isManager)
          <div class="col-md-6">
            {{ Form::bootwrapped('communities[]', 'Community', function($name) use($communities, $activeCommunities) {
                return Form::select($name, $communities, $activeCommunities, array('class' => 'form-control' , 'multiple'));
              })
            }}
          </div>
        @endif
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
      {{ Form::submit('Update Special', array('class' => 'btn btn-success pull-right')) }}
    {{ Form::close() }}
  </div>
@stop
