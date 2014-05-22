@extends('admin.template.base')

@section('content')
  <h1>Editing Community <small>{{ $community->name }}</small></h1>
  <ul class="nav nav-tabs">
    <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
    <li><a href="#images" data-toggle="tab">Additonal Images</a></li>
  </ul>
  <div class="modal fade" id="preview-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Image Preview</h4>
        </div>
        <div class="modal-body text-center">
          <img class="img-responsive img-thumbnail" src="{{ $community->main_image }}" />
        </div>
      </div>
    </div>
  </div>
  <div id="confirm-delete-modal" class="modal fade">
    {{ Form::open(array('route' => array($adminUrl . '.communities.destroy', $community->id), 'method' => 'DELETE')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Confirm Action</h4>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this community? <strong>NOTE:</strong> This will also delete all community pages associated with this community.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
        </div>
      </div>
    </div>
    {{ Form::close() }}
  </div>
  {{ Form::model($community, array('route' => array($adminUrl . '.communities.update', $community->id), 'method' => 'PUT', 'files' => true)) }}
  <div class="tab-content">
    <div class="tab-pane active" id="details">
      <div class="well clearfix">
        {{ Form::bootwrapped('name', 'Community Name', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
        <div class="media">
          @if ($community->main_image)
            <div class="pull-left">
              <img width="150" class="media-object img-responsive img-thumbnail push-half-bottom" style="cursor: pointer" data-toggle="modal" data-target="#preview-modal" src="{{ $community->main_image }}">
              <button type="button" class="btn btn-xs btn-danger btn-block" id="main-image-remove">Remove</button>
              {{ Form::hidden('main_image', $community->main_image, array('id' => 'main-image-hidden', 'disabled')) }}
            </div>
          @endif
          <div class="media-body">
            {{ Form::bootwrapped('main_image_file', 'Main Image <span class="small text-muted">- will override current image</span>', function($name){
                return Form::file($name, array('accept' => 'image/gif, image/jpeg, image/png'));
              })
            }}
          </div>
        </div>
        <hr />
        {{ Form::bootwrapped('address', 'Address', function($name){
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
        <div class="row">
          <div class="col-sm-6">
            {{ Form::bootwrapped('city', 'City', function($name){
                return Form::text($name, null, array('class' => 'form-control'));
              })
            }}
          </div>
          <div class="col-sm-4">
            {{ Form::bootwrapped('state', 'State', function($name){
                return Form::text($name, null, array('class' => 'form-control'));
              })
            }}
          </div>
          <div class="col-sm-2">
            {{ Form::bootwrapped('zip', 'Zip', function($name){
                return Form::text($name, null, array('class' => 'form-control'));
              })
            }}
          </div>
        </div>
        {{ Form::bootwrapped('map_address', 'Map Display Address', function($name){
            return Form::text($name, null, array('class' => 'form-control has-note', 'data-content' => 'The address that should be shown on the interactive map.'));
          })
        }}
        <hr />
        <div class="row">
          <div class="col-sm-6">
            {{ Form::bootwrapped('phone', 'Phone', function($name){
                return Form::text($name, null, array('class' => 'form-control'));
              })
            }}
          </div>
          <div class="col-sm-6">
            {{ Form::bootwrapped('fax', 'Fax', function($name){
                return Form::text($name, null, array('class' => 'form-control'));
              })
            }}
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            {{ Form::bootwrapped('email', 'Email Address', function($name){
                return Form::text($name, null, array('class' => 'form-control has-note', 'data-content' => 'Form submissions will be delivered to this email address. Seperate multiple email addresses with a comma.'));
              })
            }}
          </div>
          <div class="col-sm-6 @if ($isManager || $isSuperManager) hidden @endif">
            {{ Form::bootwrapped('managers[]', 'Managers', function($name) use ($managers, $community, $activeManagers) {
                return Form::select($name, $managers, $activeManagers, array('class' => 'form-control', 'multiple'));
              })
            }}
          </div>
        </div>
        <hr />
        {{ Form::bootwrapped('description', 'Description', function($name){
            return Form::textarea($name, null, array('class' => 'form-control wysiwyg-image', 'rows' => '6'));
          })
        }}
        {{ Form::bootwrapped('amenities', 'Amenities', function($name){
            return Form::textarea($name, null, array('class' => 'form-control has-note', 'rows' => '6', 'data-content' => 'Enter one feature per line.'));
          })
        }}
        {{ Form::bootwrapped('benefits', 'Benefits', function($name){
            return Form::textarea($name, null, array('class' => 'form-control has-note', 'rows' => '6', 'data-content' => 'Enter one feature per line.'));
          })
        }}
        {{ Form::bootwrapped('points_of_interest', 'Points of Interest', function($name){
            return Form::textarea($name, null, array('class' => 'form-control has-note', 'rows' => '6', 'data-content' => 'Enter one feature per line.'));
          })
        }}
        {{ Form::bootwrapped('office_hours', 'Office Hours', function($name){
            return Form::textarea($name, null, array('class' => 'form-control', 'rows' => '6'));
          })
        }}
        {{ Form::bootwrapped('license_number', 'License Number', function($name){
            return Form::text($name, null, array('class' => 'form-control has-note', 'data-content' => 'This field will only be visible on Texas communities.'));
          })
        }}
        {{ Form::bootwrapped('enabled', 'Enabled', function($name){
            return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
          })
        }}
        <hr />
        {{ Form::submit('Update Community', array('class' => 'btn btn-success pull-right')) }}
        @if ($isAdmin || $isAdstream)
          <button class="btn btn-danger pull-right push-right" type="button" data-toggle="modal" data-target="#confirm-delete-modal">Delete Community</button>
        @endif
      </div>
    </div>
    <div class="tab-pane" id="images">
      <div class="well clearfix">
        @include('admin.partials.upload')
        <hr />
        {{ Form::submit('Update Community', array('class' => 'btn btn-success pull-right')) }}
        @if ($isAdmin || $isAdstream)
          <button class="btn btn-danger pull-right push-right" type="button" data-toggle="modal" data-target="#confirm-delete-modal">Delete Community</button>
        @endif
      </div>
    </div>
  </div>
  {{ Form::close() }}
@stop

@section('scripts')
  <script>
    new Uploader();
  </script>
@stop