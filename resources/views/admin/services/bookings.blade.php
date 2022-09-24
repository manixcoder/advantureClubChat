<?php
$segment = Request::segment(2);
if (!$segment) {
    $segment = 1;
}
$base_url = URL::to('/');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Services </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="radio" class="cursor-pointer myservice_types" name="recommended" id="recommended" value="2" <?php if ($segment == 2) {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?> onchange="return window.location.href = '<?php echo $base_url . '/services/2' ?>'">
                            Client Requests
                        </div>
                        <div class="col-md-6">
                            <input type="radio" class="cursor-pointer myservice_types" name="recommended" id="recommended" value="1" <?php if ($segment == 1) {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?> onchange="return window.location.href = '<?php echo $base_url . '/services/1' ?>'">
                            Services
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table id="datatable-responsive" class="table table-striped table-bordered" style="border: none;">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Adventure</th>
                            <th>User Name</th>
                            <th>Country</th>
                            <th>Registrations</th>
                            <th>Total Cost</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($services)) {
                            foreach ($services as $bkng) {
                        ?>
                                <tr>
                                    <td>#{{$bkng->booking_id}}</td>
                                    <td>{{$bkng->adventure_name}}</td>
                                    <td>{{$bkng->customer}}</td>
                                    <td>{{$bkng->country}}</td>
                                    <td>{{$bkng->adult}} Adults, <br> {{$bkng->kids}} Youngsters</td>
                                    <td><strong>{{$bkng->currency.' '.$bkng->total_cost}}</strong></td>

                                    <td>
                                        <?php if ($bkng->status == 1) { ?>
                                            <span class="text-green">Accepted</span>
                                        <?php } elseif ($bkng->status == 2) { ?>
                                            <span class="text-red">Payment Done</span>
                                        <?php } elseif ($bkng->status == 3) {?>
                                            <span class="text-red">Cancelled</span>
                                      <?php  } elseif ($bkng->status == 4) {?>
                                        <span class="text-red">Completed</span>
                                        <?php }else { ?>
                                            <span class="text-yellow">dropped</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <ul class="edit_icon action_icons dashboard_icons">
                                            <li><a href="{{URL::to('booking/detail/'.$bkng->booking_id)}}" style="background: #1C3947;"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="#" style="background: #1D7FFF;"><i class="fa fa-comments"></i></a></li>
                                            <?php if ($bkng->status == 0) { ?>
                                                <li><a href="{{URL::to('booking/accept/'.$bkng->booking_id)}}" onclick="return confirm('Are you sure you want to accept this request ?')" style="background: #249E00;"><i class="fa fa-check"></i></a></li>
                                                <li><a href="{{URL::to('booking/decline/'.$bkng->booking_id)}}" onclick="return confirm('Are you sure you want to decline this request ?')" style="background: #FF4444;"><i class="fa fa-times"></i></a></li>
                                            <?php } ?>
                                            <li><a href="#" style="background: #FF4444;"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('.myservice_types').change(function() {
            var host = window.location.host;
            var current_url = window.location.pathname.split('/');
        });
        var table = $('table').dataTable({
            searching: true,
            paging: true,
            info: false, // hide showing entries
            ordering: true, // hide sorting
            bLengthChange: false, // hide showing entries in dropdown
            "dom": '<"pull-left"f><"pull-right"l>tip', //align search to left
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search here...",
                "paginate": {
                    previous: '&#x3c;', // or '<'
                    next: '&#x3e;' // or '>' 
                }
            }
        });

        $('#datatable-responsive_wrapper .pull-right ').append('<div class="dataTables_length"><label for="Total Users">Total Client Requests : ' + table.fnGetData().length + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>');
        $('.pull-right .dataTables_length').css({
            'font-size': '15px',
            'color': '#fff'
        });
        $('#datatable-responsive_wrapper').
        css({
            'background': '#7CA7BB',
            'padding': '10px 0px 0px 0px',
            'font-size': '18px',
            'color': '#fff',
            'border-radius': '8px 8px 0px 0px'
        });

        //        $('#datatable-responsive').css({
        //            'border': '0px',
        //            'margin-bottom': '0px !important'
        //        });

        $('#datatable-responsive_paginate').css({
            'background': '#fff'
        });

        $('.dataTables_filter input[type="search"]').
        css({
            'width': '250px'
        });
    });
</script>