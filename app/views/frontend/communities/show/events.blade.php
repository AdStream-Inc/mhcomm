<div class="row">
<?php $sortedEvents = $community->communityEvents()->orderBy('start_date', 'asc')->get() ?>
@foreach ($sortedEvents as $event)
  <div class="col-md-4">
    <div class="event-box well equal-height">
      <div class="start-time">{{ date('M d, Y', strtotime($event->start_date)) }}</div>
      <div class="end-time">runs till: {{ date('M d, Y', strtotime($event->end_date)) }}</div>
      <div class="timespan text-muted">
        {{ date('g:m a', strtotime($event->start_time)) . ' - ' . date('g:m a', strtotime($event->end_time))}}
      </div>
      <hr />
      <div class="description">{{ $event->description }}</div>
    </div>
  </div>
@endforeach
</div>