<style type="text/css">
   .colerclass{
      color: #317eeb;
   }
   .menustyle{
      margin: 10px;
   }
</style>
<!-- Start content -->
<div class="content">
   <div class="container-fluid">
      <!-- Page-Title -->
      <div class="row">
         <div class="col-sm-12">
            <h4 class="pull-left page-title">Edit Vendor</h4>
            <ol class="breadcrumb pull-right">
               <li><a href="{{ URL::to('home') }}">Home</a></li>
               <li class="active">Edit Vendor</li>
            </ol>
         </div>
      </div>
      <form  action="{{ URL::to('add-user')}}" method="POST" id="FormValidation" enctype="multipart/form-data">
         @csrf
         <div class="row" id="example-basic">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="m-b-30">
                              <button type="button" class="btn btn-primary waves-effect waves-light" onclick="window.history.go(-1); return false;"><i class="fa fa-arrow-left"></i>  Go Back </button>
                           </div>
                        </div>
                     </div>
                     <div class="row" style="text-align: center;">
                        <div class="col-md-12">
                           <div class="form-group"> 
                             <img src="{{ URL::asset('/public/profile_image/') }}/{{ $editdata->profile_image }}" class="thumb-lg rounded-circle img-thumbnail" alt="profile-image">
                             <a href="#" onclick="update_profile_image({{ $editdata->id }})">Edit</a>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <input type="hidden" name="ids" id="ids" value="{{ $editdata->id ?? '' }}">
                        <div class="col-md-6">
                           <div class="form-group">  
                              <label class="control-label">User name : <font color="red">*</font></label>
                              <input  type="text" id="name" name="name" class="form-control" required="" value="{{ $editdata->name ?? '' }}" aria-required="true" placeholder="" autocomplete="off"> 
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">  
                              <label class="control-label">User email : <font color="red">*</font></label>
                              <input  type="email" id="email" name="email" class="form-control" required="" value="{{ $editdata->email ?? ''}}" aria-required="true"> 
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">  
                              <label class="control-label">User phone : <font color="red">*</font></label>
                              <input  type="text" id="phone" name="phone" class="form-control" required="" value="{{ $editdata->phone ?? ''}}" aria-required="true" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="10" title="phone"> 
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <p class="control-label"><b>Status : </b> <font color="red">*</font></p>
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

                        <div class="col-md-6">
                           <div class="form-group">  
                             <a href="#" class="btn btn-primary" onclick="update_user_password({{$editdata->id}})">Password Change</a>
                           </div>                        
                        </div>
                     </div>
                       
                  <div class="modal-footer">
                     <button type="submit" id="submitbtn" class="btn btn-primary">Update</button>
                  </div>
               </div><!-- End card-body -->
            </div> <!-- End card -->
         </form><!-- Form End -->
      </div><!-- container -->
   </div>

<!--- MODEL CALL For Profile image edit --->
<div id="unique-model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title mt-0">Update Profile Image</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form  action="{{ url('update-user-profile-image') }}" method="POST" id="FormValidation" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="ids" id="userid" />
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <p class="control-label"><b>Image:</b> <font color="red">*</font></p>
                        <input  type="file" id="image" name="image" class="form-control" required="" aria-required="true" accept="image/x-png,image/gif,image/jpeg"> 
                     </div>
                  </div> 
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" id="submitbtn" class="btn btn-primary">Update</button> 
               <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button> 
            </div>
         </form>
      </div>
   </div>
</div>
<!-- /.modal eND -->
<!--- MODEL CALL For User password edit --->
<div id="unique-model-password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title mt-0">Update Password</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form  action="{{ url('update-user-new-password') }}" method="POST" id="FormValidation" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="ids" id="userpasswordid" />
             <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <p class="control-label"><b>New password :</b> <font color="red">*</font></p>
                        <input type="password" id="new_password" name="password" class="form-control" required="" aria-required="true">
                        <input type="checkbox" onclick="myFunction2()"> Show Password 
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <p class="control-label"><b>Confirm password :</b> <font color="red">*</font></p>
                        <input type="password" id="password" name="password" class="form-control" required="" aria-required="true">
                        <input type="checkbox" onclick="myFunction3()"> Show Confirm Password 
                     </div>
                  </div>                
               </div>
            </div>
            <div class="modal-footer"> 
               <button type="submit" onclick="check_password()" id="submitbtn" class="btn btn-primary">Update</button>
               <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>                
            </div>
         </form>
      </div>
   </div>
</div>
<!-- /Modal End -->
<!-- Script for image update -->
<script type="text/javascript">
   function update_profile_image(id){
       $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
   
      $.ajax({   
         url:"{{url('update-profile-image/')}}"+'/'+id,
         method:"POST", 
         contentType : 'application/json',
         success: function( data ) 
         {
            console.log(data);
            document.getElementById("userid").value = data.id;  
            $('#unique-model').modal('show'); 
         }
      });
   }
</script>

<!-- Script for update user password -->
<script type="text/javascript">
  function update_user_password(id){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });
   
    $.ajax({   
       url:"{{url('update-user-password/')}}"+'/'+id,
       method:"POST", 
       contentType : 'application/json',
       success: function( data ) 
       {
          console.log(data);
          document.getElementById("userpasswordid").value = data.id;  
          $('#unique-model-password').modal('show'); 
       }
    });
  }
</script>

<!-- Password & Confirm passeword mach script -->
<script type="text/javascript">
   function myFunction2() {
     var x = document.getElementById("new_password");
     if (x.type === "password") {
       x.type = "text";
     } else {
       x.type = "password";
     }
   }
</script>
<script type="text/javascript">
   function myFunction3() {
     var x = document.getElementById("password");
     if (x.type === "password") {
       x.type = "text";
     } else {
       x.type = "password";
     }
   }
</script>

<!-- Password & Confirm passeword mach script -->
<script type="text/javascript">
  function check_password()
  {
    if($('#new_password').val() != $('#password').val()) {
      alert("Password and Confirm Password don't match");
      event.preventDefault();

      $("#password").val('');    
      $("#password").focus();
      return false;
    }  
  }
</script>