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
  <h1>Changes Needing Approval</h1>
    <div id="datatable"></div>
    <div id="datatable-pager"></div>
@stop

@section('scripts')
  <script>
    new Datatable();
  </script>
@stop
