
       <!-- Modal -->
       <div class="modal fade"id="edit{{$personalinformation->id}}"  aria-labelledby="addBarangayModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBarangayModalLabel">Update AgriDistrict</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="content">
                    <form id="multi-step-form" action{{url('update')}} method="post">
                        @csrf
                        <div >
        
                            <input type="hidden" name="users_id" value="{{ $userId}}">
                           
                         
                     </div>
                     <div class="input-box">
                       
                        <input type="hidden" class="form-control light-gray-placeholder @error('first_name') is-invalid @enderror" name="country" id="validationCustom01" value="corn" readonly >
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                      </div>
                 
                        <!-- Step 1 -->
                        <div id="step-1" class="form_1">
                            {{-- <h4 class="card-titles" style="display: flex;text-align: center; "><span></span>Rice Survey Form Zamboanga City</h4> --}}
                  <br>
                  {{-- <h6 class="card-title"><span></span>Barangay</h6> --}}

                           
                            {{-- <p class="text-success">Provide clear and concise responses to each section, </p>
                          <p class="text-success"> ensuring accuracy and relevance. If certain information .</p>
                        <p class="text-success"> is not applicable, write N/A.</p><br>  --}}
                            <div class="user-details">
                                
                                <div class="input-box">
                                    <span class="details">District name</span>
                                    <select class="form-control light-gray-placeholder @error('name="district"') is-invalid @enderror"  name="district" id="validationCustom01" aria-label="Floating label select e">
                                      <option value="{{$personalinformation->district}}">{{$personalinformation->district}}</option>
                                      <option value="ayala" {{ old('name="district"') == 'ayala' ? 'selected' : '' }}>Ayala</option>
                                      <option value="tumaga" {{ old('name="district"') == 'tumaga' ? 'selected' : '' }}>Tumaga</option>
                                      <option value="culianan" {{ old('name="district"') == 'culianan' ? 'selected' : '' }}>Culianan</option>
                                      <option value="manicahan" {{ old('name="district"') == 'manicahan' ? 'selected' : '' }}>Manicahan</option>
                                      <option value="curuan" {{ old('name="district"') == 'curuan' ? 'selected' : '' }}>Curuan</option>
                                      <option value="vitali" {{ old('name="district"') == 'vitali' ? 'selected' : '' }}>Vitali</option>
                                    </select>
                                  </div>


                          
                                <div class="input-box">
                                  <span class="details">Description</span>
                                  <input type="text" class="form-control light-gray-placeholder @error('middle_name') is-invalid @enderror" value="{{$personalinformation->description}}"  name="description" placeholder="description" id="selectReligion"onchange="checkReligion()" >
                                  @error('middle_name')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                                </div>

                                <div class="input-box">
                                    <span class="details">Latitude</span>
                                    <input type="text" class="form-control light-gray-placeholder @error('middle_name') is-invalid @enderror" value="{{$personalinformation->latitude}}" name="latitude" id="lat" placeholder="Enter latitude" value="{{ old('latitude') }}" >
                                    @error('middle_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                  </div>
                           
                                  <div class="input-box">
                                    <span class="details">Longitude</span>
                                    <input type="text" class="form-control light-gray-placeholder @error('middle_name') is-invalid @enderror" value="{{$personalinformation->longitude}}" name="longitude" id="long" placeholder="Enter longitude" value="{{ old('longitude') }}" >
                                    @error('middle_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                  </div>
{{--                                  
                                  <div class="input-box">
                                    <span class="details">Altitude (meters)</span>
                                    <input type="text" class="form-control light-gray-placeholder @error('middle_name') is-invalid @enderror" value="{{$personalinformation->altitude}}" name="altitude" id="altitude" placeholder="Altitude will be fetched" readonly>
                                    @error('middle_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                  </div> --}}
                                 
                              
                                
                              </div>
                           
                              <div class="form_1_btns">
                               
                               
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
         
                                  
                        {{-- <div id="map" style="height: 200px; width: 100%;"></div>   --}}
                                  </div>
                             
                    
                             
                    </div>
                    </form>
                </div>
               
            </div>
          
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const searchInput = document.getElementById('searchInput');
                    const farmProfileSearchForm = document.getElementById('farmProfileSearchForm');
                    const showAllForm = document.getElementById('showAllForm');
              
                    let timer;
              
                    // Add event listener for search input
                    searchInput.addEventListener('input', function() {
                        // Clear previous timer
                        clearTimeout(timer);
                        // Start new timer with a delay of 500 milliseconds (adjust as needed)
                        timer = setTimeout(function() {
                            // Submit the search form
                            farmProfileSearchForm.submit();
                        }, 1000);
                    });
              
                    // Add event listener for "Show All" button
                    showAllForm.addEventListener('click', function(event) {
                        // Prevent default form submission behavior
                        event.preventDefault();
                        // Remove search query from input field
                        searchInput.value = '';
                        // Submit the form
                        showAllForm.submit();
                    });
                });
              </script>
            
              
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
            
            