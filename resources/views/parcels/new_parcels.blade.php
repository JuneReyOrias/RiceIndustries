@extends('admin.dashb')
@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')

<div class="page-content">

  <nav class="page-breadcrumb">

  </nav>
  
  {{-- <div class="progress mb-3">
    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">15% Complete</div>

  </div> --}}
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
          <h6 class="card-title"><span>I.</span>Create New Parcellary Boundary</h6>

          <br><br>
          <p class="text-success">Make sure to fill in the required information accurately for each field to define the parcellary boundary correctly. Once all fields are filled, submit the form to create the new parcellary boundary.</p><br>
       
   
          <form action{{url('newparcels')}} method="post">
            @csrf
      
            <div class="row mb-3">
              <h6 class="card-title"><span>I.</span>Parcel owner Informations</h6>
              <div class="row mb-3">
                <h6 class="card-title"><span>I.</span>Parcel owner Informations</h6>
                
                <div class="col-md-3 mb-3">    
                 
                  <label class="form-expand" for="agri_districts_id">Agri-District:</label>
                  <select class="form-control mb-4 mb-md-0" name="agri_districts_id" aria-label="agri_districts_id">
                    @foreach ($agridistricts as $agridistrict)
                            <option value="{{ $agridistrict->id }}">{{ $agridistrict->district }}</option>
                            @endforeach
                    </select>
                   
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="parcel_name">Parcel Name:</label>
                  <input type="text" class="form-control placeholder-text @error('parcel_name') is-invalid @enderror" name="parcel_name" id="validationCustom01" placeholder=" Enter parcel name" value="{{ old('parcel_name') }}" >
                  @error('parcel_name')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="arpowner_na">ARP OwnerName:</label>
                  <input type="text" class="form-control placeholder-text @error('arpowner_na') is-invalid @enderror" name="arpowner_na" id="validationCustom01" placeholder=" Enter ARP OwnerName" value="{{ old('arpowner_na') }}" >
                  @error('arpowner_na')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              
              </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="brgy_name">Brgy. Name:</label>
                  <input type="text" class="form-control placeholder-text @error('brgy_name') is-invalid @enderror" name="brgy_name" id="validationCustom01" placeholder=" Enter brgy. name" value="{{ old('brgy_name') }}" >
                  @error('brgy_name')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="tct_no">Land Title no.:</label>
                  <input type="text" class="form-control placeholder-text @error('tct_no') is-invalid @enderror" name="tct_no" id="validationCustom01" placeholder=" Enter land title no." value="{{ old('tct_no') }}" >
                  @error('tct_no')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="lot_no">Lot no.:</label>
                  <input type="text" class="form-control placeholder-text @error('lot_no') is-invalid @enderror" name="lot_no" id="validationCustom01" placeholder=" Enter lot no" value="{{ old('lot_no') }}" >
                  @error('lot_no')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="pkind_desc">PKind Description:</label>
                  <input type="text" class="form-control placeholder-text @error('pkind_desc') is-invalid @enderror" name="pkind_desc" id="validationCustom01" placeholder=" Enter property kind description" value="{{ old('pkind_desc') }}" >
                  @error('pkind_desc')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="puse_desc">PUsed Description:</label>
                    <input type="text" class="form-control placeholder-text @error('puse_desc') is-invalid @enderror" name="puse_desc" id="puse_desc" placeholder="Enter property used description" value="{{ old('puse_desc') }}" >
                    @error('verone_latitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-expand" for="actual_used">Actual Used:</label>
                    <input type="text" class="form-control placeholder-text @error('actual_used') is-invalid @enderror" name="actual_used" id="actual_used" placeholder="Enter actual used" value="{{ old('actual_used') }}" >
                    @error('actual_used')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
  
  
        
                <h6 class="card-title"><span>II.</span>Parcel color and Area</h6>

                <div class="col-md-3 mb-3">
                    
                  <label class="form-expand" for="parcolor">Parcel Color:</label>
                  <select class="form-control placeholder-text @error('parcolor') is-invalid @enderror" name="parcolor"id="parcolor" aria-label="label select e" >
                    <option selected disabled>Select color</option>
                    <option value="#FFBF00" {{ old('parcolor') == '#FFBF00' ? 'selected' : '' }}>Rice: #FFBF00</option>
                    <option value="#ffff3" {{ old('parcolor') == '#ffff3' ? 'selected' : '' }}>Corn: #ffff33</option>
                    <option value="#663300" {{ old('parcolor') == '#663300' ? 'selected' : '' }}>Coconut: #663300</option>
                    <option value="#009900" {{ old('parcolor') == '#009900' ? 'selected' : '' }}>Banana: #009900</option>
                    <option value="#0066ff" {{ old('parcolor') == '#0066ff' ? 'selected' : '' }}>FishPond: #0066ff</option>
                    
                  </select>

                  @error('parcolor')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-expand" for="area">Area (sq meters):</label>
                  <input type="text" class="form-control placeholder-text @error('area') is-invalid @enderror" name="area" id="area" placeholder="Area will be calculated" >
                  @error('area')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
            
            </div>
           

<div  class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a  href="{{route('polygon.polygons_show')}}"button  class="btn btn-success me-md-2">Back</button></a></p>
  <button type="submit" class="btn btn-success me-md-2 btn-submit">Submit</button>
</div>
          </form>
        
          
        </div>
      </div>
    </div>
  </div>
  <div id="map" style="height: 400px; width: 100%;"></div>
</div>
</div>
</div>
</div>

</div>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMstylquYwo8gAuOrkrF5IsN6K8gbgV6I&libraries=drawing,geometry&callback=initMap"></script>
<script type="text/javascript">
  var map;
var drawingManager;
var selectedShape;
var markers = [];

function initMap() {
  var initialLocation = {lat: 6.9214, lng: 122.0790};

  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: initialLocation,
    mapTypeId: 'terrain'
  });

  // Initialize the Drawing Manager
  drawingManager = new google.maps.drawing.DrawingManager({
    drawingMode: google.maps.drawing.OverlayType.POLYGON,
    drawingControl: true,
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER,
      drawingModes: ['polygon']
    },
    polygonOptions: {
      editable: true
    }
  });
  drawingManager.setMap(map);

  // Add event listener for the drawing manager
  google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
    if (event.type === google.maps.drawing.OverlayType.POLYGON) {
      if (selectedShape) {
        selectedShape.setMap(null);
      }
      selectedShape = event.overlay;
      var area = google.maps.geometry.spherical.computeArea(selectedShape.getPath());
      document.getElementById('area').value = area.toFixed(2); // Calculate and set area

      // Get the altitude of the first point of the polygon
      var path = selectedShape.getPath().getArray();
      var latLng = path[0];
      getElevation(latLng);
    }
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

  // Function to add marker to the map
  function addMarker(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: map
    });
    markers.push(marker);
  }

  // Function to delete markers from the map
  function deleteMarkers() {
    markers.forEach(marker => {
      marker.setMap(null);
    });
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
}
</script>
@endsection

