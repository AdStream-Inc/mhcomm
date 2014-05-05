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
  <h1>Specials <a class="btn btn-success pull-right" href="{{ route($adminUrl . '.specials.create') }}"><span class="fa fa-plus"> Create</a></h1>
  @if (count($specials))
    <div id="datatable"></div>
    <div id="datatable-pager"></div>
  @else
    <p>Looks like no specials have been added.</p>
  @endif
@stop

@section('scripts')
  <script>
    new Datatable();
  </script>
@stop
