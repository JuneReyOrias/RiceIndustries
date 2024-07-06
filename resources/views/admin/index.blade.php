@extends('admin.dashb')

@section('admin')


<div class="page-content">
 
  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  
    <div>
      <h4 class="mb-3 mb-md-0 " style="font-size: 19px;align-items:center;"> Zamboanga City Rice Industry Dashboard</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      <div class="dropdown me-2 mb-2 mb-md-0">
          <button class="btn btn-primary dropdown-toggle" type="button" id="districtDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              Select District
          </button>
          <ul class="dropdown-menu" aria-labelledby="districtDropdown">
              <li><a class="dropdown-item" href="#" data-district="Ayala District">Ayala</a></li>
              <li><a class="dropdown-item" href="#" data-district="Tumaga District">Tumaga</a></li>
              <li><a class="dropdown-item" href="#" data-district="Culianan District">Culianan</a></li>
              <li><a class="dropdown-item" href="#" data-district="Manicahan District">Manicahan</a></li>
              <li><a class="dropdown-item" href="#" data-district="Curuan District">Curuan</a></li>
              <li><a class="dropdown-item" href="#" data-district="Vitali District">Vitali</a></li>
          </ul>
      </div>
      
     
      <div class="dropdown me-2 mb- mb-md-0">
        <button class="btn btn-primary dropdown-toggle" type="button" id="yearlyReportDropdown" data-toggle="dropdown" aria-expanded="false">
           Yearly 
        </button>
        <ul class="dropdown-menu" aria-labelledby="yearlyReportDropdown">
            <li><a class="dropdown-items" href="#" data-report="2023">2023</a></li>
            <li><a class="dropdown-items" href="#" data-report="2022">2022</a></li>
            <!-- Add more yearly reports as needed -->
        </ul>
    </div>

    <div class="dropdown me-2 mb- mb-md-0">
      <button class="btn btn-primary dropdown-toggle" type="button" id="yearlyReportDropdown" data-toggle="dropdown" aria-expanded="false">
         Tenurial
      </button>
      <ul class="dropdown-menu" aria-labelledby="yearlyReportDropdown">
          <li><a class="dropdown-items" href="#" data-report="2023">Owner</a></li>
          <li><a class="dropdown-items" href="#" data-report="2022">Owner-Tiller</a></li>
          <li><a class="dropdown-items" href="#" data-report="2023">Tenant</a></li>
          <li><a class="dropdown-items" href="#" data-report="2022">Tiller</a></li>
          <li><a class="dropdown-items" href="#" data-report="2022">Lease</a></li>
          <!-- Add more yearly reports as needed -->
      </ul>
  </div>
  
    {{-- <div class="dropdown me-2 mb-2 mb-md-0">
        <button class="btn btn-primary dropdown-toggle" type="button" id="monthlyReportDropdown" data-toggle="dropdown" aria-expanded="false">
            Monthly 
        </button>
        <ul class="dropdown-menu" aria-labelledby="monthlyReportDropdown">
            <li><a class="dropdown-item" href="#" data-report="January">January</a></li>
            <li><a class="dropdown-item" href="#" data-report="February">February</a></li>
            <!-- Add more monthly reports as needed -->
        </ul>
    </div> --}}
    
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0 hide-on-print" onclick="printReport()">
        <i class="btn-icon-prepend" data-feather="printer"></i>
        Print
    </button>
</div>
  </div>
  
  <!-- Modal Structure -->
  <div class="modal fade" id="districtModal" tabindex="-1" aria-labelledby="districtModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="districtModalLabel">District Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p id="districtInfo">District details will be displayed here.</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  
  <!-- Yearly Report Modal -->
  <div class="modal fade" id="yearlyReportModal" tabindex="-1" aria-labelledby="yearlyReportModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="yearlyReportModalLabel">Yearly Report</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p id="yearlyReportInfo">Yearly report details will be displayed here.</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  
  <!-- Monthly Report Modal -->
  <div class="modal fade" id="monthlyReportModal" tabindex="-1" aria-labelledby="monthlyReportModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="monthlyReportModalLabel">Monthly Report</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p id="monthlyReportInfo">Monthly report details will be displayed here.</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  

  <div class="row">
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow-1">
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Numbers of Farmers</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                   
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">{{ number_format($totalfarms, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-success">
                      <span>+3.3%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                <div class="col-6 col-md-12 col-xl-7">
                  <div id="totalFarmsChart" class="mt-md-3 mt-xl-0"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Area PLanted</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                  
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">{{ number_format($totalAreaPlanted, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-danger">
                      <span>-2.8%</span>
                      <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Area Yield(Kg/Ha)</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                   
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">{{ number_format($totalAreaYield, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-success">
                      <span>+2.8%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- row -->
  

  <div class="row">
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow-1">
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Cost</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                  
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">{{ number_format($totalCost, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-success">
                      <span>+3.3%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Average  Yield  Per Area Planted (Kg/Ha)</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                   
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-2">{{ number_format($yieldPerAreaPlanted, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-danger">
                      <span>-2.8%</span>
                      <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Average Cost Per Area Planted(Ha)</h6>
                <div class="dropdown mb-2">
                  <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5"><br>
                  <h3 class="mb-1">{{ number_format($averageCostPerAreaPlanted, 2) }}</h3>
                  <div class="d-flex align-items-baseline">
                    {{-- <p class="text-success">
                      <span>+2.8%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p> --}}
                  </div>
                </div>
                {{-- <div class="col-6 col-md-12 col-xl-7">
                  <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                </div> --}}
              </div>
              
            </div>
          </div>
        </div>

        
      
      </div>
    </div>
  </div> <!-- row -->
      

  <div class="row">
    <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-baseline mb-2">
            <h6 class="card-title mb-0">Farmers Yearly</h6>
            <div class="dropdown mb-2">
              <a type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
              
                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
              </div>
            </div>
          </div>
          
          <div id="monthlySalesChart"></div>
        </div> 
      </div>
    </div>
    <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Rice Production Chart</h6>
              </div>
              <div id="storageChart"></div>
          </div>
      </div>
  </div>

  
  </div>  

      </div>
    </div>
  </div> <!-- row -->
