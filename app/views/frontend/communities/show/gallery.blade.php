@if (!empty($community->main_image) || count($community->images))
<div class="gallery">
  @if (!empty($community->main_image))
  <div class="main-image-container thumbnail">
    <div class="main-image-inner">
      <a href="{{ $community->main_image }}" class="gallery-image">
      	<img src="{{ $community->main_image }}" class="img-responsive img-rounded" />
      </a>
    </div>
  </div>
  @endif
  @if (count($community->images))
  <div class="row">
  	@foreach ($community->images as $image)
      <div class="col-md-2">
        <div class="gallery-img-container">
          <a href="{{ $image->path }}" class="gallery-image" title="{{ $image->name }}">
            <img src="{{ $image->path }}" class="img-responsive img-thumbnail equal-height" alt="{{ $image->name }}" />
          </a>
        </div>
      </div>
    @endforeach
  </div>
  @endif
    @section('scripts')
	  <script>
		$('.gallery-image').magnificPopup();
      </script>
    @stop
</div>
@endif