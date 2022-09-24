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
                <ul class="breadcrumb pull-right">
                    <li>
                        <a href="<?php echo e(URL::to('services/add')); ?>" class="waves-effect">
                            <img src="<?php echo e(asset('/public/images/add_user.png')); ?>">
                            &nbsp;&nbsp;<span>Create Service</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="radio" class="cursor-pointer myservice_types" name="recommended" id="recommended" value="2" <?php if ($segment == 2) { echo 'checked'; } ?> onchange="return window.location.href = '<?php echo $base_url . '/services/2' ?>'">
                            Client Requests
                        </div>
                        <div class="col-md-6">
                            <input type="radio" class="cursor-pointer myservice_types" name="recommended" id="recommended" value="1" <?php if ($segment == 1) {  echo 'checked';  }   ?> onchange="return window.location.href = '<?php echo $base_url . '/services/1' ?>'">
                            Services
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table id="datatable-responsive1" class="table table-striped table-bordered" style="border: none;">
                    <thead>
                        <tr>
                            <th>Adventure Id</th>
                            <th>Adventure Name</th>
                            <th>Country/Region</th>
                            <th>Participants</th>
                            <th>Unit Cost</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($services as $key => $service) {
                        ?>
                            <tr class="gradeX">
                                <td><?php echo e($service->id); ?></td>
                                <td><?php echo e($service->adventure_name); ?></td>
                                <td><?php echo e($service->country.' / '.$service->region); ?></td>
                                <td><?php echo e($service->participants .' Participant'); ?></td>
                                <td><?php echo e($service->currency_sign.' '.$service->cost_inc); ?></td>
                                <td>
                                    <?php if (date('Y-m-d') < date('Y-m-d', strtotime($service->start_date))) { ?>
                                        <span class="text-yellow">Upcoming</span>
                                    <?php } elseif ((date('Y-m-d') >= date('Y-m-d', strtotime($service->start_date))) && (date('Y-m-d') <= date('Y-m-d', strtotime($service->end_date)))) { ?>
                                        <span class="text-blue">OnGoing</span>
                                    <?php } elseif (date('Y-m-d') > date('Y-m-d', strtotime($service->end_date))) { ?>
                                        <span class="text-green">Completed</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <ul class="edit_icon action_icons dashboard_icons">
                                        <li><a href="<?php echo e(URL::to('/service/view/'.$service->id)); ?>" class="bg-black"><i class="fa fa-eye"></i></a></li>
                                        <!--<li><a href="<?php echo e(URL::to('/')); ?>" onclick="return confirm('Are you sure you want to edit this item ?')" class="bg-green"><i class="fa fa-pencil"></i></a></li>-->
                                        <li><a href="<?php echo e(URL::to('/service/detele/'.$service->id)); ?>" onclick="return confirm('Are you sure you want to delete this request ?')" class="bg-red"><i class="fa fa-trash"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        //Get the total rows
        $('#datatable-responsive1_wrapper').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="' + title + ' Search" />');
        });
        var table = $('table ').dataTable({
            searching: true,
            paging: true,
            info: false, // hide showing entries
            ordering: false, // hide sorting
            order: [
                [0, "desc"]
            ],
            columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
            bLengthChange: false, // hide showing entries in dropdown
            "dom": '<"pull-left"f><"pull-right"l>tip', //align search to left
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search here...",
                "paginate": {
                    previous: '&#x3c;', // or '<'
                    next: '&#x3e;' // or '>' 
                },
            }
        });

        $('#datatable-responsive1_wrapper .pull-right ').append('<div class="dataTables_length"><label for="Total Users">Total Users : ' + table.fnGetData().length + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>');
        $('.pull-right .dataTables_length').css({
            'font-size': '15px',
            'color': '#fff'
        });
        $('#datatable-responsive1_wrapper').
        css({
            'background': '#7CA7BB',
            'background-repeat': 'no-repeat',
            'padding': '10px 0px 0px 0px',
            'font-size': '18px',
            'color': '#fff',
            'border-radius': '8px 8px 0px 0px',
        });

        $('#datatable-responsive1').css({
            "border": "0px",
            "margin-bottom": "0px !important",
        });

        $('#datatable-responsive1_paginate').css({
            'background': '#fff'
        });

        $('.dataTables_filter input[type="search"]').
        css({
            'width': '250px'
        });
    });
</script><?php /**PATH E:\xampp\htdocs\advantureClub\resources\views/admin/services/services.blade.php ENDPATH**/ ?>