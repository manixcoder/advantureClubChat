<?php
$segment = Request::segment(3);
$base_url = URL::to('/');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">My Services > #{{$service->service_id}} > Participant</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 offset-1">
                <div class="box">
                    <div class="box-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="th">Booking ID :</td>
                                    <td>#{{$service->booking_id}}</td>
                                </tr>
                                <tr>
                                    <td class="th">User Name :</td>
                                    <td>{{$service->customer}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Nationality :</td>
                                    <td>{{$service->country}}</td>
                                </tr>
                                <tr>
                                    <td class="th">How Old :</td>
                                    <td>{{getOldAge($service->dob)}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Service Date :</td>
                                    <td>{{$service->service_date}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Registration :</td>
                                    <td>{{$service->adult}} Adults, {{$service->kids}} Youngsters</td>
                                </tr>
                                <tr>
                                    <td class="th">Unit cost :</td>
                                    <td>{{$service->currency.' '.$service->unit_cost}} </td>
                                </tr>
                                <tr>
                                    <td class="th">Total cost :</td>
                                    <td>{{$service->currency.' '.$service->total_cost}} </td>
                                </tr>
                                <tr>
                                    <td class="th">Payment Chanel :</td>
                                    <td>{{$service->payment_channel}} </td>
                                </tr>
                                <tr>
                                    <td class="th">Profile Pic :</td>
                                    <td>
                                        @if($service->profile_image !='')
                                        <img src="{{asset('public/profile_image/'.$service->profile_image)}}" class="user-image-thumb" />
                                        @else
                                        <img src="{{asset('public/uploads/profile.png')}}" class="user-image-thumb" />
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 service-right-section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="th">Health Condition :</td>
                                            <td><?php echo implode('<br>', array_column($service->dependencies, 'dependency_name')); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="th">Weight :</td>
                                            <td>{{$service->Weight}}</td>
                                        </tr>
                                        <tr>
                                            <td class="th">Height :</td>
                                            <td>{{$service->Height}}</td>
                                        </tr>
                                        <tr>
                                            <td class="th">Description :</td>
                                            <td>{{$service->message}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>