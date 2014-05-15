@extends('frontend.template.base.1-col')

@section('title', 'Jobs')

@section('content')
	<h1>Jobs</h1>
    <ul>
    @foreach ($jobs as $job)
    	<li>
        	<p class="lead">{{ $job->name }}</p>
            <p>{{ $job->description }}</p>
		</li>
    @endforeach
    </ul>
@stop