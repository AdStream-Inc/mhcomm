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
  <h1>Users
    @if ($user->hasAnyAccess(array('users.create', 'users.delete')))
      <a class="btn btn-success pull-right" href="{{ route($adminUrl . '.users.create') }}"><span class="fa fa-plus"> Create</a>
    @endif
  </h1>
  @if (count($users))
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
            @foreach ($users as $person)
              <tr>
                <td><input type="checkbox"></td>
                <td class="col-md-4">
                  @if ($user->hasAnyAccess(array('users.create', 'users.delete')))
                    <a href="{{ route($adminUrl . '.users.edit', $person->id) }}">
                  @endif
                  {{ $person->email }}
                  @if ($user->hasAnyAccess(array('users.create', 'users.delete')))
                    </a>
                  @endif
                </td>
                <td class="col-md-4">{{ $person->present()->fullName }}</td>
                <td class="col-md-2">{{ $person->present()->lastLogin }}</td>
                <td class="col-md-2">{{ $person->present()->createdOn }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @else
    <p>Looks like no user have been added.</p>
  @endif
@stop
