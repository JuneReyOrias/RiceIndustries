@extends('admin.dashb')

@section('admin')

<style>
  /* Custom style for the dropdown width */
  .custom-dropdown {
      width: 2px; /* Adjust the width as needed */
  }

  .custom-card {
    height: 100px; /* Adjust height as needed */
    width: 80px;  /* Adjust width as needed */
    display: flex;
    justify-content: center;
    align-items: center;
}

.custom-card .card-body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px; /* Adjust padding as needed */
    border: 1px solid transparent; /* Initial transparent border */
    border-image: linear-gradient(to right, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.1)); /* Gradient for border */
 
}

.custom-card h4 {
    margin-top: 20px; /* Adjust margin as needed */
    
}
.custom-card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
   
}
</style>
<div class="page-content">
 
  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  
    <div>
      <h4 class="mb-3 mb-md-0 " style="font-size: 19px;align-items:center;"> Zambo-AgriMap Dashboard</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      {{-- <div class="dropdown me-2 mb-2 mb-md-0">
        <button class="btn btn-primary dropdown-toggle" type="button" id="districtDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          Select District
        </button>
        <ul class="dropdown-menu" aria-labelledby="districtDropdown">
          @foreach ($districts as $district )
          <li><a class="dropdown-item" href="#" data-district={{$district->district}}>{{$district->district}}</a></li>
          @endforeach
          
        </ul>
      </div> --}}
    
    <!-- Modal -->
