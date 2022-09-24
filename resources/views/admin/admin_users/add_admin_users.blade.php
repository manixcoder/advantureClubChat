<style type="text/css">
    .colerclass{
        color: #317eeb;
    }
    .menustyle{
        margin: 10px;
    }
</style>
<?php $segment = Request::segment(2);?>
<div class="content add_adventure_users">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title"><a href="{{ URL::to('list-adventure-users') }}">Users</a> > Add New User</h4>
            </div>
        </div>
        <?php //echo"<pre>";print_r($editData);exit;
         if(!empty($editData)){
         ?>
        <input type="hidden" name="id" id="id"  value="{{ $editData->id }}">
           <?php  $s = URL::to('add-admin-user/'.$editData->id ) ;
          }else{
             $s = URL::to('add-admin-user');
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
                                    <h5><?php if ($segment) {
                                            echo 'Edit User';
                                        } else {
                                            echo 'Add New User';
                                        } ?></h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">UserName</label>
                                        <?php
                                        $name = '';
                                        if (request('name')) {
                                            $name = request('name');
                                        } elseif (!empty($user_detail) && (request('name') == '')) {
                                            $name = $user_detail['name'];
                                        }
                                        ?>
                                        <input type="text" id="name" name="name" class="form-control" aria-required="true" value="{{$name}}" placeholder="User Name" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)">
                                        <?php if (isset($validation['name'])) { ?>
                                            <label class="error">{{ $validation['name'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <?php
                                        $email = '';
                                        if (request('email')) {
                                            $email = request('email');
                                        } elseif (!empty($user_detail) && (request('email') == '')) {
                                            $email = $user_detail['email'];
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
                                        <label for="cities">Now Located In</label>
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
                                            foreach ($countries as $value) {
                                                $sel = '';
                                                if ($country == $value->id) {
                                                    $sel = 'selected';
                                                }
                                            ?>
                                                <option value="{{ $value->id }}" <?php echo $sel; ?>>{{ $value->country }}</option>
                                            <?php } ?>
                                        </select>
                                        <?php if (isset($validation['country'])) { ?>
                                            <label class="error">{{ $validation['country'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cities">Region</label>
                                        <?php $region = DB::table('regions')->get(); ?>
                                        <select class="form-control" id="region" name="region">

                                        </select>
                                        <?php if (isset($validation['region'])) { ?>
                                            <label class="error">{{ $validation['region'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cities">City</label>
                                        <?php $cities = DB::table('cities')->get(); ?>
                                        <select class="form-control" id="cities" name="cities">

                                        </select>
                                        <?php if (isset($validation['cities'])) { ?>
                                            <label class="error">{{ $validation['cities'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="mobile_code">Code</label>
                                                <?php
                                                $mobile_code = '';
                                                if (request('mobile_code')) {
                                                    $mobile_code = request('mobile_code');
                                                } elseif (!empty($user_detail) && (request('mobile_code') == '')) {
                                                    $mobile_code = $user_detail['mobile_code'];
                                                }
                                                ?>

                                                <select class="form-control" id="mobile_code" name="mobile_code">
                                                    <option value="">Select Code</option>
                                                    <?php
                                                    foreach ($countries as $value) {
                                                        $sel = '';
                                                        if ($mobile_code == $value->code) {
                                                            $sel = 'selected';
                                                        }
                                                    ?>
                                                        <option value="{{ $value->code }}" <?php echo $sel; ?>>{{ $value->code.' - '.$value->country }}</option>
                                                    <?php } ?>
                                                </select>
                                                <?php if (isset($validation['mobile_code'])) { ?>
                                                    <label class="error">{{ $validation['mobile_code'] }}</label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="mobile">Mobile</label>
                                                <?php
                                                $mobile = '';
                                                if (request('mobile')) {
                                                    $mobile = request('mobile');
                                                } elseif (!empty($user_detail) && (request('mobile') == '')) {
                                                    $mobile = $user_detail['mobile'];
                                                }
                                                ?>
                                                <input type="text" id="mobile" name="mobile" class="form-control" value="{{$mobile}}" aria-required="true" placeholder="Mobile Number" minlength="5">
                                                <!-- <input type="text" id="mobile" name="mobile" class="form-control" value="{{$mobile}}" aria-required="true" placeholder="Mobile Number" maxlength="15" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"> -->
                                                <?php if (isset($validation['mobile'])) { ?>
                                                    <label class="error">{{ $validation['mobile'] }}</label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group date_of_birth">
                                        <label for="dob">Date of birth</label>
                                        <?php
                                        $dob = '';
                                        if (request('dob')) {
                                            $dob = request('dob');
                                        } elseif (!empty($user_detail) && (request('dob') == '')) {
                                            $dob = $user_detail['dob'];
                                        }
                                        ?>
                                        <input type="text" id="dob" name="dob" class="form-control datepicker" value="{{$dob}}" placeholder="Date of birth" readonly>
                                        <?php if (isset($validation['dob'])) { ?>
                                            <label class="error">{{ $validation['dob'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight">weight</label>
                                        <?php
                                        $weight = '';
                                        if (request('weight')) {
                                            $weight = request('weight');
                                        } elseif (!empty($user_detail) && (request('weight') == '')) {
                                            $weight = $user_detail['weight'];
                                        }
                                        $weights = DB::table('weights')->where(['deleted_at' => NULL])->get();
                                        ?>
                                        <select name="weight" id="weight" class="form-control" aria-required="true">
                                            <option value="">Select Weight</option>
                                            @forelse($weights as $weight)
                                            <option value="{{ $weight->weightName }}">{{ $weight->weightName}}</option>
                                            @empty
                                            <p>No Record</p>
                                            @endforelse
                                        </select>
                                        <?php if (isset($validation['weight'])) { ?>
                                            <label class="error">{{ $validation['weight'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="height">height</label>
                                        <?php
                                        $height = '';
                                        if (request('height')) {
                                            $height = request('height');
                                        } elseif (!empty($user_detail) && (request('height') == '')) {
                                            $height = $user_detail['height'];
                                        }
                                        $heights = DB::table('heights')->where(['deleted_at' => NULL])->get();
                                        ?>
                                        <select name="height" id="height" class="form-control" aria-required="true">
                                            <option value="">Select height</option>
                                            @forelse($heights as $height)
                                            <option value="{{ $height->heightName }}">{{ $height->heightName}}</option>
                                            @empty
                                            <p>No Record</p>
                                            @endforelse
                                        </select>
                                        <?php if (isset($validation['height'])) { ?>
                                            <label class="error">{{ $validation['height'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Profile image: <span style="color: red;">*</span></label>
                                        <input type="file" id="image" name="image" class="form-control" aria-required="true" accept="image/*">
                                        <?php if (isset($validation['image'])) { ?>
                                            <label class="error">{{ $validation['image'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="">Select gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <?php if (isset($validation['gender'])) { ?>
                                            <label class="error">{{ $validation['gender'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="control-label">Password:</label>
                                        <input type="password" id="password" name="password" class="form-control" aria-required="true">
                                        <?php if (isset($validation['password'])) { ?>
                                            <label class="error">{{ $validation['password'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="natinality" class="control-label">Natinality:</label>
                                        <select class="form-control" id="natinality" name="natinality">
                                            <option value="">Select Country</option>
                                            <?php
                                            foreach ($countries as $value) {
                                                $sel = '';
                                                if ($country == $value->id) {
                                                    $sel = 'selected';
                                                }
                                            ?>
                                                <option value="{{ $value->id }}" <?php echo $sel; ?>>{{ $value->short_name }}</option>
                                            <?php } ?>
                                        </select>
                                        <?php if (isset($validation['natinality'])) { ?>
                                            <label class="error">{{ $validation['natinality'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="control-label"><b>Status</b>
                                            <font color="red">*</font>
                                        </p>
                                        <div class="radio radio-info form-check-inline">
                                            <input type="radio" id="active" value="1" name="status" <?php if (request('status') == '' || request('status') == '1') { echo 'checked'; } ?>>
                                            <label for="inlineRadio1"> Active </label>
                                        </div>
                                        <div class="radio radio-info form-check-inline">
                                            <input type="radio" id="inactive" value="0" name="status" <?php if (request('status') == '0') { echo 'checked'; } ?>>
                                            <label for="inlineRadio1"> Inactive </label>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>

                            <?php
                            if (count($health_conditions)) {
                                $health_condition = [];
                                if (request('health_condition')) {
                                    $health_condition = request('health_condition');
                                } elseif (!empty($user_detail) && (request('health_condition') == '')) {
                                    $health_condition = $user_detail['health_condition'];
                                }

                                foreach ($health_conditions as $hel) {
                                    $checked = '';
                                    if (in_array($hel->id, $health_condition)) {
                                        $checked = 'checked';
                                    }
                            ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="checkbox" id="chk_1" value="{{$hel->id}}" name="health_condition[]" <?php echo $checked; ?>>
                                            <span for="chk_1">{{$hel->name}}</span>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                            <?php if (isset($validation['health_condition'])) { ?>
                                <label class="error">{{ $validation['health_condition'] }}</label>
                            <?php } ?>

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
    $(document).ready(function() {
        $("#dob").datepicker({
            format: 'yyyy-mm-dd',
            // startDate: '+1d',
            autoclose: true,
            // showOn: "button",
            // buttonImage: "public/images/calender.png",
            // buttonImageOnly: true,
            // buttonText: "Select date",
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

        $('#region').change(function() {
            base_url = '<?php echo URL::to('/'); ?>';
            $region_id = $('#region').val();
            $('#region').val($region_id);
            $.post(base_url + '/get_city/' + $region_id, {
                "_token": "{{ csrf_token() }}",
                count: $region_id
            }, function(data) {
                $('#cities').html(data);
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
</script>