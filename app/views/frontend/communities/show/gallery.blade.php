<div class="gallery">
  <div class="main-image-container thumbnail">
    <div class="main-image-inner">
      <img src="{{ $community->main_image }}" class="img-responsive img-rounded" />
    </div>
  </div>
  <div class="row">
  	@foreach ($community->images as $image)
      <div class="col-md-2">
        <div class="gallery-img-container">
          <img src="{{ $image->path }}" class="img-responsive img-thumbnail equal-height" alt="{{ $image->name }}" />
        </div>
      </div>
    @endforeach
  </div>
</div>