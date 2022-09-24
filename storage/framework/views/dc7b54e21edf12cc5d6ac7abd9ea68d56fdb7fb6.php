<?php
$sessionId = Session::get('user_id');
$users = DB::table('users')->where('id', $sessionId)->first();
$userrole = Session::get('userRole');
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">

            <ul>
                <li><a href="<?php echo e(URL::to('dashboard')); ?>" class="waves-effect dashboard-icon"><img src="<?php echo e(asset('/public/images/dashboard.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Dashboard </span></a>
                </li>
            </ul>
            <?php
            if ($userrole == 1) {
                ?>
                
                <?php if(!empty(Session::get('country_id'))): ?>
                
                <?php
                $country_arr = DB::table('role_assignments')->where('country_id', Session::get('country_id'))->get();
                foreach($country_arr as $countss)
                {
                $countss->role_id;
                //@endphp
                
                // print_r($countss); ?>
                
                
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('requests/vendors')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/requests.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Requests</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('list-adventure-users')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/users.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Users</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('list-adventure-partners')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/partners.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Partners</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('services')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/services.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Clients and services</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('list-service-offers')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/service_offers.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Service Offers</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('list-reviews')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/reviews.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Reviews</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('sub-packages')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/sub_packages.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Sub Packages</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('list-promocode')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/promocode.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Promocode</span></a>
                    </li>
                </ul>
                <ul>
                    <li><a href="<?php echo e(URL::to('/questionreport')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/question_reports.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Question Reports</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/transactions')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/transactions.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Transactions</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#" class="waves-effect"><img src="<?php echo e(asset('/public/images/administrations.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Administrations</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/announcement')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/announcements.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Announcements</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/selections')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/selection_manage.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Selection Manager</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/countries')); ?>" class="waves-effect">
                            <img src="<?php echo e(asset('/public/images/locations.png')); ?>">&nbsp;&nbsp;&nbsp;
                            <span>Country</span>
                        </a>
                    </li>
                </ul>
                
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/list-admin-users')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/administrations.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Admin User</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/roleaccess')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/role_access.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Role Access</span></a>
                    </li>
                </ul>
                
                <ul>
                    <li>
                        <a href="#" class="waves-effect"><img src="<?php echo e(asset('/public/images/visit_location.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Visit Locations</span></a>
                    </li>
                </ul>
                
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/about-us')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/about_us.png')); ?>">&nbsp;&nbsp;&nbsp;<span>About Us</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/terms-conditions')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/terms_and_conditions.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Terms and Conditions</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/privacy-policy')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/terms_and_conditions.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Privacy Policy</span></a>
                    </li>
                </ul>
               <?php
               }
               ?>
                <?php else: ?>
                
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('requests/vendors')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/requests.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Requests</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('list-adventure-users')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/users.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Users</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('list-adventure-partners')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/partners.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Partners</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('services')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/services.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Clients and services</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('list-service-offers')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/service_offers.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Service Offers</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('list-reviews')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/reviews.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Reviews</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('sub-packages')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/sub_packages.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Sub Packages</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('list-promocode')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/promocode.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Promocode</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/questionreport')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/question_reports.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Question Reports</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/transactions')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/transactions.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Transactions</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#" class="waves-effect"><img src="<?php echo e(asset('/public/images/administrations.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Administrations</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/announcement')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/announcements.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Announcements</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/selections')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/selection_manage.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Selection Manager</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/countries')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/locations.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Country</span></a>
                    </li>
                </ul>
                
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/list-admin-users')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/administrations.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Admin User</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/roleaccess')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/role_access.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Role Access</span></a>
                    </li>
                </ul>
                
                <ul>
                    <li>
                        <a href="#" class="waves-effect">
                            <img src="<?php echo e(asset('/public/images/visit_location.png')); ?>">&nbsp;&nbsp;&nbsp;
                            <span>Visit Locations</span>
                        </a>
                    </li>
                </ul>
                
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/about-us')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/about_us.png')); ?>">&nbsp;&nbsp;&nbsp;<span>About Us</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/terms-conditions')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/terms_and_conditions.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Terms and Conditions</span></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?php echo e(URL::to('/privacy-policy')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/terms_and_conditions.png')); ?>">&nbsp;&nbsp;&nbsp;<span>Privacy Policy</span></a>
                    </li>
                </ul>
                
                <?php endif; ?>
                
                
                
            <?php } ?>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="content-page"><?php /**PATH E:\xampp\htdocs\advantureClub\resources\views/layouts/menubar.blade.php ENDPATH**/ ?>