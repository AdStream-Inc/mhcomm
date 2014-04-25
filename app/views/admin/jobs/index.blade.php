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
  <h1>Jobs <a class="btn btn-success pull-right" href="{{ route($adminUrl . '.jobs.create') }}"><span class="fa fa-plus"> Create</a></h1>
  @if (count($jobs))
    <div class="panel panel-default">
      <div class="panel-body">
        {{ Form::open() }}
          <div class="form-search">
            <input name="filter" placeholder="Search" class="form-control" type="text">
            <span class="fa fa-search text-muted form-search-icon"></span>
          </div>
        {{ Form::close() }}
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th><input type="checkbox"></th>
              @foreach ($fields as $field)
                <th>{{ $field }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($jobs as $job)
              <tr>
                <td><input type="checkbox"></td>
                <td class="col-md-6"><a href="{{ route($adminUrl . '.jobs.edit', $job->id) }}">{{ $job->name }}</a></td>
                <td class="col-md-3">{{ $job->present()->isEnabled }}</td>
                <td class="col-md-3">{{ $job->present()->createdOn }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @else
    <p>Looks like no jobs have been added.</p>
  @endif
@stop
