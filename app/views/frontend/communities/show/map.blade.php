<div class="well">
	<div class="flexible-container">
    <div id="map-canvas"></div>
  </div>
</div>

@section('scripts')
  <script>
      function initialize() {
        var map = new google.maps.Map(document.getElementById("map-canvas"), {zoom: 14});
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({address: '{{ $community->map_address }}'}, function(res) {
          var location = res[0].geometry.location;

          new google.maps.Marker({
            map: map,
            position: location
          });

          map.setCenter(location);
        });
      }

      function loadScript() {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
          'callback=initialize';
        document.body.appendChild(script);
      }

      window.onload = loadScript;
  </script>
@stop