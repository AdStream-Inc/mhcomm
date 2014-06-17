<div class="row">
  <?php
    $sortedEvents = $community->communityEvents()
                              ->orderBy('start_date', 'asc')
                              ->where('end_date', '>=', date('Y-m-d'))
                              ->get()
  ?>
@foreach ($sortedEvents as $event)
  @if ($event->recurring)
    <div class="col-md-12">
      <div class="event-box well">
        <div class="clearfix">
          <div class="title">{{ $event->name }}</div>
          <div class="dates">
            <span class="start-time"><span class="text-muted">starts:</span> {{ date('M d, Y', strtotime($event->start_date)) }}</span>
            <span class="seperator">-</span>
            <span class="end-time"><span class="text-muted">ends:</span> {{ date('M d, Y', strtotime($event->end_date)) }}</span>
          </div>
        </div>
        @if ($event->start_time || $event->end_time)
          <div class="timespan text-muted">
            {{ $event->start_time . ' - ' . $event->end_time }}
          </div>
        @endif
        <hr />
        <div class="description push-bottom">{{ $event->description }}</div>
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
      </div>
    </div>
  @else
    <div class="col-md-12">
      <div class="event-box well">
        <div class="clearfix">
          <div class="title">{{ $event->name }}</div>
          <div class="dates">
            <span class="start-time"><span class="text-muted">starts:</span> {{ date('M d, Y', strtotime($event->start_date)) }}</span>
            <span class="seperator">-</span>
            <span class="end-time"><span class="text-muted">ends:</span> {{ date('M d, Y', strtotime($event->end_date)) }}</span>
          </div>
        </div>
        <div class="timespan text-muted">
          {{ $event->start_time . ' - ' . $event->end_time }}
        </div>
        <hr />
        <div class="description">{{ $event->description }}</div>
      </div>
    </div>
  @endif
@endforeach
</div>