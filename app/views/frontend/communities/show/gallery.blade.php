@if (!empty($community->main_image))
  <div class="well">
    <a href="{{ $community->main_image }}" class="gallery-image">
      <img src="{{ $community->main_image }}" class="img-responsive img-rounded" />
    </a>
  </div>
@endif