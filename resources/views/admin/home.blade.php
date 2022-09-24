<?php 
   $sessionId =  Session::get('user_id');
   $users = DB::table('users')->where('id', $sessionId)->first();
?>

<link href="{{ asset('public/assets/css/page_css/home.css') }}" rel="stylesheet" type="text/css" />
<!-- Start content -->
<div class="content">
   <div class="container-fluid">
      <div class="">
         <div class="">
            <!-- Page-Title -->
            <div class="row">
               <div class="col-sm-12">
                  <h4 class="pull-left page-title">Dashboard</h4>
                  <!-- <ol class="breadcrumb pull-right">
                     <li><a href="#">Admin</a></li>
                     <li class="active">Dashboard</li>
                  </ol> -->
               </div>
            </div>
            <div class="row">
               @if(Session::get('userRole') == 1)
               <div class="col-md-4 col-xl-4">
                  <a href="{{url::to('users')}}">
                     <div class="mini-stat clearfix bg-primary bx-shadow">
                     	<div class="registration_part">
                        	<img src="{{ asset('/public/images/registration.png')}}">
                        	<h3>Registration</h3>
                        </div>
                        <div class="total_users">
	                        <div class="tiles-progress">
	                             <p>New Users</p>
	                             <span>501</span>
	                        </div>
	                        <div class="mini-stat-info">
	                           <p>Total Users</p>	
	                           <span class="counter">{{ $usredata }}</span>
	                        </div>
                        </div>
                     </div>
                  </a>
               </div>
               <div class="col-md-4 col-xl-4">
                  <a href="{{url::to('vendor-request')}}">
                     <div class="mini-stat clearfix bg-dark">
                     	<div class="registration_part">
                        	<img src="{{ asset('/public/images/subscription.png')}}">
                        	<h3>Subscription</h3>
                    	</div>
                    	<div class="total_users">
                    		<div class="tiles-progress">
	                           	  <p>New Partner</p>
	                              <span>20</span>
	                        </div>
	                        <div class="mini-stat-info">
	                        	<p>Total Partner</p>
	                           <span class="counter">{{ $vendor_requests ?? ''}}</span>
	                        </div>
                    	</div>
                     </div>
                  </a>
               </div>  
               <div class="col-md-4 col-xl-4">
                  <a href="{{url::to('customers')}}">
                     <div class="mini-stat clearfix bg-danger">
                     	<div class="registration_part">
                        	<img src="{{ asset('/public/images/service_booking.png')}}">
                        	<h3>Service Booking</h3>
                    	</div>
                    	<div class="total_users">
	                        <div class="tiles-progress">
	                           	<p>New Booking</p>
	                            <span>12</span>
	                        </div>
	                        <div class="mini-stat-info">
	                        	<p>Total Booking</p>
	                           <span class="counter">{{ $customerdata ?? ''}}</span>
	                        </div>
                    	</div>
                     </div>
                  </a>
                </div>

                <div class="my_services">
                  	<h3>My Services<a href="#"><i class="fa fa-eye"></i>See All</a></h3>
                  	<table class="table"> 
						<thead> 
							<tr> 
								<th>Booking ID</th> 
								<th>Adventure</th> 
								<th>User Name</th> 
								<th>Nationality</th> 
								<th>Registrations</th>
								<th>Total Cost</th>
								<th>Actions</th>
							</tr> 
						</thead> 
						<tbody> 
							<tr> 
								<td>#947459085</td> 
								<td>River Rafting</td> 
								<td>Paul Molive</td> 
								<td>Indian</td>
								<td>2 Adults, <br> 3 Youngsters</td>
								<td><strong>$ 502.50</strong></td>
								<td>
									<ul class="edit_icon">
										<li><a href="#" style="background: #1C3947;"><i class="fa fa-eye"></i></a></li>
										<li><a href="#" style="background: #1D7FFF;"><i class="fa fa-comments"></i></a></li>
										<li><a href="#" style="background: #249E00;"><i class="fa fa-check"></i></a></li>
										<li><a href="#" style="background: #FF4444;"><i class="fa fa-times"></i></a></li>
									</ul>
								</td>
							</tr>
							<tr> 
								<td>#947455487</td> 
								<td>Hill Climbing</td> 
								<td>Janson Doe</td> 
								<td>Indian</td>
								<td>1 Adults, <br> 1 Youngsters</td>
								<td><strong>$ 201.00</strong></td>
								<td>
									<ul class="edit_icon">
										<li><a href="#" style="background: #1C3947;"><i class="fa fa-eye"></i></a></li>
										<li><a href="#" style="background: #1D7FFF;"><i class="fa fa-comments"></i></a></li>
										<li><a href="#" style="background: #249E00;"><i class="fa fa-check"></i></a></li>
										<li><a href="#" style="background: #FF4444;"><i class="fa fa-times"></i></a></li>
									</ul>
								</td>
							</tr> 
							<tr> 
								<td>#947459085</td> 
								<td>River Rafting</td> 
								<td>Paul Molive</td> 
								<td>Indian</td>
								<td>2 Adults, <br> 3 Youngsters</td>
								<td><strong>$ 502.50</strong></td>
								<td>
									<ul class="edit_icon">
										<li><a href="#" style="background: #1C3947;"><i class="fa fa-eye"></i></a></li>
										<li><a href="#" style="background: #1D7FFF;"><i class="fa fa-comments"></i></a></li>
										<li><a href="#" style="background: #249E00;"><i class="fa fa-check"></i></a></li>
										<li><a href="#" style="background: #FF4444;"><i class="fa fa-times"></i></a></li>
									</ul>
								</td>
							</tr>
							<tr> 
								<td>#947455487</td> 
								<td>Hill Climbing</td> 
								<td>Janson Doe</td> 
								<td>Indian</td>
								<td>1 Adults, <br> 1 Youngsters</td>
								<td><strong>$ 201.00</strong></td>
								<td>
									<ul class="edit_icon">
										<li><a href="#" style="background: #1C3947;"><i class="fa fa-eye"></i></a></li>
										<li><a href="#" style="background: #1D7FFF;"><i class="fa fa-comments"></i></a></li>
										<li><a href="#" style="background: #249E00;"><i class="fa fa-check"></i></a></li>
										<li><a href="#" style="background: #FF4444;"><i class="fa fa-times"></i></a></li>
									</ul>
								</td>
							</tr> 
						</tbody> 
					</table>
                  </div>

                <!--<div class="col-md-3 col-xl-3">
                  <a href="{{url::to('countries')}}">
                     <div class="mini-stat clearfix bg-info bx-shadow">
                        <span class="mini-stat-icon"><i class="fas fa-sitemap"></i></span>
                        <div class="mini-stat-info text-right">
                           <span class="counter">{{ $countrydata ?? ''}}</span>
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
                  <a href="{{url::to('manage-adventure-program')}}">
                     <div class="mini-stat clearfix bg-warning bx-shadow">
                        <span class="mini-stat-icon"><i class="fas fa-sitemap"></i></span>
                        <div class="mini-stat-info text-right">
                           <span class="counter">{{ $adventure_programdata ?? ''}}</span>
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
                  <a href="{{url::to('customers')}}">
                     <div class="mini-stat clearfix bg-primary bx-shadow">
                        <span class="mini-stat-icon"><i class="fas fa-sitemap"></i></span>
                        <div class="mini-stat-info text-right">
                           <span class="counter">{{ $customerdata ?? ''}}</span>
                           Total Adventure 
                        </div>
                        <div class="tiles-progress">
                           <div class="m-t-20">
                              <h5 class="text-uppercase text-white m-0">Adventure  <span class="pull-right">View</span></h5>
                           </div>
                        </div>
                     </div>
                  </a>
               </div>
               <div class="col-md-3 col-xl-3">
                  <a href="{{url::to('product')}}">
                     <div class="mini-stat clearfix bg-success bx-shadow">
                        <span class="mini-stat-icon"><i class="fas fa-sitemap"></i></span>
                        <div class="mini-stat-info text-right">
                           <span class="counter">{{ $productdata ?? ''}}</span>
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
               @endif
               @if(Session::get('userRole') == 2)
                  <div class="col-md-3 col-xl-3">
                     <a href="{{url::to('category')}}">
                        <div class="mini-stat clearfix bg-danger bx-shadow">
                           <span class="mini-stat-icon"><i class="fas fa-sitemap"></i></span>
                           <div class="mini-stat-info text-right">
                              <span class="counter">{{ $customerdata ?? ''}}</span>
                              Total Adventures
                           </div>
                           <div class="tiles-progress">
                              <div class="m-t-20">
                                 <h5 class="text-uppercase text-white m-0">Adventures <span class="pull-right">View</span></h5>
                              </div>
                           </div>
                        </div>
                     </a>
                  </div> -->



                  <div class="col-md-6 col-xl-6">
                     <a href="{{url::to('category')}}">
                        <div class="mini-stat clearfix bg-danger bx-shadow">
                           <span class="mini-stat-icon"><i class="fas fa-sitemap"></i></span>
                           <div class="mini-stat-info text-right">
                              <span class="counter">{{ $customerdata ?? ''}}</span>
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
               @endif                 
            </div>
         </div>
      </div>
   </div>
</div>