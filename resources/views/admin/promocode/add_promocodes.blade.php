<style type="text/css">
   .colerclass{
      color: #317eeb;
   }
   .menustyle{
      margin: 10px;
   }
</style>

<div class="content add_adventure_users">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <h4 class="pull-left page-title"><a href="{{ URL::to('list-promocode') }}" return false;">Promocode</a> > Create Promocode</h4>
         </div>
      </div>
      <?php 
         if(!empty($editData)){
         ?>
         <input type="hidden" name="id" value="{{ $editData->id }}">
      <?php } ?>
      <form  action="{{ URL::to('add-promocode') }}" method="POST" id="FormValidation" enctype="multipart/form-data">
         @csrf
         <div class="row" id="example-basic">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-body">
                     <div class="row">  
                        <div class="col-md-12">
                        <?php if(!empty($editData)){?>
                           <h5>Update Promocode</h5>
                           <?php }else{ ?>
                           <h5>Create Promocode</h5>
                           <?php } ?>
                        </div>
                       
                        <?php //echo"<pre>";print_r($editData);exit;
                        //echo"<pre>";print_r($request->all());exit;?>
                        <div class="col-md-6">
                            <div class="form-group">
                            <?php
                                $promocode_name = '';
                                if (request('promocode_name')) {
                                    $promocode_name = request('promocode_name');
                                    $readonly = '';
                                } elseif (!empty($editData) && (request('promocode_name') == '')) {
                                    $promocode_name = $editData->promocode_name;
                                    $readonly = "readonly";
                                   }else{
                                    $promocode_name = '';
                                   }
                            ?>
                                <input type="text" id="promocode_name" name="promocode_name" class="form-control" value="{{$promocode_name}}" placeholder="Promocode Name" "readonly" = $readonly>        
                                <?php if (isset($validation['promocode_name'])) { ?>
                                        <label class="error">{{ $validation['promocode_name'] }}</label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">  
                           <?php
                                $code = '';
                                if (request('code')) {
                                    $code = request('code');
                                } elseif (!empty($editData) && (request('code') == '')) {
                                    $code = $editData->code;
                                   }else{
                                    $code = '';
                                   }
                            ?>
                              <input type="text" id="code" name="code" class="form-control"  value="{{$code}}"  aria-required="true" placeholder="Code"> 
                              <?php if (isset($validation['code'])) { ?>
                                    <label class="error">{{ $validation['code'] }}</label>
                              <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                           <h5>Discount Type</h5>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                           <?php
                                $discount_type = '';
                                if (request('discount_type')) {
                                    $discount_type = request('discount_type');
                                } elseif (!empty($editData) && (request('discount_type') == '')) {
                                    $discount_type = $editData->discount_type;
                                   }
                            ?>
                              <div class="radio radio-info form-check-inline">
                                 <input type="radio" id="amount_discount" value="{{!empty($discount_type)?$discount_type:'A'}}" name="discount_type" checked="">
                                 <label for="amount_discount"> Amount Discount </label>
                              </div>
                              <div class="radio radio-info form-check-inline">
                                 <input type="radio" id="percentage_discount" value="{{!empty($discount_type)?$discount_type:'P'}}" name="discount_type">
                                 <label for="percentage_discount"> Percentage Discount </label>
                              </div>
                              <?php if (isset($validation['discount_type'])) { ?>
                                    <label class="error">{{ $validation['discount_type'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                           <?php
                                $discount_amount = '';
                                if (request('discount_amount')) {
                                    $discount_amount = request('discount_amount');
                                } elseif (!empty($editData) && (request('discount_amount') == '')) {
                                    $discount_amount = $editData->discount_amount;
                                   }
                            ?>
                              <input type="number"class="form-control" id="discount_amount"  name="discount_amount" step="1" value="{{$discount_amount}}" placeholder="Discount Amount">
                              <?php if (isset($validation['discount_amount'])) { ?>
                                    <label class="error">{{ $validation['discount_amount'] }}</label>
                              <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                           <?php
                                $redeemed_count = '';
                                if (request('redeemed_count')) {
                                    $redeemed_count = request('redeemed_count');
                                } elseif (!empty($editData) && (request('redeemed_count') == '')) {
                                    $redeemed_count = $editData->redeemed_count;
                                   }
                            ?>
                              <input type="number"class="form-control" id="redeemed_count"  name="redeemed_count" step="1" value={{$redeemed_count}} placeholder="Redeemed Count">
                              <?php if (isset($validation['redeemed_count'])) { ?>
                                    <label class="error">{{ $validation['redeemed_count'] }}</label>
                              <?php } ?>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                           <div class="form-group date_of_birth">  
                              <!-- <input type="text" onfocus="(this.type='date')"onblur="(this.value == '' ? this.type='text' : this.type='date')" id="start_date" name="start_date" class="form-control" required="" aria-required="true" placeholder="Start Date">  -->
                            <?php
                                $start_date = '';
                                if (request('start_date')) {
                                    $start_date = request('start_date');
                                } elseif (!empty($editData) && (request('start_date') == '')) {
                                    $start_date = $editData->start_date;
                                   }
                            ?>
                              <input type="text" id="start_date" name="start_date" class="form-control"  aria-required="true" placeholder="Start Date" value="{{$start_date}}" > 
                              <span><img src="{{URL::to('/public/images/calender.png')}}" id="datepicker"></span> 
                              <?php if (isset($validation['start_date'])) { ?>
                                    <label class="error">{{ $validation['start_date'] }}</label>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group date_of_birth">  
                           <?php
                                $end_date = '';
                                if (request('end_date')) {
                                    $end_date = request('end_date');
                                } elseif (!empty($editData) && (request('end_date') == '')) {
                                    $end_date = $editData->end_date;
                                   }
                            ?>
                              <input type="text"  id="end_date" name="end_date" class="form-control"  aria-required="true" placeholder="End Date" value="{{$end_date}}" > 
                               <span><img src="{{URL::to('/public/images/calender.png')}}" id="datepicker" ></span> 
                               <?php if (isset($validation['end_date'])) { ?>
                                    <label class="error">{{ $validation['end_date'] }}</label>
                              <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                           <?php
                                $description = '';
                                if (request('description')) {
                                    $description = request('description');
                                } elseif (!empty($editData) && (request('description') == '')) {
                                    $description = $editData->description;
                                   }
                                ?>
                              <textarea name="description" class="form-control info" placeholder="Write description..." >{{$description}}</textarea>
                              <?php if (isset($validation['description'])) { ?>
                                    <label class="error">{{ $validation['description'] }}</label>
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
     
         $( function() {
            $( "#start_date,#end_date" ).datepicker({
               showOn: "button",
               buttonImage: "public/images/calender.png",
               buttonImageOnly: true,
               buttonText: "Select date"
            });
        });

</script>


