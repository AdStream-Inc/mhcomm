@extends('admin.template.base')

@section('content')
  <h1>Add a Community</h1>
  <div class="well clearfix">
    {{ Form::open(array('route' => $adminUrl . '.communities.store')) }}
      {{ Form::bootwrapped('name', 'Community Name', function($name){
          return Form::text($name, null, array('class' => 'form-control'));
        })
      }}
      <hr />
      {{ Form::bootwrapped('address', 'Address', function($name){
          return Form::text($name, null, array('class' => 'form-control'));
        })
      }}
      <div class="row">
        <div class="col-sm-6">
          {{ Form::bootwrapped('city', 'City', function($name){
              return Form::text($name, null, array('class' => 'form-control'));
            })
          }}
        </div>
        <div class="col-sm-4">
          {{ Form::bootwrapped('state', 'State', function($name){
              return Form::text($name, null, array('class' => 'form-control'));
            })
          }}
        </div>
        <div class="col-sm-2">
            {{ Form::bootwrapped('zip', 'Zip', function($name){
                return Form::text($name, null, array('class' => 'form-control'));
              })
            }}
        </div>
      </div>
      {{ Form::bootwrapped('map_address', 'Map Display Address', function($name){
          return Form::text($name, null, array('class' => 'form-control has-note', 'data-content' => 'The address that should be shown on the interactive map.'));
        })
      }}
      <hr />
      <div class="row">
        <div class="col-sm-6">
          {{ Form::bootwrapped('phone', 'Phone', function($name){
              return Form::text($name, null, array('class' => 'form-control'));
            })
          }}
        </div>
        <div class="col-sm-6">
          {{ Form::bootwrapped('fax', 'Fax', function($name){
              return Form::text($name, null, array('class' => 'form-control'));
            })
          }}
        </div>
      </div>
      {{ Form::bootwrapped('email', 'Email Address', function($name){
          return Form::text($name, null, array('class' => 'form-control has-note', 'data-content' => 'Form submissions will be delivered to this email address. Seperate multiple email addresses with a comma.'));
        })
      }}
      <hr />
      {{ Form::bootwrapped('description', 'Description', function($name){
          return Form::textarea($name, null, array('class' => 'form-control wysiwyg', 'rows' => '6'));
        })
      }}
      {{ Form::bootwrapped('amenities', 'Amenities', function($name){
          return Form::textarea($name, null, array('class' => 'form-control has-note', 'rows' => '6', 'data-content' => 'Enter one feature per line.'));
        })
      }}
      {{ Form::bootwrapped('benefits', 'Benefits', function($name){
          return Form::textarea($name, null, array('class' => 'form-control has-note', 'rows' => '6', 'data-content' => 'Enter one feature per line.'));
        })
      }}
      {{ Form::bootwrapped('points_of_interest', 'Points of Interest', function($name){
          return Form::textarea($name, null, array('class' => 'form-control has-note', 'rows' => '6', 'data-content' => 'Enter one feature per line.'));
        })
      }}
      {{ Form::bootwrapped('office_hours', 'Office Hours', function($name){
          return Form::textarea($name, null, array('class' => 'form-control', 'rows' => '6'));
        })
      }}
      {{ Form::bootwrapped('license_number', 'License Number', function($name){
          return Form::text($name, null, array('class' => 'form-control has-note', 'data-content' => 'This field will only be visible on Texas communities.'));
        })
      }}
      {{ Form::bootwrapped('enabled', 'Enabled', function($name){
          return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
        })
      }}
      <hr />
      {{ Form::submit('Add Community', array('class' => 'btn btn-success pull-right')) }}
    {{ Form::close() }}
  </div>
@stop
