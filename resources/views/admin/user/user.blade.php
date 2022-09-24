<div class="content">
   <div class="container-fluid">
      <!-- Page-Title -->
      <div class="row">
         <div class="col-sm-12">
            <h4 class="pull-left page-title">Manage Vendor</h4>
            <ol class="breadcrumb pull-right">
               <li><a href="{{ URL::to('home') }}">Home</a></li>
               <li class="active">Manage Vendor</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="m-b-30">
                           <button type="button" class="btn btn-primary waves-effect waves-light" onclick="addRecords()">Add <i class="md md-add-circle-outline"></i></button>
                        </div>
                     </div>
                  </div>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>Sr.No.</th>
                           <th>VendorName</th>
                           <th>Email</th>
                           <th>Phone</th>
                           <th>Image</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $userData = DB::table('users')->where('users_role', 2)->get(); ?>
                        @foreach($userData as $key => $data)
                        <tr class="gradeX">
                           <td>{{ $key+1 }}</td>
                           <td>{{ $data->name }}</td>
                           <td>{{ $data->email }}</td>
                           <td>{{ $data->phone }}</td>
                           <td>
                              @if($data->profile_image!='')
                              <img src="{{ asset('public/profile_image/').'/'.$data->profile_image }}" alt="profile image" height="50" width="50">
                              @else
                              <img src="{{ asset('public/no-image.jpg')}}" alt="profile image" height="50" width="50">
                              @endif
                           </td>
                           @if($data->status == 0)
                           <td>
                              <p class="mb-0">
                                 <span class="badge badge-success">Active</span>
                              </p>
                           </td>
                           @else
                           <td>
                              <p class="mb-0">
                                 <span class="badge badge-danger">Inactive</span>
                              </p>
                           </td>
                           @endif
                           <td class="actions">
                              <a href="{{ URL::to('user-edit',$data->id)}}" class="on-default edit-row" data-toggle="tooltip" data-modal="modal-12" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                              &nbsp;&nbsp;&nbsp;
                              <a href="{{ URL::to('user-view',$data->id)}}" class="on-default eye-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="fa fa-eye"></i></a>
                              &nbsp;&nbsp;&nbsp;
                              <a href="{{ URL::to('delete-user',$data->id)}}" class="on-default remove-row" onclick="return confirm('Are you sure you want to delete this item?');" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <!-- end card-body -->
            </div>
         </div>
         <!-- container -->
      </div>
   </div>
</div>
<!-- content -->

<!--- MODEL CALL--->
<div id="unique-model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title mt-0">Vendor Define</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{ url('add-user') }}" method="POST" id="FormValidation" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="ids" id="ids">
            <div class="modal-body">
               <div class="row">

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="field-1" class="control-label">Name: <font color="red">*</font></label>
                        <input type="text" id="name" name="name" class="form-control" required="" aria-required="true" title="name">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="field-1" class="control-label">Email: <font color="red">*</font></label>
                        <input type="email" id="email" name="email" class="form-control" required="" aria-required="true" title="email" onchange="email_check()">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="field-1" class="control-label">Phone: <font color="red">*</font></label>
                        <input type="text" id="phone" name="phone" class="form-control" required="" aria-required="true" autocomplete="off" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="10" title="phone">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="field-1" class="control-label">Password: <font color="red">*</font></label>
                        <input type="password" id="password" name="password" class="form-control" required="" aria-required="true" pattern=".{8,12}" title="8 to 12 characters">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="field-1" class="control-label">Profile image: <span style="color: red;">*</span></label>
                        <input type="file" id="image" name="image" class="form-control" required="" aria-required="true" accept="image/*">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <p class="control-label"><b>Status</b>
                           <font color="red">*</font>
                        </p>
                        <div class="radio radio-info form-check-inline">
                           <input type="radio" id="active" value="0" name="status" checked="">
                           <label for="inlineRadio1"> Active </label>
                        </div>
                        <div class="radio radio-info form-check-inline">
                           <input type="radio" id="inactive" value="1" name="status">
                           <label for="inlineRadio1"> Inactive </label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
               <button type="submit" id="submitbtn" class="btn btn-primary">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- /.modal eND -->

<script type="text/javascript">
   function editRecords(id) {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

      $.ajax({
         url: "{{url('user-edit/')}}" + '/' + id,
         method: "POST",
         contentType: 'application/json',
         success: function(data) {
            document.getElementById("ids").value = data.id;
            document.getElementById("name").value = data.name;
            document.getElementById("email").value = data.email;
            document.getElementById("phone").value = data.phone;
            var val = data.status;
            if (val == 1) {
               $('input[name=status][value=' + val + ']').prop('checked', true);
            } else {
               $('input[name=status][value=' + val + ']').prop('checked', true);
            }
            document.getElementById("submitbtn").innerText = 'UPDATE';
            $('#unique-model').modal('show');
         }
      });
   }

   function addRecords() {
      document.getElementById("FormValidation").reset();
      document.getElementById("submitbtn").innerText = 'Save';
      $('#unique-model').modal('show');
   }

   function viewRecords(id) {

      $.ajaxSetup({

         headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

         }

      });

      $.ajax({

         url: "{{url('unique/edit/')}}" + '/' + id,

         method: "POST",

         contentType: 'application/json',

         success: function(data) {
            document.getElementById("job_id").value = data.job_id;
            document.getElementById("v_emp_id").innerText = data.emp_id;
            document.getElementById("v_reg_no").innerHTML = data.reg_no;
            $('#unique-view-model').modal('show');
         }
      });

   }
</script>

<script type="text/javascript">
   function email_check() {
      var y = $('#email').val();
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      $.ajax({
         url: "{{url('useremail/')}}" + '/' + y,
         method: "POST",
         contentType: 'application/json',
         success: function(data) {
            if (data) {
               //alert('Email already registered');

               $("#email").val('');
               $("#email").focus();
            } else {
               return true;
            }
         }
      });
   }
</script>