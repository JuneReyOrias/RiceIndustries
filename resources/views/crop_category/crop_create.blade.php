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
       
          <form action{{url('crop_categorys')}} method="post">
            @csrf
            <div class="row mb-3">
              <div class="col-md-3 mb-3" >
                <label class="form-expand" >Category Name:</label>
                <select class="form-control placeholder-text @error('categorize_id') is-invalid @enderror" name="categorizes_id" id="selectseedVarie" onchange="checkseedVarie()" aria-label="label select e">
                  @foreach ($Cat as $Categorize)
                  <option value="{{ $Categorize->id }}">{{ $Categorize->cat_name }}</option>

                  @endforeach
                </select>
               
                @error('agri_districts_id')
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
                <label class="form-expand" for="crop_descript">Description:</label>
                <input type="text" class="form-control placeholder-text @error('crop_descript') is-invalid @enderror" name="crop_descript" id="validationCustom01" placeholder="Enter description" value="{{ old('cat_descript') }}" >
                @error('crop_descript')
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
        
          <h4 class="mb-3 mb-md-0">Crop Category</h4>
            <br>
       <p class="text-success">This page provides a clear overview of the personal data we have collected about you, including categories of information, purposes of collection, data usage, sharing practices, security measures, and options for data access and control. We are committed to transparency and safeguarding your privacy rights.</p><br>
         <div class="table-responsive tab ">
          <table class="table table-bordered datatable">
              <thead class="thead-light">
                  <tr >
                    <th>No.</th>
                      <th>CropCatID</th>
                      <th>CategoryID</th>
                      <th>Crop Name</th>
                      <th>Description</th>
                      <th>Created At</th>
                      <th>Updated</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @if($CropCat->count() > 0)
              @foreach($CropCat as $cropcat)
                  <tr class="table-light">
                       <td>{{ $loop->iteration }}</td>
                       <td>{{  $cropcat->id }}</td>
                      <td>{{  $cropcat->categorizes_id }}</td>
                      <td>{{  $cropcat->crop_name}}</td>
                      <td>{{  $cropcat->crop_descript }}</td>
                     
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
            {{ $CropCat->links() }}
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
 
  <!--end for Production Cost-->
  {{-- <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <h6 class="card-title">Import File</h6>
            <p class="text-muted mb-3">Import excel file, csv file or Msacces file only.</p>
            <div class="form-errors"></div>
            <form id="upload-form" method="post" enctype="multipart/form-data" onsubmit="saveForm(event)">
              @csrf
       
                <div class="form-group mb-3">
                  <label for=inputemail>Upload</label>
                  <input type="file" class ="form-control" id="myDropify" name="upload_file" aria-describedby="emailHelp">
                  <span class="text-danger input_image_err formErrors"></span>
              </div>
            <div class="form-group mb-2 text-center">
              <button type="submit" class="btn btn-primary me-2">Submit</button>
            </div>
             
            </form>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmz9ATKxIep9tiCx5/Z9fNEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
            </script>
            <script sr="https://cdn. jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
            integrity="sha384-7VPbUDkoPSGFnVtY10QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
            </script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

             <script>
              function saveForm(e){
                e.preventDefault();
                console.log($('#upload-form'));
                var uploadForm= $('upload-for,')(0);
                Var uploadFormData= new FormData(uploadForm);

                $.ajax({
                  method="Post",
                  url:"{{url('saveUploadForm')}}",
                  data:uploadFormData,
                  processData:false,
                  contentType:false,
                  success:function(response){
                    console.log(response);
                    $(#form-errors).html('');
                  },
                  error:function(response){

                  }
                })
              }
             </script> --}}
           
       
        </div>
      </div>
    </div>
  
  </div>

</div>@endsection
    
