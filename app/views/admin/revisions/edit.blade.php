@extends('admin.template.base')

@section('main.prepend')

@stop

@section('wide-content')
  <div class="page-header">
    <h1>Changes <small>for {{$model->name}}</small></h1>
  </div>
  {{ Form::open(array('method' => 'PUT', 'url' => $adminUrl . '/revisions/' . $revisions[0]->group_hash)) }}
    @foreach ($revisions as $revision)
      <div class="well clearfix">
        <h4 class="list-group-item-heading">{{ $revision->user->present()->fullName }} changed field <code>{{ $revision->key }}</code> on {{ $revision->present()->createdOn}} to:</h4>
  <pre class="panel">{{$revision->new_value}}</pre>
        <div class="btn-group pull-right" data-toggle="buttons">
          <label class="btn btn-sm btn-default">
            <input type="radio" name="deny[{{ $revision->id }}]" value="{{ $revision->id }}"> Deny
          </label>
          <label class="btn btn-sm btn-default">
            <input type="radio" name="approve[{{ $revision->id }}]" value="{{ $revision->id }}"> Approve
          </label>
        </div>
      </div>
    @endforeach
    <hr />
    {{ Form::submit('Submit', array('class' => 'btn btn-success pull-right')) }}
  {{ Form::close() }}
@stop