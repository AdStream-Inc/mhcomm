@extends('frontend.template.communities.2-col-right')

@section('title', $community->name)

@section('content')
@include('frontend.modules.communities.h1')
@include('frontend.modules.communities.gallery')
@include('frontend.modules.communities.' . $content)
@stop

@section('sidebar')
@include('frontend.modules.communities.navigation')
@stop