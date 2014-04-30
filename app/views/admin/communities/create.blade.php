@extends('admin.template.base')

@section('content')
  <h1>Add a Community</h1>
  <div class="panel panel-default">
    {{ Form::open(array('route' => $adminUrl . '.communities.store', 'class' => 'panel-body')) }}
      <div class="form-group">
        {{ Form::bootwrapped('name', 'Name', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('address', 'Address', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('city', 'City', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('state', 'State', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('zip', 'Zip', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('map_address', 'Map Display Address', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('phone', 'Phone', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('email', 'Email Address', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('description', 'Description', function($name){
            return Form::textarea($name, null, array('class' => 'form-control wysiwyg', 'rows' => '6'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('amenities', 'Amenities', function($name){
            return Form::textarea($name, null, array('class' => 'form-control', 'rows' => '6'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('benefits', 'Benefits', function($name){
            return Form::textarea($name, null, array('class' => 'form-control', 'rows' => '6'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('points_of_interest', 'Points of Interest', function($name){
            return Form::textarea($name, null, array('class' => 'form-control', 'rows' => '6'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('office_hours', 'Office Hours', function($name){
            return Form::textarea($name, null, array('class' => 'form-control', 'rows' => '6'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('license_number', 'License Number', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
      </div>
      <div class="form-group">
        {{ Form::bootwrapped('enabled', 'Enabled', function($name){
            return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
          })
        }}
      </div>
      <hr />
      {{ Form::submit('Add Community', array('class' => 'btn btn-success pull-right')) }}
    {{ Form::close() }}
  </div>
@stop