<div class="production" ></div>

<script>
  function printReport() {
      // Apply print styles
      const link = document.createElement('link');
      link.rel = 'stylesheet';
      link.href = '{{ asset('css/print.css') }}';
      document.head.appendChild(link);
  
      // Get current date
      var currentDate = new Date();
      var formattedDate = currentDate.toLocaleDateString();
      var formattedTime = currentDate.toLocaleTimeString();
  
      // Create a new element to hold the title and the current date
      const titleElement = document.createElement('div');
      titleElement.textContent = 'Farmers Data Report';
      titleElement.style.fontWeight = 'bold'; // Adjust styling as needed
  
      const currentDateElement = document.createElement('div');
      currentDateElement.textContent = 'Printed on: ' + currentDate;
      currentDateElement.style.marginBottom = '20px'; // Adjust styling as needed
  
      // Insert the title and the current date elements into the document body
      document.body.insertBefore(titleElement, document.body.firstChild);
      document.body.insertBefore(currentDateElement, titleElement.nextSibling);
  
      // Hide the navbar
      const navbar = document.querySelector('.navbar');
      if (navbar) {
          navbar.style.display = 'none';
      }
  
      // Hide other elements not to be printed
      const elementsToHide = document.querySelectorAll('.exclude-from-print');
      elementsToHide.forEach(element => {
          element.style.display = 'none';
      });
      document.querySelectorAll('.hide-on-print').forEach(button => {
              button.style.display = 'none';
          });
      // Insert space after "Average Cost per Area Planted"
      insertSpaceForPrinting();
  
      // Print only the page content
      window.print();
  
      // Show the navbar after printing
      if (navbar) {
          navbar.style.display = '';
      }
  
      // Show the hidden elements after printing
      elementsToHide.forEach(element => {
          element.style.display = '';
      });
      document.querySelectorAll('.hide-on-print').forEach(button => {
              button.style.display = 'block';
          });
      // Remove the title and the current date elements after printing
      titleElement.remove();
      currentDateElement.remove();
  }
  
  // Function to insert a space after "Average Cost per Area Planted" when printing
  function insertSpaceForPrinting() {
      const averageCostSection = document.getElementById('average-cost-section'); // Adjust the ID accordingly
      if (averageCostSection) {
          const spaceDiv = document.createElement('div');
          spaceDiv.style.marginBottom = '1000px'; // Adjust the margin as needed
          averageCostSection.parentNode.insertBefore(spaceDiv, averageCostSection.nextSibling);
      }
  }
  
  
  </script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdn.jsdelivr.net/npm/@sgratzl/chartjs-chart-geo@latest"></script>

<script>
function printReport() {
    window.print();
}

function showSection(sectionId) {
    // Hide all sections first
    document.querySelectorAll('.report-section').forEach(section => {
        section.style.display = 'none';
    });
    // Show the selected section
    document.getElementById(sectionId).style.display = 'block';
}

// Optionally, a function to show all sections
function showAllSections() {
    document.querySelectorAll('.report-section').forEach(section => {
        section.style.display = 'block';
    });
}
 first
showSection('personal_info');



</script>

  <!-- Include Bootstrap Bundle with Popper -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <!-- Include Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          // Initialize feather icons
          feather.replace();

          // Get the dropdown menu and items
          const dropdownMenu = document.getElementById('districtDropdown');
          const dropdownItems = document.querySelectorAll('.dropdown-item');
          const districtModal = new bootstrap.Modal(document.getElementById('districtModal'));
          const districtInfo = document.getElementById('districtInfo');

          // Add click event listener to each dropdown item
          dropdownItems.forEach(item => {
              item.addEventListener('click', function(event) {
                  event.preventDefault();
                  const selectedDistrict = this.getAttribute('data-district');
                  dropdownMenu.textContent = selectedDistrict;
                  console.log('Selected District:', selectedDistrict);
                  
                  // Update the modal content
                  districtInfo.textContent = `Information about ${selectedDistrict}`;
                  
                  // Show the modal
                  districtModal.show();
              });
          });
      });


      document.addEventListener('DOMContentLoaded', function() {
          // Initialize feather icons
          feather.replace();

          // Get the dropdown menu and items
          const dropdownMenu = document.getElementById('yearlyReportDropdown');
          const dropdownItems = document.querySelectorAll('.dropdown-items');
          const yearlyReportModal = new bootstrap.Modal(document.getElementById('yearlyReportModal'));
          const yearlyReportInfo = document.getElementById('yearlyReportInfo');

          // Add click event listener to each dropdown item
          dropdownItems.forEach(item => {
              item.addEventListener('click', function(event) {
                  event.preventDefault();
                  const selectedReport = this.getAttribute('data-report');
                  dropdownMenu.textContent = selectedReport;
                  console.log('Selected District:', selectedReport);
                  
                  // Update the modal content
                  yearlyReportInfo.textContent = `Information about ${selectedReport}`;
                  
                  // Show the modal
                  yearlyReportModal.show();
              });
          });
      });
      
      // function printReport() {
      //     console.log('Print report function called.');
      //     // Implement print functionality
      // }



//   </script>



@endsection