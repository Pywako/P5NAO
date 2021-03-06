(function(){
    var map;
})();

    function initMap() {
        var centreFrance = {lat: 46.1368447, lng: -2.4363844};
        var map = new google.maps.Map(document.getElementById('map'), {
            center: centreFrance,
            zoom: 6
        });

        var markers =[];

        var elt = document.getElementById('json_data');
        var locations = elt.innerText || elt.textContent;
        locations = JSON.parse(locations);
        if(locations ==""){
            locations = [
                {nom: 'oiseau1', lat: 46.498392, lng: 2.610353},
                {nom: 'oiseau2', lat: 48.8615, lng: 2.34706}
            ]
        }

        var largeInfowindow = new google.maps.InfoWindow({});
        var bounds = new google.maps.LatLngBounds();

        for (var i = 0; i < locations.length; i++) {
            var position = {
                lat: locations[i].lat,
                lng: locations[i].lng
            };
            var nom = locations[i].nom;
            var marker = new google.maps.Marker({
                map: map,
                position: position,
                title: nom,
                animation: google.maps.Animation.DROP,
                id: i
            });
            markers.push(marker);
            bounds.extend(marker.position);
            marker.addListener('click', function(){
                populateInfoWindow(this, largeInfowindow);
            });
        }
        map.fitBounds(bounds);

        function populateInfoWindow(marker, infowindow) {
            if (infowindow.marker != marker) {
                infowindow.marker = marker;
                infowindow.setContent('<div>' + marker.title + '</div>');
                infowindow.open(map, marker);
                infowindow.addListener('closeclick', function () {
                    infowindow.setMarket(null);
                });
            }
        }
    }