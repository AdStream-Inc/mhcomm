@extends('frontend.template.base.base')

@section('title', 'Contact Us')

@section('main')
  <div class="container">
    <h1>Pre-Qualification Application</h1>
    {{ Form::open() }}
    <div class="row">
      <div class="col-md-8">
        <div class="well clearfix">
          <div class="row">
            <div class="col-md-6">
              {{ Form::bootwrapped('first_name', 'First Name', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-6">
              {{ Form::bootwrapped('last_name', 'Last Name', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-12">
              {{ Form::bootwrapped('email', 'Email', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-5">
              {{ Form::bootwrapped('phone', 'Phone (include area code)', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-3">
              {{ Form::bootwrapped('time_to_contact', 'Best time to reach you?', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-4">
              {{ Form::bootwrapped('way_to_reach', 'Best way to contact you?', function($name){
                  return Form::select($name, array('email' => 'Email', 'phone' => 'Phone', 'mail' => 'Mail'), null, array('class' => 'form-control'));
                })
              }}
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-md-12">
              {{ Form::bootwrapped('street', 'Street', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-5">
              {{ Form::bootwrapped('city', 'City', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-4">
              {{ Form::bootwrapped('state', 'State', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-3">
              {{ Form::bootwrapped('zip', 'Zip', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-md-4">
              {{ Form::bootwrapped('employed', 'Employed full time?', function($name){
                  return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-4">
              {{ Form::bootwrapped('purchase_or_renting', 'Interested in purchasing or renting your own home?', function($name){
                  return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-4">
              {{ Form::bootwrapped('employed', 'Employed full time?', function($name){
                  return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-3">
              {{ Form::bootwrapped('income', 'Net Month Income', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-4">
              {{ Form::bootwrapped('income', 'Current monthly housing payment', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-2">
            {{ Form::bootwrapped('employed', 'Utilities included?', function($name){
                  return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
                })
              }}
            </div>
          <hr />
          {{ Form::submit('Submit', array('class' => 'btn btn-success pull-right')) }}
        </div>
      </div>
    </div>
  </div>
  {{ Form::close() }}
@stop