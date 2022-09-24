<?php
$segment = Request::segment(3);
$base_url = URL::to('/');
 // dd($service);
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Adventure Requests > #{{$segment}}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="th">Requests ID :</td>
                                    <td>#{{ $service->id }}</td>
                                </tr>
                                <tr>
                                    <td class="th">Company Name :</td>
                                    <td>{{ $service->company_name }}</td>
                                </tr>
                                <tr>
                                    <td class="th">Official Address :</td>
                                    <td>{{ $service->address }}</td>
                                </tr>
                                <tr>
                                    <td class="th">Country :</td>
                                    <td>{{ $service->country }}</td>
                                </tr>
                                <tr>
                                    <td class="th">Nationality :</td>
                                    <td>{{ $service->country }}</td>
                                </tr>
                                <tr>
                                    <td class="th">GeoLocation :</td>
                                    <td>{{ $service->location }}</td>
                                </tr>
                                <tr>
                                    <td class="th">Licensed :</td>
                                    <td>{{ $service->license }}</td>
                                </tr>
                                <tr>
                                    <td class="th">CR Name :</td>
                                    <td>{{ $service->cr_name }}</td>
                                </tr>
                                <tr>
                                    <td class="th">CR Number :</td>
                                    <td>{{ $service->cr_number }}</td>
                                </tr>
                                <tr>
                                    <td class="th">CR Copy :</td>
                                    <td>
                                        @if($service->cr_copy!='')
                                        <img src="{{ asset('public/').'/'.$service->cr_copy }}" alt="image" width="100" height="100">
                                        @else
                                        <img src="{{ asset('public/images/noImages.png') }}" alt="image" width="100" height="100">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="th">Partnership :</td>
                                    <td>{{ $service->title }}</td>
                                </tr>
                                <tr>
                                    <td class="th">Payment :</td>
                                    <td> {{ $service->title }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 service-right-section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="th">Requests On :</td>
                                                <td>{{ date("d M Y", strtotime($service->request_date))  }}</td>
                                            </tr>
                                            <tr>
                                                <td class="th">Payment Setup :</td>
                                                <td>
                                                    @if($service->debit_card == '1' )
                                                    {{ "debit card" }}
                                                    @endif

                                                    @if($service->visa_card)
                                                    {{ "visa card" }}
                                                    @endif

                                                    @if($service->payon_arrival)
                                                    {{ "payon arrival" }}
                                                    @endif

                                                    @if($service->paypal)
                                                    {{ "paypal" }}
                                                    @endif
                                                </td>
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
                                        <div class="col-md-4">
                                            <button  class="badge bg-blue" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                <i class="fa fa-bell"></i> &nbsp;&nbsp;<span class="text-blue">Notify</span>
                                            </button >
                                        </div>
                                        <div class="col-md-4">
                                    <a href="{{ URL::to('/partnership/accept/') }}/{{ $service->user_id }}" onclick="return confirm('Are you sure you want to accept this request ?')">
                                        <span class="badge bg-green"><i class="fa fa-check"></i> &nbsp;&nbsp;<span class="text-green">Accept</span></span>
                                    </a>
                                </div>
                                        <div class="col-md-4">
                                    <a href="{{ URL::to('/partnership/decline/') }}/{{ $service->user_id }}" onclick="return confirm('Are you sure you want to decline this request ?')">
                                        <span class="badge bg-red"><i class="fa fa-times" style="margin-left: 2px;"></i> &nbsp;&nbsp;<span class="text-red">Decline</span></span>
                                    </a>
                                </div>
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
                                @if($service->profile_image!='')
                                        <img src="{{ asset('public/uploads/').'/'.$service->profile_image }}" alt="image" width="100" height="100">
                                        @else
                                        <img src="{{ asset('public/images/noImages.png') }}" alt="image" width="100" height="100">
                                        @endif
                                <ul>
                                    <li>User Name : >{{ $service->name }}</li>
                                    <li>User Email : >{{ $service->email }}</li>
                                </ul>
                            </div>
                        </div>
                        <form method="post" action="{{ URL::to('/notify-user') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $service->user_id}}">
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

        </div>
    </div>