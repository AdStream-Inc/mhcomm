@extends('frontend.template.base.base')

@section('title', 'Thanks!')

@section('main')
  <div class="container">
    <div class="well">
      <div class="jumbotron flush-bottom">
        <h2><strong>Thanks for applying to {{ $couponData['location'] }}!</strong></h2>
        <p>As a token of our gratitude here is a coupon on behalf of {{ $couponData['location'] }}. For questions regarding this coupon please call {{ $couponData['location'] }} at {{ $couponData['phone'] }}</p>
        <hr />
        <p>{{ $couponData['content'] }}</p>
        <p>This coupon is valid until the following date: <strong>{{ date('M d, Y', strtotime('+30 days')) }}</strong></p>
        <hr />
        @if (Session::has('visited_community'))
          <a href="{{ url('communities/' . Session::get('visited_community') . '.html') }}" class="btn btn-primary">Go back</a>
        @else
          <a href="{{ url('/') }}" class="btn btn-primary">Go back</a>
        @endif
      </div>
    </div>
  </div>
@stop