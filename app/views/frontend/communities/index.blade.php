@extends('frontend.template.base.1-col')

@section('title', 'All Communities')

@section('content')
    <div id="datatable"></div>
    <div id="datatable-pager"></div>
@stop

@section('scripts')
  <script>
    new Datatable();
  </script>
@stop