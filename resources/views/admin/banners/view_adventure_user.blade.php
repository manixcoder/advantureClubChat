<style type="text/css">
   .colerclass{
      color: #317eeb;
   }
   .menustyle{
      margin: 10px;
   }
</style>
<!-- Start content -->
<div class="content">
   <div class="container-fluid">
      <!-- Page-Title -->
      <div class="row">
         <div class="col-sm-12">
         <!-- echo"<pre>";{{print_r($editdata)}};exit; -->
            @if($editdata->users_role == 3) 
             
            <!--<h4 class="pull-left page-title"><a href="#" onclick="window.history.go(-1); return false;">Users </a>  > #{{$editdata->id}}</h4>-->
            <h4 class="pull-left page-title"><a href="{{URL::to('list-adventure-users')}}" >Users </a>  > #{{$editdata->id}}</h4>
            
            <ol class="breadcrumb pull-right">
               <li><a href="{{ URL::to('home') }}">Home</a></li>
               <li class="active">View User</li>
            </ol>
            @else
            <h4 class="pull-left page-title">View Partner</h4>
            <ol class="breadcrumb pull-right">
               <li><a href="{{ URL::to('home') }}">Home</a></li>
               <li class="active">View Partner</li>
            </ol>
            @endif
         </div>
      </div>

      <div class="content partner_details">
         <div class="container-fluid">
               
            <div class="partners">
               <div class="row">
                  <div class="col-md-6">
                     <ul>
                        <li>
                           <p>User ID :</p>
                           <h3>{{$editdata->id }}</h3>
                        </li>
                        <li>
                           <p>User Name :</p>
                           <h3>{{$editdata->name}}</h3>
                        </li>
                        <li>
                           <p>Email Address :</p>
                           <h3>{{$editdata->email}}</h3>
                        </li>
                        <li>
                           <p>Mobile No. :</p>
                           <h3>{{$editdata->mobile}}</h3>
                        </li>
                        <li>
                           <p>Nationality :</p>
                           <h3>{{$editdata->country_name }}</h3>
                        </li>
                        <li>
                           <p>City/State :</p>
                           <h3>{{$editdata->region_name}}</h3>
                        </li>
                        <li>
                           <p>Date of Birth :</p>
                           <h3>{{$editdata->dob}}</h3>
                        </li>
                        <li>
                           <p>Profile Pic :</p>
                           <h3>
                              @if($editdata->profile_image!='')
                                 <img src="{{ asset('public/profile_image/').'/'.$editdata->profile_image }}" alt="image" width="100" height="100">
                              @else
                                 <img src="{{ asset('public/images/avatar-5.png') }}" alt="image" width="100" height="100">
                              @endif
                           </h3>
                        </li>
                     </ul>
                  </div>
                  <div class="col-md-6">
                     <ul>
                        <li>
                           <p>Health Conditions :</p>
                           <!-- <h3 class="ellipsis">{{strlen($editdata->health_conditions)>45 ? substr($editdata->health_conditions,0,45)."...":$editdata->health_conditions}}</h3>                      -->
                           <h3 class="ellipsis">{{$editdata->health_conditions}}</h3>
                        </li>
                        <li>
                           <p>Weight in Kg :</p>
                           <h3>{{$editdata->Weight}}</h3>                     
                        </li>
                        <li>
                           <p>Height in CM :</p>
                           <h3>{{$editdata->Height}}</h3>                     
                        </li>
                        <li>
                           <p>Status :</p>
                           <h3>
                              <label class="switch" for="checkbox">
                                 <input type="checkbox" id="checkbox" />
                                 @if($editdata->status==1)
                                    <span>Active &nbsp;&nbsp;<img src="{{ asset('/public/images/ac_active.png')}}"></span>
                                 @else
                                    <span>Inactive &nbsp;&nbsp;<img src="{{ asset('/public/images/ac_inactive.png')}}"></span>
                                    @endif
                                 
                              </label>
                           </h3>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div><!-- container -->
   </div>
