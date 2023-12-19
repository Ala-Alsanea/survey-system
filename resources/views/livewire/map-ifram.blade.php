<div>

     <script defer src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <style type="text/css">
            #map {
                height: 400px;
            }
        </style>

        <div class="container mt-5">
            {{-- <h2>Laravel Google Maps Multiple Markers Example </h2> --}}
            <div id="map"></div>
        </div>

        <script defer type="text/javascript">
            function initMap() {
                const myLatLng = {
                    lat: 22.2734719,
                    lng: 70.7512559
                };
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 5,
                    center: myLatLng,
                });

                var locations = {{ Js::from($locations) }};

                var infowindow = new google.maps.InfoWindow();

                var marker, i;

                for (i = 0; i < locations.length; i++) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map
                    });

                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(locations[i][0]);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));

                }
            }

            window.initMap = initMap;
        </script>

        <script defer type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>



</div>
