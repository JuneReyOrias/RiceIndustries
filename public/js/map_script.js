// // $(document).read(function() {
// //         var map = new google.maps.Map(document.getElementById('map'), {
// //             center: { lat: 6.9214, lng: 122.0790 },
// //             zoom: 11
// //         })



// //     })

// let map; // Declare the map variable to make it accessible globally
// let markers = []; // Declare a global array to keep track of markers

// function initMap() {
//     // Create LatLng objects for different locations
//     const locationZC = { lat: 6.9214, lng: 122.0790 };
//     const locationManicahan = { lat: 7.0245, lng: 122.1935 };
//     const locationTumaga = { lat: 6.9434, lng: 122.0795 };
//     const locationAyala = { lat: 6.9692, lng: 121.9471 };
//     const locationCulianan = { lat: 6.977367, lng: 122.168928 };
//     const locationCuruan = { lat: 7.2004, lng: 122.1803 };
//     const locationVitali = { lat: 7.3586, lng: 122.3483 };

//     // Create a LatLng array for the Perm District polygon
//     const permDistrictCoordinates = [
//         { lat: 7.0124959, lng: 122.1256655 }, // Vertex 1
//         { lat: 7.109593, lng: 122.1973943 }, // Vertex 2
//         { lat: 7.1101943, lng: 122.2377896 }, // Vertex 3
//         { lat: 7.0135169, lng: 122.2035705 }, // Vertex 4
//     ];

//     // Options for the map
//     const mapOptions = {
//         center: locationZC,
//         zoom: 11
//     };

//     // Create the map instance
//     map = new google.maps.Map(document.getElementById('map'), mapOptions);

//     // Place a marker on the map for each location
//     new google.maps.Marker({
//         position: locationZC,
//         map: map,
//         title: 'Zamboanga City'
//     });
//     new google.maps.Marker({
//         position: locationManicahan,
//         map: map,
//         title: 'Manicahan District'
//     });
//     new google.maps.Marker({
//         position: locationTumaga,
//         map: map,
//         title: 'Tumaga District'
//     });
//     new google.maps.Marker({
//         position: locationAyala,
//         map: map,
//         title: 'Ayala District'
//     });
//     new google.maps.Marker({
//         position: locationCulianan,
//         map: map,
//         title: 'Culianan District'
//     });
//     new google.maps.Marker({
//         position: locationCuruan,
//         map: map,
//         title: 'Curuan District'
//     });
//     new google.maps.Marker({
//         position: locationVitali,
//         map: map,
//         title: 'Vitali District'
//     });

//     // Assuming you have an array of rice farmer coordinates
//     const riceFarmers = [
//         { position: { lat: 7.201, lng: 122.184 }, title: 'Rice Farmer 1', district: 'Curuan District' },
//         { position: { lat: 7.202, lng: 122.185 }, title: 'Rice Farmer 2', district: 'Curuan District' },
//         // Add more rice farmer data as needed
//     ];

//     function displayFarmersByDistrict(district) {
//         // Clear previous markers (if any)
//         markers.forEach(marker => marker.setMap(null));

//         // Filter rice farmers by district
//         const farmersInDistrict = riceFarmers.filter(farmer => farmer.district === district);

//         // Create markers for rice farmers in the specified district
//         farmersInDistrict.forEach(farmer => {
//             const marker = new google.maps.Marker({
//                 position: farmer.position,
//                 map: map,
//                 title: farmer.title,
//                 district: farmer.district,
//             });
//             markers.push(marker); // Add marker to the global array for clustering
//         });

//         // Use MarkerClusterer to cluster the markers
//         var markerCluster = new MarkerClusterer(map, markers, {
//             imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
//         });
//     }

//     // Add event listeners for district markers
//     google.maps.event.addListener(locationCuruanMarker, 'click', function() {
//         displayFarmersByDistrict('Curuan District');
//     });

//     // Create the Perm District polygon
//     const permDistrictPolygon = new google.maps.Polygon({
//         paths: permDistrictCoordinates,
//         strokeColor: '#fff',
//         strokeOpacity: 0.8,
//         strokeWeight: 2,
//         fillColor: '#FF0000',
//         fillOpacity: 0.35
//     });
//     permDistrictPolygon.setMap(map);

//     // Function to handle the toggle of satellite view
//     function toggleSatelliteView() {
//         const isChecked = document.getElementById('satelliteToggle').checked;
//         if (isChecked) {
//             map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
//         } else {
//             map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
//         }
//     }

//     // Add event listener to the checkbox for handling the toggle
//     document.getElementById('satelliteToggle').addEventListener('change', toggleSatelliteView);

//     // Add event listener to the file input for direct file upload
//     document.getElementById('fileInput').addEventListener('change', handleFileUpload);
// }

// // Function to handle file upload
// function handleFileUpload(event) {
//     const fileInput = event.target;
//     const selectedFile = fileInput.files[0];

//     if (selectedFile) {
//         const reader = new FileReader();

//         reader.onload = function(event) {
//             const fileContent = event.target.result;
//             const fileExtension = selectedFile.name.split('.').pop().toLowerCase();

//             if (fileExtension === 'kml') {
//                 displayKML(fileContent);
//             } else if (fileExtension === 'kmz') {
//                 displayKMZ(fileContent);
//             } else if (fileExtension === 'geojson') {
//                 displayGeoJSON(fileContent);
//             } else {
//                 alert('Unsupported file format. Please upload a KML, KMZ, or GeoJSON file.');
//             }
//         };

//         reader.readAsText(selectedFile);
//     }
// }

// // Function to display KML data on the map
// function displayKML(kmlData) {
//     const kmlLayer = new google.maps.KmlLayer({
//         url: 'data:text/xml;charset=UTF-8,' + encodeURIComponent(kmlData),
//         map: map
//     });
// }

