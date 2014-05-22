@extends('admin.template.base')

@section('styles')
  {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/jstree/3.0.0/themes/default/style.min.css') }}
@stop

@section('main.prepend')
  @if (Alert::has('success'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ Alert::first('success') }}
    </div>
  @endif

  @if (Alert::has('error'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ Alert::first('error') }}
    </div>
  @endif
@stop

@section('content')
  <div id="confirm-delete-modal" class="modal fade">
    {{ Form::open(array('route' => array($adminUrl . '.community-pages.destroy', $lastUpdated['id'] ?: 0), 'method' => 'DELETE')) }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Confirm Action</h4>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this page?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
        </div>
      </div>
    </div>
    {{ Form::close() }}
  </div>

  <h1>Community Pages</h1>
  <div class="row">
    <div class="col-md-4">
      <div class="well">
        @if ($community)
          <label class="text-muted small">Current Community:</label>
          <h4 class="list-group-item-heading push-bottom">{{ $community->name }}</h4>
        @endif
        <button type="button" class="btn btn-primary btn-sm btn-block" id="community-change">Change Community</button>
      </div>
      <hr />
      <div class="well tree-outer">
        <div class="tree-inner">
          <div class="clearfix push-half-bottom">
            <button class="btn btn-sm btn-block btn-success pull-right @if(isset($communityLastUpdated)) is-visible @endif" id="page-create"><span class="fa fa-plus"> Create</button>
          </div>
          <div id="tree">
            @if ($pagesTree)
              {{ $pagesTree }}
            @else
              <p>No Pages Added.</p>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      @if (isset($communityLastUpdated))
        {{ Form::open(array('route' => array($adminUrl . '.community-pages.update', $communityLastUpdated['id']), 'id' => 'pages-form', 'method' => 'PUT')) }}
      @else
        {{ Form::open(array('route' => $adminUrl . '.community-pages.store', 'id' => 'pages-form')) }}
      @endif
        <div class="well clearfix">
          {{ Form::bootwrapped('name', 'Name', function($name) use($communityLastUpdated){
              return Form::text($name, $communityLastUpdated['name'] ?: null, array('class' => 'form-control'));
            })
          }}
          {{ Form::bootwrapped('parent_id', 'Parent Page', function($name) use($pagesDropdown, $communityLastUpdated){
              return Form::select($name, $pagesDropdown, $communityLastUpdated['parent_id'] ?: null, array('class' => 'form-control'));
            })
          }}

          {{ Form::hidden('community_id', Input::get('community_id'), array('class' => 'form-control')) }}

          <div class="row">
            <div class="col-md-3">
              {{ Form::bootwrapped('enabled', 'Active?', function($name) use($pagesDropdown, $communityLastUpdated){
                  return Form::select($name, array('1' => 'Yes', '0' => 'No'), $communityLastUpdated['enabled'] ?: null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-4">
              {{ Form::bootwrapped('auth_only', 'Visible To', function($name) use($communityLastUpdated){
                  return Form::select($name, array('0' => 'All', '1' => 'Logged In User'), $communityLastUpdated['auth_only'] ?: null, array('class' => 'form-control'));
                })
              }}
            </div>
            <div class="col-md-5">
              {{ Form::bootwrapped('template', 'Template', function($name) use($templatesDropdown, $communityLastUpdated){
                  return Form::select($name, $templatesDropdown, $communityLastUpdated['template'] ?: null, array('class' => 'form-control', 'id' => 'template'));
                })
              }}
            </div>
          </div>
          @foreach($templates as $identifier => $template)
            <div id="{{ $identifier }}" class="template-sections">
              @foreach($template['sections'] as $key => $title)
                <div class="form-group">
                  {{ Form::label('templates[' . $identifier . '-' . $key . ']', $title) }}
                  {{ Form::textarea(
                      'templates[' . $identifier . '-' . $key . ']',
                      isset($communityLastUpdated['sections'][$identifier . '-' . $key]) ? $communityLastUpdated['sections'][$identifier . '-' . $key] : null,
                      array('class' => 'form-control template-section-content', 'rows' => 4, 'id' => $identifier . '-' . $key)
                    )
                  }}
                </div>
              @endforeach
            </div>
          @endforeach
          <hr />
          <input type="submit" id="form-save" class="btn btn-success pull-right @if (empty($communityLastUpdated)) is-visible @endif" value="Create Page" />
          <input type="submit" id="form-update" class="btn btn-success pull-right @if (isset($communityLastUpdated)) is-visible @endif" value="Update Page" />
          <input data-toggle="modal" data-target="#confirm-delete-modal" type="button" id="form-delete" class="btn btn-danger pull-right @if (isset($lastUpdated)) is-visible @endif" value="Delete Page" />
        </div>
      {{ Form::close() }}
    </div>
  </div>

  <div class="modal fade" id="community_select">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Select a community to add pages to</h4>
        </div>
        <div class="modal-body">
          {{ Form::select('community_select', $communitiesDropdown, Input::get('community_id'), array('class' => 'form-control')) }}
        </div>
        <div class="modal-footer">
          @if (Input::get('community_id'))
            <button type="button" class="btn btn-default" id="community-select-cancel">Cancel</button>
          @endif
          <button type="button" class="btn btn-primary" id="community-select-submit">Select</button>
        </div>
      </div>
    </div>
  </div>
@stop

@section('scripts')
  <script>
    new CommunityPages();
  </script>

  @if($pagesTree)
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jstree/3.0.0/jstree.min.js') }}
    <script>
      (function($, window, document, undefined) {
        $('#tree').jstree({
          plugins: ['wholerow', 'state'],
          defaults: {
            state: {
              ttl: (1000 * 60) * 2
            }
          }
        }).on('ready.jstree changed.jstree open_node.jstree', function() {
          $('.jstree-anchor .jstree-icon').css('background', 'none').addClass('fa fa-file');
        });

        $('#form-save').on('click', function(e) {
          $('#tree').jstree('clear_state');
        });

        @if (empty($communityLastUpdated))
          $('#tree').jstree('clear_state');
        @endif
      })(jQuery, window, document);
    </script>
  @endif
@stop