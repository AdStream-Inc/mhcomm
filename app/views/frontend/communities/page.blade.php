@extends('frontend.template.communities.2-col-left')

@section('body_class')
@parent
community-page-{{ $page->name }}
@stop

@section('title', ucwords(str_replace('_', ' ', $page->name)) . ' - ' . $community->name)

@section('breadcrumbs')
  {{-- {{ Breadcrumbs::render('community_page', $community, $page->getParents(), $page) }} --}}
  <div class="page-title-container clearfix">
    <h1 class="page-title">{{ ucwords(str_replace('_', ' ', $page->name)) . ' <span>' . $community->name . '</span>' }}</h1>
    @if (count($community->images))
      <span class="small text-muted gallery-toggle">View Gallery <span class="fa fa-picture-o"></span></span>
    @endif
  </div>

  @if (count($community->images))
  <div id="gallery">
    @foreach ($community->images as $key => $image)
      <a href="{{ $image->path }}" class="gallery-image" title="{{ $image->name }}">
        <img src="{{ $image->path }}" class="img-responsive img-thumbnail" alt="{{ $image->name }}" />
      </a>
    @endforeach
  </div>
  @endif
@stop

@section('content')
  <div class="well">
    {{ $page->section($page->template . '-content') }}
  </div>
@stop

@section('sidebar')
  @include('frontend.communities.show.sidebar', array('content' => $page))
@stop