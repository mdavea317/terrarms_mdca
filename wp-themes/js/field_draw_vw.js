    let map, selectedShape;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 14.3545117, lng: 121.0818405 },
        zoom: 18,
			mapTypeId: google.maps.MapTypeId.SATELLITE, // Set map type to Satellite
        });

        // Get geometry from the hidden input field
        const geometry = document.getElementById('geometry').value;

        if (geometry) {
            const coordinates = JSON.parse(geometry);

            // Convert the coordinates into a Google Maps LatLng object array
            const latLngArray = coordinates.map(coord => new google.maps.LatLng(coord.lat, coord.lng));

            // Create a polygon and set it on the map, but make it non-editable
            selectedShape = new google.maps.Polygon({
                paths: latLngArray,
                editable: false,  // Disable editing
                draggable: false, // Disable dragging
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
                map: map,
            });

            // Fit the map to the bounds of the polygon
            const bounds = new google.maps.LatLngBounds();
            latLngArray.forEach(latLng => bounds.extend(latLng));
            map.fitBounds(bounds);
        }
    }

window.onload = initMap;
