<div class="clearfix">
  <p class="text-muted pull-right"><span class="text-danger">*</span> required fields</p>
</div>
<div class="row">
  @if (Session::has('community') || isset($community))
    {{ Form::hidden('community', $community->name) }}
  @endif
  <div class="col-md-6">
    {{ Form::bootwrapped('first_name', 'First Name <span class="text-danger">*</span>', function($name){
        return Form::text($name, null, array('class' => 'form-control'));
      })
    }}
  </div>
  <div class="col-md-6">
    {{ Form::bootwrapped('last_name', 'Last Name <span class="text-danger">*</span>', function($name){
        return Form::text($name, null, array('class' => 'form-control'));
      })
    }}
  </div>
  <div class="col-md-12">
    {{ Form::bootwrapped('email', 'Email <span class="text-danger">*</span>', function($name){
        return Form::text($name, null, array('class' => 'form-control'));
      })
    }}
  </div>
  <div class="col-md-5">
    {{ Form::bootwrapped('phone', 'Phone (include area code) <span class="text-danger">*</span>', function($name){
        return Form::text($name, null, array('class' => 'form-control'));
      })
    }}
  </div>
  <div class="col-md-3">
    {{ Form::bootwrapped('time_to_contact', 'Best time to reach you?', function($name){
        return Form::text($name, null, array('class' => 'form-control'));
      })
    }}
  </div>
  <div class="col-md-4">
    {{ Form::bootwrapped('way_to_reach', 'Best way to contact you? <span class="text-danger">*</span>', function($name){
        return Form::select($name, array('email' => 'Email', 'phone' => 'Phone', 'mail' => 'Mail'), null, array('class' => 'form-control'));
      })
    }}
  </div>
</div>
<hr />
<div class="row">
  <div class="col-md-12">
    {{ Form::bootwrapped('street', 'Street <span class="text-danger">*</span>', function($name){
        return Form::text($name, null, array('class' => 'form-control'));
      })
    }}
  </div>
  <div class="col-md-5">
    {{ Form::bootwrapped('city', 'City <span class="text-danger">*</span>', function($name){
        return Form::text($name, null, array('class' => 'form-control'));
      })
    }}
  </div>
  <div class="col-md-4">
    {{ Form::bootwrapped('state', 'State <span class="text-danger">*</span>', function($name){
        return Form::text($name, null, array('class' => 'form-control'));
      })
    }}
  </div>
  <div class="col-md-3">
    {{ Form::bootwrapped('zip', 'Zip <span class="text-danger">*</span>', function($name){
        return Form::text($name, null, array('class' => 'form-control'));
      })
    }}
  </div>
</div>
<hr />
@if (Session::has('communities') || isset($communities))
  {{ Form::bootwrapped('community', 'Community you are interested in', function($name) use($communities) {
      return Form::select($name, $communities, null, array('class' => 'form-control'));
    })
  }}
@endif
{{ Form::bootwrapped('purchase_or_renting', 'Interested in purchasing, renting, or moving in your own home?', function($name){
    return Form::select($name, array('Purchasing' => 'Purchasing', 'Renting' => 'Renting', 'Moving In' => 'Moving In'), null, array('class' => 'form-control', 'id' => 'type-toggle'));
  })
}}
<hr />
<div class="row">
  <div class="col-md-6">
    {{ Form::bootwrapped('employed', 'Employment Status', function($name){
        return Form::select($name, array('Full-Time' => 'Full-Time', 'Part-Time' => 'Part-Time', 'Fixed Income' => 'Fixed Income', 'Other' => 'Other'), null, array('class' => 'form-control'));
      })
    }}
  </div>
  <div class="col-md-6">
    {{ Form::bootwrapped('house_payment', 'Current monthly housing payment', function($name){
        return Form::text($name, null, array('class' => 'form-control'));
      })
    }}
  </div>
  <div class="col-md-6">
    {{ Form::bootwrapped('co_purchaser', 'Do you have a co-purchaser?', function($name){
        return Form::select($name, array('No' => 'No', 'Yes' => 'Yes'), 'No', array('class' => 'form-control', 'id' => 'co-sign-toggle'));
      })
    }}
  </div>
  <div class="col-md-6">
    {{ Form::bootwrapped('income', 'Monthly gross income <span class="text-danger">*</span>', function($name){
        return Form::text($name, null, array('class' => 'form-control'));
      })
    }}
  </div>
  <div class="col-md-6" data-type="cosigner">
    {{ Form::bootwrapped('co_purchaser_income', 'Co-purchaser monthly gross income', function($name){
        return Form::text($name, null, array('class' => 'form-control'));
      })
    }}
  </div>
</div>
<hr />
<div class="row">
  <div class="col-md-6" data-type="purchasing:renting">
    {{ Form::bootwrapped('bedrooms', 'Number of bedrooms needed', function($name){
        return Form::select($name, array('1' => 1, '2' => 2, '3' => 3, '4' => 4), null, array('class' => 'form-control'));
      })
    }}
  </div>
  <div class="col-md-6" data-type="moving-in">
    {{ Form::bootwrapped('house_size', 'Size of your home', function($name){
        return Form::select($name, array('16x80' => '16x80', '14x70' => '14x70', '12x60' => '12x60', 'Other' => 'Other'), null, array('class' => 'form-control'));
      })
    }}
  </div>
</div>
<hr />
<div class="row">
  <div class="col-md-6">
    {{ Form::bootwrapped('move_in_date', 'How soon until you&apos;re ready to move in?', function($name){
        return Form::text($name, null, array('class' => 'form-control'));
      })
    }}
  </div>
  <div class="col-md-6">
    {{ Form::bootwrapped('buying_process', 'Where are you in the buying process', function($name){
        return Form::select($name, array('Just Looking' => 'Just Looking', 'Ready to move' => 'Ready to move', 'Moving in next few months' => 'Moving in next few months'), null, array('class' => 'form-control'));
      })
    }}
  </div>
</div>
<hr />
{{ Form::bootwrapped('how_did_you_hear', 'How did you hear about us?', function($name){
    return Form::select($name, array('Web Search' => 'Web Search', 'Newspapaer' => 'Newspapaer', 'Friend/Relative' => 'Friend/Relative', 'Craigslist' => 'Craigslist', 'Drove By' => 'Drove By', 'Other' => 'Other'), null, array('class' => 'form-control', 'id' => 'type-toggle'));
  })
}}
{{ Form::bootwrapped('comments', 'Questions or comments', function($name){
    return Form::textarea($name, null, array('class' => 'form-control', 'rows' => 6));
  })
}}
<hr />
{{ Form::submit('Submit', array('class' => 'btn btn-success pull-right')) }}


@section('scripts')
  @parent
  <script>
    var form = new ApplyForm();
  </script>
@stop