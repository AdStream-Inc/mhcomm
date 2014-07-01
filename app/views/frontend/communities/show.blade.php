@extends('frontend.template.communities.2-col-left')

@section('body_class')
@parent
community-{{ $content }}
@stop

@section('title', ucwords(str_replace('_', ' ', $content)) . ' - ' . $community->name)

@section('breadcrumbs')
  {{-- {{ Breadcrumbs::render('community', $community, $content) }} --}}

  @if (count($community->images))
  <!-- <div id="gallery">
    @foreach ($community->images as $key => $image)
      <a href="{{ $image->path }}" class="gallery-image" title="{{ $image->name }}">
        <img src="{{ $image->path }}" class="img-responsive img-thumbnail" alt="{{ $image->name }}" />
      </a>
    @endforeach
  </div> -->
  @endif
@stop

@section('content')
<!-- <h1 class="page-title">{{ ucwords(str_replace('_', ' ', $content)) . ' <span>' . $community->name . '</span>' }}</h1> -->
@include('frontend.communities.show.' . $content)
@stop

@section('sidebar')
@include('frontend.communities.show.sidebar', array('content' => $content))
@stop