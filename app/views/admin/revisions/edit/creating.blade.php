@extends('admin.template.base')

@section('main.prepend')

@stop

@section('wide-content')
  <div class="page-header">
    <h1>{{$model->name}}</h1>
  </div>
  {{ Form::open(array('method' => 'PUT', 'url' => $adminUrl . '/revisions/' . $revisions[0]->group_hash)) }}
	<h4 class="list-group-item-heading">{{ $revisions[0]->user->present()->fullName }} created this item at {{ $revisions[0]->present()->createdOn}}</h4>
	<hr />
    @foreach ($revisions as $revision)
      <div class="well clearfix">
        <h4 class="list-group-item-heading">{{ $revision->present()->presentableKey }}</h4>
        <hr />
<pre class="panel">{{ $revision->presenter ? $model->{$revision->presenter}($revision->new_value) : $revision->new_value }}</pre>
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