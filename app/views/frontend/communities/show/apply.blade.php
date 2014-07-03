{{ Form::open() }}
<div class="row">
  <div class="col-md-12">
    <div class="well clearfix">
      <h1>Apply Now for Residency</h1>
      @include ('frontend.partials.apply')
    </div>
  </div>
</div>
{{ Form::close() }}

@section('scripts')
  @parent
  <script>
    var form = new ApplyForm();
  </script>
@stop