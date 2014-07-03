<div class="well clearfix">
  <h1>Previous Newsletters</h1>
  <div class="list-group flush-bottom">
    @foreach ($newsletters as $newsletter)
      <a class="list-group-item" href="{{ $newsletter['path'] }}" target="_blank">{{ $newsletter['name'] }}</a>
    @endforeach
  </div>
</div>