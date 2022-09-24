<style type="text/css">
    .colerclass{
        color: #317eeb;
    }
    .menustyle{
        margin: 10px;
    }
</style>
<?php 
$segment = Request::segment(2);
$countries = DB::table('countries')->get();
?>
<div class="content add_adventure_users">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title"><a href="{{ URL::to('list-service-offers') }}">Service Offers</a> > Create Service Offer</h4>
            </div>
        </div>
        <?php //echo"<pre>";print_r($editData);exit;
         if(!empty($editData)){
         ?>
        <input type="hidden" name="id" id="id"  value="{{ $editData->id }}">
           <?php  $s = URL::to('add-service-offer/'.$editData->id ) ;
          }else{
             $s = URL::to('add-service-offer');
          }
      ?>
      <form  action="{{ $s}}" method="POST" id="FormValidation" enctype="multipart/form-data">
         @csrf
        <!--<form  action="{{ URL::to('add-adventure-user') }}" method="POST"  enctype="multipart/form-data">-->
        <!--    @csrf-->
            <div class="row" id="example-basic">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">  
                                <div class="col-md-12">
                                    <h5><?php if($segment){echo 'Edit User';} else {echo 'Create Service Offer';}?></h5>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                           
                                            $adv_name = '';
                                            if (request('adventure_name')) {
                                                $adv_name = request('adventure_name');
                                            } elseif (!empty($offer_detail) && (request('adventure_name') == '')) {
                                                $adv_name = $offer_detail['adventure_name'];
                                            }
                                            ?>

                                            <select class="form-control" id="adventure_name" name="adventure_name"  >
                                                <option value="">Select Adventure</option>
                                                <?php
                                                foreach ($adv_names as $value) {
                                                    $sel = '';
                                                    if ($adv_name == $value->id) {
                                                        $sel = 'selected';
                                                    }
                                                    ?>
                                                    <option value="{{ $value->id }}" <?php echo $sel; ?>>{{ $value->adventure_name }}</option>
                                                <?php } ?>
                                            </select>
                                            <?php if (isset($validation['adventure_name'])) { ?>
                                                <label class="error">{{ $validation['adventure_name'] }}</label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-6">
                                        <div class="form-group">  
                                            <?php
                                            $name = '';
                                            if (request('name')) {
                                                $name = request('name');
                                            } elseif (!empty($offer_detail) && (request('name') == '')) {
                                                $name = $offer_detail['name'];
                                            }
                                            ?>
                                            <input type="text" id="name" name="name" class="form-control" value="{{$name}}" aria-required="true" placeholder="Offer Name"> 
                                            <?php if (isset($validation['name'])) { ?>
                                                <label class="error">{{ $validation['name'] }}</label>
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
                                        } elseif (!empty($offer_detail) && (request('start_date') == '')) {
                                            $start_date = $offer_detail->start_date;
                                        }
                                    ?>
                                    <input type="date" id="start_date" name="start_date" class="form-control"  aria-required="true" placeholder="Start Date" value="{{$start_date}}" > 
                                    <!-- <span><img src="{{URL::to('/public/images/calender.png')}}" id="datepicker"></span>  -->
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
                                        } elseif (!empty($offer_detail) && (request('end_date') == '')) {
                                            $end_date = $offer_detail->end_date;
                                        }
                                    ?>
                                    <input type="date"  id="end_date" name="end_date" class="form-control"  aria-required="true" placeholder="End Date" value="{{$end_date}}" > 
                                   <!--  <span><img src="{{URL::to('/public/images/calender.png')}}" id="datepicker" ></span>  -->
                                    <?php if (isset($validation['end_date'])) { ?> 
                                            <label class="error">{{ $validation['end_date'] }}</label>
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
                                        } elseif (!empty($offer_detail) && (request('discount_type') == '')) {
                                            $discount_type = $offer_detail->discount_type;
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
                                        } elseif (!empty($offer_detail) && (request('discount_amount') == '')) {
                                            $discount_amount = $offer_detail->discount_amount;
                                        }
                                    ?>
                                    
                                    <input type="number"class="form-control" id="discount_amount"  name="discount_amount" step="1" value="{{$discount_amount}}" placeholder="Discount Amount">
                                    <?php if (isset($validation['discount_amount'])) { ?>
                                            <label class="error">{{ $validation['discount_amount'] }}</label>
                                    <?php } ?>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="currency"> currency Code</label>
                                                <?php
                                                $currency = '';
                                                if (request('currency')) {
                                                    $currency = request('currency');
                                                } elseif (!empty($user_detail) && (request('currency') == '')) {
                                                    $currency = $user_detail['currency'];
                                                }
                                                ?>

                                                <select class="form-control" id="currency" name="currency">
                                                    <option value="">Select Currency</option>
                                                    <?php
                                                    foreach ($countries as $value) {
                                                        $sel = '';
                                                        if ($currency == $value->currency) {
                                                            $sel = 'selected';
                                                        }
                                                    ?>
                                                        <option value="{{ $value->currency }}" <?php echo $sel; ?>>{{ $value->currency.' - '.$value->country }}</option>
                                                    <?php } ?>
                                                </select>
                                                <?php if (isset($validation['mobile_code'])) { ?>
                                                    <label class="error">{{ $validation['mobile_code'] }}</label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div for="currAmt" id="currAmt">Current Amount:
                                    <div id="currAmount" name="currAmt" ></div>
                                    </div>
                                </div>
                                <div class="col-md-6 license_status">
                                    <div class="form-group">
                                        <?php
                                        $banner_img = '';
                                        if (request('banner')) {
                                            $banner_img = request('banner');
                                        } elseif (!empty($offer_detail) && (request('banner') == '')) {
                                            $banner_img = $offer_detail->banner;
                                            }
                                        ?>   
                                        <label for="field-2" class="control-label">Banner Image: <span style="color: red;">*</span></label> 
                                        <input  type="file" id="banner" name="banner" class="form-control" value="{{$banner_img}}" aria-required="true" accept="image/*"> 
                                        <?php if (isset($validation['banner'])) { ?>
                                            <label class="error">{{ $validation['banner'] }}</label>
                                        <?php } ?>         
                                    </div>
                                </div>

                                
                                <div class="col-md-12">
                                <div class="form-group">
                                <?php
                                        $description = '';
                                        if (request('description')) {
                                            $description = request('description');
                                        } elseif (!empty($offer_detail) && (request('description') == '')) {
                                            $description = $offer_detail->description;
                                        }
                                        ?>
                                    <textarea rows="5" name="description" class="form-control info" placeholder="Write description..." >{{$description}}</textarea>
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
                </div>
            </div>
        </form><!-- Form End -->
    </div><!-- container -->
</div>

<script type="text/javascript">
     
    $(function () {
    $("#start_date").datepicker({
        format: 'yyyy-mm-dd',
        startDate: '+1d',
        autoclose: true,
    }).on('changeDate', function (ev) {
        var next_date = new Date(ev.date);
        next_date.setDate(next_date.getDate() + 1);
        $("#end_date").datepicker({
            format: 'yyyy-mm-dd',
            startDate: next_date,
            autoclose: true,
        });
    });

    $('#discount_amount').mouseout(function(event){
        event.preventDefault();
       $dis = $('#discount_amount').val();
        $curr =$('#currAmount').text($dis);
        $('#currAmount').value=$curr;
    });
});
</script>

            <script type="text/javascript">
                $(document).ready(function () {
                    $("#dob").datepicker({
                         format: 'yyyy-mm-dd',
                        // startDate: '+1d',
                         autoclose: true,
                        // showOn: "button",
                        // buttonImage: "public/images/calender.png",
                        // buttonImageOnly: true,
                        // buttonText: "Select date",
                    });
                    $('#country').change(function () {
                        base_url = '<?php echo URL::to('/'); ?>';
                        $country_id = $('#country').val();
                        $('#currency').val($country_id);
                        $.post(base_url + '/get_regions/' + $country_id,
                                {
                                    "_token": "{{ csrf_token() }}",
                                    count: $country_id
                                }, function (data) {
                            $('#region').html(data);
                        });
                    });
                });
    <?php if (request('country')) { ?>
                    base_url = '<?php echo URL::to('/'); ?>';
                    $country_id = <?php echo request('country'); ?>;
                    $region = <?php echo request('region') ?? 0; ?>;
                    $('#currency').val($country_id);
                    $.post(base_url + '/get_regions/' + $country_id,
                            {
                                "_token": "{{ csrf_token() }}",
                                count: $country_id,
                                region: $region
                            }, function (data) {
                        $('#region').html(data);
                    });
    <?php } ?>



            </script>

