@extends('admin.template.base')

@section('styles')
  {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/jstree/3.0.0/themes/default/style.min.css') }}

  @if (isset($lastUpdated))
    <script>
      var LAST_UPDATED_ID = {{ $lastUpdated['id'] }};
    </script>
  @endif
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
  <h1>Pages</h1>
  <div class="row">
    <div class="col-md-4">
      <div class="well tree-outer">
        <div class="tree-inner">
          <div class="clearfix push-half-bottom">
            <button class="btn btn-sm btn-block btn-success pull-right @if(isset($lastUpdated)) is-visible @endif" id="page-create"><span class="fa fa-plus"> Create</button>
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
      @if (isset($lastUpdated))
        {{ Form::open(array('route' => array($adminUrl . '.pages.update', $lastUpdated['id']), 'id' => 'pages-form', 'method' => 'PUT')) }}
      @else
        {{ Form::open(array('route' => $adminUrl . '.pages.store', 'id' => 'pages-form')) }}
      @endif
        <div class="well clearfix">
          {{ Form::bootwrapped('name', 'Name', function($name) use($lastUpdated){
              return Form::text($name, $lastUpdated['name'] ?: null, array('class' => 'form-control'));
            })
          }}
          {{ Form::bootwrapped('parent_id', 'Parent Page', function($name) use($pagesDropdown, $lastUpdated){
              return Form::select($name, $pagesDropdown, $lastUpdated['parent_id'] ?: null, array('class' => 'form-control'));
            })
          }}
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                {{ Form::label('enabled', 'Active?') }}
                {{ Form::select('enabled', array('1' => 'Yes', '0' => 'No'), $lastUpdated['enabled'] ?: null, array('class' => 'form-control')) }}
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{ Form::label('auth_only', 'Visible To') }}
                {{ Form::select('auth_only', array('0' => 'All', '1' => 'Logged In User'), $lastUpdated['auth_only'] ?: null, array('class' => 'form-control')) }}
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                {{ Form::label('template', 'Template') }}
                {{ Form::select('template', $templatesDropdown, $lastUpdated['template'] ?: null, array('class' => 'form-control')) }}
              </div>
            </div>
          </div>
          @foreach($templates as $identifier => $template)
            <div id="{{ $identifier }}" class="template-sections">
              @foreach($template['sections'] as $key => $title)
                <div class="form-group">
                  {{ Form::label('templates[' . $identifier . '-' . $key . ']', $title) }}
                  {{ Form::textarea(
                      'templates[' . $identifier . '-' . $key . ']',
                      isset($lastUpdated['sections'][$identifier . '-' . $key]) ? $lastUpdated['sections'][$identifier . '-' . $key] : null,
                      array('class' => 'form-control template-section-content', 'rows' => 4, 'id' => $identifier . '-' . $key)
                    )
                  }}
                </div>
              @endforeach
            </div>
          @endforeach
          <hr />
          <input type="submit" id="form-save" class="btn btn-success pull-right @if (empty($lastUpdated)) is-visible @endif" value="Create Page" />
          <input type="submit" id="form-update" class="btn btn-success pull-right @if (isset($lastUpdated)) is-visible @endif" value="Update Page" />
        </div>
      {{ Form::close() }}
    </div>
  </div>
@stop

@if ($pagesTree)
  @section('scripts')
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jstree/3.0.0/jstree.min.js') }}
    <script>
      (function($, window, document, undefined) {
        $('#tree').jstree({
          plugins: ['wholerow', 'state'],
        }).on('ready.jstree changed.jstree open_node.jstree', function() {
          replaceIcons();
        })


        replaceIcons();

        function replaceIcons() {
          $('.jstree-anchor .jstree-icon').css('background', 'none').addClass('fa fa-file');
        }
      })(jQuery, window, document);
    </script>
  @stop
@endif