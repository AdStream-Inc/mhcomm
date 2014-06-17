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
  <h1>Application Coupon</h1>
  <div class="well clearfix">
    {{ Form::open() }}
      {{ Form::bootwrapped('content', 'Coupon Content', function($name) use ($content) {
          return Form::textarea($name, $content, array('class' => 'form-control', 'rows' => '4'));
        })
      }}
      <hr />
      {{ Form::submit('Update Coupon', array('class' => 'btn btn-success pull-right')) }}
    {{ Form::close() }}
  </div>
@stop