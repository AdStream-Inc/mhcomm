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
@stop

@section('content')
  <h1>Pages</h1>
  <div class="row">
    <div class="col-md-4">
      <div class="well tree-outer">
        <div class="tree-inner">
          <div class="clearfix push-half-bottom">
            <button class="btn btn-sm btn-block btn-success pull-right page-create"><span class="fa fa-plus"> Create</button>
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
      {{ Form::open(array('route' => $adminUrl . '.pages.store', 'id' => 'pages-form')) }}
        <div class="panel panel-default">
          <div class="panel-body">
            {{ Form::bootwrapped('name', 'Name', function($name){
                return Form::text($name, null, array('class' => 'form-control'));
              })
            }}
            {{ Form::bootwrapped('parent_id', 'Parent Page', function($name) use($pagesDropdown){
                return Form::select($name, $pagesDropdown, null, array('class' => 'form-control'));
              })
            }}
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  {{ Form::label('enabled', 'Active?') }}
                  {{ Form::select('enabled', array('1' => 'Yes', '0' => 'No'), null, array('class' => 'form-control')) }}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {{ Form::label('auth_only', 'Visible To') }}
                  {{ Form::select('auth_only', array('0' => 'All', '1' => 'Logged In User'), null, array('class' => 'form-control')) }}
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  {{ Form::label('template', 'Template') }}
                  {{ Form::select('template', $templatesDropdown, null, array('class' => 'form-control')) }}
                </div>
              </div>
            </div>
            @foreach($templates as $identifier => $template)
              <div id="{{ $identifier }}" class="template-sections">
                @foreach($template['sections'] as $key => $title)
                  <div class="form-group">
                    {{ Form::label('templates[' . $key . ']', $title) }}
                    {{ Form::textarea('templates[' . $key . ']', null, array('class' => 'form-control template-section-content', 'rows' => 4)) }}
                  </div>
                @endforeach
              </div>
            @endforeach
            <hr />
            {{ Form::submit('Create Page', array('class' => 'btn btn-success pull-right', 'id' => 'form-save')) }}
            {{ Form::submit('Update Page', array('class' => 'btn btn-success pull-right', 'id' => 'form-update')) }}
          </div>
        </div>
      {{ Form::close() }}
    </div>
  </div>
@stop

@if ($pagesTree)
  @section('scripts')
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jstree/3.0.0/jstree.min.js') }}
    <script>
      // need to fix this still
      var pageTree = $('#tree').jstree({
        plugins: ['wholerow'],
      }).on('changed.jstree open_node.jstree', function() {
        console.log('test');
        replaceIcons();
      });

      replaceIcons();

      function replaceIcons() {
        $('.jstree-anchor .jstree-icon').css('background', 'none').addClass('fa fa-file');
      }
    </script>
  @stop
@endif