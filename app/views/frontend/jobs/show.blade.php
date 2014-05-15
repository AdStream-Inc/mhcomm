@extends('frontend.template.base.1-col')

@section('title', 'Jobs')

@section('content')
	<h1>{{ $job->name }}</h1>
  <div class="row">
    <div class="col-sm-8">
      <div class="well">
        <h3>Job Description</h3>
        {{ $job->description }}
      </div>
    </div>
    <div class="col-sm-4">
      <div class="well">
        <h3>Qualifications</h3>
        {{ $job->qualifications }}
      </div>
    </div>
  </div>
@stop