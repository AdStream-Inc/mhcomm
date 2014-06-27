@extends('emails.email-base')

@section('title', 'Revision Pending Your Approval')

@section('preheader-left', 'Revision Pending Your Approval')

@section('body-title', 'Revision Pending Your Approval')

@section('body-subtitle', 'Below is the url where you can find the pending revision.')

@section('body-content')
  <a href="{{ url(Config::get('site.admin_url') . '/revisions/'. $hash . '/edit') }}">Link to revision</a>
@stop