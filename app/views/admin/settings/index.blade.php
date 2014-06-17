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
  <h1>Settings</h1>
  <div class="well clearfix">
    {{ Form::open() }}
      <div class="form-group">
        {{ Form::label('title', 'Site Title', array('class' => 'control-label')) }}
        {{ Form::text('title', $siteTitle, array('class' => 'form-control')) }}
      </div>
      <!-- <div class="form-group">
        {{ Form::label('admin_url', 'Admin Url', array('class' => 'control-label')) }}
        {{ Form::text('admin_url', $adminUrl, array('class' => 'form-control')) }}
        <span class="help-block">* Requires logout.</span>
      </div> -->
      <hr />
      {{ Form::submit('Save Settings', array('class' => 'btn btn-success pull-right')) }}
    {{ Form::close() }}
  </div>
@stop