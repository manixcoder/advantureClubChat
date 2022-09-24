<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Subscription Packages </h4>
                <ul class="breadcrumb pull-right">
                    <li>
                        <a href="{{URL::to('sub-packages/add')}}" class="waves-effect">
                            <img src="{{ asset('/public/images/add_user.png')}}">
                            &nbsp;&nbsp;<span>Create package</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap datatable-package" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Package ID</th>
                            <th>Package Name</th>
                            <th>Includes</th>
                            <th>Not Includes</th>
                            <th>Cost</th>
                            <th>offer cost</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($packages)) {
                            foreach ($packages as $key => $pkg) {
                                $includes = DB::table('package_detail')->where('package_id', $pkg->id)->where('detail_type', '1')->get();
                                $excludes = DB::table('package_detail')->where('package_id', $pkg->id)->where('detail_type', '1')->get();
                        ?>
                                <tr class="gradeX">
                                    <td>#{{ $key+1 }}</td>
                                    <td>{{ $pkg->title }}</td>
                                    <td>
                                        @forelse ($includes as $include)
                                        <li> <?php 
                                        echo substr($include->title, 0, 10).'... ';
                                        ?></li>
                                        @empty
                                        <p> Not includes</p>
                                        @endforelse

                                    </td>
                                    <td>
                                    @forelse ($excludes as $exclude)
                                        <li><?php 
                                        echo substr($exclude->title, 0, 10).'... ';
                                        ?></li>
                                        @empty
                                        <p>Not includes</p>
                                        @endforelse
                                        </td>
                                    <td>{{$pkg->symbol}}{{ abs($pkg->cost) }}</td>
                                    <td>{{$pkg->symbol}}{{ abs($pkg->offer_cost) }}</td>
                                    <?php
                                    if ($pkg->status == 1) {
                                        $status = 'Active';
                                        $class = 'badge-success';
                                    } else {
                                        $status = 'InActive';
                                        $class = 'badge-danger';
                                    }
                                    ?>
                                    <td>
                                        <p class="mb-0">
                                            <span id="statusText_{{$pkg->id}}" class="badge <?php echo $class; ?>">{{ $status }}</span>
                                        </p>
                                    </td>
                                    <td>
                                        <ul class="edit_icon action_icons dashboard_icons">
                                            <li>
                                                <label class="switch">
                                                    <?php
                                                    if ($pkg->status == 1) {
                                                        $statVal = 1;
                                                        $checked = 'checked = checked';
                                                    } else {
                                                        $statVal = 0;
                                                        $checked = '';
                                                    }
                                                    ?>
                                                    <input type="checkbox" class="togBtn" id="togBtn_{{$pkg->id}}" name="togBtn_{{$pkg->id}}" value="{{ $statVal}}" <?php echo $checked; ?> />
                                                    <span class="slider round"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <a href="{{URL::to('sub-packages/delete/'.$pkg->id)}}" onclick="return confirm('Are you sure you want to delete this request ?')" class="bg-red"><i class="fa fa-trash"></i></a>
                                            </li>
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
        //Get the total rows
        $('#datatable-responsive1_wrapper').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="' + title + ' Search" />');
        });
        var table = $('table').dataTable({
            searching: true,
            paging: true,
            info: false, // hide showing entries
            ordering: true, // hide sorting
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
                }
            }
        });

        $('#datatable-responsive1_wrapper .pull-right ').append('<div class="dataTables_length"><label for="Total Partners">Total Partners : ' + table.fnGetData().length + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>');
        $('.pull-right .dataTables_length').css({
            'font-size': '15px',
            'color': '#fff'
        });
        $('#datatable-responsive1_wrapper').
        css({
            'background': '#7CA7BB',
            'padding': '10px 0px 0px 0px',
            'font-size': '18px',
            'color': '#fff',
            'border-radius': '8px 8px 0px 0px'
        });

        $('#datatable-responsive1').css({
            'border': '0px',
            'margin-bottom': '0px !important'
        });

        $('#datatable-responsive1_paginate').css({
            'background': '#fff'
        });

        $('.dataTables_filter input[type="search"]').
        css({
            'width': '250px'
        });
    });
</script>
<script>
    $(window).load(function() {
        $('#datatable-responsive1').on("click", ".togBtn", function() {
            var btnId = $(this).attr('id');
            var ret = btnId.split("_");
            var id = ret[1];
            var status = $(this).val();
            if (status == 1) {
                var changedStatus = $(this).val('0');
                var statusNew = changedStatus.attr('value');
                var textStatus = $("#statusText_" + id).text("InActive");
                $("#statusText_" + id).removeClass("badge-success").addClass("badge-danger");
            } else {
                var changedStatus = $(this).val('1');
                var statusNew = changedStatus.attr('value');
                var textStatus = $('#statusText_' + id).text('Active');
                $("#statusText_" + id).removeClass("badge-danger").addClass("badge-success");
            }
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{url('update-pkg-status')}}" + '/' + id,
                method: "GET",
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "id": id,
                    "status": statusNew
                },
                success: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>