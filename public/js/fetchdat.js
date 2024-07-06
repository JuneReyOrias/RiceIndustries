// // var map;
// // var myLatLng;
// // $(document).ready(function() {
// //     geoLocationInit();
// // });

// // function geoLocationInit() {
// //     if (navigator.geolocation) {
// //         navigator.geolocation.getCurrentPosition(success, fail);
// //     } else {
// //         alert("Browser not supported");
// //     }
// // }

// // function success(position) {

// //     var gps_latitudeval = position.coords.latitude;
// //     var gps_longitudeval = position.coords.longitude;
// //     console.log([gps_latitudeval, gps_longitudeval]);
// //     myLatLng = new google.maps.gps_longitudeval(gps_latitudeval, gps_longitudeval);
// //     createMap(myLatLng);
// //     // nearbySearch(myLatLng, "school");
// //     searchfarm(gps_latitudeval, gps_longitudeval);
// // }

// // function fail() {
// //     alert("it fails");
// // }
// // //Create Map
// // function createMap(myLatLng) {
// //     map = new google.maps.Map(document.getElementById('map'), {
// //         center: myLatLng,
// //         zoom: 12
// //     });
// //     var marker = new google.maps.Marker({
// //         position: myLatLng,
// //         map: map
// //     });
// // }
// // //Create marker
// // function createMarker(latlng, icn, name) {
// //     var marker = new google.maps.Marker({
// //         position: latlng,
// //         map: map,
// //         icon: icn,
// //         title: name
// //     });
// // }

// // function searchfarm(gps_latitude, gps_longitude) {
// //     $.post('http://localhost/api/searchfarm', { gps_latitude: gps_latitude, gps_longitude: gps_longitude }, function(match) {
// //         // console.log(match);
// //         $('#girlsResult').html('');

// //         $.each(match, function(i, val) {
// //             var ggps_latitudeval = val.gps_latitude;
// //             var ggps_longitudeval = val.gps_longitude;
// //             var grice_farm_address = val.rice_farm_address;
// //             var ggps_longitudeval = new google.maps.LatLng(ggps_latitudeval, ggps_longitudeval);
// //             var gicn = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
// //             createMarker(GLatLng, gicn, gname);
// //             var html = '<h5><li>' + gname + '</li></h5>';
// //             $('#girlsResult').append(html);
// //         });

// //         // $.each(match, function(i, val) {
// //         //   console.log(val.name);
// //         // });
// //     });
// // }

// // $('#searchGirls').submit(function(e) {
// //     e.preventDefault();
// //     var val = $('#locationSelect').val();
// //     $.post('http://localhost/api/getLocationCoords', { val: val }, function(match) {

// //         var myLatLng = new google.maps.LatLng(match[0], match[1]);
// //         createMap(myLatLng);
// //         searchGirls(match[0], match[1]);
// //     });
// // });
// // public/js/app.js

// let map;
// let drawingManager;
// let polyline;

// function initMap() {
//     map = new google.maps.Map(document.getElementById('map'), {
//         center: { lat: 0, lng: 0 },
//         zoom: 2
//     });

//     drawingManager = new google.maps.drawing.DrawingManager({
//         drawingControl: true,
//         drawingControlOptions: {
//             position: google.maps.ControlPosition.TOP_CENTER,
//             drawingModes: ['polygon']
//         },
//         polygonOptions: {
//             editable: true,
//             draggable: true
//         }
//     });

//     drawingManager.setMap(map);

//     google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
//         if (event.type === 'polygon') {
//             polyline = event.overlay.getPath().getArray();
//         }
//     });
// }

// function save() {
//     if (polyline) {
//         const area = google.maps.geometry.spherical.computeArea(polyline);
//         const perimeter = google.maps.geometry.spherical.computeLength(polyline);

//         // Send data to the server for saving to the database
//         fetch('/save', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//                 },
//                 body: JSON.stringify({
//                     coordinates: polyline.map(point => ({ lat: point.lat(), lng: point.lng() })),
//                     area: area,
//                     perimeter: perimeter,
//                 }),
//             })
//             .then(response => response.json())
//             .then(data => {
//                 console.log('Polygon saved successfully:', data);
//             })
//             .catch(error => {
//                 console.error('Error saving polygon:', error);
//             });
//     } else {
//         console.error('No polygon drawn');
//     }
// }

// // Run initMap when the page is loaded
// google.maps.event.addDomListener(window, 'load', initMap);
// c
// function save() {
//     if (polyline) {
//         const area = google.maps.geometry.spherical.computeArea(polyline);
//         const perimeter = google.maps.geometry.spherical.computeLength(polyline);

//         // Send data to the server for saving to the database
//         fetch('/save', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//                 },
//                 body: JSON.stringify({
//                     coordinates: polyline.map(point => ({ lat: point.lat(), lng: point.lng() })),
//                     area: area,
//                     perimeter: perimeter,
//                 }),
//             })
//             .then(response => response.json())
//             .then(data => {
//                 console.log('Polyline saved successfully:', data);
//             })
//             .catch(error => {
//                 console.error('Error saving polyline:', error);
//             });
//     } else {
//         console.error('No polyline drawn');
//     }
// }

