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
  <h1>
    Communities
    @if ($authUser->hasAnyAccess(array('communities.create')))
      <a class="btn btn-success pull-right" href="{{ route($adminUrl . '.communities.create') }}"><span class="fa fa-plus"></span> Create</a>
    @endif
  </h1>
  @if (count($communities))
    <div id="datatable"></div>
    <div id="datatable-pager"></div>
  @else
    <p>Looks like no communities have been added.</p>
  @endif
@stop

@section('scripts')
  <script>
    new Datatable();
  </script>
@stop