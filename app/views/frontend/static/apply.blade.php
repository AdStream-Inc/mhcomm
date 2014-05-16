@extends('frontend.template.base.base')

@section('title', 'Contact Us')

@section('main')
  <div class="container">
    <h1>Pre-Qualification Application</h1>
    {{ Form::open() }}
    <div class="row">
      <div class="col-md-12">
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
            <div class="col-md-6">
              {{ Form::bootwrapped('employed', 'Employed full time?', function($name){
                  return Form::select($name, array('Yes' => 'Yes', 'No' => 'No'), null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-6">
              {{ Form::bootwrapped('income', 'Net monthly income', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-6">
              {{ Form::bootwrapped('purchase_or_renting', 'Interested in purchasing, renting, or moving in your own home?', function($name){
                  return Form::select($name, array('Purchasing' => 'Purchasing', 'Renting' => 'Renting', 'Moving In' => 'Moving In'), null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-6">
              {{ Form::bootwrapped('financing', 'Will you need financing through the community?', function($name){
                  return Form::select($name, array('Yes' => 'Yes', 'No' => 'No'), null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-6">
              {{ Form::bootwrapped('house_payment', 'Current monthly housing payment', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-6">
              {{ Form::bootwrapped('down_payment', 'The most you can put down towards a down payment', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-6">
              {{ Form::bootwrapped('co_purchaser', 'Do you have a co-purchaser?', function($name){
                  return Form::select($name, array('Yes' => 'Yes', 'No' => 'No'), null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-6">
              {{ Form::bootwrapped('down_payment', 'Co-purchaser monthly net income', function($name){
                  return Form::text($name, null, array('class' => 'form-control'));
                })
              }}
            </div>
          </div>
          <hr />
          {{ Form::submit('Submit', array('class' => 'btn btn-success pull-right')) }}
        </div>
      </div>
    </div>
  </div>
  {{ Form::close() }}
@stop