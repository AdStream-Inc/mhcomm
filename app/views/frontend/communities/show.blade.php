@extends('frontend.template.communities.2-col-left')

@section('body_class')
@parent
community-{{ $content }}
@stop

@section('title', ucwords(str_replace('_', ' ', $content)) . ' - ' . $community->name)

@section('breadcrumbs')
  {{ Breadcrumbs::render('community', $community, $content) }}
@stop

@section('content')
<h1>{{ ucwords(str_replace('_', ' ', $content)) . ' <span>' . $community->name . '</span>' }}</h1>
@include('frontend.communities.show.' . $content)
@stop

@section('sidebar')
@include('frontend.communities.show.sidebar', array('content' => $content))
@stop