let map; // Declare the map variable to make it accessible globally

// Function to initialize and display the map
function initMap() {
    // Create LatLng objects for different locations
    const locationZC = { lat: 6.9214, lng: 122.0790 }; // New York City, USA
    const locationManicahan = { lat: 7.0245, lng: 122.1935 }; // Manicahan, Philippines
    const locationTumaga = { lat: 6.9434, lng: 122.0795 }; // Tumaga, Philippines
    const locationAyala = { lat: 6.9692, lng: 121.9471 }; // Tumaga, Philippines
    const locationCulianan = { lat: 6.977367, lng: 122.168928 }; // Tumaga, Philippines
    const locationCuruan = { lat: 7.2004, lng: 122.1803 }; // Tumaga, Philippines
    const locationVitali = { lat: 7.3586, lng: 122.3483 }; // Tumaga, Philippines

    // Create a LatLng array for the Perm District polygon
    const permDistrictCoordinates = [
        { lat: 7.0124959, lng: 122.1256655 }, // Vertex 1
        { lat: 7.109593, lng: 122.1973943 }, // Vertex 2
        { lat: 7.1101943, lng: 122.2377896 }, // Vertex 3
        { lat: 7.0135169, lng: 122.2035705 }, // Vertex 4
    ];

    // Options for the map
    const mapOptions = {
        center: locationZC,
        zoom: 11
    };

    // Create the map instance
    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    // Place a marker on the map for each location
    new google.maps.Marker({
        position: locationZC,
        map: map,
        title: 'Zamboanga City'
    });
    new google.maps.Marker({
        position: locationManicahan,
        map: map,
        title: 'Manicahan District'
    });
    new google.maps.Marker({
        position: locationTumaga,
        map: map,
        title: 'Tumaga District'
    });
    new google.maps.Marker({
        position: locationAyala,
        map: map,
        title: 'Ayala District'
    });
    new google.maps.Marker({
        position: locationCulianan,
        map: map,
        title: 'Culianan District'
    });
    new google.maps.Marker({
        position: locationCuruan,
        map: map,
        title: 'Curuan District'
    });
    new google.maps.Marker({
        position: locationVitali,
        map: map,
        title: 'Vitali District'
    });

    // Create the Perm District polygon
    const permDistrictPolygon = new google.maps.Polygon({
        paths: permDistrictCoordinates,
        strokeColor: '#fff',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35
    });
    permDistrictPolygon.setMap(map);

    // Function to handle the toggle of satellite view
    function toggleSatelliteView() {
        const isChecked = document.getElementById('satelliteToggle').checked;
        if (isChecked) {
            map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
        } else {
            map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
        }
    }

    // Add event listener to the checkbox for handling the toggle
    document.getElementById('satelliteToggle').addEventListener('change', toggleSatelliteView);

    // Add event listener to the file input for direct file upload
    document.getElementById('fileInput').addEventListener('change', handleFileUpload);
}

// Function to handle file upload
function handleFileUpload(event) {
    const fileInput = event.target;
    const selectedFile = fileInput.files[0];

    if (selectedFile) {
        const reader = new FileReader();

        reader.onload = function(event) {
            const fileContent = event.target.result;
            const fileExtension = selectedFile.name.split('.').pop().toLowerCase();

            // Handle different file types (KML, KMZ, GeoJSON)
            if (fileExtension === 'kml') {
                displayKML(fileContent);
            } else if (fileExtension === 'kmz') {
                displayKMZ(fileContent);
            } else if (fileExtension === 'geojson') {
                displayGeoJSON(fileContent);
            } else {
                alert('Unsupported file format. Please upload a KML, KMZ, or GeoJSON file.');
            }
        };

        reader.readAsText(selectedFile);
    }
}

// Function to display KML data on the map
function displayKML(kmlData) {
    // Parse and display the KML data on the map using Google Maps JavaScript API
    const kmlLayer = new google.maps.KmlLayer({
        url: 'data:text/xml;charset=UTF-8,' + encodeURIComponent(kmlData),
        map: map
    });
}

// Function to display KMZ data on the map
function displayKMZ(kmzData) {
    // Parse and display the KMZ data on the map using Google Maps JavaScript API
    const kmzLayer = new google.maps.KmlLayer({
        url: 'data:application/vnd.google-earth.kmz+xml;charset=UTF-8,' + encodeURIComponent(kmzData),
        map: map
    });
}

// Function to display GeoJSON data on the map
function displayGeoJSON(geojsonData) {
    // Parse and display the GeoJSON data on the map using Google Maps JavaScript API
    const geojsonLayer = new google.maps.Data();
    geojsonLayer.addGeoJson(JSON.parse(geojsonData));
    geojsonLayer.setMap(map);
}

// Load the map when the page is ready
google.maps.event.addDomListener(window, 'load', initMap);