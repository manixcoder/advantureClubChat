<?php
$sessionId = Session::get('user_id');
$users = DB::table('users')->where('id', $sessionId)->first();
?>

<link href="<?php echo e(asset('public/assets/css/page_css/home.css')); ?>" rel="stylesheet" type="text/css" />
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Dashboard</h4>
            </div>
        </div>
        <div class="row">
            <?php if(Session::get('userRole') == 1): ?>
            <div class="col-md-4 col-xl-4">
                <a href="<?php echo e(url::to('list-adventure-users')); ?>">
                    <div class="mini-stat clearfix bg-primary bx-shadow">
                        <div class="registration_part">
                            <img src="<?php echo e(asset('/public/images/registration.png')); ?>">
                            <h3>Registration</h3>
                        </div>
                        <div class="total_users">
                            <div class="tiles-progress">
                                <p>New Users</p>
                                <span><?php echo e($new_customer); ?></span>
                            </div>
                            <div class="mini-stat-info">
                                <p>Total Users</p>	
                                <span class="counter"><?php echo e($total_customer); ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-xl-4">
                
                    <div class="mini-stat clearfix bg-dark">
                        <div class="registration_part">
                            <img src="<?php echo e(asset('/public/images/subscription.png')); ?>">
                            <h3>Subscription</h3>
                        </div>
                        <div class="total_users">
                            <div class="tiles-progress">
                                <p>New Partner</p>
                                <a href="<?php echo e(url::to('list-adventure-partners')); ?>"><span><?php echo e($new_partner); ?></span></a>
                            </div>
                            <div class="mini-stat-info">
                                <p>Total Partner</p>
                                <a href="<?php echo e(url::to('list-adventure-partners')); ?>">
                                    <span class="counter"><?php echo e($total_partner); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                
            </div>  
            <div class="col-md-4 col-xl-4">
                <a href="<?php echo e(url::to('services/2')); ?>">
                    <div class="mini-stat clearfix bg-danger">
                        <div class="registration_part">
                            <img src="<?php echo e(asset('/public/images/service_booking.png')); ?>">
                            <h3>Service Booking</h3>
                        </div>
                        <div class="total_users">
                            <div class="tiles-progress">
                                <p>New Booking</p>
                                <span><?php echo e($new_booking); ?></span>
                            </div>
                            <div class="mini-stat-info">
                                <p>Total Booking</p>
                                <span class="counter"><?php echo e($total_booking ?? ''); ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="my_services">
                <h3>My Services<a href="<?php echo e(URL::to('/services/2')); ?>">See All</a></h3>
                <table class="table"> 
                    <thead> 
                        <tr> 
                            <th>Booking ID</th> 
                            <th>Adventure</th> 
                            <th>User Name</th> 
                            <th>Nationality</th> 
                            <th>Registrations</th>
                            <th>Total Cost</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr> 
                    </thead> 
                    <tbody>
                        <?php
                        if (count($bookings)) {
                            foreach ($bookings as $bkng) {
                                ?>
                                <tr> 
                                    <td>#<?php echo e($bkng->booking_id); ?></td> 
                                    <td><?php echo e($bkng->adventure_name); ?></td> 
                                    <td><?php echo e($bkng->customer); ?></td> 
                                    <td><?php echo e($bkng->country); ?></td>
                                    <td><?php echo e($bkng->adult); ?> Adults, <br> <?php echo e($bkng->kids); ?> Youngsters</td>
                                    <td><strong><?php echo e($bkng->currency.' '.$bkng->total_cost); ?></strong></td>
                                    <td>
                                        <?php if ($bkng->status == 1) { ?>
                                            <span class="text-green"><?php echo e($bkng->booking_status_text); ?></span>
                                        <?php } elseif ($bkng->status == 2) { ?>
                                            <span class="text-red"><?php echo e($bkng->booking_status_text); ?></span>
                                        <?php }else{ ?>
                                            <span class="text-yellow"><?php echo e($bkng->booking_status_text); ?></span>
                                       <?php } ?>
                                    </td>
                                    <td>
                                        <ul class="edit_icon action_icons dashboard_icons">
                                            <li><a href="<?php echo e(URL::to('booking/detail/'.$bkng->booking_id)); ?>" class="bg-black"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="#" style="background: #1D7FFF;"><i class="fa fa-comments"></i></a></li>
                                            <?php if ($bkng->status == 0) { ?>
                                                <li><a href="<?php echo e(URL::to('booking/accept/'.$bkng->booking_id)); ?>" onclick="return confirm('Are you sure you want to accept this request ?')" style="background: #249E00;"><i class="fa fa-check"></i></a></li>
                                                <li><a href="<?php echo e(URL::to('booking/decline/'.$bkng->booking_id)); ?>" onclick="return confirm('Are you sure you want to decline this request ?')" style="background: #FF4444;"><i class="fa fa-times"></i></a></li>
                                                    <?php } ?>
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

            <!--
            <div class="col-md-3 col-xl-3">
              <a href="<?php echo e(url::to('countries')); ?>">
                 <div class="mini-stat clearfix bg-info bx-shadow">
                    <span class="mini-stat-icon"><i class="fas fa-sitemap"></i></span>
                    <div class="mini-stat-info text-right">
                       <span class="counter"><?php echo e($countrydata ?? ''); ?></span>
                       Total Counrty
                    </div>
                    <div class="tiles-progress">
                       <div class="m-t-20">
                          <h5 class="text-uppercase text-white m-0">Counrty <span class="pull-right">View</span></h5>
                       </div>
                    </div>
                 </div>
              </a>
           </div>
           <div class="col-md-3 col-xl-3">
              <a href="<?php echo e(url::to('manage-adventure-program')); ?>">
                 <div class="mini-stat clearfix bg-warning bx-shadow">
                    <span class="mini-stat-icon"><i class="fas fa-sitemap"></i></span>
                    <div class="mini-stat-info text-right">
                       <span class="counter"><?php echo e($adventure_programdata ?? ''); ?></span>
                       Total Adventure Program
                    </div>
                    <div class="tiles-progress">
                       <div class="m-t-20">
                          <h5 class="text-uppercase text-white m-0">Adventure Program <span class="pull-right">View</span></h5>
                       </div>
                    </div>
                 </div>
              </a>
           </div>
           <div class="col-md-3 col-xl-3">
              <a href="<?php echo e(url::to('customers')); ?>">
                 <div class="mini-stat clearfix bg-primary bx-shadow">
                    <span class="mini-stat-icon"><i class="fas fa-sitemap"></i></span>
                    <div class="mini-stat-info text-right">
                       <span class="counter"><?php echo e($customerdata ?? ''); ?></span>
                       Total Adventure 
                    </div>
                    <div class="tiles-progress">
                       <div class="m-t-20">
                          <h5 class="text-uppercase text-white m-0">Adventure<span class="pull-right">View</span></h5>
                       </div>
                    </div>
                 </div>
              </a>
           </div>
           <div class="col-md-3 col-xl-3">
              <a href="<?php echo e(url::to('product')); ?>">
                 <div class="mini-stat clearfix bg-success bx-shadow">
                    <span class="mini-stat-icon"><i class="fas fa-sitemap"></i></span>
                    <div class="mini-stat-info text-right">
                       <span class="counter"><?php echo e($productdata ?? ''); ?></span>
                       Total Products
                    </div>
                    <div class="tiles-progress">
                       <div class="m-t-20">
                          <h5 class="text-uppercase text-white m-0">Products<span class="pull-right">View</span></h5>
                       </div>
                    </div>
                 </div>
              </a>
           </div>
           <?php endif; ?>
           <?php if(Session::get('userRole') == 2): ?>
              <div class="col-md-3 col-xl-3">
                 <a href="<?php echo e(url::to('category')); ?>">
                    <div class="mini-stat clearfix bg-danger bx-shadow">
                       <span class="mini-stat-icon"><i class="fas fa-sitemap"></i></span>
                       <div class="mini-stat-info text-right">
                          <span class="counter"><?php echo e($customerdata ?? ''); ?></span>
                          Total Adventures
                       </div>
                       <div class="tiles-progress">
                          <div class="m-t-20">
                             <h5 class="text-uppercase text-white m-0">Adventures <span class="pull-right">View</span></h5>
                          </div>
                       </div>
                    </div>
                 </a>
              </div> 
          -->



            <div class="col-md-6 col-xl-6">
                <a href="<?php echo e(url::to('category')); ?>">
                    <div class="mini-stat clearfix bg-danger bx-shadow">
                        <span class="mini-stat-icon"><i class="fas fa-sitemap"></i></span>
                        <div class="mini-stat-info text-right">
                            <span class="counter"><?php echo e($customerdata ?? ''); ?></span>
                            Total Products
                        </div>
                        <div class="tiles-progress">
                            <div class="m-t-20">
                                <h5 class="text-uppercase text-white m-0">Products <span class="pull-right">View</span></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div> 
            <?php endif; ?>                 
        </div>
    </div>
</div><?php /**PATH E:\xampp\htdocs\advantureClub\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>