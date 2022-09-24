<?php
$segment = Request::segment(3);
$base_url = URL::to('/');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">My Services > #{{$segment}}</h4>
            </div>
        </div>
        <?php
        $serviceImagesData = DB::table('service_images')->where('service_id', $service->service_id)->orderBy('id', 'ASC')->get();
        ?>
        <div class="row">
            @forelse ($serviceImagesData as $serviceImages)
            <div class="col-md-3 booking-detail-banner">
                <img class="img-responsive" src="{{ URL::asset('/public/uploads/') }}/{{ $serviceImages->image_url }}" alt="Photo">
            </div>
            @empty
            <!-- <div class="col-md-3 booking-detail-banner">
                <img class="img-responsive" src="{{asset('public/walls/1.jpg')}}" alt="Photo">
            </div>

            <div class="col-md-3 booking-detail-banner">
                <img class="img-responsive" src="{{asset('public/walls/2.jpg')}}" alt="Photo">
            </div>
            <div class="col-md-3 booking-detail-banner">
                <img class="img-responsive" src="{{asset('public/walls/3.jpg')}}" alt="Photo">
            </div>
            <div class="col-md-3 booking-detail-banner">
                <img class="img-responsive" src="{{asset('public/walls/4.jpg')}}" alt="Photo">
            </div> -->
            @endforelse
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="th">Request ID :</td>
                                    <td>#{{$service->id}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Adventure Name :</td>
                                    <td>{{$service->adventure_name}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Country :</td>
                                    <td>{{$service->country}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Region :</td>
                                    <td>{{$service->region}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Service Sector :</td>
                                    <td>{{$service->service_sector}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Level :</td>
                                    <td>{{$service->service_level}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Duration :</td>
                                    <td>{{$service->duration}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Available Seats :</td>
                                    <td>{{$service->available_seats}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Availability :</td>
                                    <td>
                                        <?php
                                        if ($service->service_plan == 0) {
                                            foreach ($service->availability as $date) {
                                                echo date('d M,Y', strtotime($date->date)) . '<br>';
                                            }
                                        } elseif ($service->service_plan == 1) {
                                            echo implode(',', array_column($service->availability, 'day'));
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="th">Activities Includes :</td>
                                    <td><?php echo implode('<br>', array_column($service->included_activities, 'activity')); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Aimed for :</td>
                                    <td>{{$service->aimed_for}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Dependency :</td>
                                    <td><?php echo implode('<br>', array_column($service->dependencies, 'dependency_name')); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Start Date :</td>
                                    <td>{{date('d M Y',strtotime($service->start_date))}}</td>
                                </tr>
                                <tr>
                                    <td class="th">End Date :</td>
                                    <td>{{date('d M Y',strtotime($service->end_date))}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Informations :</td>
                                    <td>{{$service->write_information}}</td>
                                </tr>
                                <tr>
                                    <td class="th">T & C :</td>
                                    <td>{{$service->terms_conditions}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Pre-Requesits :</td>
                                    <td>{{$service->pre_requisites}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 service-right-section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="th">Min. Requirement :</td>
                                            <td>{{$service->minimum_requirements}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box">
                            <?php foreach ($service->programs as $prg) { ?>
                                <h3 class="box-title service-program-detail">
                                    <?php echo date('h:i A', strtotime($prg->start_datetime)) . ' - ' . date('h:i A', strtotime($prg->end_datetime)) . ' - ' . $prg->title; ?>
                                </h3>
                                <p class="prg-desc"><?php echo $prg->description; ?></p>
                            <?php } ?>
                            <div class="box-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="th">Address :</td>
                                            <td>{{$service->specific_address}}</td>
                                        </tr>
                                        <tr>
                                            <td class="th">Country :</td>
                                            <td>{{$service->country}}</td>
                                        </tr>
                                        <tr>
                                            <td class="th">Region :</td>
                                            <td>{{$service->region}}</td>
                                        </tr>
                                        <tr>
                                            <td class="th">Total cost :</td>
                                            <td>{{$service->cost_inc}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="star-div">
                                    <?php
                                    $blank_star = 5;
                                    for ($i = 1; $i <= floor($service->stars); $i++) {
                                        $blank_star = 5 - $i;
                                    ?>
                                        <span><i class="fa fa-star"></i></span>
                                        <?php
                                    }
                                    if ($blank_star > 0) {
                                        for ($j = 1; $j <= $blank_star; $j++) {
                                        ?>
                                            <span><i class="fa fa-star-o"></i></span>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <span class="star-review-span">{{$service->stars}} ({{$service->reviewd_by}} Reviews)</span>
                                </div>
                            </div>
                            <!--<div class="col-md-6">
                                <div class="star-div pull-right">
                                    <a href="{{URL::to('/service/reviews/'.$service->id)}}">
                                        <span class="badge bg-blue view-all-icon"><i class="fa fa-eye"></i> </span><span class="text-blue">&nbsp;&nbsp;See All</span>
                                    </a>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="datatable-responsive" class="table table-striped table-bordered" style="border: none;">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>User Name</th>
                            <th>Nationality</th>
                            <th>Service Date</th>
                            <th>Registrations</th>
                            <th>Total Cost</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $services = $bookings;
                        if (count($services)) {
                            foreach ($services as $bkng) {
                        ?>
                                <tr>
                                    <td>#{{$bkng->booking_id}}</td>
                                    <td>{{$bkng->customer}}</td>
                                    <td>{{$bkng->country}}</td>
                                    <td>{{date('d M, Y',strtotime($bkng->booking_date))}}</td>
                                    <td>{{$bkng->adult}} Adults, <br> {{$bkng->kids}} Youngsters</td>
                                    <td><strong>{{$bkng->currency.' '.$bkng->total_cost}}</strong></td>

                                    <td>
                                        <?php if ($bkng->status == 1) { ?>
                                            <span class="text-green">{{$bkng->booking_status_text}}</span>
                                        <?php } elseif ($bkng->status == 2) { ?>
                                            <span class="text-red">{{$bkng->booking_status_text}}</span>
                                        <?php } else { ?>
                                            <span class="text-yellow">{{$bkng->booking_status_text}}</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <ul class="edit_icon action_icons dashboard_icons">
                                            <li><a href="{{URL::to('service/participant/'.$bkng->booking_id)}}" style="background: #1C3947;"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="#" style="background: #1D7FFF;"><i class="fa fa-comments"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>