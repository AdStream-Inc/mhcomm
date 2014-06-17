<div class="modal fade" id="event-preview-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Image Preview</h4>
      </div>
      <div class="modal-body text-center">
        <img class="img-responsive img-thumbnail" />
      </div>
    </div>
  </div>
</div>

<div id="event-form">
  <button type="button" id="event-add" class="btn btn-primary push-bottom">
    <span class="fa fa-plus"></span>
    Add Event
  </button>
  <div id="events">
    <div class="row">
      @if ($events)
        @foreach ($events as $event)
          <div class="col-md-6">
            <div class="panel panel-body push-bottom event-box" data-id="{{ $event->id }}">
              <button data-toggle="modal" data-target="#event-delete-modal" type="button" class="close" aria-hidden="true">&times;</button>
              {{ Form::bootwrapped('old_events[' . $event->id . '][name]', 'Event Name', function($name) use($event){
                  return Form::text($name, $event->name, array('class' => 'form-control'));
                })
              }}
              <div class="media">
                @if ($event->image_url)
                  <div class="pull-left">
                    <a href="#" data-toggle="modal" data-target="#event-preview-modal" class="btn btn-xs btn-link preview-link" data-src="{{ $event->image_url }}">Preview Image</a><br />
                    <button type="button" class="btn btn-xs btn-danger btn-block event-image-remove">Remove</button>
                    {{ Form::hidden('old_events[' . $event->id . '][image_url]', $event->image_url, array('class' => 'event-image-hidden', 'disabled')) }}
                  </div>
                @endif
                <div class="media-body">
                  {{ Form::bootwrapped('new_event_image[' . $event->id . ']', 'Image', function($name) {
                      return Form::file($name, array('class' => 'event-file-upload'));
                    })
                  }}
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  {{ Form::bootwrapped('old_events[' . $event->id . '][start_date]', 'Start Date', function($name) use($event){
                      return Form::text($name, date('m/d/y', strtotime($event->start_date)), array('class' => 'form-control date'));
                    })
                  }}
                </div>
                <div class="col-md-6">
                  {{ Form::bootwrapped('old_events[' . $event->id . '][end_date]', 'End Date', function($name) use($event){
                      return Form::text($name, date('m/d/y', strtotime($event->end_date)), array('class' => 'form-control date'));
                    })
                  }}
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  {{ Form::bootwrapped('old_events[' . $event->id . '][start_time]', 'Start Time', function($name) use($event){
                      return Form::text($name, $event->start_time, array('class' => 'form-control time'));
                    })
                  }}
                </div>
                <div class="col-md-6">
                  {{ Form::bootwrapped('old_events[' . $event->id . '][end_time]', 'End Time', function($name) use($event){
                      return Form::text($name, $event->end_time, array('class' => 'form-control time'));
                    })
                  }}
                </div>
              </div>
              {{ Form::bootwrapped('old_events[' . $event->id . '][description]', 'Description', function($name) use($event){
                  return Form::textarea($name, $event->description, array('class' => 'form-control', 'rows' => '3'));
                })
              }}
              <div class="checkbox">
                <label>
                  {{ Form::checkbox('old_events[' . $event->id . '][recurring]', null, $event->recurring) }}
                  Recurring event?
                </label>
              </div>
              <div class="recurring-container  @if ($event->recurring) active @endif">
                {{ Form::bootwrapped('old_events[' . $event->id . '][recurring_frequency]', 'Frequency', function($name) use($event) {
                    return Form::select($name, array('daily' => 'Daily', 'weekly' => 'Weekly', 'monthly' => 'Monthly', 'yearly' => 'Yearly'), $event->recurring_frequency ?: null, array('class' => 'form-control'));
                  })
                }}
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
  <div class="modal fade" id="event-delete-modal">
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
</div>