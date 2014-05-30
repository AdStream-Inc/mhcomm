@extends('admin.template.base')

@section('main.prepend')

@stop

@section('wide-content')
  <div class="page-header">
    <h1>{{$model->name}}</h1>
  </div>
  {{ Form::open(array('method' => 'PUT', 'url' => $adminUrl . '/revisions/' . $revisions[0]->group_hash)) }}
  	<div class="clearfix">
    <h4 class="list-group-item-heading pull-left">{{ $revisions[0]->user->present()->fullName }} deleted this item on {{ $revisions[0]->present()->createdOn}}</h4>
    <div class="btn-group pull-right" data-toggle="buttons">
      <label class="btn btn-sm btn-default">
        <input type="radio" name="deny[{{ $revisions[0]->id }}]" value="{{ $revisions[0]->id }}"> Deny
      </label>
      <label class="btn btn-sm btn-default">
        <input type="radio" name="approve[{{ $revisions[0]->id }}]" value="{{ $revisions[0]->id }}"> Approve
      </label>
    </div>
    </div>
    <hr />
    {{ Form::submit('Submit', array('class' => 'btn btn-success pull-right')) }}
  {{ Form::close() }}
@stop