@extends('frontend.template.base.1-col')

@section('body_class')
@parent
cms-page-{{ $page->name }}
@stop

@section('title', ucwords(str_replace('_', ' ', $page->name)))

@section('breadcrumbs')
  <div class="page-title-container clearfix">
    <h1 class="page-title pull-left">{{ ucwords(str_replace('_', ' ', $page->name)) }}</h1>
  </div>
  
@stop

@section('content')
  <div class="well">
    {{ $page->section($page->template . '-content') }}
  </div>
@stop