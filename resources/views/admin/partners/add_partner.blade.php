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
            <h4 class="pull-left page-title"><a href="{{ URL::to('home') }}">Users</a> > Add New Partner</h4>
         </div>
      </div>
      <form action="{{ URL::to('add-partner') }}" method="POST" id="FormValidation" enctype="multipart/form-data">
         @csrf
         <div class="row" id="example-basic">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <h5>Add New Partner</h5>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group search_part">
                              <input type="text" id="UserName" name="search" class="form-control" required="" aria-required="true" placeholder="Search by user id,name,email,mobile....">
                              <button><img src="{{ asset('public/images/search.png') }}"></button>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="text" id="UserName" name="UserName" class="form-control" required="" aria-required="true" placeholder="User Name">
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="text" id="EmailAddress" name="EmailAddress" class="form-control" required="" aria-required="true" placeholder="Email Address">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php $country = DB::table('countries')->get(); ?>
                              <select class="form-control" id="CountryId" name="CountryId" required="">
                                 <option value="">Nationality</option>
                                 @foreach($country as $value)
                                 <option value="{{ $value->id }}">{{ $value->name }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php $region = DB::table('Region')->get(); ?>
                              <select class="form-control" id="RegionId" name="RegionId" required="">
                                 <option value="">City/State</option>
                                 @foreach($region as $value)
                                 <option value="{{ $value->Id }}">{{ $value->Name }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="text" id="mobileNo" name="mobileNo" class="form-control" required="" aria-required="true" placeholder="Mobile Number">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group date_of_birth">
                              <input type="text" onfocus="(this.type='date')" onblur="(this.value == '' ? this.type='text' : this.type='date')" id="date_of_birth" name="date_of_birth" class="form-control" required="" aria-required="true" placeholder="Date of Birth">
                              <span><img src="{{ asset('public/images/calender.png') }}"></span>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="text" id="weight" name="weight" class="form-control" required="" aria-required="true" placeholder="Weight in KG">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="text" id="height" name="height" class="form-control" required="" aria-required="true" placeholder="Height in CM">
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <input type="checkbox" id="active" value="1" name="status" checked="">
                              <label for="inlineRadio1"> Good Condition </label>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <input type="checkbox" id="active" value="1" name="status" checked="">
                              <label for="inlineRadio1"> Bone weakness </label>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <input type="checkbox" id="active" value="1" name="status" checked="">
                              <label for="inlineRadio1"> Breathing difficulty </label>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <input type="checkbox" id="active" value="1" name="status" checked="">
                              <label for="inlineRadio1"> Muscles issue </label>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <input type="checkbox" id="active" value="1" name="status" checked="">
                              <label for="inlineRadio1"> Backbone issue</label>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <input type="checkbox" id="active" value="1" name="status" checked="">
                              <label for="inlineRadio1"> Joints issue </label>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <input type="checkbox" id="active" value="1" name="status" checked="">
                              <label for="inlineRadio1"> Liagment issue</label>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <input type="checkbox" id="active" value="1" name="status" checked="">
                              <label for="inlineRadio1"> Not Good Condition </label>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="form-group">
                              <h4>Official Details</h4>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="text" id="company_name" name="company_name" class="form-control" required="" aria-required="true" placeholder="Company Name">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <input type="text" id="company_address" name="mobileNo" class="form-control" required="" aria-required="true" placeholder="Office Address">
                           </div>
                        </div>
                        <div class="col-md-12 date_of_birth">
                           <div class="form-group">
                              <input type="text" id="company_location" name="mobileNo" class="form-control" required="" aria-required="true" placeholder="Geo Location">
                              <span><img src="{{ asset('public/images/map.png') }}"></span>
                           </div>
                        </div>
                     </div>

                     <div class="having_license">
                        <h3>Having License?</h3>
                        <form action="#">
                           <p>
                              <input type="radio" id="test1" name="radio-group" checked>
                              <label for="test1">Yes</label>
                           </p>
                           <p>
                              <input type="radio" id="test2" name="radio-group">
                              <label for="test2">No</label>
                           </p>
                        </form>
                     </div>

                     <div class="attach_cr">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <input type="text" id="cr_name" name="csName" class="form-control" required="" aria-required="true" placeholder="CR Name">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <input type="number" id="company_address" name="crNumber" class="form-control" required="" aria-required="true" placeholder="CR Number">
                              </div>
                           </div>
                           <div class="col-md-6 attach_cr_copy">
                              <div class="form-group">
                                 <div class="cr_copy">
                                    <span><img src="{{ asset('public/images/map.png') }}"></span>
                                    <p>Attach CR copy</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="payment_setup">
                        <h3>Payment Setup</h3>
                        <form>
                           <div class="form-group">
                              <input type="checkbox">
                              <label for="debit-card">Oman Debit Card</label>
                           </div>
                           <div class="form-group">
                              <input type="checkbox">
                              <label for="visa-card">International Visa Card</label>
                           </div>
                           <div class="form-group">
                              <input type="checkbox">
                              <label for="Arrival">Pay On Arrival</label>
                           </div>
                           <div class="form-group">
                              <input type="checkbox">
                              <label for="PayPal">PayPal</label>
                           </div>
                           <div class="form-group paypal">
                              <input type="text" id="Paypal" name="Paypal" class="form-control" required="" aria-required="true" placeholder="Paypal id here">
                           </div>
                           <div class="form-group">
                              <input type="checkbox">
                              <label for="PayPal">Wire Transfer</label>
                           </div>
                        </form>
                     </div>

                     <div class="package_part">
                        <h3>Subscription Package</h3>
                        <ul>
                           <li>
                              <a href="#" class="active">1 Week - Free</a>
                           </li>
                           <li>
                              <a href="#">Monthly - $ 5.00</a>
                           </li>
                           <li>
                              <a href="#">Quarterly - $ 25.00</a>
                           </li>
                           <li>
                              <a href="#">Yearly - $ 45.00</a>
                           </li>
                        </ul>
                     </div>

                     <div class="modal-footer text-center">
                        <button type="submit" id="submitbtn" class="btn btn-primary cancel">Cancel</button>
                        <button type="submit" id="submitbtn" class="btn btn-primary save">Save</button>
                     </div>
                  </div><!-- End card-body -->
               </div> <!-- End card -->
      </form><!-- Form End -->
   </div><!-- container -->
</div>

<script type="text/javascript">
   $(".chosen-select").chosen({
      no_results_text: "Oops, nothing found!"
   })
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