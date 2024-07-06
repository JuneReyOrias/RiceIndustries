@extends('admin.dashb')
@section('admin')

@extends('layouts._footer-script')
@extends('layouts._head')

<div class="page-content">
  <nav class="page-breadcrumb"></nav>
  
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card border rounded">
        <div class="card-body">
          
          @if (session('message'))
          <div class="alert alert-success" role="alert">
            {{ session('message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
         
          @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
          
          <h6 class="card-title"><span>I.</span>Create New Pin/Agri-Districty</h6>
          <br><br>
          <p class="text-success">Make sure to fill in the required information accurately for each field to define the Pin/Agri-District correctly. Once all fields are filled, submit the form to create the new Pin/Agri-District.</p><br>
       
          <form action{{ url('store') }} method="post">
            @csrf
      
            <div class="row mb-3">
              <h6 class="card-title"><span>I.</span> Pin/Agri-District</h6>
              
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="parcel_name">District Name:</label>
                
                <select class="form-control light-gray-placeholder @error('name="district"') is-invalid @enderror"  name="district" id="validationCustom01" aria-label="Floating label select e">
                  <option selected disabled>Select</option>
                  <option value="ayala" {{ old('name="district"') == 'ayala' ? 'selected' : '' }}>Ayala</option>
                  <option value="tumaga" {{ old('name="district"') == 'tumaga' ? 'selected' : '' }}>Tumaga</option>
                  <option value="culianan" {{ old('name="district"') == 'culianan' ? 'selected' : '' }}>Culianan</option>
                  <option value="manicahan" {{ old('name="district"') == 'manicahan' ? 'selected' : '' }}>Manicahan</option>
                  <option value="curuan" {{ old('name="district"') == 'curuan' ? 'selected' : '' }}>Curuan</option>
                  <option value="vitali" {{ old('name="district"') == 'vitali' ? 'selected' : '' }}>Vitali</option>
                </select>
              </div>
              
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="arpowner_na">Description:</label>
                <input type="text" class="form-control placeholder-text @error('arpowner_na') is-invalid @enderror" name="description" placeholder="Enter description" value="{{ old('arpowner_na') }}">
                @error('arpowner_na')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="latitude">Latitude:</label>
                <input type="text" class="form-control placeholder-text @error('latitude') is-invalid @enderror" name="latitude" id="lat" placeholder="Enter latitude" value="{{ old('latitude') }}">
                @error('latitude')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="longitude">Longitude:</label>
                <input type="text" class="form-control placeholder-text @error('longitude') is-invalid @enderror" name="longitude" id="long" placeholder="Enter longitude" value="{{ old('longitude') }}">
                @error('longitude')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-3 mb-3">
                <label class="form-expand" for="altitude">Altitude (meters):</label>
                <input type="text" class="form-control placeholder-text @error('altitude') is-invalid @enderror" name="altitude" id="altitude" placeholder="Altitude will be fetched" readonly>
                @error('altitude')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-3 mb-3">
                <label class="form-expand" for="area">Area (sq meters):</label>
                <input type="text" class="form-control placeholder-text @error('area') is-invalid @enderror" name="area" id="area" placeholder="Area will be calculated" readonly>
                @error('area')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="{{ route('polygon.polygons_show') }}" class="btn btn-success me-md-2">Back</a>
              <button type="submit" class="btn btn-success me-md-2 btn-submit">Submit</button>
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
  
  <div id="map" style="height: 400px; width: 100%;"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMstylquYwo8gAuOrkrF5IsN6K8gbgV6I&libraries=drawing,geometry&callback=initMap"></script>
<script type="text/javascript">
  var map;
  var markers = [];

  function initMap() {
    var initialLocation = {lat: 6.9214, lng: 122.0790};

    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 16.3,
      center: initialLocation,
      mapTypeId: 'terrain'
    });

    // This event listener will call addMarker() when the map is clicked.
    map.addListener('click', function(event) {
      if (markers.length >= 1) {
          deleteMarkers();
      }

      addMarker(event.latLng);
      document.getElementById('lat').value = event.latLng.lat();
      document.getElementById('long').value = event.latLng.lng();

      // Fetch the altitude for the clicked point
      getElevation(event.latLng);
    });

    // Event listener for latitude and longitude input fields
    $('#lat, #long').on('change', function() {
      var lat = parseFloat($('#lat').val());
      var lng = parseFloat($('#long').val());
      
      if (!isNaN(lat) && !isNaN(lng)) {
        var location = { lat: lat, lng: lng };
        map.setCenter(location);
        deleteMarkers();
        addMarker(location);
      }
    });
  }

  // Adds a marker to the map and push to the array.
  function addMarker(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: map
    });
    markers.push(marker);
  }

  // Sets the map on all markers in the array.
  function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
  }

  // Removes the markers from the map, but keeps them in the array.
  function clearMarkers() {
    setMapOnAll(null);
  }

  // Deletes all markers in the array by removing references to them.
  function deleteMarkers() {
    clearMarkers();
    markers = [];
  }

  // Fetch and display the elevation of a location
  function getElevation(latLng) {
    var elevator = new google.maps.ElevationService();
    elevator.getElevationForLocations({'locations': [latLng]}, function(results, status) {
      if (status === 'OK') {
        if (results[0]) {
          var elevation = results[0].elevation;
          document.getElementById('altitude').value = elevation.toFixed(2);
        } else {
          document.getElementById('altitude').value = 'No data';
        }
      } else {
        document.getElementById('altitude').value = 'Error';
      }
    });
  }

  // jQuery event listener for form submission
  $(document).ready(function() {
    $(document).on('click', '.btn-submit', function(event) {
      var form = $(this).closest("form");

      event.preventDefault(); // Prevent the default button action

      swal({
          title: "Are you sure you want to submit this form?",
          text: "Please confirm your action.",
          icon: "warning",
          buttons: {
              cancel: "Cancel",
              confirm: {
                  text: "Yes, Continue!",
                  value: true,
                  visible: true,
                  className: "btn-success",
                  closeModal: false
              }
          },
          dangerMode: true,
      }).then((willSubmit) => {
          if (willSubmit) {
              // Display loading indicator
              swal({
                  title: "Processing...",
                  text: "Please wait.",
                  buttons: false,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  icon: "info",
                  timerProgressBar: true,
              });

              // Submit the form after a short delay to allow the loading indicator to be shown
              setTimeout(function() {
                  form.submit(); // Submit the form
              }, 500);
          }
      });
    });
  });
</script>

@endsection
