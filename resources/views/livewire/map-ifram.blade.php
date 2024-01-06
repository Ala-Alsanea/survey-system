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
                lat: 14.503970215,
                lng: 44.785315881
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 7,
                center: myLatLng,
            });

            var locations = {{ Js::from($this->locations) }};


            // console.log('infowindow'infowindow)


            var marker, i;

            for (i = 0; i < locations.length; i++) {

              const  infowindow = new google.maps.InfoWindow({
                    // ariaLabel: locations[i][0],
                    content: locations[i][0],
                });

                console.log('locations[i][0]',locations[i][0])

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    title: locations[i][3],
                    optimized:true,
                    // icon:'https://www.svgrepo.com/show/315940/map-pointer.svg',
                    // label: locations[i][0],
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        // infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                        // console.log('infowindow'infowindow)

                    }
                })(marker, i));

            }
        }

        window.initMap = initMap;
    </script>

    <script defer type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>



</div>
