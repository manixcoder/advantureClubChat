<div class="content add_adventure_users">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title"><a href="{{URL::to('services')}}">My Services</a> > Create Service</h4>
            </div>
        </div>
        <form action="{{ URL::to('services/add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row" id="example-basic">
                <div class="col-md-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="box-header with-border" style="margin-bottom: 15px;">
                                <h4 class="box-title">Description</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php
                                        $owner = '';
                                        if (request('owner')) {
                                            $owner = request('owner');
                                        } elseif (!empty($service_detail) && (request('owner') == '')) {
                                            $owner = $service_detail['owner'];
                                        }
                                        ?>
                                        <select class="form-control" id="owner" name="owner">
                                            <option value=''>Select owner</option>

                                            <?php
                                            foreach ($vendors as $ven) {
                                                $sel = '';
                                                if ($owner == $ven['id']) {
                                                    $sel = 'selected';
                                                }
                                            ?>
                                                <option value='<?php echo $ven['id']; ?>' <?= $sel ?>><?php echo $ven['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if (isset($validation['owner'])) { ?>
                                            <label class="error">{{ $validation['owner'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 text-center">
                                            <img class="img-responsive" id="banner1" src="https://picsum.photos/seed/picsum/500/180" alt="Photo">
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <img class="img-responsive" id="banner2" src="https://picsum.photos/seed/picsum/500/180" alt="Photo">
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <img class="img-responsive" id="banner3" src="https://picsum.photos/seed/picsum/500/180" alt="Photo">
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <img class="img-responsive" id="banner4" src="https://picsum.photos/seed/picsum/500/180" alt="Photo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="file" id="banners" name="banners[]" class="form-control" multiple>
                                        <?php if (isset($validation['banners'])) { ?>
                                            <label class="error">{{ $validation['banners'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        $adventure_name = '';
                                        if (request('adventure_name')) {
                                            $adventure_name = request('adventure_name');
                                        } elseif (!empty($service_detail) && (request('adventure_name') == '')) {
                                            $adventure_name = $service_detail['name'];
                                        }
                                        ?>
                                        <input type="text" id="adventure_name" name="adventure_name" class="form-control" value="{{$adventure_name}}" placeholder="Adventure Name">
                                        <?php if (isset($validation['adventure_name'])) { ?>
                                            <label class="error">{{ $validation['adventure_name'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">

                                        <?php
                                        $service_sector = '';
                                        if (request('service_sector')) {
                                            $service_sector = request('service_sector');
                                        } elseif (!empty($service_sector) && (request('service_sector') == '')) {
                                            $service_sector = $service_detail['service_sector'];
                                        }
                                        ?>
                                        <select class="form-control" id="service_sector" name="service_sector">
                                            <option value=''>Service sector</option>
                                            <?php
                                            foreach ($sectors as $sec) {
                                                $sel = '';
                                                if ($service_sector == $sec['id']) {
                                                    $sel = 'selected';
                                                }
                                            ?>
                                                <option value='<?= $sec['id'] ?>' <?= $sel ?>><?= $sec['sector'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if (isset($validation['service_sector'])) { ?>
                                            <label class="error">{{ $validation['service_sector'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        $country = '';
                                        if (request('country')) {
                                            $country = request('country');
                                        } elseif (!empty($service_detail) && (request('country') == '')) {
                                            $country = $service_detail['country'];
                                        }
                                        ?>
                                        <select class="form-control" id="country" name="country">
                                            <option value=''>Select country</option>
                                            <?php
                                            foreach ($countries as $cntri) {
                                                $sel = '';
                                                if ($country == $cntri['id']) {
                                                    $sel = 'selected';
                                                }
                                            ?>
                                                <option value='<?= $cntri['id'] ?>' <?= $sel ?>><?= $cntri['country'] ?></option>
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
                                        $region = [];
                                        if (request('region')) {
                                            $region = request('region');
                                        } elseif (!empty($service_detail) && (request('region') == '')) {
                                            $region = explode(',', $service_detail['region']);
                                        }
                                        ?>
                                        <select class="form-control" id="region" name="region">
                                            <option value=''>Select region</option>
                                        </select>
                                        <?php if (isset($validation['region'])) { ?>
                                            <label class="error">{{ $validation['region'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        $service_category = '';
                                        if (request('service_category')) {
                                            $service_category = request('service_category');
                                        } elseif (!empty($service_detail) && (request('service_category') == '')) {
                                            $service_category = $service_detail['service_category'];
                                        }
                                        ?>
                                        <select class="form-control" id='service_category' name='service_category'>
                                            <option value=''>Service category</option>
                                            <?php
                                            foreach ($categories as $cat) {
                                                $sel = '';
                                                if ($service_category == $cat['id']) {
                                                    $sel = 'selected';
                                                }
                                            ?>
                                                <option value='<?= $cat['id'] ?>' <?= $sel ?>><?= $cat['category'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if (isset($validation['service_category'])) { ?>
                                            <label class="error">{{ $validation['service_category'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        $service_type = '';
                                        if (request('service_type')) {
                                            $service_type = request('service_type');
                                        } elseif (!empty($service_detail) && (request('service_type') == '')) {
                                            $service_type = $service_detail['service_type'];
                                        }
                                        ?>
                                        <select class="form-control" id='service_type' name='service_type'>
                                            <option value=''>Service type</option>
                                            <?php
                                            foreach ($types as $typ) {
                                                $sel = '';
                                                if ($service_type == $typ['id']) {
                                                    $sel = 'selected';
                                                }
                                            ?>
                                                <option value='<?= $typ['id'] ?>' <?= $sel ?>><?= $typ['type'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if (isset($validation['service_type'])) { ?>
                                            <label class="error">{{ $validation['service_type'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        $service_level = '';
                                        if (request('service_level')) {
                                            $service_level = request('service_level');
                                        } elseif (!empty($service_detail) && (request('service_level') == '')) {
                                            $service_level = $service_detail['service_level'];
                                        }
                                        ?>
                                        <select class="form-control" id='service_level' name='service_level'>
                                            <option value=''>Service level</option>
                                            <?php
                                            foreach ($levels as $lvl) {
                                                $sel = '';
                                                if ($service_level == $lvl['id']) {
                                                    $sel = 'selected';
                                                }
                                            ?>
                                                <option value='<?= $lvl['id'] ?>' <?= $sel ?>><?= $lvl['level'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if (isset($validation['service_level'])) { ?>
                                            <label class="error">{{ $validation['service_level'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        $duration = '';
                                        if (request('duration')) {
                                            $duration = request('duration');
                                        } elseif (!empty($service_detail) && (request('duration') == '')) {
                                            $duration = $service_detail['duration'];
                                        }
                                        ?>
                                        <select class="form-control" id="duration" name='duration'>
                                            <option value=''>Duration</option>
                                            <?php
                                            foreach ($durations as $dur) {
                                                $sel = '';
                                                if ($duration == $dur->id) {
                                                    $sel = 'selected';
                                                }
                                            ?>
                                                <option value='<?= $dur->id ?>' <?= $sel ?>><?= $dur->duration ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if (isset($validation['duration'])) { ?>
                                            <label class="error">{{ $validation['duration'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        $available_seats = '';
                                        if (request('available_seats')) {
                                            $available_seats = request('available_seats');
                                        } elseif (!empty($service_detail) && (request('available_seats') == '')) {
                                            $available_seats = $service_detail['available_seats'];
                                        }
                                        ?>
                                        <input type="text" id="available_seats" name="available_seats" class="form-control" value="{{$available_seats}}" placeholder="Available Seats">
                                        <?php if (isset($validation['available_seats'])) { ?>
                                            <label class="error">{{ $validation['available_seats'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        $activities = [];
                                        if (request('activities')) {
                                            $activities = request('activities');
                                        } elseif (!empty($service_detail) && (request('activities') == '')) {
                                            $activities = explode(',', $service_detail['activities']);
                                        }
                                        ?>
                                        <select class="form-control" id="activities" name="activities[]" multiple>
                                            <option value=''>Select activities</option>

                                            <?php
                                            foreach ($activities_list as $act) {
                                                $sel = '';
                                                if (in_array($act->id, $activities)) {
                                                    $sel = 'selected';
                                                }
                                            ?>
                                                <option value='<?php echo $act->id; ?>' <?= $sel ?>><?php echo $act->activity; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if (isset($validation['activities'])) { ?>
                                            <label class="error">{{ $validation['activities'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php
                                        $write_information = '';
                                        if (request('write_information')) {
                                            $write_information = request('write_information');
                                        } elseif (!empty($service_detail) && (request('write_information') == '')) {
                                            $write_information = $service_detail['write_information'];
                                        }
                                        ?>
                                        <textarea class="form-control" id="write_information" name='write_information' rows="7" placeholder="Write information">{{$write_information}}</textarea>
                                        <?php if (isset($validation['write_information'])) { ?>
                                            <label class="error">{{ $validation['write_information'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label service-plan-label">Is recommended</label>
                                        <div class="row">
                                            <?php
                                            $recommended = '';
                                            if (request('recommended')) {
                                                $recommended = request('recommended');
                                            } elseif (!empty($service_detail) && (request('recommended') == '')) {
                                                $recommended = $service_detail['recommended'];
                                            }
                                            ?>
                                            <div class="col-md-4">
                                                <input type="radio" name="recommended" id="recommended" value="1" <?php
                                                                                                                    if ($recommended == 1) {
                                                                                                                        echo 'checked';
                                                                                                                    }
                                                                                                                    ?>>
                                                Yes
                                            </div>
                                            <div class="col-md-4">
                                                <input type="radio" name="recommended" id="recommended" value="2" <?php
                                                                                                                    if ($recommended == 2) {
                                                                                                                        echo 'checked';
                                                                                                                    }
                                                                                                                    ?>>
                                                No
                                            </div>
                                            <div class="col-md-12">
                                                <?php if (isset($validation['recommended'])) { ?>
                                                    <label class="error">{{ $validation['recommended'] }}</label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label service-plan-label">Service Plan</label>
                                        <div class="row">
                                            <?php
                                            $service_plan = '';
                                            if (request('service_plan')) {
                                                $service_plan = request('service_plan');
                                            } elseif (!empty($service_detail) && (request('service_plan') == '')) {
                                                $service_plan = $service_detail['service_plan'];
                                            }

                                            foreach ($service_plans as $splan) {
                                                $checked = '';
                                                if ($service_plan == $splan->id) {
                                                    $checked = 'checked';
                                                }
                                            ?>
                                                <div class="col-md-4">
                                                    <input type="radio" name="service_plan" class="service_plan_radio" id="service_plan1" value="{{$splan->id}}" <?= $checked ?>>
                                                    {{$splan->title}}
                                                </div>
                                            <?php } ?>
                                            <div class="col-md-12">
                                                <?php if (isset($validation['service_plan'])) { ?>
                                                    <label class="error">{{ $validation['service_plan'] }}</label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="row weekdays-row weekdays_div" style="display:none">
                                            <div class="col-md-12 inline-checkboxes">
                                                <?php
                                                $service_plan_days = [];
                                                if (request('service_plan_days')) {
                                                    $service_plan_days = request('service_plan_days');
                                                } elseif (!empty($service_detail) && (request('service_plan_days') == '')) {
                                                    $service_plan_days = $service_detail['service_plan_days'];
                                                }
                                                foreach ($weekdays as $wd) {
                                                    $checked = '';
                                                    if (in_array($wd->id, $service_plan_days)) {
                                                        $checked = 'checked';
                                                    }
                                                ?>
                                                    <div class="checkbox-cus">
                                                        <input type="checkbox" name='service_plan_days[]' value="{{$wd->id}}" <?= $checked ?>>
                                                        {{$wd->day}}
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="row calender_days_div" style="display:none">
                                            <?php
                                            $particular_date = '';
                                            if (request('particular_date')) {
                                                $particular_date = request('particular_date');
                                            } elseif (!empty($service_detail) && (request('particular_date') == '')) {
                                                $particular_date = $service_detail['particular_date'];
                                            }
                                            ?>
                                            <div class="col-md-12">
                                                <input type="text" id="particular_date" name="particular_date" class="form-control datepicker" value="<?php echo $particular_date; ?>" placeholder="Select multiple date" readonly>
                                            </div>
                                        </div>
                                        <?php if (isset($validation['service_plan_days'])) { ?>
                                            <label class="error">{{ $validation['service_plan_days'] }}</label>
                                        <?php } elseif (isset($validation['particular_date'])) { ?>
                                            <label class="error">{{ $validation['particular_date'] }}</label>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label service-plan-label">Service For</label>
                                        <div class="row weekdays-row">
                                            <div class="col-md-12 inline-checkboxes">
                                                <?php
                                                $sservice_for = [];
                                                if (request('service_for')) {
                                                    $sservice_for = request('service_for');
                                                } elseif (!empty($service_detail) && (request('service_for') == '')) {
                                                    $sservice_for = $service_detail['service_for'];
                                                }
                                                foreach ($service_for as $sfor) {
                                                    $checked = '';
                                                    if (in_array($sfor->id, $sservice_for)) {
                                                        $checked = 'checked';
                                                    }
                                                ?>
                                                    <div class="checkbox-cus">
                                                        <input type="checkbox" name='service_for[]' value='{{$sfor->id}}' <?= $checked ?>>
                                                        {{$sfor->sfor}}
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php if (isset($validation['service_for'])) { ?>
                                            <label class="error">{{ $validation['service_for'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label service-plan-label">Dependency</label>
                                        <div class="row weekdays-row">
                                            <div class="col-md-12 inline-checkboxes">
                                                <?php
                                                $dependency = [];
                                                if (request('dependency')) {
                                                    $dependency = request('dependency');
                                                } elseif (!empty($service_detail) && (request('dependency') == '')) {
                                                    $dependency = $service_detail['dependency'];
                                                }
                                                foreach ($dependencies as $dep) {
                                                    $checked = '';
                                                    if (in_array($dep->id, $dependency)) {
                                                        $checked = 'checked';
                                                    }
                                                ?>
                                                    <div class="checkbox-cus">
                                                        <input type="checkbox" name="dependency[]" value="{{$dep->id}}" <?= $checked ?>>
                                                        {{$dep->dependency_name}}
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php if (isset($validation['dependency'])) { ?>
                                            <label class="error">{{ $validation['dependency'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="field-1" class="control-label service-plan-label">Program</label>
                                    <div class="row add-more-parent-div">
                                        <?php
                                        if (request('schedule_title')) {
                                            $schedule_title = request('schedule_title');
                                            $gathering_date = request('gathering_date');
                                            $gathering_start_time = request('gathering_start_time');
                                            $gathering_end_time = request('gathering_end_time');
                                            $program_description = request('program_description');
                                            foreach ($schedule_title as $key => $val) {
                                        ?>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <?php
                                                                $s_title = $schedule_title[$key] ?? '';
                                                                $g_date = $gathering_date[$key] ?? '';
                                                                $g_stime = $gathering_start_time[$key] ?? '';
                                                                $g_etime = $gathering_end_time[$key] ?? '';
                                                                $p_desc = $program_description[$key] ?? '';
                                                                ?>
                                                                <input type="text" class="form-control" id="schedule_title" name='schedule_title[]' placeholder="Schedule Title" value="{{$s_title}}">
                                                                <?php if (isset($validation['schedule_title'])) { ?>
                                                                    <label class="error">{{ $validation['schedule_title'] }}</label>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control cursor-pointer gathering_datepicker" name='gathering_date[]' placeholder="Gathering Date" value="{{$g_date}}" readonly>
                                                                <?php if (isset($validation['gathering_date'])) { ?>
                                                                    <label class="error">{{ $validation['gathering_date'] }}</label>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control cursor-pointer gathering_start_time" name='gathering_start_time[]' placeholder="Start Time" value="{{$g_stime}}" readonly>
                                                                <?php if (isset($validation['gathering_start_time'])) { ?>
                                                                    <label class="error">{{ $validation['gathering_start_time'] }}</label>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control cursor-pointer gathering_end_time" name='gathering_end_time[]' placeholder="End Time" value="{{$g_etime}}" readonly>
                                                                <?php if (isset($validation['gathering_end_time'])) { ?>
                                                                    <label class="error">{{ $validation['gathering_end_time'] }}</label>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php
                                                        $program_description = [];
                                                        if (request('program_description')) {
                                                            $program_description = request('program_description');
                                                        } elseif (!empty($service_detail) && (request('program_description') == '')) {
                                                            $program_description = $service_detail['program_description'];
                                                        }
                                                        ?>
                                                        <textarea class="form-control" rows="7" id='program_description' name='program_description[]' placeholder="Program description">{{$p_desc}}</textarea>
                                                        <?php if (isset($validation['program_description'])) { ?>
                                                            <label class="error">{{ $validation['program_description'] }}</label>
                                                        <?php } ?>
                                                    </div>
                                                </div> <?php
                                                    }
                                                } else {
                                                        ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <?php
                                                            $schedule_title = [];
                                                            if (request('schedule_title')) {
                                                                $schedule_title = request('schedule_title');
                                                            } elseif (!empty($service_detail) && (request('schedule_title') == '')) {
                                                                $schedule_title = $service_detail['schedule_title'];
                                                            }
                                                            ?>
                                                            <input type="text" class="form-control" id="schedule_title" name='schedule_title[]' placeholder="Schedule Title" value="" required="">
                                                            <?php if (isset($validation['schedule_title'])) { ?>
                                                                <label class="error">{{ $validation['schedule_title'] }}</label>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <?php
                                                            $gathering_date = [];
                                                            if (request('gathering_date')) {
                                                                $gathering_date = request('gathering_date');
                                                            } elseif (!empty($service_detail) && (request('gathering_date') == '')) {
                                                                $gathering_date = $service_detail['gathering_date'];
                                                            }
                                                            ?>
                                                            <input type="text" class="form-control cursor-pointer gathering_datepicker" name='gathering_date[]' placeholder="Gathering Date" value="" readonly required="">
                                                            <?php if (isset($validation['gathering_date'])) { ?>
                                                                <label class="error">{{ $validation['gathering_date'] }}</label>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <?php
                                                            $gathering_start_time = [];
                                                            if (request('gathering_start_time')) {
                                                                $gathering_start_time = request('gathering_start_time');
                                                            } elseif (!empty($service_detail) && (request('gathering_start_time') == '')) {
                                                                $gathering_start_time = $service_detail['gathering_start_time'];
                                                            }
                                                            ?>
                                                            <input type="text" class="form-control cursor-pointer gathering_start_time" name='gathering_start_time[]' placeholder="Start Time" value="" readonly required="">
                                                            <?php if (isset($validation['gathering_start_time'])) { ?>
                                                                <label class="error">{{ $validation['gathering_start_time'] }}</label>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <?php
                                                            $gathering_end_time = [];
                                                            if (request('gathering_end_time')) {
                                                                $gathering_end_time = request('gathering_end_time');
                                                            } elseif (!empty($service_detail) && (request('gathering_end_time') == '')) {
                                                                $gathering_end_time = $service_detail['gathering_end_time'];
                                                            }
                                                            ?>
                                                            <input type="text" class="form-control cursor-pointer gathering_end_time" name='gathering_end_time[]' placeholder="End Time" value="" readonly required="">
                                                            <?php if (isset($validation['gathering_end_time'])) { ?>
                                                                <label class="error">{{ $validation['gathering_end_time'] }}</label>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                    $program_description = [];
                                                    if (request('program_description')) {
                                                        $program_description = request('program_description');
                                                    } elseif (!empty($service_detail) && (request('program_description') == '')) {
                                                        $program_description = $service_detail['program_description'];
                                                    }
                                                    ?>
                                                    <textarea class="form-control" rows="7" id='program_description' name='program_description[]' placeholder="Program description"></textarea>
                                                    <?php if (isset($validation['program_description'])) { ?>
                                                        <label class="error">{{ $validation['program_description'] }}</label>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default pull-right add-more-btn"><i class="fa fa-plus-circle"></i>&nbsp;Add more program</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label service-plan-label">Cost/GeoLoc</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <?php
                                                $specific_address = '';
                                                if (request('specific_address')) {
                                                    $specific_address = request('specific_address');
                                                } elseif (!empty($service_detail) && (request('specific_address') == '')) {
                                                    $specific_address = $service_detail['specific_address'];
                                                }
                                                ?>
                                                <input type="text" class="form-control" id="specific_address" name='specific_address' placeholder="Type Specific Address/Location" value="{{$specific_address}}">
                                                <?php if (isset($validation['specific_address'])) { ?>
                                                    <label class="error">{{ $validation['specific_address'] }}</label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <?php
                                            $cost_inc = '';
                                            if (request('cost_inc')) {
                                                $cost_inc = request('cost_inc');
                                            } elseif (!empty($service_detail) && (request('cost_inc') == '')) {
                                                $cost_inc = $service_detail['cost_inc'];
                                            }
                                            ?>
                                            <input type="text" class="form-control" id="cost_inc" name='cost_inc' placeholder="Set Cost" value="{{$cost_inc}}">
                                            <small>Including gears and other taxes</small>
                                            <?php if (isset($validation['cost_inc'])) { ?>
                                                <label class="error">{{ $validation['cost_inc'] }}</label>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?php
                                            $cost_exc = '';
                                            if (request('cost_exc')) {
                                                $cost_exc = request('cost_exc');
                                            } elseif (!empty($service_detail) && (request('cost_exc') == '')) {
                                                $cost_exc = $service_detail['cost_exc'];
                                            }
                                            ?>
                                            <input type="text" class="form-control" id="cost_exc" name='cost_exc' placeholder="Set Cost" value="{{$cost_exc}}">
                                            <small>Excluding gears and other taxes</small>
                                            <?php if (isset($validation['cost_exc'])) { ?>
                                                <label class="error">{{ $validation['cost_exc'] }}</label>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?php
                                            $currencies = '';
                                            if (request('currency')) {
                                                $currencies = request('currency');
                                            } elseif (!empty($service_detail) && (request('currency') == '')) {
                                                $currencies = $service_detail['currency'];
                                            }
                                            ?>
                                            <select class="form-control" id="currency" name='currency'>
                                                <option value="">Select Currency</option>
                                                <?php
                                                foreach ($currencies as $curr) {
                                                    $sel = '';
                                                    if ($currency == $curr['id']) {
                                                        $sel = 'selected';
                                                    }
                                                ?>
                                                    <option value="{{@$curr['id']}}" <?= $sel ?>><?php echo @$curr['currency'] . ' (' . @$curr['country'] . ')'; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if (isset($validation['currency'])) { ?>
                                                <label class="error">{{ @$validation['currency'] }}</label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php if (isset($validation['title'])) { ?>
                                        <label class="error">{{ @$validation['title'] }}</label>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $pre_requisites = '';
                                    if (request('pre_requisites')) {
                                        $pre_requisites = request('pre_requisites');
                                    } elseif (!empty($service_detail) && (request('pre_requisites') == '')) {
                                        $pre_requisites = $service_detail['pre_requisites'];
                                    }
                                    ?>
                                    <textarea class="form-control" rows="7" id='pre_requisites' name='pre_requisites' placeholder="Type Pre-Requisites...">{{$pre_requisites}}</textarea>
                                    <?php if (isset($validation['pre_requisites'])) { ?>
                                        <label class="error">{{ $validation['pre_requisites'] }}</label>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $minimum_requirements = '';
                                    if (request('minimum_requirements')) {
                                        $minimum_requirements = request('minimum_requirements');
                                    } elseif (!empty($service_detail) && (request('minimum_requirements') == '')) {
                                        $minimum_requirements = $service_detail['minimum_requirements'];
                                    }
                                    ?>
                                    <textarea class="form-control" rows="7" id='minimum_requirements' name='minimum_requirements' placeholder="Type Minimum Requirement...">{{$minimum_requirements}}</textarea>
                                    <?php if (isset($validation['minimum_requirements'])) { ?>
                                        <label class="error">{{ $validation['minimum_requirements'] }}</label>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $terms_conditions = '';
                                    if (request('terms_conditions')) {
                                        $terms_conditions = request('terms_conditions');
                                    } elseif (!empty($service_detail) && (request('terms_conditions') == '')) {
                                        $terms_conditions = $service_detail['terms_conditions'];
                                    }
                                    ?>
                                    <textarea class="form-control" rows="7" id="terms_conditions" name='terms_conditions' placeholder="Type Terms & Conditions...">{{$terms_conditions}}</textarea>
                                    <?php if (isset($validation['terms_conditions'])) { ?>
                                        <label class="error">{{ $validation['terms_conditions'] }}</label>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="cancel" class="btn btn-default cancel"><a href="{{url()->previous()}}">Cancel</a></button>
                            <button type="submit" id="submit" class="btn btn-primary save">Save</button>
                        </div>
                    </div><!-- End card-body -->
                </div> <!-- End card -->
        </form><!-- Form End -->
    </div><!-- container -->
</div>
</div>
<div class="add-more-program-div-content" style="display:none">
    <div class="col-md-12">
        <div class="alert close-program-btn">
            <button type="button" class="close remove-program-btn">×</button>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name='schedule_title[]' placeholder="Schedule Title" value="" required="">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control cursor-pointer gathering_datepicker" name='gathering_date[]' placeholder="Gathering Date" value="" readonly required="">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control cursor-pointer gathering_start_time" name='gathering_start_time[]' placeholder="Gathering Start Time" value="" readonly required="">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control cursor-pointer gathering_end_time" name='gathering_end_time[]' placeholder="Gathering End Time" value="" readonly required="">
                </div>
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="7" name='program_description[]' placeholder="Program description"></textarea>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#start_date").datepicker({
            format: 'yyyy-mm-dd',
            startDate: '+1d',
            autoclose: true,
        }).on('changeDate', function(ev) {
            var next_date = new Date(ev.date);
            next_date.setDate(next_date.getDate() + 1);
            $("#end_date").datepicker({
                format: 'yyyy-mm-dd',
                startDate: next_date,
                autoclose: true,
            });
        });
    });
    $(document).ready(function() {
        var date = new Date();
        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        $(".gathering_datepicker").datepicker({
            format: 'yyyy-mm-dd',
            startDate: '+1d',
            autoclose: true,
        });
        $("#particular_date").datepicker({
            format: 'yyyy-mm-dd',
            startDate: '+1d',
            endDate: lastDay,
            multidate: true
        });
        $('.gathering_start_time').timepicker({
            pickDate: false,
            format: 'H:mm',
            showMeridian: false,
            minuteStep: 15

        });
        $('.gathering_end_time').timepicker({
            pickDate: false,
            format: 'H:mm',
            showMeridian: false,
            minuteStep: 15

        });
        $('.add-more-btn').click(function() {
            $('.add-more-parent-div').append($('.add-more-program-div-content').html());
            $(".gathering_datepicker").datepicker({
                format: 'yyyy-mm-dd',
                startDate: '+1d',
                autoclose: true,
            });
            $('.gathering_start_time').timepicker({
                pickDate: false,
                format: 'H:mm',
                showMeridian: false,
                minuteStep: 15

            });
            $('.gathering_end_time').timepicker({
                pickDate: false,
                format: 'H:mm',
                showMeridian: false,
                minuteStep: 15

            });
        });
        $('.service_plan_radio').change(function() {
            if ($(this).val() == 1) {
                $('.calender_days_div').hide();
                $('.weekdays_div').show();
            } else if ($(this).val() == 2) {
                $('.calender_days_div').show();
                $('.weekdays_div').hide();
            }
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

        $("#banners").change(function() {
            var $fileUpload = $("#banners");
            if (parseInt($fileUpload.get(0).files.length) > 4) {
                alert("You are only allowed to upload a maximum of 4 files");
                $("#banners").val('');
                return false;
            } else {
                var allFiles = this.files;
                jQuery.each(allFiles, function(i, file) {
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function(event) {
                            $('#banner' + ++i).attr('src', event.target.result);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    });
    $(document).on('click', '.remove-program-btn', function() {
        if (confirm('Are you sure you want to remove this program?')) {
            $(this).parent().parent().remove();
        }
    });


    <?php if (request('country')) { ?>

        base_url = '<?php echo URL::to('/'); ?>';
        $country_id = <?php echo request('country'); ?>;
        $region = <?php echo request('region'); ?>;
        $('#currency').val($country_id);
        $.post(base_url + '/get_regions/' + $country_id, {
            "_token": "{{ csrf_token() }}",
            count: $country_id,
            region: $region
        }, function(data) {
            $('#region').html(data);
        });
    <?php
    }
    if (request('service_plan')) {
    ?>
        var service_plan_val = <?php echo request('service_plan'); ?>;
        if (service_plan_val == 1) {
            $('.calender_days_div').hide();
            $('.weekdays_div').show();
        } else if (service_plan_val == 2) {
            $('.calender_days_div').show();
            $('.weekdays_div').hide();

        }
    <?php } ?>
</script>