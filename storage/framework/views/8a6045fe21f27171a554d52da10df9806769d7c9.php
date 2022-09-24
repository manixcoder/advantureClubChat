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
                        <a href="<?php echo e(URL::to('services/add')); ?>" class="waves-effect">
                            <img src="<?php echo e(asset('/public/images/add_user.png')); ?>">
                            &nbsp;&nbsp;<span>Create Service</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="radio" class="cursor-pointer myservice_types" name="recommended" id="recommended" value="2" <?php
                        if ($segment == 'vendors') {
                            echo 'checked';
                        }
                        ?>  onchange="return window.location.href = '<?php echo $base_url . '/requests/vendors' ?>'" >
                        Partner Requests
                    </div>
                    <div class="col-md-6">
                        <input type="radio" class="cursor-pointer myservice_types" name="recommended" id="recommended" value="1" 
                        <?php
                        if ($segment == 'adventures') {
                            echo 'checked';
                        }
                        ?> onchange="return window.location.href = '<?php echo $base_url . '/requests/adventures' ?>'" >
                        Adventure Requests
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <table id="datatable-responsive" class="table table-striped table-bordered" style="border: none;">
                <thead>
                    <tr>
                        <th>Request Id</th>
                        <th>User Name</th>
                        <th>Country</th>
                        <th>Adventure Name</th>
                        <th>Category</th>
                        <th>Aimed For</th>
                        <th>Created On</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($services)) {
                        foreach ($services as $key => $service) {
                           // dd($service);
                            $serviceFor = DB::table('service_service_for as ssf')
                            ->leftJoin('service_for as sf','ssf.sfor_id','=','sf.id')
                            ->where('ssf.service_id', '=', $service->id)->get();
                           //dd($serviceFor);
                            ?>
                            <tr class = "gradeX">
                                <td>#<?php echo e($service->id); ?></td>
                                <td><a href="<?php echo e(URL::to('/view-adventure-user/'.$service->user_id)); ?>" ><?php echo e($service->provider_name); ?></a></td>
                                <td><?php echo e($service->country); ?></td>
                                <td><?php echo e($service->adventure_name); ?></td>
                                <td><?php echo e($service->service_category); ?></td>
                                <td>
                                    <?php $__empty_1 = true; $__currentLoopData = $serviceFor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $for): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li><?php echo e($for->sfor); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p>No Aimed For</p>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(date('d M, Y',strtotime($service->created_at))); ?></td>
                                <td>
                                    <?php if($service->status =='0'){
                                    echo "Panding";
                                }else if($service->status =='1'){
                                    echo "Accepted";
                                }else{
                                  echo "Decline";  
                                }
                                ?>
                                </td>
                                <td>
                                    <ul class="edit_icon action_icons dashboard_icons">
                                        <li><a href="<?php echo e(URL::to('/requests/adventures/view/'.$service->id)); ?>" class="bg-black"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="<?php echo e(URL::to('/')); ?>" onclick="return confirm('Are you sure you want to edit this item ?')" class="bg-green"><i class="fa fa-pencil"></i></a></li>
                                        <li><a href="<?php echo e(URL::to('/service/detele/'.$service->id)); ?>" onclick="return confirm('Are you sure you want to delete this request ?')" class="bg-red"><i class="fa fa-trash"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr class = "gradeX">
                            <td colspan="7" class="text-center">No request found</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div><?php /**PATH E:\xampp\htdocs\advantureClub\resources\views/admin/services/adventure_request.blade.php ENDPATH**/ ?>