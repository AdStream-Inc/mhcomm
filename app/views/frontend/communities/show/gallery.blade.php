@if (!empty($community->main_image))
  <div class="well">
    <a href="{{ $community->main_image }}" class="gallery-image">
      <img src="{{ $community->main_image }}" class="img-responsive img-rounded" />
    </a>
    @if (count($community->images) >= 2)
      <div id="gallery" class="active">
      @foreach ($community->images as $key => $image)
        <a href="{{ $image->path }}" class="gallery-image" title="{{ $image->name }}">
          <img src="{{ $image->path }}" class="img-responsive img-thumbnail" alt="{{ $image->name }}" />
        </a>
      @endforeach
      </div>
    @else
      <div id="gallery">
      @foreach ($community->images as $key => $image)
        <a href="{{ $image->path }}" class="gallery-image" title="{{ $image->name }}">
          <img src="{{ $image->path }}" class="img-responsive img-thumbnail" alt="{{ $image->name }}" />
        </a>
      @endforeach
      </div>
    @endif
  </div>
@endif