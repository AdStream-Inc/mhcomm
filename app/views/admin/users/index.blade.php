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
  <h1>Users</h1>
  <div class="row">
    <div class="col-md-7">

    </div>
    <div class="col-md-5 text-right">
      {{ Form::open(array('class' => 'form-inline')) }}
        <div class="btn-group form-group text-left">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Filters <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#" data-filter-reset>Show all</a></li>
            <li><a href="#" data-filter="enabled:1">Show enabled</a></li>
            <li><a href="#" data-filter="enabled:0">Show disabled</a></li>
          </ul>
        </div>
        <div class="form-group form-search">
          <input name="filter" placeholder="Search" class="form-control" type="text">
          <span class="fa fa-search text-muted form-search-icon"></span>
        </div>
        <a class="btn btn-success" href="{{ route($adminUrl . '.users.create') }}"><span class="fa fa-plus"> Create</a>
      {{ Form::close() }}
    </div>
  </div>
  @if (count($users))
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
        @foreach ($users as $user)
          <tr>
            <td><input type="checkbox"></td>
            <td class="col-md-4"><a href="{{ route($adminUrl . '.users.edit', $user->id) }}">{{ $user->email }}</a></td>
            <td class="col-md-4">{{ $user->first_name }} {{ $user->last_name }}</td>
            <td class="col-md-2">{{ $user->last_login }}</td>
            <td class="col-md-2">{{ $user->created_at }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>Looks like no jobs have been listed.</p>
  @endif
@stop
