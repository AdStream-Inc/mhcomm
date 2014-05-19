@extends('emails.email-base')

@section('title', 'Contact Form Submission')

@section('preheader-left', 'Contact Form Submission')

@section('body-title', 'Email from: ' . $first_name . ' ' . $last_name)

@section('body-subtitle', 'Below is the information this person has submitted for review')

@section('body-content')
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#FFFFFF; border:1px solid #ddd;">
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Regarding</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $community }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">First name</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $first_name }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Last name</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $last_name }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Email</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $email }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Phone</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $phone}}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Best time to contact</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $time_to_contact }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Best way to reach</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $way_to_reach }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Street</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $street }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">City</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $city }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">State</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $state }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Zip</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $zip }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee;" width="30%">Comments</td>
        <td style="padding: 10px;">{{ $comments }}</td>
      </tr>
    </table>
@stop