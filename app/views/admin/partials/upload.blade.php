<div id="upload-form">
  <button type="button" id="file-add" class="btn btn-primary push-bottom">
    <span class="fa fa-plus"></span>
    Add File
  </button>
  <div class="panel flush-bottom">
    <table class="table table-striped table-hover" id="upload-files">
      @if (isset($images))
        @foreach ($images as $image)
          <tr class="file-row">
            <td class="col-sm-1 text-center">
              <img style="cursor: pointer" data-toggle="modal" data-target="#preview-modal" class="img-thumbnail img-preview" src="{{ $image->path }}" height="33" width="33" />
            </td>
            <td>{{ Form::text('old_titles[' . $image->id . ']', $image->name, array('class' => 'form-control input-sm old-input', 'data-id' => $image->id)) }}</td>
            <td class="col-sm-1 text-center"><button data-toggle="modal" data-target="#close-modal" type="button" class="close"  aria-hidden="true">&times;</button></td>
          </tr>
        @endforeach
      @endif
    </table>
  </div>

  <div class="modal fade" id="close-modal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body text-center">
          Are you sure you want to delete?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-sm btn-danger delete-button">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="preview-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Image Preview</h4>
        </div>
        <div class="modal-body text-center">
          <img class="img-responsive img-thumbnail" id="preview-img" />
        </div>
      </div>
    </div>
  </div>
</div>