 {{-- <!-- boostrap company model -->
 <div class="modal fade" id="company-modal" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content"style=" background-image: url(https://watchmendailyjournal.com/wp-content/uploads/2023/04/da.jpg);">
      <div class="modal-header">
        <h4 class="modal-title" id="CompanyModal"></h4>
      </div>
      <div class="modal-body">
        <div class="main_div">
          <div class="title">Sign Up Form</div>
         
          <form class="forms-sample " method="post" action="{{ route('register') }}">
            @csrf
          <div class="mb-3">
            <label for="exampleInputUsername1" class="form-label">Name</label>
            <input type="text" class="form-control" id="exampleInputUsername1" name ="name"autocomplete="name" placeholder="name" required>
          </div>
          <div class="mb-3">
            <label for="userEmail" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="userEmail" placeholder="Email"required>
          </div>
          <div class="mb-3">
            <label for="agri_district" class="form-label">Agri District</label>
            <input type="text" name="agri_district" class="form-control" id="userEmail" placeholder="Agri_District">
          </div>
          <div class="mb-3">
            <label for="userPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="userPassword" autocomplete="current-password" placeholder="Password">
          </div>
          <div class="mb-3">
            <label for="userPassword" class="form-label">confirm Password</label>
            <input type="password" name="password" class="form-control" id="userPassword" autocomplete="current-password" placeholder="Confirm Password">
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <input type="text" name="role" class="form-control" id="userEmail" placeholder="Role">
          </div>
          <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="authCheck">
            <label class="form-check-label" for="authCheck">
              Remember me
            </label>
          </div>
          <div>
            <button type="submit"  class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                Sign up
              </button>
          </div>
          <a href={{url('/home')}} class="d-block mt-3 text-muted">have already account? Log in</a>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>

</div>
</div>
</div>
      <div class="modal-footer">
         
      </div>
    </div>
  </div>
</div>
<!-- end bootstrap model -->

</body>
<script type="text/javascript">
  
$(document).ready( function () {

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$('#ajax-crud-datatable').DataTable({
       processing: true,
       serverSide: true,
       ajax: "{{ url('ajax-crud-datatable') }}",
       columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'address', name: 'address' },
                { data: 'created_at', name: 'created_at' },
                {data: 'action', name: 'action', orderable: false},
             ],
             order: [[0, 'desc']]
   });

});

function add(){

   $('#CompanyForm').trigger("reset");
   $('#CompanyModal').html("Web AgriMap");
   $('#company-modal').modal('show');
   $('#id').val('');

}   
function editFunc(id){
 
$.ajax({
    type:"POST",
    url: "{{ url('edit-company') }}",
    data: { id: id },
    dataType: 'json',
    success: function(res){
      $('#CompanyModal').html("Edit Company");
      $('#company-modal').modal('show');
      $('#id').val(res.id);
      $('#name').val(res.name);
      $('#address').val(res.address);
      $('#email').val(res.email);
   }
});
}  

function deleteFunc(id){
    if (confirm("Delete Record?") == true) {
    var id = id;
      
      // ajax
      $.ajax({
          type:"POST",
          url: "{{ url('delete-company') }}",
          data: { id: id },
          dataType: 'json',
          success: function(res){

            var oTable = $('#ajax-crud-datatable').dataTable();
            oTable.fnDraw(false);
         }
      });
   }
}

$('#CompanyForm').submit(function(e) {

 e.preventDefault();

 var formData = new FormData(this);

 $.ajax({
    type:'POST',
    url: "{{ url('store')}}",
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
    success: (data) => {
      $("#company-modal").modal('hide');
      var oTable = $('#ajax-crud-datatable').dataTable();
      oTable.fnDraw(false);
      $("#btn-save").html('Submit');
      $("#btn-save"). attr("disabled", false);
    },
    error: function(data){
       console.log(data);
     }
   });
});

</script>
</html> --}}