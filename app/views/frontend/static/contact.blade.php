@extends('frontend.template.base.base')

@section('title', 'Contact Us')

@section('main')
  <div class="container">
    {{ Form::open() }}
      <div class="well clearfix">
        <h1>Contact Us</h1>
        <hr />
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
        {{ Form::bootwrapped('type', 'Why are you reaching out to us?', function($name){
            return Form::select($name, array('comment' => 'Comment', 'question' => 'Question', 'complaint' => 'Complaint', 'other' => 'Other'), null, array('class' => 'form-control'));
          })
        }}
        {{ Form::bootwrapped('comments', 'Questions or comments', function($name){
            return Form::textarea($name, null, array('class' => 'form-control', 'rows' => 6));
          })
        }}
        <hr />
        {{ Form::submit('Submit', array('class' => 'btn btn-success pull-right')) }}
      </div>
    {{ Form::close() }}
  </div>
@stop