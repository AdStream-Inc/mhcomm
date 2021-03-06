(function($) {

    function HomeMap() {
        this.map = new google.maps.Map(document.getElementById("map-canvas"), {
            zoom: 5
        });
        this.geocoder = new google.maps.Geocoder();
        this.ib = new InfoBox();

        this.init();
    }

    HomeMap.prototype.init = function() {
        var self = this;

        google.maps.event.addListener(self.map, "click", function() {
            self.ib.close();
        });

        $.get(URL.current + '/home-map', function(res) {
            var markers = [];
            var bounds = new google.maps.LatLngBounds();

            $.each(res, function() {
                var mapAddress = this.map_address.replace(/\s+/g, '').split(',');

                if (mapAddress[0] && mapAddress[1]) {
                    var hours = this.office_hours.replace(/(?:\r\n|\r|\n)/g, '<br />');

                    var html = '<div class="inner">';
                    html += '<h4 class="ib-name flush-bottom">' + this.name + '</h4>';
                    html += '<div class="push-bottom"><a href="' + URL.base + '/communities/' + this.slug + '.html' + '">Click for more info</a></div>';
                    html += '<div class="ib-address">' + this.phone;
                    html += '<br />' + this.address;
                    html += '<br />' + this.city + ', ' + this.state;
                    html += '</div><hr />';
                    html += '<div class="ib-office-hours"><strong>Office Hours</strong><br />' + hours + '</div></div>';

                    var latlng = new google.maps.LatLng(mapAddress[0], mapAddress[1]);
                    var marker = new google.maps.Marker({
                        map: self.map,
                        position: latlng,
                        html: html
                    });

                    bounds.extend(latlng);

                    google.maps.event.addListener(marker, "click", function(e) {
                        self.ib.close();
                        self.ib.setOptions({
                            content: this.html,
                            pixelOffset: new google.maps.Size(-160, 0),
                            boxStyle: {
                                background: "url('http://google-maps-utility-library-v3.googlecode.com/svn/tags/infobox/1.1.12/examples/tipbox.gif') no-repeat 20px 0"
                            },
                            closeBoxMargin: '10px 10px',
                            infoBoxClearance: new google.maps.Size(1, 1)
                        });
                        self.ib.open(this.map, this);
                    });

                    markers.push(location);
                }
            });

            self.map.fitBounds(bounds);
        });
    };

    window.HomeMap = HomeMap;
})(jQuery);