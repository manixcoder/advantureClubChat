<?php
$segment = Request::segment(3);
$base_url = URL::to('/');
 // dd($service);
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Adventure Requests > #<?php echo e($segment); ?></h4>
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
                                    <td>#<?php echo e($service->id); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Company Name :</td>
                                    <td><?php echo e($service->company_name); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Official Address :</td>
                                    <td><?php echo e($service->address); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Country :</td>
                                    <td><?php echo e($service->country); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Nationality :</td>
                                    <td><?php echo e($service->country); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">GeoLocation :</td>
                                    <td><?php echo e($service->location); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Licensed :</td>
                                    <td><?php echo e($service->license); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">CR Name :</td>
                                    <td><?php echo e($service->cr_name); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">CR Number :</td>
                                    <td><?php echo e($service->cr_number); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">CR Copy :</td>
                                    <td>
                                        <?php if($service->cr_copy!=''): ?>
                                        <img src="<?php echo e(asset('public/').'/'.$service->cr_copy); ?>" alt="image" width="100" height="100">
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('public/images/noImages.png')); ?>" alt="image" width="100" height="100">
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="th">Partnership :</td>
                                    <td><?php echo e($service->title); ?></td>
                                </tr>
                                <tr>
                                    <td class="th">Payment :</td>
                                    <td> <?php echo e($service->title); ?> </td>
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
                                                <td><?php echo e(date("d M Y", strtotime($service->request_date))); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="th">Payment Setup :</td>
                                                <td>
                                                    <?php if($service->debit_card == '1' ): ?>
                                                    <?php echo e("debit card"); ?>

                                                    <?php endif; ?>

                                                    <?php if($service->visa_card): ?>
                                                    <?php echo e("visa card"); ?>

                                                    <?php endif; ?>

                                                    <?php if($service->payon_arrival): ?>
                                                    <?php echo e("payon arrival"); ?>

                                                    <?php endif; ?>

                                                    <?php if($service->paypal): ?>
                                                    <?php echo e("paypal"); ?>

                                                    <?php endif; ?>
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
                                    <a href="<?php echo e(URL::to('/partnership/accept/')); ?>/<?php echo e($service->user_id); ?>" onclick="return confirm('Are you sure you want to accept this request ?')">
                                        <span class="badge bg-green"><i class="fa fa-check"></i> &nbsp;&nbsp;<span class="text-green">Accept</span></span>
                                    </a>
                                </div>
                                        <div class="col-md-4">
                                    <a href="<?php echo e(URL::to('/partnership/decline/')); ?>/<?php echo e($service->user_id); ?>" onclick="return confirm('Are you sure you want to decline this request ?')">
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
                                <?php if($service->profile_image!=''): ?>
                                        <img src="<?php echo e(asset('public/uploads/').'/'.$service->profile_image); ?>" alt="image" width="100" height="100">
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('public/images/noImages.png')); ?>" alt="image" width="100" height="100">
                                        <?php endif; ?>
                                <ul>
                                    <li>User Name : ><?php echo e($service->name); ?></li>
                                    <li>User Email : ><?php echo e($service->email); ?></li>
                                </ul>
                            </div>
                        </div>
                        <form method="post" action="<?php echo e(URL::to('/notify-user')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="user_id" value="<?php echo e($service->user_id); ?>">
                            <input type="hidden" name="sender_id" value="<?php echo e(Auth::user()->id); ?>">
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
    </div><?php /**PATH E:\xampp\htdocs\advantureClub\resources\views/admin/adventureRequests/adventureRequestsDetails.blade.php ENDPATH**/ ?>