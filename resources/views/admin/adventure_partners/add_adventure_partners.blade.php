<style type="text/css">
   .colerclass {
      color: #317eeb;
   }

   .menustyle {
      margin: 10px;
   }
</style>
<div class="content add_partner">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <h4 class="pull-left page-title"><a href="{{URL::to('list-adventure-partners')}}">Partners</a> > Add New Partner</h4>
         </div>
      </div>
      <?php
      if (!empty($editData)) {
      ?>
         <input type="hidden" name="edit_id" value="{{ $editData->id }}">
      <?php } ?>
      <form action="{{ URL::to('add-adventure-partner') }}" method="POST" id="FormValidation" enctype="multipart/form-data">
         @csrf
         <div class="row" id="example-basic">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <!--    <div class="col-md-12">
                           <h5>Add New Partner</h5>
                        </div>
                        
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php
                              $name = '';
                              if (request('name')) {
                                 $name = request('name');
                              } elseif (!empty($user_detail) && (request('name') == '')) {
                                 $name = $user_detail->name;
                              }
                              ?>
                              <input type="text" id="name" name="name" class="form-control" aria-required="true" value="{{$name}}" placeholder="User Name">
                              <?php if (isset($validation['name'])) { ?>
                                 <label class="error">{{ $validation['name'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php
                              $email = '';
                              if (request('email')) {
                                 $email = request('email');
                              } elseif (!empty($user_detail) && (request('email') == '')) {
                                 $email = $user_detail->email;
                              }
                              ?>
                              <input type="text" id="email" name="email" class="form-control" value="{{$email}}" aria-required="true" placeholder="Email Address">
                              <?php if (isset($validation['email'])) { ?>
                                 <label class="error">{{ $validation['email'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php
                              $country = '';
                              if (request('country')) {
                                 $country = request('country');
                              } elseif (!empty($user_detail) && (request('country') == '')) {
                                 $country = $user_detail['country'];
                              }
                              ?>

                              <select class="form-control" id="country" name="country">
                                 <option value="">Select Country</option>
                                 <?php
                                 $countries = DB::table('countries')->where(['deleted_at' => NULL])->get();
                                 foreach ($countries as $value) { ?>
                                    <option value="{{ $value->id }}" {{ $country ==  $value->id  ? 'selected' : ''}}>{{ $value->country }}</option>
                                 <?php } ?>
                              </select>
                              <?php if (isset($validation['country'])) { ?>
                                 <label class="error">{{ $validation['country'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php
                              $region = '';
                              if (request('region')) {
                                 $region = request('region');
                              } elseif (!empty($user_detail) && (request('region') == '')) {
                                 $region = $user_detail['region'];
                              }
                              ?>
                              <?php $region = DB::table('regions')->get(); ?>
                              <select class="form-control" id="region" name="region">

                              </select>
                              <?php if (isset($validation['region'])) { ?>
                                 <label class="error">{{ $validation['region'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="row">
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <?php
                                    $mobile_code = '';
                                    if (request('mobile_code')) {
                                       $mobile_code = request('mobile_code');
                                    } elseif (!empty($user_detail) && (request('mobile_code') == '')) {
                                       $mobile_code = $user_detail->country_id;
                                    }
                                    ?>

                                    <select class="form-control" id="mobile_code" name="mobile_code">
                                       <option value="">Select Code</option>
                                       <?php
                                       foreach ($countries as $value) {
                                          $sel = '';
                                          if ($mobile_code == $value->id) {
                                             $sel = 'selected';
                                          }
                                       ?>
                                          <option value="{{ $value->id }}" <?php echo $sel; ?>>{{ $value->code.' - '.$value->country }}</option>
                                       <?php } ?>
                                    </select>
                                    <?php if (isset($validation['mobile_code'])) { ?>
                                       <label class="error">{{ $validation['mobile_code'] }}</label>
                                    <?php } ?>
                                 </div>
                              </div>
                              <div class="col-md-9">
                                 <div class="form-group">
                                    <?php
                                    $mobile = '';
                                    if (request('mobile')) {
                                       $mobile = request('mobile');
                                    } elseif (!empty($user_detail) && (request('mobile') == '')) {
                                       $mobile = $user_detail->mobile;
                                    }
                                    ?>
                                    <input type="text" id="mobile" name="mobile" class="form-control" value="{{$mobile}}" aria-required="true" placeholder="Mobile Number">
                                    <?php if (isset($validation['mobile'])) { ?>
                                       <label class="error">{{ $validation['mobile'] }}</label>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group date_of_birth">
                              <?php
                              $dob = '';
                              if (request('dob')) {
                                 $dob = request('dob');
                              } elseif (!empty($editData) && (request('dob') == '')) {
                                 $dob = $editData->dob;
                              }
                              ?>
                              <input type="text" id="dob" name="dob" class="form-control" aria-required="true" placeholder="Date of Birth" value="{{$dob}}">
                              <span><img src="{{URL::to('/public/images/calender.png')}}"></span>
                              <?php if (isset($validation['dob'])) { ?>
                                 <label class="error">{{ $validation['dob'] }}</label>
                              <?php } ?>
                             
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php
                              $weight = '';
                              if (request('weight')) {
                                 $weight = request('weight');
                              } elseif (!empty($editData) && (request('weight') == '')) {
                                 $weight = $editData->weight;
                              }
                              ?>
                              <input type="text" id="weight" name="weight" class="form-control" aria-required="true" placeholder="Weight in KG" value="{{$weight}}">
                              <span class="unit">(in KG)</span>
                              <?php if (isset($validation['weight'])) { ?>
                                 <label class="error">{{ $validation['weight'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php
                              $height = '';
                              if (request('height')) {
                                 $height = request('height');
                              } elseif (!empty($editData) && (request('height') == '')) {
                                 $height = $editData->height;
                              }
                              ?>
                              <input type="text" id="height" name="height" class="form-control" aria-required="true" placeholder="Height in CM" value="{{$height}}">
                              <span class="unit">(in CM)</span>
                              <?php if (isset($validation['height'])) { ?>
                                 <label class="error">{{ $validation['height'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-6 ">
                           <div class="form-group">
                              <?php
                              $image = '';
                              if (request('image')) {
                                 $image = request('image');
                              } elseif (!empty($editData) && (request('image') == '')) {
                                 $image = $editData->image;
                              }
                              ?>
                             
                              <label for="field-1" class="control-label">Profile image: <span style="color: red;">*</span></label>
                              <input type="file" id="image" name="image" class="form-control" value="{{$image}}" aria-required="true" accept="image/*">
                              <?php if (isset($validation['image'])) { ?>
                                 <label class="error">{{ $validation['image'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <p class="control-label"><b>Status</b>
                                 <font color="red">*</font>
                              </p>
                              <div class="radio radio-info form-check-inline">
                                 <input type="radio" id="active" value="1" name="status" <?php if (request('status') == '' || request('status') == '1') {
                                                                                             echo 'checked';
                                                                                          } ?>>
                                 <label for="inlineRadio1"> Active </label>
                              </div>
                              <div class="radio radio-info form-check-inline">
                                 <input type="radio" id="inactive" value="0" name="status" <?php if (request('status') == '0') {
                                                                                                echo 'checked';
                                                                                             } ?>>
                                 <label for="inlineRadio1"> Inactive </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <h4>Health Conditions</h4>
                           </div>
                        </div>
                        <?php
                        // $health_condition = '';
                        // if (request('health_condition')) {
                        //    $health_condition = request('health_condition');
                        // } elseif (!empty($editData) && (request('health_condition') == '')) {
                        //    $health_condition = $editData->health_condition;
                        // }
                        ?>
                        <?php
                        $checked = '';
                        $health_conditions = DB::table('health_conditions')->get();
                        foreach ($health_conditions as $value) {
                        ?>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <input type="checkbox" id="chk_{{$value->id}}" value="{{$value->id}}" <?php if (request('health_condition') && in_array($value->id, $health_condition)) {
                                                                                                            echo 'checked';
                                                                                                         } ?> name="health_condition[]">
                                 <span for="chk_{{$value->id}}"> {{$value->name}} </span>
                              </div>
                           </div>
                        <?php } ?>

                        <?php if (isset($validation['health_condition'])) { ?>
                           <label class="error">{{ $validation['health_condition'] }}</label>
                        <?php } ?>

                        -->


                        <div class="col-md-12">
                           <h5>Add New Partner</h5>
                        </div>
                        <div class="col-md-6">
                           @php
                           $userData = DB::table('users')->where('users_role','!=',1)->get();
                           @endphp
                           <div class="form-group">
                              <select name="user_id" id="user_id" class="form-control" aria-required="true">
                                 <option value="">Select User</option>
                                 @foreach($userData as $user)
                                 <option value="{{ $user->id }}">{{ $user->name }}</option>
                                 @endforeach
                              </select>
                              <!-- <input type="text" id="name" name="name" class="form-control" aria-required="true" value="{{$name}}" placeholder="User Name"> -->
                              <?php if (isset($validation['name'])) { ?>
                                 <label class="error">{{ $validation['name'] }}</label>
                              <?php } ?>
                           </div>
                        </div>



                        <div class="col-md-12">
                           <div class="form-group">
                              <h4>Official Details</h4>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php
                              $company_name = '';
                              if (request('company_name')) {
                                 $company_name = request('company_name');
                              } elseif (!empty($editData) && (request('company_name') == '')) {
                                 $company_name = $editData->company_name;
                              }
                              ?>
                              <input type="text" id="company_name" name="company_name" class="form-control" aria-required="true" placeholder="Company Name" value="{{$company_name}}">
                              <?php if (isset($validation['company_name'])) { ?>
                                 <label class="error">{{ $validation['company_name'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php
                              $company_address = '';
                              if (request('company_address')) {
                                 $company_address = request('company_address');
                              } elseif (!empty($editData) && (request('company_address') == '')) {
                                 $company_address = $editData->company_address;
                              }
                              ?>
                              <input type="text" id="company_address" name="company_address" class="form-control" aria-required="true" placeholder="Office Address" value="{{$company_address}}">
                              <?php if (isset($validation['company_address'])) { ?>
                                 <label class="error">{{ $validation['company_address'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group date_of_birth">
                              <?php
                              $company_location = '';
                              if (request('company_location')) {
                                 $company_location = request('company_location');
                              } elseif (!empty($editData) && (request('company_location') == '')) {
                                 $company_location = $editData->company_location;
                              }
                              ?>

                              <input type="text" id="company_location" name="company_location" class="form-control" aria-required="true" placeholder="Geo Location" value="{{$company_location}}">
                              <span onclick="getLocation()">
                                 <img src="{{URL::to('/public/images/map.png')}}">
                              </span>
                              <?php if (isset($validation['company_location'])) { ?>
                                 <label class="error">{{ $validation['company_location'] }}</label>
                              <?php } ?>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="form-group">
                              <h3>Having License?</h3>
                           </div>
                        </div>
                        <!-- <form action="#"> -->
                        <div class="col-md-12">
                           <div class="form-group">
                              <div class="radio radio-info form-check-inline license_status_yes">
                                 <input type="radio" id="yes" value="1" name="license_status" <?php if (request('license_status') == '' || request('license_status') == '1') {
                                                                                                   echo 'checked';
                                                                                                } ?>>
                                 <label for="inlineRadio2"> Yes </label>
                              </div>
                              <div class="radio radio-info form-check-inline license_status_no">
                                 <input type="radio" id="no" value="0" name="license_status" <?php if (request('license_status') == '0') {
                                                                                                echo 'checked';
                                                                                             } ?>>
                                 <label for="inlineRadio2"> No </label>
                              </div>
                           </div>
                        </div>


                        <!-- <div class="attach_cr">
                        <div class="row"> -->
                        <div class="col-md-6 license_status">
                           <div class="form-group">
                              <?php
                              $crName = '';
                              if (request('crName')) {
                                 $crName = request('crName');
                              } elseif (!empty($editData) && (request('crName') == '')) {
                                 $crName = $editData->crName;
                              }
                              ?>
                              <input type="text" id="cr_name" name="crName" class="form-control" aria-required="true" placeholder="CR Name" value="{{$crName}}">
                              <?php if (isset($validation['crName'])) { ?>
                                 <label class="error">{{ $validation['crName'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-6 license_status">
                           <div class="form-group">
                              <?php
                              $crNumber = '';
                              if (request('crNumber')) {
                                 $crNumber = request('crNumber');
                              } elseif (!empty($editData) && (request('crNumber') == '')) {
                                 $crNumber = $editData->crNumber;
                              }
                              ?>
                              <input type="number" id="cr_number" name="crNumber" class="form-control" aria-required="true" placeholder="CR Number" value="{{$crNumber}}">
                              <?php if (isset($validation['crNumber'])) { ?>
                                 <label class="error">{{ $validation['crNumber'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-6 license_status">
                           <div class="form-group">
                              <?php
                              $crCopy = '';
                              if (request('crCopy')) {
                                 $crCopy = request('crCopy');
                              } elseif (!empty($editData) && (request('crCopy') == '')) {
                                 $crCopy = $editData->crCopy;
                              }
                              ?>
                              <label for="field-2" class="control-label">Cr Copy: <span style="color: red;">*</span></label>
                              <input type="file" id="crCopy" name="crCopy" class="form-control" value="{{$crCopy}}" aria-required="true" accept="image/*">
                              <?php if (isset($validation['crCopy'])) { ?>
                                 <label class="error">{{ $validation['crCopy'] }}</label>
                              <?php } ?>

                           </div>
                        </div>
                        <!-- </div>
                     </div> -->
                        <div class="col-md-12">
                           <div class="form-group">
                              <h4>Payment Setup</h4>
                           </div>

                           <?php
                           $payment_mode = '';
                           if (request('payment_mode')) {
                              $payment_mode = request('payment_mode');
                           } elseif (!empty($editData) && (request('payment_mode') == '')) {
                              $payment_mode = $editData->payment_mode;
                           }
                           ?>
                           <?php
                           $checked = '';
                           $paymentmodes = DB::table('get_all_paymentmode')->get();
                           foreach ($paymentmodes as $value) {
                           ?>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <input type="checkbox" id="chk_{{$value->id}}" value="{{$value->payment_name}}" <?php if (request('payment_mode') && in_array($value->id, $payment_mode)) {
                                                                                                                        echo 'checked';
                                                                                                                     } ?> name="payment_mode[]">
                                    <span for="chk_{{$value->id}}"> {{$value->payment_name}}</span>
                                 </div>
                              </div>
                           <?php } ?>

                           <?php if (isset($validation['payment_mode'])) { ?>
                              <label class="error">{{ $validation['payment_mode'] }}</label>
                           <?php } ?>
                        </div>
                        <div class="col-md-12 package_part" id="package_part">
                           <div class="form-group">
                              <h3>Subscription Package</h3>

                              <!-- <div class="col-md-12 package_part" id="package_part">
                              <div class="form-group">  
                                 <h3>Subscription Package</h3>
                              </div> 
                           </div>-->
                              <ul>
                                 <?php
                                 $checked = '';
                                 $subscription = DB::table('packages')->get();
                                 foreach ($subscription as $value) {
                                    $subscription_id  = '';
                                    if (request('subscription_id')) {
                                       $subscription_id = request('subscription_id');
                                    } elseif (!empty($editData) && (request('subscription_id') == '')) {
                                       $subscription_id = $editData->subscription_id;
                                    }

                                    $active = '';

                                    if ($value->id == '2') {
                                       $active = 'active';
                                    } else {
                                       $active = '';
                                    }
                                    if ($value->id == '3') {
                                       $active = 'active';
                                    } else {
                                       $active = '';
                                    }
                                    if ($value->id == '4') {
                                       $active = 'active';
                                    } else {
                                       $active = '';
                                    }
                                    if ($value->id == '1') {
                                       $active = 'active';
                                    } else {
                                       $active = '';
                                    }
                                 ?>
                                    <li>
                                       <span class="form-group plan {{$active}}" id="subscription_{{$value->id}}" name="subscription" value="{{$value->id}}">
                                          {{$value->title}} - {{$value->duration}} <br />
                                          <em style="color:red">Today's offer:</em> <br />
                                          <strike>{{$value->symbol}}{{$value->cost}}</strike>
                                          {{$value->symbol}}{{$value->offer_cost}}
                                       </span>
                                    </li>

                                 <?php } ?>
                                 <input id="subscription_id" type="hidden" name="subscription_id" value="">
                              </ul>
                              <?php if (isset($validation['subscription_id'])) { ?>
                                 <label class="error">{{ $validation['subscription_id'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer text-center">
                        <button type="cancel" id="canceltbtn" class="btn btn-default cancel"><a href="{{url()->previous()}}">Cancel</a></button>
                        <button type="submit" id="submitbtn" class="btn btn-primary save">Save</button>
                     </div>
                  </div><!-- End card-body -->
               </div> <!-- End card -->
            </div>
         </div>
      </form><!-- Form End -->
   </div><!-- container -->
</div>

<script type="text/javascript">
   $(function() {
      $("#dob").datepicker({
         showOn: "button",
         buttonImage: "public/images/calender.png",
         buttonImageOnly: true,
         buttonText: "Select date",
         format: 'yyyy-mm-dd',
         showOtherMonths: true,
         selectOtherMonths: true,
         autoclose: true,
         changeMonth: true,
         changeYear: true,
      });

      $('.license_status_no').change(function() {
         $('.license_status').hide();
      });
      $('.license_status_yes').change(function() {
         $('.license_status').show();
      });
      $('#country').change(function() {
         base_url = '<?php echo URL::to('/'); ?>';
         $country_id = $('#country').val();
         $('#currency').val($country_id);
         $.post(base_url + '/get_regions/' + $country_id, {
            "_token": "{{ csrf_token() }}",
            count: $country_id
         }, function(data) {
            $('#region').html(data);
         });
      });
   });
   <?php if (request('country')) { ?>
      base_url = '<?php echo URL::to('/'); ?>';
      $country_id = <?php echo request('country'); ?>;
      $region = <?php echo request('region') ?? 0; ?>;
      $('#currency').val($country_id);
      $.post(base_url + '/get_regions/' + $country_id, {
         "_token": "{{ csrf_token() }}",
         count: $country_id,
         region: $region
      }, function(data) {
         $('#region').html(data);
      });
   <?php } ?>

   $(".chosen-select").chosen({
      no_results_text: "Oops, nothing found!"
   })

   var x = document.getElementById("company_location");

   function getLocation() {
      if (navigator.geolocation) {
        
         navigator.geolocation.getCurrentPosition(showPosition);
      } else {
         x.value = "Geolocation is not supported by this browser.";
      }
   }

   function showPosition(position) {
      alert(position);
      x.value = "Latitude: " + position.coords.latitude +
         ", Longitude: " + position.coords.longitude;
   }

   /* For input type file */
   $('#file-input').change(function() {
      var i = $(this).prev('label').clone();
      var file = $('#file-input')[0].files[0].name;
      $(this).prev('label').text("File Attached : " + file);
   });

   /* Active class on Subscription type */
   // Get the container element
   var pkgContainer = document.getElementById("package_part");

   // Get all buttons with class="btn" inside the container
   var pkgs = pkgContainer.getElementsByClassName("plan");

   // Loop through the buttons and add the active class to the current/clicked button
   for (var i = 0; i < pkgs.length; i++) {
      pkgs[i].addEventListener("click", function() {
         var current = document.getElementsByClassName("active");
         current[0].className = current[0].className.replace(" active", "");
         this.className += " active";
         var cname = this.className;
         var data1 = document.getElementsByClassName(cname)[0].getAttribute("id");
         var sub_id = document.getElementById(data1).getAttribute("value");
         document.getElementById('subscription_id').value = sub_id;
      });
   }
</script>
<!-- Script for datepicker -->
<script type="text/javascript">
   $(function() {
      $('.date-pick').datePicker()
      $('#dt1').bind(
         'dpClosed',
         function(e, selectedDates) {
            var d = selectedDates[0];
            if (d) {
               d = new Date(d);
               $('#dt2').dpSetStartDate(d.addDays(1).asString());
            }
         }
      );
      $('#dt2').bind(
         'dpClosed',
         function(e, selectedDates) {
            var d = selectedDates[0];
            if (d) {
               d = new Date(d);
               $('#dt1').dpSetEndDate(d.addDays(-1).asString());
            }
         }
      );
   });
</script>


<script type="text/javascript">
   $('#ServiceId').change(function() {
      var service_cat_id = $(this).val();
      if (service_cat_id) {
         $.ajax({
            type: "GET",
            url: "{{url('get-servicecategory/')}}" + '/' + service_cat_id,
            success: function(res) {
               if (res) {
                  $("#home_cat_id").empty();
                  $("#home_cat_id").append('<option>-- Choose Service Category --</option>');
                  $.each(res, function(key, value) {
                     $("#home_cat_id").append('<option value="' + value.Id + '">' + value.Name + '</option>');
                  });
               } else {
                  $("#home_cat_id").empty();
               }
            }
         });
      } else {
         $("#home_cat_id").empty();
      }
   });
   /* script for activity */
   $('#home_cat_id').change(function() {
      var service_cat_id = $(this).val();
      if (service_cat_id) {
         $.ajax({
            type: "GET",
            url: "{{ url('get-service-activity/') }}" + '/' + service_cat_id,
            success: function(res) {
               console.log(res);
               if (res) {
                  $("#activity_id").empty();
                  $("#activity_id").append('<option>-- Choose Service Activity --</option>');
                  $.each(res, function(key, value) {
                     $("#activity_id").append('<option value="' + value.Id + '">' + value.Name + '</option>');
                  });
               } else {
                  $("#activity_id").empty();
               }
            }
         });
      } else {
         $("#activity_id").empty();
      }
   });
</script>