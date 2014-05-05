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
    @if ($authUser->hasAnyAccess(array('users.create')))
      <a class="btn btn-success pull-right" href="{{ route($adminUrl . '.users.create') }}"><span class="fa fa-plus"> Create</a>
    @endif
  </h1>
  @if (count($users))
    <div id="datatable"></div>
    <div id="datatable-pager"></div>
  @else
    <p>Looks like no user have been added.</p>
  @endif
@stop

@section('scripts')
  <script>
    new Datatable();
  </script>
@stop