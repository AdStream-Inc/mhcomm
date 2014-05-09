@extends('frontend.template.base')

@section('title', 'Communities')

@section('header')
  <div class="header">
    @include('frontend.modules.header')
  </div>
@stop

@section('main')
  <div class="container">
    <div id="datatable"></div>
    <div id="datatable-pager"></div>
  </div>
@stop

@section('footer')

@stop

@section('scripts')
  <script>
    new Datatable();
  </script>
@stop