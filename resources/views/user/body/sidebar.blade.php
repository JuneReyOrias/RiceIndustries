<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
     Zambo<span>Agrimap</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item">
        <a href="{{route('user.user_dash')}}" class="nav-link">
          <img src="../assets/logo/layout.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
          <span class="link-title"style=",margin-left:12px;">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Agri-Map</li>
     
    {{-- <li class="nav-item">
      <a href="{{route('map.arcmap')}}" class="nav-link"> 
          <i class="link-icon" data-feather="map"></i>
          <span class="link-title">ZamboAgriMap</span>
        </a>
      </li>  --}}
     
   
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#crop" role="button" aria-expanded="false" aria-controls="uiComponents">
          <img src="../assets/logo/wheat.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">

          <span class="link-title" style=" margin-left: 12px;"> Crop</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="crop">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('map.agrimap')}}" class="nav-link">Rice</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Corn</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Coconut</a>
            </li>
           
            
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#livestocks" role="button" aria-expanded="false" aria-controls="uiComponents">
          <img src="../assets/logo/livestock.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
          <span class="link-title"style="margin-left:12px;"> Livestock</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="livestocks">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="" class="nav-link">Chicken</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Hogs</a>
            </li>
           
            
          </ul>
        </div>
      </li>
      {{-- <li class="nav-item nav-category">Components</li> --}}
      <li class="nav-item nav-category">Crops</li>

      {{-- rice --}}
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#croprice" role="button" aria-expanded="false" aria-controls="croprice">
          <img src="../assets/logo/rice.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">

          <span class="link-title"style="margin-left:12px;">Rice</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="croprice">
          <a class="nav-link" data-bs-toggle="collapse" href="#report" role="button" aria-expanded="false" aria-controls="report">
            <img src="../assets/logo/report.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">

            <span class="link-title"style="margin-left:12px;">Reports/Agri-Districts</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="report">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('user.agriFarmers.ayala_farmers')}}" class="nav-link">Ayala Rice Farmers</a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.agriFarmers.tumaga_farmers')}}" class="nav-link">Tumaga Rice Farmers</a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.agriFarmers.culianan_farmers')}}" class="nav-link">Culianan Rice Farmers</a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.agriFarmers.manicahan_farmers')}}" class="nav-link">Manicahan Rice Farmers</a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.agriFarmers.curuan_farmers')}}" class="nav-link">Curuan Rice Farmers</a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.agriFarmers.vitali_farmers')}}" class="nav-link">Vitali Rice Farmers</a>
              </li>
            </ul>
          </div>
       
        
          <a class="nav-link" data-bs-toggle="collapse" href="#charts" role="button" aria-expanded="false" aria-controls="charts">
            <i class="link-icon" data-feather="slack"></i>
            <span class="link-title">Rice Varieties</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="charts">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('user.RiceVariety.inbred_hybrid')}}" class="nav-link">Rice Varieties/District</a>
              </li>
            </ul>
          </div>

          <a class="nav-link" data-bs-toggle="collapse" href="#Ricecharts" role="button" aria-expanded="false" aria-controls="charts">
            <img src="../assets/logo/graph.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
            <span class="link-title"style="margin-left:12px;">Rice Crop Production</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="Ricecharts">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('user.cropProduction.rice_crop')}}" class="nav-link">RiceField</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">Upland Rice</a>
              </li>
            </ul>
          </div>
        </div>
      </li>
      
     {{-- corn --}}
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#Corn" role="button" aria-expanded="false" aria-controls="Corn">
          <img src="../assets/logo/corn.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
          <span class="link-title" style="margin-left:12px;">Corn</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="Corn">
          <a class="nav-link" data-bs-toggle="collapse" href="#reports" role="button" aria-expanded="false" aria-controls="report">
            <img src="../assets/logo/report.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
            <span class="link-title"style="margin-left:12px;">Reports/Agri-Districts</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="reports">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="" class="nav-link">Ayala Corn Farmers</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">Tumaga Corn Farmers</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">Culianan Corn Farmers</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">Manicahan Corn Farmers</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">Curuan Corn Farmers</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">Vitali Corn Farmers</a>
              </li>
            </ul>
          </div>
        
         
          <a class="nav-link" data-bs-toggle="collapse" href="#chart" role="button" aria-expanded="false" aria-controls="charts">
            <i class="link-icon" data-feather="slack"></i>
            <span class="link-title">Corn Varieties</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="chart">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="" class="nav-link">Corn Varieties/District</a>
              </li>
            </ul>
          </div>

          <a class="nav-link" data-bs-toggle="collapse" href="#corncharts" role="button" aria-expanded="false" aria-controls="charts">
            <img src="../assets/logo/graph.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
            <span class="link-title"style="margin-left:12px;">Corn Crop Production</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="corncharts">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="" class="nav-link">CornField</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">Upland Corn</a>
              </li>
            </ul>
          </div>
        </div>
      </li>
      
       {{-- coconut --}}
       <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#Coconut" role="button" aria-expanded="false" aria-controls="Coconut">
          <img src="../assets/logo/coconut.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
          <span class="link-title"style="margin-left:12px;">Coconut</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="Coconut">
          <a class="nav-link" data-bs-toggle="collapse" href="#reportscoco" role="button" aria-expanded="false" aria-controls="report">
            <img src="../assets/logo/report.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
            <span class="link-title"style="margin-left:12px;">Reports/Agri-Districts</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="reportscoco">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="" class="nav-link">Ayala Coconut Farmers</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">Tumaga Coconut Farmers</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">Culianan Coconut Farmers</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">Manicahan Coconut Farmers</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">Curuan Coconut Farmers</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">Vitali Coconut Farmers</a>
              </li>
            </ul>
          </div>
    
          <a class="nav-link" data-bs-toggle="collapse" href="#chartcoco" role="button" aria-expanded="false" aria-controls="charts">
            <i class="link-icon" data-feather="slack"></i>
            <span class="link-title">Coconut Varieties</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="chartcoco">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="" class="nav-link">Coconut Varieties/District</a>
              </li>
            </ul>
          </div>

          <a class="nav-link" data-bs-toggle="collapse" href="#corncharts" role="button" aria-expanded="false" aria-controls="charts">
            <img src="../assets/logo/graph.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
            <span class="link-title"style="margin-left:12px;">Coconut Production</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="corncharts">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="" class="nav-link">Coconut</a>
              </li>
              {{-- <li class="nav-item">
                <a href="{{route('admin.rice_varieties.rice_varietydistrict')}}" class="nav-link">Upland Corn</a>
              </li> --}}
            </ul>
          </div>
        </div>
      </li>

    {{--  livestock  --}}
    <li class="nav-item nav-category">Livestock</li>

    {{-- chicken --}}
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#chicken" role="button" aria-expanded="false" aria-controls="chicken">
        <img src="../assets/logo/chicken.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
        <span class="link-title"style="margin-left:12px;">Chicken</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
      </a>
      <div class="collapse" id="chicken">
        <a class="nav-link" data-bs-toggle="collapse" href="#report" role="button" aria-expanded="false" aria-controls="report">
          <img src="../assets/logo/report.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
          <span class="link-title"style="margin-left:12px;">Reports/Agri-Districts</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="report">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="" class="nav-link">Ayala Chicken Farmers</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Tumaga Chicken Farmers</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Culianan Chicken Farmers</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Manicahan Chicken Farmers</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Curuan Chicken Farmers</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Vitali Chicken Farmers</a>
            </li>
          </ul>
        </div>
        
        
      

        <a class="nav-link" data-bs-toggle="collapse" href="#Ricecharts" role="button" aria-expanded="false" aria-controls="charts">
          <img src="../assets/logo/graph.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
          <span class="link-title"style="margin-left:12px;">Chicken Production</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="Ricecharts">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="" class="nav-link">Chicken</a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{route('admin.crop_production.rice_crops')}}" class="nav-link">Upland Rice</a>
            </li> --}}
          </ul>
        </div>
      </div>
    </li>
    
   {{-- hog --}}
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#Hogs" role="button" aria-expanded="false" aria-controls="Hogs">
        <img src="../assets/logo/pig.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
        <span class="link-title"style="margin-left:12px;">Hogs</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
      </a>
      <div class="collapse" id="Hogs">
        <a class="nav-link" data-bs-toggle="collapse" href="#reportshog" role="button" aria-expanded="false" aria-controls="report">
          <img src="../assets/logo/report.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
          <span class="link-title"style="margin-left:12px;">Reports/Agri-Districts</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="reportshog">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="" class="nav-link">Ayala hog Farmers</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Tumaga hog Farmers</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Culianan hog Farmers</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Manicahan hog Farmers</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Curuan hog Farmers</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Vitali hog Farmers</a>
            </li>
          </ul>
        </div>
      
      
        <a class="nav-link" data-bs-toggle="collapse" href="#hogcharts" role="button" aria-expanded="false" aria-controls="charts">
          <img src="../assets/logo/graph.png" alt="Crop Icon" style="width: 20px; height: 20px; color: white;">
          <span class="link-title"style="margin-left:12px;">hog Production</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="corncharts">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('admin.rice_varieties.rice_varietydistrict')}}" class="nav-link">hogs</a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{route('admin.rice_varieties.rice_varietydistrict')}}" class="nav-link">Upland Corn</a>
            </li> --}}
          </ul>
        </div>
      </div>
    </li>
    

      
 

    </ul>
  </div>
</nav>
<script>
  $(document).ready(function() {
    $('#croprice .collapse').on('shown.bs.collapse', function () {
    $(this).prev('.nav-link').addClass('active');
    }).on('hidden.bs.collapse', function () {
    $(this).prev('.nav-link').removeClass('active');
    });
  
    $('#croprice').on('shown.bs.collapse', function () {
    // Prevent adding active class to the "Rice" link
    $('a[href="#croprice"]').removeClass('active');
    });
  });
  </script>

<script>
$(document).ready(function() {
  $('#chicken .collapse').on('shown.bs.collapse', function () {
  $(this).prev('.nav-link').addClass('active');
  }).on('hidden.bs.collapse', function () {
  $(this).prev('.nav-link').removeClass('active');
  });

  $('#chicken').on('shown.bs.collapse', function () {
  // Prevent adding active class to the "Rice" link
  $('a[href="#chicken"]').removeClass('active');
  });
});
</script>