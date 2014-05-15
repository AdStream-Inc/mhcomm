@extends('frontend.template.base.1-col')

@section('title', 'All Communities')

@section('content')
  <div class="well">
    <h1>Our Communities</h1>
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