// // Function to display KMZ data on the map
// function displayKMZ(kmzData) {
//     const kmzLayer = new google.maps.KmlLayer({
//         url: 'data:application/vnd.google-earth.kmz+xml;charset=UTF-8,' + encodeURIComponent(kmzData),
//         map: map
//     });
// }

// // Function to display GeoJSON data on the map
// function displayGeoJSON(geojsonData) {
//     const geojsonLayer = new google.maps.Data();
//     geojsonLayer.addGeoJson(JSON.parse(geojsonData));
//     geojsonLayer.setMap(map);
// }

// // Call initMap when the page loads
// google.maps.event.addDomListener(window, 'load', initMap);
// let map; // Declare the map variable to make it accessible globally
// let markers = []; // Declare a global array to keep track of markers

// function initMap() {
//     // ... (your existing code)

//     // Fetch farm profiles from Laravel route
//     fetch('/get-farm-profiles')
//         .then(response => response.json())
//         .then(farmProfiles => {
//             farmProfiles.forEach(profile => {
//                 // Create a marker for each farm profile
//                 new google.maps.Marker({
//                     position: { lat: profile.gps_latitude, lng: profile.gps_longitude },
//                     map: map,
//                     title: profile.name,
//                 });
//             });
//         })
//         .catch(error => console.error('Error fetching farm profiles:', error));
// }

// // ... (your existing code)

// // Call initMap when the page loads
// google.maps.event.addDomListener(window, 'load', initMap);


// let map; // Global map variable
// let markers = []; // Global array to track markers

// function initMap() {
//     // Define your map options and create the map instance
//     // ...

//     // Display a loading message or indicator
//     document.getElementById('loadingIndicator').style.display = 'block';

//     // Fetch farm profiles from your Laravel backend
//     fetch('/get-farm-profiles')
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .then(farmProfiles => {
//             // Hide the loading indicator
//             document.getElementById('loadingIndicator').style.display = 'none';

//             // Iterate over each farm profile to create a marker
//             farmProfiles.forEach(profile => {
//                 const marker = new google.maps.Marker({
//                     position: new google.maps.LatLng(profile.gps_latitude, profile.gps_longitude),
//                     map: map,
//                     title: profile.name,
//                     icon: 'path/to/custom-icon.png' // Custom icon for the marker
//                 });

//                 // Create an info window for each marker
//                 const infoWindow = new google.maps.InfoWindow({
//                     content: `<h3>${profile.name}</h3><p>More details about the farm...</p>`
//                 });

//                 // Add click event listener to open the info window on marker click
//                 marker.addListener('click', () => {
//                     infoWindow.open(map, marker);
//                 });

//                 markers.push(marker);
//             });
//         })
//         .catch(error => {
//             console.error('Error fetching farm profiles:', error);
//             document.getElementById('errorIndicator').innerText = 'Failed to load farm profiles.';
//         });

//     // Other map initialization code
//     // Customize map styles (if needed)
//     const styledMapType = new google.maps.StyledMapType(
//         [ /* Array of style objects */ ], { name: 'Styled Map' }
//     );
//     map.mapTypes.set('styled_map', styledMapType);
//     map.setMapTypeId('styled_map');

//     // Try to get the user's location
//     if (navigator.geolocation) {
//         navigator.geolocation.getCurrentPosition(position => {
//             const userLocation = {
//                 lat: position.coords.latitude,
//                 lng: position.coords.longitude
//             };
//             map.setCenter(userLocation);
//             new google.maps.Marker({
//                 position: userLocation,
//                 map: map,
//                 title: "You are here"
//             });
//         }, () => {
//             // Handle error or denial of location access
//         });
//     }

//     // Add zoom and pan controls
//     map.setOptions({
//         zoomControl: true,
//         panControl: true
//     });

//     // Add a search box
//     const input = document.getElementById('pac-input');
//     const searchBox = new google.maps.places.SearchBox(input);
//     map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

//     // Bias the search box results towards current map's viewport
//     map.addListener('bounds_changed', () => {
//         searchBox.setBounds(map.getBounds());
//     });

//     // Add event listeners for map interaction
//     google.maps.event.addListener(map, 'click', (event) => {
//         // Code to execute on map click
//     });
// }

// // Ensure the initMap function is called when the window loads
// google.maps.event.addDomListener(window, 'load', initMap);
let map; // Global map variable
let markers = []; // Global array to track markers

function initMap() {
    // Define map options
    const mapOptions = {
        center: { lat: 6.9214, lng: 122.0790 },
        zoom: 11,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapId: '474a1fbd51c3e27f'
    };

    // Create the map instance
    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    // Fetch farm profiles (replace with your actual fetch code)
    fetch('/map/arcmap')
        .then(response => response.json())
        .then(farmProfiles => {
            farmProfiles.forEach(farmprofile => {
                const gps_latitude = parseFloat(farmprofileprofile.gps_latitude);
                const gps_longitude = parseFloat(farmprofileprofile.gps_longitude);

                // Check if latitude and longitude are valid numbers
                if (!isNaN(gps_latitude) && !isNaN(gps_longitude)) {
                    // Create a marker at the farm's coordinates
                    const marker = new google.maps.Marker({
                        position: { lat: gps_latitude, lng: gps_longitude },
                        map: map,
                        title: `${farmprofile.name} (${latitude}, ${gps_longitude})`, // Display name and coordinates in the marker's title
                    });

                    // Add the marker to the markers array
                    markers.push(marker);

                }
            });
        })
        .catch(error => {
            console.error('Error fetching farm profiles:', error);
        });

    // Other map initialization code...
    // ...
}

// Ensure the initMap function is called when the window loads
google.maps.event.addDomListener(window, 'load', initMap);