@extends('admin.template.base')

@section('content')
  <h1>Editing Community <small>{{ $community->name }}</small></h1>
  <ul class="nav nav-tabs">
    <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
    <li><a href="#images" data-toggle="tab">Additional Images</a></li>
    <li><a href="#events" data-toggle="tab">Events</a></li>
    @if (count($newsletters))
      <li><a href="#newsletters" data-toggle="tab">Old Newsletters</a></li>
    @endif
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
        <div class="row">
          <div class="col-md-8">
            {{ Form::bootwrapped('name', 'Community Name', function($name){
                return Form::text($name, null, array('class' => 'form-control'));
              })
            }}
          </div>
          <div class="col-md-4">
            {{ Form::bootwrapped('subdomain', 'Subdomain Prefix', function($name){
                return Form::text($name, null, array('class' => 'form-control'));
              })
            }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
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
          </div>
          <div class="col-md-6">
            <div class="media">
              @if ($community->newsletter)
                <div class="pull-left">
                  <a href="{{ $community->newsletter }}" target="_blank" style="display: block; width: 150px; height: 75px; line-height: 75px;" class="panel panel-primary text-center small">
                    Preview File
                  </a>
                  <button type="button" class="btn btn-xs btn-danger btn-block" id="newsletter-remove">Remove</button>
                  {{ Form::hidden('newsletter', $community->newsletter, array('id' => 'newsletter-hidden', 'disabled')) }}
                </div>
              @endif
              <div class="media-body">
                {{ Form::bootwrapped('newsletter_file', 'Newsletter <span class="small text-muted">- will override current newsletter</span>', function($name){
                    return Form::file($name);
                  })
                }}
              </div>
            </div>
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
            return Form::text($name, null, array('class' => 'form-control has-note', 'data-content' => 'Latitude follow by Longitude. Comma separated.'));
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
        {{ Form::bootwrapped('area_manager', 'Area Manager', function($name){
            return Form::text($name, null, array('class' => 'form-control has-note', 'data-content' => 'Comma separated'));
          })
        }}
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
            return Form::text($name, null, array('class' => 'form-control'));
          })
        }}
        <div class="row">
          <div class="col-md-6">
            {{ Form::bootwrapped('enabled', 'Enabled', function($name){
                return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
              })
            }}
          </div>
          <div class="col-md-6">
            {{ Form::bootwrapped('is_featured', 'Featured', function($name){
                return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
              })
            }}
          </div>
        </div>
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
    <div class="tab-pane" id="events">
      <div class="well clearfix">
        @include('admin.partials.event')
        <hr />
        {{ Form::submit('Update Community', array('class' => 'btn btn-success pull-right')) }}
        @if ($isAdmin || $isAdstream)
          <button class="btn btn-danger pull-right push-right" type="button" data-toggle="modal" data-target="#confirm-delete-modal">Delete Community</button>
        @endif
      </div>
    </div>
    @if (count($newsletters))
      <div class="tab-pane" id="newsletters">
        <div id="newsletter-delete-modal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirm Action</h4>
              </div>
              <div class="modal-body">
                Are you sure you want to delete this newsletter?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="newsletter-delete-button">Delete</button>
              </div>
            </div>
          </div>
        </div>
        <div class="well clearfix">
          <div class="panel flush-bottom">
            <table class="table table-hover table-striped">
            @foreach ($newsletters as $file)
              <tr>
                <td><a target="_blank" href="{{ $file['path'] }}">{{ $file['name'] . '<br />' }}</a></td>
                <td><button data-path="{{ $file['original'] }}" data-toggle="modal" data-target="#newsletter-delete-modal" type="button" class="close"  aria-hidden="true">&times;</button></td>
              </tr>
            @endforeach
            </table>
          </div>
          <hr />
          {{ Form::submit('Update Community', array('class' => 'btn btn-success pull-right')) }}
          @if ($isAdmin || $isAdstream)
            <button class="btn btn-danger pull-right push-right" type="button" data-toggle="modal" data-target="#confirm-delete-modal">Delete Community</button>
          @endif
        </div>
      </div>
    </div>
  @endif
  {{ Form::close() }}
@stop

@section('scripts')
  <script>
    new Uploader();
    new EventMaker();
  </script>
@stop