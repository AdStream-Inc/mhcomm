@extends('frontend.template.base.1-col')

@section('title', 'All Communities')

@section('content')
  <div class="well">
    <div class="clearfix row">
      <h1 class="pull-left col-sm-10 col-xs-12">Our Communities</h1>
      <div class="pull-right col-sm-2 col-xs-12">
        {{ Form::select('state_filter', $communityStates, Input::get('state_filter'), array('class' => 'form-control input-sm', 'id' => 'state-filter')) }}
      </div>
    </div>
    <hr />
    <table class="table table-hover table-striped table-bordered flush-bottom">
      <thead>
        <tr class="bg-primary">
          <th>Community</th>
          <th>Address</th>
          <th>City</th>
          <th>State</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($communities as $community)
          <tr>
            <td>{{ $community->name }}</td>
            <td>{{ $community->address }}</td>
            <td>{{ $community->city }}</td>
            <td>{{ $community->state }}</td>
            <td class="text-center"><a href="{{ url('communities/' . $community->slug . '.html') }}">View</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@stop

@section('scripts')
  <script>
    (function($) {
      $('#state-filter').on('change', function() {
        var val = $(this).val();

        if (!val || val == 0) {
          window.location = URL.base + '/communities';
        } else {
          window.location.href = URL.current + '?state_filter=' + val;
        }
      });
    })(jQuery);
  </script>
@stop