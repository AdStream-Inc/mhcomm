@extends('emails.email-base')

@section('title', 'Contact Form Submission')

@section('preheader-left', 'Contact Form Submission')

@section('body-title', 'Coupon Courtesy Of: ' . $location)

@section('body-content')
  {{ $content }}
  <hr />
  <p>This coupon is valid until the following date: <strong>{{ date('M d, Y', strtotime('+30 days')) }}</strong></p>
  <p>For questions regarding this coupon please call {{ $location }} at {{ $phone }}</p>
@stop