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
    <div class="table-responsive">
      <table id="community-list" class="table table-hover table-striped table-bordered flush-bottom">
        <thead>
          <tr class="bg-primary">
            <th>Community Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($communities as $community)
            <tr data-url="{{ url('communities/' . $community->slug . '.html') }}">
              <td>{{ $community->name }}</td>
              <td>{{ $community->address }}</td>
              <td>{{ $community->city }}</td>
              <td>{{ $community->state }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop