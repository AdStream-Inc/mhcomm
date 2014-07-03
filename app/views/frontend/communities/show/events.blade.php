<?php
  $sortedEvents = $community->communityEvents()
    ->where('end_date', '>=', date('Y-m-d'))
    ->get();
?>
@if (count($sortedEvents))
  <div class="row">
    @foreach ($sortedEvents as $event)
      <div class="col-md-12">
        <div class="event-box well">
          <div class="clearfix">
            <div class="media">
            @if ($event->image_url)
              <div class="pull-left">
                <a href="{{ $event->image_url }}" class="event-image-toggle">
                  <img src="{{ $event->image_url }}" style="max-width: 100px" class="media-object img-thumbnail" />
                </a>
              </div>
            @endif
              <div class="media-body">
                <div class="clearfix">
                  <div class="title">{{ $event->name }}</div>
                  <div class="dates">
                    <span class="start-time">
                      <span class="text-muted">starts:</span> {{ date('M d, Y', strtotime($event->start_date)) }}
                    </span>
                    <span class="seperator">-</span>
                    <span class="end-time">
                      <span class="text-muted">ends:</span> {{ date('M d, Y', strtotime($event->end_date)) }}
                    </span>
                  </div>
                </div>
                @if ($event->start_time || $event->end_time)
                  <div class="timespan text-muted">
                    {{ $event->start_time . ' - ' . $event->end_time }}
                  </div>
                @endif
                <hr />
                <div class="description  @if ($event->recurring) push-bottom @endif">{{ $event->description }}</div>
                @if ($event->recurring)
                  <div class="recurring-container">
                    <p><strong>This event is also running on the following dates:</strong></p>
                    @if ($event->recurring_frequency == 'daily')
                      @for ($i = 1, $len = 7; $i != $len; $i++)
                        <span class="label label-default">{{ date('M d, Y', strtotime('+' . $i . ' day', strtotime($event->start_date))) }}</span>
                      @endfor
                    @elseif ($event->recurring_frequency == 'weekly')
                      @for ($i = 1, $len = 4; $i != $len; $i++)
                        <span class="label label-default">{{ date('M d, Y', strtotime('+' . $i . ' week', strtotime($event->start_date))) }}</span>
                      @endfor
                    @elseif ($event->recurring_frequency == 'monthly')
                      @for ($i = 1, $len = 4; $i != $len; $i++)
                        <span class="label label-default">{{ date('M d, Y', strtotime('+' . $i . ' month', strtotime($event->start_date))) }}</span>
                      @endfor
                    @else
                      @for ($i = 1, $len = 2; $i != $len; $i++)
                        <span class="label label-default">{{ date('M d, Y', strtotime('+' . $i . ' year', strtotime($event->start_date))) }}</span>
                      @endfor
                    @endif
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@else
  <div class="well">
    <p class="flush-bottom">There are no events scheduled at this time. Please check back again at a later date.</p>
  </div>
@endif