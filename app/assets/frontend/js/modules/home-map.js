(function($) {
    function initialize() {
        var map = new google.maps.Map(document.getElementById("map-canvas"), {zoom: 4});
        var geocoder = new google.maps.Geocoder();
        var ib = new InfoBox();

        google.maps.event.addListener(map, "click", function() { ib.close() });

        $.get(URL.current + '/home-map', function(res) {
            var markers = [];

            $.each(res, function() {
                var mapAddress = this['map_address'];
                var hours = this['office_hours'].replace(/(?:\r\n|\r|\n)/g, '<br />');
                var html = '<div class="inner">';
                html += '<h4 class="ib-name">';
                html += '<a href="'+ URL.base + '/communities/' + this['slug'] + '.html' + '">' + this['name'] + '</a>';
                html += '</h4>';
                html += '<div class="ib-address">' + this['address'];
                html += '<br />' + this['city'] + ', ' + this['state'];
                html += '</div><hr />';
                html += '<div class="ib-office-hours"><strong>Office Hours</strong><br />' + hours + '</div></div>';

                geocoder.geocode({ address: mapAddress }, function(res) {
                    if (res && res.length) {
                        var location = res[0].geometry.location;

                        var marker = new google.maps.Marker({
                            map: map,
                            position: location,
                            html: html
                        });

                        google.maps.event.addListener(marker, "click", function (e) {
                            ib.close();
                            ib.setOptions({
                                content: this.html,
                                pixelOffset: new google.maps.Size(-160, 0),
                                boxStyle: {
                                    background: "url('http://google-maps-utility-library-v3.googlecode.com/svn/tags/infobox/1.1.12/examples/tipbox.gif') no-repeat 20px 0"
                                },
                                closeBoxMargin: '10px 10px',
                                infoBoxClearance: new google.maps.Size(1, 1)
                            });
                            ib.open(this.map, this);
                        });

                        markers.push(location);
                        map.setCenter(markers[0]);
                    }
                });
            });
        });
    }

    window.onload = initialize;
})(jQuery);