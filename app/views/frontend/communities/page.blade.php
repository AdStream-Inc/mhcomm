@extends('frontend.template.communities.2-col-left')

@section('body_class')
  @parent
  community-page-{{ $page->name }}
@stop

@section('title', ucwords(str_replace('_', ' ', $page->name)) . ' - ' . $community->name)

@section('breadcrumbs')
  {{-- {{ Breadcrumbs::render('community_page', $community, $page->getParents(), $page) }} --}}
@stop

@section('content')
  <div class="well clearfix">
    {{ $page->section($page->template . '-content') }}
  </div>
@stop

@section('sidebar')
  @include('frontend.communities.show.sidebar', array('content' => $page))
@stop