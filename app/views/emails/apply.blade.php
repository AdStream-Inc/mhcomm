@extends('emails.email-base')

@section('title', 'Application Form Submission')

@section('preheader-left', 'Application Form Submission')

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
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Comments</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $comments }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Type of application</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $purchase_or_renting }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Employed?</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $employed }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Monthly income</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $income }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Co-purchaser?</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $co_purchaser }}</td>
      </tr>
      @if (isset($co_purchaser_income))
        <tr>
          <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Co-purchaser income</td>
          <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $co_purchaser_income }}</td>
        </tr>
      @endif
      @if ($purchase_or_renting == 'Purchasing' || $purchase_or_renting == 'Renting')
        <tr>
          <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Bedrooms needed</td>
          <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $bedrooms }}</td>
        </tr>
      @endif
      @if ($purchase_or_renting == 'Moving In')
        <tr>
          <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">House Size</td>
          <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $house_size }}</td>
        </tr>
      @endif
      <tr>
        <td style="padding: 10px; background-color: #eee; border-bottom: 1px solid #fff;" width="30%">Move in date</td>
        <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $move_in_date }}</td>
      </tr>
      <tr>
        <td style="padding: 10px; background-color: #eee;" width="30%">Buying process</td>
        <td style="padding: 10px;">{{ $buying_process }}</td>
      </tr>
    </table>
@stop