<!-- Start content -->
<div class="content">
   <div class="container-fluid">
      <div class="wraper">
         <div class="row">
            <div class="col-sm-12">
               <div class="bg-picture text-center" style="background-image:url('{{ asset('public/assets/images/big/bg.jpg') }}')">
                  <div class="bg-picture-overlay"></div>
                  <div class="profile-info-name">
                     <img src="{{ URL::asset('/public/profile_image/') }}/{{ $companydata->profile_image }}" class="thumb-lg rounded-circle img-thumbnail" alt="profile-image">
                     <a href="#" onclick="update_profile_image({{ $companydata->id }})">Edit</a>
                     <h3 class="text-white">{{ $companydata->first_name ?? '' }} {{ $companydata->last_name ?? '' }}</h3>
                  </div>
               </div>
               <!--/ meta -->
            </div>
         </div>

         <div class="row">
            <div class="col-lg-6">
               <div class="tab-content profile-tab-content">

                  <div class="" id="" aria-labelledby="">
                     <!-- Personal-Information -->
                     <div class="card card-default card-fill">
                        <div class="card-header">
                           <h3 class="card-title">Edit Profile</h3>
                        </div>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="card-body">
                           <form action="{{'edit-userprofile'}}" method="POST" id="FormValidation" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="u_ids" value='{{Auth::user()->id ?? ""}}'>
                              <input type="hidden" name="c_ids" value='{{$companydata->id ?? ""}}'>
                              <div class="form-group">
                                 <label for="FullName">Name</label>
                                 <input type="text" name="name" id="name" value="{{ $companydata->name ?? '' }} " id="Name" required="" aria-required="true" class="form-control">
                              </div>
                              <div class="form-group">
                                 <label for="Email">Email</label>
                                 <input type="email" name="email" value="{{ $companydata->email ?? '' }} {{ $companydata->last_name ?? '' }}" id="Email" class="form-control" required="" aria-required="true" readonly="">
                              </div>
                              <button class="btn btn-primary waves-effect waves-light w-md pull-right" type="submit">Update Profile</button>
                           </form>
                        </div>
                     </div>
                     <!-- Personal-Information -->
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="tab-content profile-tab-content">

                  <div class="" id="" aria-labelledby="">
                     <!-- Personal-Information -->
                     <div class="card card-default card-fill">
                        <div class="card-header">
                           <h3 class="card-title">Change Password</h3>
                        </div>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="card-body">
                           <form action="{{'edit-userprofile'}}" method="POST" id="FormValidation" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="u_ids" value='{{Auth::user()->id ?? ""}}'>
                              <input type="hidden" name="c_ids" value='{{$companydata->id ?? ""}}'>
                              <div class="form-group">
                                 <label for="Password">Current Password</label>
                                 <input type="password" name="password" placeholder="" id="password" class="form-control" required="" value="" aria-required="true" autocomplete="off">
                                 @error('password')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label for="RePassword">New Password</label>
                                 <input type="password" name="new_password" placeholder="" id="new_password" class="form-control" required="" aria-required="true">
                                 @error('password')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                              <button class="btn btn-primary waves-effect waves-light w-md pull-right" type="submit">Change Password</button>
                           </form>
                        </div>
                     </div>
                     <!-- Personal-Information -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- container-fluid -->
   </div>
   <!-- content -->
</div>

<!--- MODEL CALL--->
<div id="unique-model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title mt-0">Update Profile Image</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{ url('update-user-profile-image') }}" method="POST" id="FormValidation" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="ids" id="ids">
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <p class="control-label"><b>Image:</b>
                           <font color="red">*</font>
                        </p>
                        <input type="file" id="image" name="image" class="form-control" required="" aria-required="true" accept="image/x-png,image/gif,image/jpeg">
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

<script type="text/javascript">
   $('#name').on('keypress', function(event) {
      var regex = new RegExp("^[a-zA-Z0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
      if (!regex.test(key)) {
         event.preventDefault();
         return false;
      }
   });
</script>

<script type="text/javascript">
   function update_profile_image(id) {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

      $.ajax({
         url: "{{url('update-profile-image/')}}" + '/' + id,
         method: "POST",
         contentType: 'application/json',
         success: function(data) {
            $('#unique-model').modal('show');
            document.getElementById("ids").value = data.id;
         }
      });
   }
</script>