<div class="modal fade" id="districtModal" tabindex="-1" aria-labelledby="districtModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="districtModalLabel">District Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="districtName"></p>

        <label for="tenurialStatus" class="form-label">Select Tenurial Status:</label>
          <select id="tenurialStatus" class="form-select form-select-modern mb-3">
            <option value="all">All</option>
            <option value="owner">Owner</option>
            <option value="tenant">Tenant</option>
            <option value="tiller">Tiller</option>
            <option value="lease">Lease</option>
          </select>
        <p id="numberOfFarmers"></p>
        <p id="totalAreaPlanted"></p>
        <p id="totalAreaYield"></p>
        <p id="totalCost"></p>
        <p id="avgYieldPerArea"></p>
        <p id="avgCostPerArea"></p>
        <p id="seasonFarmersProduction"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>


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
    <div class="col-12 stretch-card">
        <div class="row flex-grow-1">
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <h6 class="card-title mb-0">Total Numbers of Farmers</h6>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <h4 class="mb-2">{{ number_format($totalfarms, 2) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card custom-card">
              <div class="card-body">
                  <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Total Area Planted</h6>
                  </div>
                  <div class="d-flex justify-content-center align-items-center">
                      <div class="text-center">
                          <h4 class="mb-2">{{ number_format($totalAreaPlanted, 2) }}</h4>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-md-4 grid-margin stretch-card">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Total Area Yield (Kg/Ha)</h6>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="text-center">
                        <h4 class="mb-2">{{ number_format($totalAreaYield, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
           
  
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <h6 class="card-title mb-0">Total Cost</h6>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <h4 class="mb-2">Php {{ number_format($totalCost, 2) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card custom-card">
              <div class="card-body">
                  <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Ave.Yield/Area Planted (Kg/Ha)</h6>
                  </div>
                  <div class="d-flex justify-content-center align-items-center">
                      <div class="text-center">
                          <h4 class="mb-2">{{ number_format($yieldPerAreaPlanted, 2) }}</h4>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-md-4 grid-margin stretch-card">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Variety Planted/Districts</h6>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="text-center">
                        <h4 class="mb-2">{{ number_format($yieldPerAreaPlanted, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>

  

  
      

  <div class="row">
    <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-baseline mb-2">
            <h6 class="card-title mb-0">Farmers Variety Planted/Districts</h6>
           
          </div>
          
          <div style="width: 80%; margin: auto;">
            <form id="cropForm" action="{{ url('/admin/dashboard') }}" method="GET" class="mb-4">
                <label for="crop" class="form-label">Select Crop:</label>
                <select class="form-select" name="crop" id="crop" onchange="document.getElementById('cropForm').submit();">
                    <option value="Rice" {{ $selectedCrop == 'Rice' ? 'selected' : '' }}>Rice</option>
                    <option value="Corn" {{ $selectedCrop == 'Corn' ? 'selected' : '' }}>Corn</option>
                    <option value="Coconut" {{ $selectedCrop == 'Coconut' ? 'selected' : '' }}>Coconut</option>
                    <option value="Other" {{ $selectedCrop == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </form>
            <div id="monthlySalesChart"></div>
        </div>
    
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

  <div style="width: 80%; margin: auto;">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Farmers Yields/Districts</h6>
            </div>
            
            <form id="filterForm" action="{{ url('/admin/dashboard') }}" method="GET" class="mb-4">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="crop" class="form-label">Select Crop:</label>
                        <select class="form-select custom-dropdown" name="crop" id="crop" onchange="document.getElementById('filterForm').submit();">
                            <option value="Rice" {{ $selectedCrop == 'Rice' ? 'selected' : '' }}>Rice</option>
                            <option value="Corn" {{ $selectedCrop == 'Corn' ? 'selected' : '' }}>Corn</option>
                            <option value="Coconut" {{ $selectedCrop == 'Coconut' ? 'selected' : '' }}>Coconut</option>
                            <option value="Other" {{ $selectedCrop == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="harvestDate" class="form-label">Harvested Date:</label>
                        <input type="date" class="form-control" name="harvestDate" id="harvestDate" value="{{ $selectedDate }}" onchange="document.getElementById('filterForm').submit();">
                    </div>
                    <div class="col-md-3">
                        <label for="croppingCycle" class="form-label">Cropping Cycle:</label>
                        <select class="form-select custom-dropdown" name="croppingCycle" id="croppingCycle" onchange="document.getElementById('filterForm').submit();">
                            <option value="">Select Cycle</option>
                            <option value="Cycle 1" {{ $selectedCycle == 'Cycle 1' ? 'selected' : '' }}>Cycle 1</option>
                            <option value="Cycle 2" {{ $selectedCycle == 'Cycle 2' ? 'selected' : '' }}>Cycle 2</option>
                            <option value="Cycle 3" {{ $selectedCycle == 'Cycle 3' ? 'selected' : '' }}>Cycle 3</option>
                            <!-- Add more cycles as needed -->
                        </select>
                    </div>
                </div>
            </form>
            <div id="yieldPieChart"></div>
        </div>
    </div>
</div>
  </div>  

      </div>
    </div>
  </div> <!-- row -->
<div class="production" ></div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      var yieldData = @json($yieldData);  // This should be the data fetched based on filters

      // If no data is available, handle that case
      if (!yieldData || Object.keys(yieldData).length === 0) {
          document.querySelector("#yieldPieChart").innerHTML = "<p>No data available for the selected filters.</p>";
          return;
      }

      var districts = Object.keys(yieldData);
      var yieldValues = districts.map(district => yieldData[district]['yield'] || 0);

      var options = {
          chart: {
              type: 'pie',
              height: 350
          },
          series: yieldValues,
          labels: districts.map(d => d + ' District'),
          colors: ['#1E90FF', '#FF4500', '#32CD32', '#FFD700', '#8A2BE2', '#FF69B4'],
          legend: {
              position: "bottom",
          },
          dataLabels: {
              enabled: true,
              style: {
                  fontSize: '14px',
              },
          },
          tooltip: {
              y: {
                  formatter: function (val) {
                      return val + " kg/ha";
                  }
              }
          }
      }

      var apexPieChart = new ApexCharts(document.querySelector("#yieldPieChart"), options);
      apexPieChart.render();
  });
</script>
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

<!-- Bootstrap JS -->
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdn.jsdelivr.net/npm/@sgratzl/chartjs-chart-geo@latest"></script>



  <!-- Include Bootstrap Bundle with Popper -->
  {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
  <!-- Include Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>
  
{{-- <script>
 <?php
    // Fetch the data for manicahan from your database or any other source
    // $manicahanData = $totalfarm;
    ?>
document.addEventListener('DOMContentLoaded', function() {
  const districtDropdownItems = document.querySelectorAll('.dropdown-item');
  const districtNameElement = document.getElementById('districtName');
  const numberOfFarmersElement = document.getElementById('numberOfFarmers');
  const totalAreaPlantedElement = document.getElementById('totalAreaPlanted');
  const totalAreaYieldElement = document.getElementById('totalAreaYield');
  const totalCostElement = document.getElementById('totalCost');
  const avgYieldPerAreaElement = document.getElementById('avgYieldPerArea');
  const avgCostPerAreaElement = document.getElementById('avgCostPerArea');
  const seasonFarmersProductionElement = document.getElementById('seasonFarmersProduction');
  const tenurialStatusSelect = document.getElementById('tenurialStatus');
  const manicahan = <?php echo json_encode($manicahanData); ?>;
  const data = {
    'ayala': {
      all: {
        numberOfFarmers: manicahan,
        totalAreaPlanted: 500,
        totalAreaYield: 2000,
        totalCost: 10000,
        avgYieldPerArea: 4,
        avgCostPerArea: 20,
        seasonFarmersProduction: 'Spring'
      },
      owner: { /* specific data for owners */ },
      tenant: { /* specific data for tenants */ },
      tiller: { /* specific data for tillers */ },
      lease: { /* specific data for lease */ }
    },
    'tumaga': {
      all: {
        numberOfFarmers: manicahan,
        totalAreaPlanted: 56,
        totalAreaYield: 2000,
        totalCost: 10000,
        avgYieldPerArea: 4,
        avgCostPerArea: 20,
        seasonFarmersProduction: 'Spring'
      },
      owner: { /* specific data for owners */ },
      tenant: { /* specific data for tenants */ },
      tiller: { /* specific data for tillers */ },
      lease: { /* specific data for lease */ }
    },
    // ... other districts data
  };

  function updateModal(district, tenurialStatus) {
    const districtData = data[district];
    if (!districtData) {
      console.error(`No data available for ${district}`);
      return;
    }

    const tenurialData = districtData[tenurialStatus];
    if (!tenurialData) {
      console.error(`No tenurial status data available for ${tenurialStatus} in ${district}`);
      return;
    }

    districtNameElement.textContent = district;
    numberOfFarmersElement.textContent = `Number of Farmers: ${tenurialData.numberOfFarmers}`;
    totalAreaPlantedElement.textContent = `Total Area Planted: ${tenurialData.totalAreaPlanted}`;
    totalAreaYieldElement.textContent = `Total Area Yield (Kg/Ha): ${tenurialData.totalAreaYield}`;
    totalCostElement.textContent = `Total Cost: ${tenurialData.totalCost}`;
    avgYieldPerAreaElement.textContent = `Average Yield Per Area Planted (Kg/Ha): ${tenurialData.avgYieldPerArea}`;
    avgCostPerAreaElement.textContent = `Average Cost Per Area Planted (Ha): ${tenurialData.avgCostPerArea}`;
    seasonFarmersProductionElement.textContent = `Season Farmers Production: ${tenurialData.seasonFarmersProduction}`;
  }

  districtDropdownItems.forEach(item => {
    item.addEventListener('click', function() {
      const selectedDistrict = this.getAttribute('data-district');
      const selectedTenurialStatus = tenurialStatusSelect.value;
      updateModal(selectedDistrict, selectedTenurialStatus);
      const districtModal = new bootstrap.Modal(document.getElementById('districtModal'));
      districtModal.show();
    });
  });

  tenurialStatusSelect.addEventListener('change', function() {
    const selectedDistrict = document.getElementById('districtName').textContent;
    if (selectedDistrict) {
      updateModal(selectedDistrict, this.value);
    }
  });
});



</script> --}}
<script>
        document.addEventListener('DOMContentLoaded', function () {
            var data = @json($data);

            var districts = Object.keys(data);
            var inbrid = districts.map(district => data[district]['Inbrid']);
            var hybrid = districts.map(district => data[district]['Hybrid']);
            var notSpecified = districts.map(district => data[district]['Not specified']);

            var options = {
                chart: {
                    type: 'bar',
                    height: '318',
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false
                    },
                },
                theme: {
                    mode: 'light'
                },
                tooltip: {
                    theme: 'light'
                },
                colors: ['#28a745', '#17a2b8', '#ffc107'],
                fill: {
                    opacity: .9
                },
                grid: {
                    padding: {
                        bottom: -4
                    },
                    borderColor: '#dee2e6',
                    xaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                series: [
                    {
                        name: 'Inbrid',
                        data: inbrid
                    },
                    {
                        name: 'Hybrid',
                        data: hybrid
                    },
                    {
                        name: 'Not specified',
                        data: notSpecified
                    }
                ],
                xaxis: {
                    type: 'category',
                    categories: districts.map(d => d + ' District'),
                    axisBorder: {
                        color: '#28a745',
                    },
                    axisTicks: {
                        color: '#28a745',
                    },
                },
                yaxis: {
                    title: {
                        text: 'Number of Farms',
                        style: {
                            size: 9,
                            color: '#28a745'
                        }
                    },
                },
                legend: {
                    show: true,
                    position: "top",
                    horizontalAlign: 'center',
                    itemMargin: {
                        horizontal: 8,
                        vertical: 0
                    },
                },
                stroke: {
                    width: 0
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '10px',
                    },
                    offsetY: -27
                },
                plotOptions: {
                    bar: {
                        columnWidth: "50%",
                        borderRadius: 4,
                        dataLabels: {
                            position: 'top',
                            orientation: 'vertical',
                        }
                    },
                },
            }

            var apexBarChart = new ApexCharts(document.querySelector("#monthlySalesChart"), options);
            apexBarChart.render();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>




@endsection