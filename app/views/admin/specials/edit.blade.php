@extends('admin.template.base')

@section('content')
  <div id="confirm-delete-modal" class="modal fade">
    {{ Form::open(array('route' => array($adminUrl . '.specials.destroy', $special->id), 'method' => 'DELETE')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Confirm Action</h4>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this special?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
        </div>
      </div>
    </div>
    {{ Form::close() }}
  </div>

  <h1>Editing Special <small>{{ $special->name }}</small></h1>
  <div class="well clearfix">
    {{ Form::model($special, array('route' => array($adminUrl . '.specials.update', $special->id), 'method' => 'PUT')) }}
      {{ Form::bootwrapped('name', 'Name', function($name){
          return Form::text($name, null, array('class' => 'form-control'));
        })
      }}
      <div class="row">
        <div class="col-md-6 @if($isManager) invisible @endif">
          {{ Form::bootwrapped('communities[]', 'Community', function($name) use($communities, $activeCommunities) {
              return Form::select($name, $communities, $activeCommunities, array('class' => 'form-control' , 'multiple'));
            })
          }}
        </div>
        <div class="col-md-6">
          {{ Form::bootwrapped('enabled', 'Enabled', function($name){
              return Form::select($name, array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control'));
            })
          }}
        </div>
      </div>
      {{ Form::bootwrapped('content', 'Content', function($name){
          return Form::textarea($name, null, array('class' => 'form-control wysiwyg-image', 'rows' => '4'));
        })
      }}
      <hr />
      {{ Form::submit('Update Special', array('class' => 'btn btn-success pull-right')) }}
      @if ($isAdmin || $isAdstream)
        <button class="btn btn-danger pull-right push-right" type="button" data-toggle="modal" data-target="#confirm-delete-modal">Delete Special</button>
      @endif
    {{ Form::close() }}
  </div>
@stop
