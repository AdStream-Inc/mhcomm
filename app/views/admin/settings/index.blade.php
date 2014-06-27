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
      {{ Form::bootwrapped('title', 'Site Title', function($name) use ($siteTitle){
          return Form::text($name, $siteTitle, array('class' => 'form-control'));
        })
      }}
      {{ Form::bootwrapped('revision_emails', 'Recipient(s) for revision updates <span class="text-muted"> - comma separated</span>', function($name){
          return Form::text($name, Config::get('site.revision_emails'), array('class' => 'form-control'));
        })
      }}
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