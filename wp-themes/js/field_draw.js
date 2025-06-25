let map;
let drawingManager;
let selectedShape;

function initMap() {
    // Initialize the map with specified options
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 14.3545117, lng: 121.0818405 },
        zoom: 18,
        mapTypeId: google.maps.MapTypeId.SATELLITE, // Set map type to Satellite
    });

    // Get geometry from the hidden field
    const geometry = document.getElementById('geometry').value;

    if (geometry) {
        const coordinates = JSON.parse(geometry);

        // Convert the coordinates into a Google Maps LatLng object array
        const latLngArray = coordinates.map(coord => new google.maps.LatLng(coord.lat, coord.lng));

        // Create a polygon and set it on the map
        selectedShape = new google.maps.Polygon({
            paths: latLngArray,
            editable: true,
            map: map,
        });

        // Fit the map to the shape's bounds
        const bounds = new google.maps.LatLngBounds();
        latLngArray.forEach(latLng => bounds.extend(latLng));
        map.fitBounds(bounds);
    }

    // Initialize the drawing manager
    const drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.POLYGON,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['polygon'],
        },
        polygonOptions: {
            editable: true,
        },
    });

    drawingManager.setMap(map);

    // Event listener for drawing manager overlay completion
    google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
        if (event.type === google.maps.drawing.OverlayType.POLYGON) {
            if (selectedShape) {
                selectedShape.setMap(null); // Remove previous shape
            }
            selectedShape = event.overlay;

            // Extract the path as an array of lat/lng objects
            const path = selectedShape.getPath();
            document.getElementById('geometry').value = JSON.stringify(
                path.getArray().map((latLng) => ({
                    lat: latLng.lat(),
                    lng: latLng.lng(),
                }))
            );
        }
    });
}

// Initialize the map when the window loads
window.onload = initMap;
