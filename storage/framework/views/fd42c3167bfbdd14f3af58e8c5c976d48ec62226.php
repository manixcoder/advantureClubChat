<?php
$segment = Request::segment(2);
if (!$segment) {
    $segment = 'vendors';
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
                        <!--<a href="<?php echo e(URL::to('services/add')); ?>" class="waves-effect">
                            <img src="<?php echo e(asset('/public/images/add_user.png')); ?>">
                            &nbsp;&nbsp;<span>Create Service</span>
                        </a>-->
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="radio" class="cursor-pointer myservice_types" name="recommended" id="recommended" value="2" <?php if ($segment == 'vendors') { echo 'checked';} ?> onchange="return window.location.href = '<?php echo $base_url . '/requests/vendors' ?>'">
                        Partner Requests
                    </div>
                    <div class="col-md-6">
                        <input type="radio" class="cursor-pointer myservice_types" name="recommended" id="recommended" value="1" <?php if ($segment == 'adventures') { echo 'checked'; }  ?> onchange="return window.location.href = '<?php echo $base_url . '/requests/adventures' ?>'">
                        Adventure Requests
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <table id="datatable-responsive" class="table table-striped table-bordered" style="border: none;">
                <thead>
                    <tr>
                        <th>Requests ID</th>
                        <th>Company Name</th>
                        <th>User Name</th>
                        <th>Request Date</th>
                        <th>Country</th>
                        <th>Licensed</th>
                        <th>Partnership</th>
                        <th>Payment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($services)) {
                        foreach ($services as $key => $service) {
                            ?>
                            <tr class="gradeX">
                                <td>#<?php echo e($service->id); ?></td>
                                <td><?php echo e($service->company_name); ?></td>
                                <td><a href="<?php echo e(URL::to('/view-adventure-user/'.$service->user_id)); ?>" ><?php echo e($service->name); ?></a></td>
                                <td><?php echo e(date("d M Y", strtotime($service->request_date))); ?></td>
                                <td><?php echo e($service->country); ?></td>                               
                                <td><?php echo e($service->license); ?></td>
                                <td><?php echo e($service->title); ?></td>
                                <td><?php echo e($service->is_online); ?></td>
                                <td>
                                    <ul class="edit_icon action_icons dashboard_icons">
                                        <li>
                                            <a href="<?php echo e(URL::to('/partner-requests/view/'.$service->id)); ?>" class="bg-black"><i class="fa fa-eye"></i></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(URL::to('/')); ?>" onclick="return confirm('Are you sure you want to edit this item ?')" class="bg-green"><i class="fa fa-pencil"></i></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(URL::to('/service/detele/'.$service->id)); ?>" onclick="return confirm('Are you sure you want to delete this request ?')" class="bg-red">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr class="gradeX">
                            <td colspan="7" class="text-center">No request found</td>
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
      $('#datatable-responsive1').each(function() {
         var title = $(this).text();
         $(this).html('<input type="text" placeholder="' + title + ' Search" />');


         column.data().unique().sort().each(function(title, j) {
            if (column.search() === '^' + title + '$') {
               select.append('<option value="' + title + '" selected="selected">' + title + '</option>')
            } else {
               select.append('<option value="' + title + '">' + title + '</option>')
            }
         });


      });
      var table = $('table ').dataTable({
         searching: true,
         paging: true,
         info: false, // hide showing entries
         ordering: true, // hide sorting
         columnDefs: [{
            orderable: true,
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

   /* Status toggle starts */
   $(window).load(function() {
      $('.togBtn').click(function() {
         var btnId = $(this).attr('id');
         //alert(btnId);
         var ret = btnId.split("_");
         var id = ret[1];
         var status = $('#' + btnId).val();
         if (status == 1) {
            var changedStatus = $(this).val('0');
            var statusNew = changedStatus.attr('value');
            $('#' + btnId).val(statusNew);
            var textStatus = $("#statusText_" + id).text("InActive");
            $("#statusText_" + id).removeClass("badge-success").addClass("badge-danger");
         } else {
            var changedStatus = $(this).val('1');
            var statusNew = changedStatus.attr('value');
            $('#' + btnId).val(statusNew);
            $('input[name=' + btnId + '][value=' + statusNew + ']').prop('checked', true);
            var textStatus = $('#statusText_' + id).text('Active');
            $("#statusText_" + id).removeClass("badge-danger").addClass("badge-success");
         }

         $.ajax({
            url: "<?php echo e(url('update-user-status')); ?>" + '/' + id,
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
   /* Status toggle ends */
   function editRecords(id) {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

      $.ajax({
         url: "<?php echo e(url('user/role/edit/')); ?>" + '/' + id,
         method: "POST",
         contentType: 'application/json',
         success: function(data) {
            $('#unique-model').modal('show');
            document.getElementById("ids").value = data.id;
            document.getElementById("username").value = data.username;
            document.getElementById("email").value = data.email;
            document.getElementById("password").value = data.password;
            var val = data.status;

            if (val == 1) {
               $('input[name=status][value=' + val + ']').prop('checked', true);
            } else {
               $('input[name=status][value=' + val + ']').prop('checked', true);
            }
            document.getElementById("submitbtn").innerText = 'UPDATE';
         }
      });
   }

   function addRecords() {
      document.getElementById("FormValidation").reset();
      document.getElementById("submitbtn").innerText = 'Save';
      $('#unique-model').modal('show');
   }
</script><?php /**PATH E:\xampp\htdocs\advantureClub\resources\views/admin/services/vendor_request.blade.php ENDPATH**/ ?>