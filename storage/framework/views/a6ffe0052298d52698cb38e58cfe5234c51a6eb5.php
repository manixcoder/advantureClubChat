<?php
$segment = Request::segment(3);
$base_url = URL::to('/');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Adventure Requests > #<?php echo e($segment); ?></h4>
            </div>
        </div>
        <?php
        $serviceImagesData = DB::table('service_images')->where('service_id', $service->service_id)->orderBy('id', 'ASC')->get();
        ?>
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $serviceImagesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceImages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-3 booking-detail-banner">
                <img class="img-responsive" src="<?php echo e(URL::asset('/public/uploads/')); ?>/<?php echo e($serviceImages->image_url); ?>" alt="Photo">
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-md-3 booking-detail-banner">
                <img class="img-responsive" src="<?php echo e(asset('public/walls/1.jpg')); ?>" alt="Photo">
            </div>

            <div class="col-md-3 booking-detail-banner">
                <img class="img-responsive" src="<?php echo e(asset('public/walls/2.jpg')); ?>" alt="Photo">
            </div>
            <div class="col-md-3 booking-detail-banner">
                <img class="img-responsive" src="<?php echo e(asset('public/walls/3.jpg')); ?>" alt="Photo">
            </div>
            <div class="col-md-3 booking-detail-banner">
                <img class="img-responsive" src="<?php echo e(asset('public/walls/4.jpg')); ?>" alt="Photo">
            </div>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="th">Requests ID :</td>
                                    <td>#<?php echo e($service->id); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Adventure Name :</td>
                                    <td><?php echo e($service->adventure_name); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Country :</td>
                                    <td><?php echo e($service->country); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Region :</td>
                                    <td><?php echo e($service->region); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Service Sector :</td>
                                    <td><?php echo e($service->service_sector); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Level :</td>
                                    <td><?php echo e($service->service_level); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Duration :</td>
                                    <td><?php echo e($service->duration); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Available Seats :</td>
                                    <td><?php echo e($service->available_seats); ?></td>
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
                                    <td><?php echo e($service->aimed_for); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Dependency :</td>
                                    <td><?php echo implode('<br>', array_column($service->dependencies, 'dependency_name')); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Start Date :</td>
                                    <td><?php echo e(date('d M Y',strtotime($service->start_date))); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">End Date :</td>
                                    <td><?php echo e(date('d M Y',strtotime($service->end_date))); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Informations :</td>
                                    <td><?php echo e($service->write_information); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">T & C :</td>
                                    <td><?php echo e($service->terms_conditions); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Pre-Requesits :</td>
                                    <td><?php echo e($service->pre_requisites); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Min. Requirement :</td>
                                    <td><?php echo e($service->minimum_requirements); ?></td>
                                </tr>

                                <tr>
                                    <td class="th">Address :</td>
                                    <td><?php echo e($service->specific_address); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Country :</td>
                                    <td><?php echo e($service->country); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Region :</td>
                                    <td><?php echo e($service->region); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Total cost :</td>
                                    <td><?php echo e($service->cost_inc); ?></td>
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
                                Program
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">

                                </div>
                            </div>
                            <!-- <div class="box">
                            <div class="box-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="th">Min. Requirement :</td>
                                            <td><?php echo e($service->minimum_requirements); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
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
                                                <td><?php echo e($service->specific_address); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="th">Country :</td>
                                                <td><?php echo e($service->country); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="th">Region :</td>
                                                <td><?php echo e($service->region); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="th">Total cost :</td>
                                                <td><?php echo e($service->cost_inc); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-12">
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
                                    <span class="star-review-span"> <?php echo e($service->stars); ?> (<?php echo e($service->reviewd_by); ?> Reviews)</span>
                                </div>
                            </div>
                        </div>
                    </div> -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="star-div">
                                        <!--<a href="<?php echo e(URL::to('service/accept/')); ?>/<?php echo e($service->id); ?>" class="btn btn-block btn-primary">Notify</a>-->
                                        <a href="<?php echo e(URL::to('service/accept/')); ?>/<?php echo e($service->id); ?>" class="btn btn-block btn-success">Accept</a>
                                        <a href="<?php echo e(URL::to('service/decline/')); ?>/<?php echo e($service->id); ?>" class="btn btn-block btn-danger">Decline</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div><?php /**PATH E:\xampp\htdocs\advantureClub\resources\views/admin/adventureRequests/requests_detail.blade.php ENDPATH**/ ?>