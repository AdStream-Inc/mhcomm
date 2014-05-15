@extends('frontend.template.base.1-col')

@section('title', 'Jobs')

@section('content')
	<h1>Current Job Opportunities</h1>
  <ul class="list-group">
    @foreach ($jobs as $job)
  	<li class="list-group-item">
      <h3 class="list-group-item-heading"><a href="{{ url('jobs/' . $job->slug . '.html') }}">{{ $job->name }}</a></h3>
      <p class="list-group-item-text">{{ $job->description }}</p>
	  </li>
  @endforeach
  </ul>
  {{ $jobs->links() }}
@stop