@extends('frontend.template.base.base')

@section('title', 'Contact Us')

@section('main')
  <div class="container">
    {{ Form::open() }}
      <div class="row">
        <div class="col-md-12">
          <div class="well clearfix">
            <h1>Apply Now for Residency</h1>
            <hr />
            @include ('frontend.partials.apply')
          </div>
        </div>
      </div>
    {{ Form::close() }}
  </div>
@stop