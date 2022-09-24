<?php
$segment = Request::segment(3);
$base_url = URL::to('/');
 if($service->nationality_id !='' ){
   $countriesData = DB::table('countries')->where(['id' => $service->nationality_id])->first();
   $nationality = $countriesData->short_name;

 }else{
    $nationality="";
 }

 $bookingUserData = DB::table('users')
            ->select(['users.*', 'countries.country', 'regions.region'])
            ->leftJoin('countries', 'users.country_id', '=', 'countries.id')
            ->leftJoin('regions', 'users.country_id', '=', 'regions.country_id')
            ->where('users.id', $service->booking_user)
            ->first();
        //dd($editdata);

        $health_conditions = $bookingUserData->health_conditions ? explode(',', $bookingUserData->health_conditions) : [];
        if (count($health_conditions)) {
            $cond = DB::table('health_conditions')
                ->select(['name'])
                ->whereIn('id', $health_conditions)->get();
            $bookingUserData->health_conditions = $cond;
        }
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">My Services > #{{$segment}}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <section class="content-header">
                    <ol class="breadcrumb" style="padding-left: 0">
                        <li class="active">{{$service->category}}</li>
                    </ol>
                </section>
            </div>
            <div class="col-sm-6">
                <section class="content-header">
                    <ol class="breadcrumb pull-right booking-detail-booked-on" style="padding-right: 0">
                        <li>Booked on : {{date('d M, Y | h:i',strtotime($service->booked_on))}}</li>
                    </ol>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 booking-detail-banner">
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="th">Adventure Name :</td>
                                    <td>{{$service->adventure_name}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Booking Id :</td>
                                    <td>{{$service->booking_id}}</td>
                                </tr>
                                <tr>
                                    <td class="th">User Name :</td>
                                    <td>{{$service->customer}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Nationality :</td>
                                    <td>{{ $nationality }}</td>
                                </tr>
                                 <tr>
                                    <td class="th">country :</td>
                                    <td>{{ $service->country }}</td>
                                </tr>
                                <tr>
                                    <td class="th">How Old :</td>
                                    <td>{{getOldAge($service->dob)}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Service Date :</td>
                                    <td>{{date('d M, Y',strtotime($service->service_date))}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Registrations :</td>
                                    <td>{{$service->adult}} Adults, {{$service->kids}} Youngsters</td>
                                </tr>
                                <tr>
                                    <td class="th">Unit Cost :</td>
                                    <td>{{$service->currency.' '.$service->unit_cost}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Total Cost :</td>
                                    <td>{{$service->currency.' '.$service->total_cost}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Payment Chanel :</td>
                                    <td>{{$service->payment_channel??'N/A'}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Health Condition :</td>
                                    <td><?php foreach ($bookingUserData->health_conditions as $hc) { ?>
                                            <li>{{$hc->name}}</li>
                                        <?php } ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Height & Weight :</td>
                                    <td>{{$service->height}} | {{$service->weight}}</td>
                                </tr>
                                <tr>
                                    <td class="th">Client Message :</td>
                                    <td>{{$service->message}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-4">
                                <span class="badge bg-blue"><i class="fa fa-comments"></i> &nbsp;&nbsp;<span class="text-blue">Status : <?php if ($service->status == 0){ echo "Requested";}else if($service->status == 1){ echo "Payment Done";}else if($service->status == 2){ echo "Cancelled";}else if($service->status == 3){ echo "Accepted";} ?></span></span>
                            </div>

                            <div class="col-md-4">
                                <span class="badge bg-blue"><i class="fa fa-comments"></i> &nbsp;&nbsp;<span class="text-blue">Chat Client</span></span>
                            </div>

                            <div class="col-md-4">
                                <button  class="badge bg-blue" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-bell"></i> &nbsp;&nbsp;<span class="text-blue">Notify</span>
                                </button >
                            </div>
                            <?php
                            if ($service->status == 0) {
                            ?>
                                <div class="col-md-4">
                                    <a href="{{URL::to('booking/accept/'.$service->booking_id)}}" onclick="return confirm('Are you sure you want to accept this request ?')">
                                        <span class="badge bg-green"><i class="fa fa-check"></i> &nbsp;&nbsp;<span class="text-green">Accept</span></span>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{URL::to('booking/decline/'.$service->booking_id)}}" onclick="return confirm('Are you sure you want to decline this request ?')">
                                        <span class="badge bg-red"><i class="fa fa-times" style="margin-left: 2px;"></i> &nbsp;&nbsp;<span class="text-red">Decline</span></span>
                                    </a>
                                </div>
                            <?php } else if ($service->status == 1) {
                            ?>
                                <div class="col-md-4">
                                    <span class="text-green">{{$service->booking_status_text}}</span>
                                </div>
                            <?php } else if ($service->status == 2) {
                            ?>
                                <div class="col-md-4">
                                    <span class="text-red">{{$service->booking_status_text}}</span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Notify to</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="profile section">
                            <div class="profile_image">
                                <img src="{{ URL::to('/public/uploads/') }}/{{ $service->profile_image }}" >
                                <ul>
                                    <li>User Name : {{ $service->customer }}</li>
                                    <li>User Email : {{ $service->email }}</li>
                                </ul>
                            </div>
                        </div>
                        <form method="post" action="{{ URL::to('/notify-user') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$service->booking_user}}">
                            <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
                        <div class="modal-body">
                            <input type="text" name="title" placeholder="notify title"></br>

                            <textarea name="message" placeholder="Write message to notify...……..."></textarea>
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>