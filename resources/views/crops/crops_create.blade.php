@extends('admin.dashb')
@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')
{{-- @extends('agent.agent_Dashboard')
@section('agent')  --}}
{{-- @extends('agent.agent_Dashboard') --}}

{{-- @section('agent') --}}

<div class="page-content">

  <nav class="page-breadcrumb">

  </nav>
  
  {{-- <div class="progress mb-3">
    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">15% Complete</div>

  </div> --}}
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card border rounded">
        @if($errors->any())
        <ul class="alert alert-warning">
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
        @endif
      
          <div class="card-body">
          
          <h6 class="card-title"><span>I.</span>Create Crop Category</h6>

          <br>
       <br>
          <form action{{url('crops')}} method="post">
            @csrf
            <div class="row mb-3">
              <div class="col-md-3 mb-3" >
                <label class="form-expand" >Crop Category Name:</label>
                <select class="form-control placeholder-text @error('crop_categorys_id') is-invalid @enderror" name="crop_categorys_id" id="selectseedVarie" onchange="checkseedVarie()" aria-label="label select e">
                  @foreach ($CropCat as $Categorize)
                  <option value="{{ $Categorize->id }}">{{ $Categorize->crop_name }}</option>

                  @endforeach
                </select>
               
                @error('crop_categorys_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="crop_name">Crop Name:</label>
                <input type="text" class="form-control placeholder-text @error('crop_name') is-invalid @enderror" name="crop_name" id="validationCustom01" placeholder="Enter crop name" value="{{ old('crop_name') }}" >
                @error('crop_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="crop_variety">Crop Variety Name:</label>
                <input type="text" class="form-control placeholder-text @error('crop_variety') is-invalid @enderror" name="crop_variety" id="validationCustom01" placeholder="Enter crop variety name" value="{{ old('crop_variety') }}" >
                @error('crop_variety')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="validationCustom02" style="font-size: 12px;">Crop Planting Season:</label>
                <input class="form-control placeholder-text @error('crop_planting_season') is-invalid @enderror"
                       name="crop_planting_season" id="datepicker" placeholder="crop planting season"
                       value="{{ old('crop_planting_season') }}" data-input='true'>
                @error('crop_planting_season')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="validationCustom02" style="font-size: 12px;">Crop Harvesting Season:</label>
                <input class="form-control placeholder-text @error('crop_harvesting_season') is-invalid @enderror"
                       name="crop_harvesting_season" id="datepicker" placeholder="crop Harvesting Season"
                       value="{{ old('crop_harvesting_season') }}" data-input='true'>
                @error('crop_harvesting_season')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="crop_type_soil">Crop Type Soil:</label>
                <input type="text" class="form-control placeholder-text @error('crop_type_soil') is-invalid @enderror" name="crop_type_soil" id="validationCustom01" placeholder="Enter type of soil" value="{{ old('crop_type_soil') }}" >
                @error('crop_type_soil')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-expand" for="crop_description">Description:</label>
                <input type="text" class="form-control placeholder-text @error('crop_description') is-invalid @enderror" name="crop_description" id="validationCustom01" placeholder="Enter description" value="{{ old('cat_descript') }}" >
                @error('crop_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
            

              </div>

<div  class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button  type="submit" class="btn btn-success me-md-2">Submit</button></a></p>
</div>
          </form>
        
          
        </div>
      </div>
    </div>
  </div>
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
        
          <h4 class="mb-3 mb-md-0">Crop</h4>
            <br>
       <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
         <div class="table-responsive tab ">
          <table class="table table-bordered datatable">
              <thead class="thead-light">
                  <tr >
                    <th>No.</th>
                      <th>CropID</th>
                      <th>Crop CategoryID</th>
                      <th>Crop Name</th>
                      <th>Crop Variety Name</th>
                      <th>Crop Planting Season</th> 
                       <th>Crop Harvest Season</th>
                       <th>Crop Type of Soil</th>
                      <th>Description</th>
                      <th>Created At</th>
                      <th>Updated</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @if($Crop->count() > 0)
              @foreach($Crop as $cropcat)
                  <tr class="table-light">
                       <td>{{ $loop->iteration }}</td>
                       <td>{{  $cropcat->id }}</td>
                      <td>{{  $cropcat->crop_categorys_id }}</td>
                      <td>{{  $cropcat->crop_name}}</td>
                      <td>{{  $cropcat->crop_variety }}</td>
                      <td>{{  $cropcat->crop_planting_season}}</td>
                      <td>{{  $cropcat->crop_harvesting_season }}</td>
                      <td>{{  $cropcat->crop_type_soil }}</td>
                      <td>{{  $cropcat->crop_description }}</td>
                      <td>{{ $cropcat->created_at}}</td>
                      <td>{{ $cropcat->updated_at}}</td>
                      <td>
{{--                          
                           <a href="{{route('parcels.edit',  $categorize->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> 
              
                           <form  action="{{ route('parcels.delete',  $categorize->id) }}"method="post" accept-charset="UTF-8" style="display:inline">
                              {{ csrf_field()}}
                              <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                          </form> --}}
                         
                      </td>
                  </tr>
              @endforeach
              @else
              <tr>
                  <td class="text-center" colspan="5">Crop Category not found</td>
              </tr>
          @endif
              </tbody>
          </table>
      </div>

 
        </div>
              <!-- Pagination links -->
    <div class="row"style="align-content: center;display: flex;
    align-items: center; align-self: center">
        <div class="col-md-7" style="align-content: center;display: flex;
        align-items: center;">
            {{ $Crop->links() }}
        </div>
    </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

</div>
</div>
 
 
       
        </div>
      </div>
    </div>
  
  </div>

</div>
<script>
 document.addEventListener('DOMContentLoaded', function () {
  flatpickr("#datepicker", {
      dateFormat: "Y-m-d", // Date format (YYYY-MM-DD)
      // Additional options can be added here
  });
});</script>
@endsection
    

