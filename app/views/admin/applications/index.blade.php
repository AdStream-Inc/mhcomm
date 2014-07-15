@extends('admin.template.base')

@section('main.prepend')
  @if (Alert::has('success'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ Alert::first('success') }}
    </div>
  @endif
@stop

@section('content')
  <h1>Export Submitted Applications</h1>
  <div class="well clearfix">
    {{ Form::open() }}
      <div class="row">
        <div class="col-md-5">
          {{ Form::bootwrapped('start_date', 'Start Date', function($name) {
              return Form::text($name, null, array('class' => 'form-control datepicker'));
            })
          }}
        </div>
        <div class="col-md-5">
          {{ Form::bootwrapped('end_date', 'End Date', function($name) {
              return Form::text($name, null, array('class' => 'form-control datepicker'));
            })
          }}
        </div>
        <div class="col-md-2">
          <label>&nbsp;</label>
          {{ Form::submit('Export', array('class' => 'btn btn-success btn-block')) }}
        </div>
      </div>
    {{ Form::close() }}
  </div>
@stop