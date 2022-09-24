<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Selections </h4>
                <ul class="breadcrumb pull-right">
                    <li><a href="{{URL::to('selections/add')}}" class="waves-effect"><img src="{{ asset('/public/images/add_user.png')}}">&nbsp;&nbsp;<span>Create Selection</span></a>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;    border: none;">
                    <thead>
                        <tr>
                            <th width="75px">Selection ID</th>
                            <th>Name</th>
                            <th>Under</th>
                            <th>Created On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $curr_tab = Request::segment(2) ?? 1;
                        foreach ($records as $key => $val) {
                            ?>
                            <tr class = "gradeX">
                                <td><?= $val['id'] ?></td>
                                <td><?= $val['name'] ?></td>
                                <td><?= $val['under'] ?></td>
                                <td><?= date('d M Y', strtotime($val['created_at'])) ?></td>
                                <td>
                                    <a href="{{URL::to('selections/delete/'.$curr_tab.'/'.$val['id'])}}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash delete-icon action-icons"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3 selections-tab">

                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link <?php
                    if ($curr_tab == 1 || $curr_tab == '') {
                        echo 'active';
                    }
                    ?>" href="{{URL::to('/selections/1')}}" role="tab" aria-controls="v-pills-home" aria-selected="true">Service Sector</a>
                    <a class="nav-link <?php
                    if ($curr_tab == 2) {
                        echo 'active';
                    }
                    ?>" href="{{URL::to('/selections/2')}}" role="tab" aria-controls="v-pills-profile" aria-selected="false">Service Category</a>
                    <a class="nav-link <?php
                    if ($curr_tab == 3) {
                        echo 'active';
                    }
                    ?>"  href="{{URL::to('/selections/3')}}" role="tab" aria-controls="v-pills-messages" aria-selected="false">Service Type</a>
                    <a class="nav-link <?php
                    if ($curr_tab == 4) {
                        echo 'active';
                    }
                    ?>"  href="{{URL::to('/selections/4')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">Service Level</a>
                    <a class="nav-link <?php
                    if ($curr_tab == 5) {
                        echo 'active';
                    }
                    ?>"  href="{{URL::to('/selections/5')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">Duration</a>
                    <a class="nav-link <?php
                    if ($curr_tab == 6) {
                        echo 'active';
                    }
                    ?>"  href="{{URL::to('/selections/6')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">Activities</a>
                    <a class="nav-link <?php
                    if ($curr_tab == 7) {
                        echo 'active';
                    }
                    ?>"  href="{{URL::to('/selections/7')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">Aimed</a>
                    <a class="nav-link <?php
                    if ($curr_tab == 8) {
                        echo 'active';
                    }
                    ?>"  href="{{URL::to('/selections/8')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">Dependency</a>
                    <a class="nav-link <?php
                       if ($curr_tab == 9) {
                           echo 'active';
                       }
                       ?>"  href="{{URL::to('/selections/9')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">Currency</a>
					   
					   <a class="nav-link <?php
                       if ($curr_tab == 10) {
                           echo 'active';
                       }
                       ?>"  href="{{URL::to('/selections/10')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">Health Condition</a>
					   
					    <a class="nav-link <?php
                       if ($curr_tab == 11) {
                           echo 'active';
                       }
                       ?>"  href="{{URL::to('/selections/11')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">Height</a>
					   <a class="nav-link <?php
                       if ($curr_tab == 12) {
                           echo 'active';
                       }
                       ?>"  href="{{URL::to('/selections/12')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">Weight</a>
					  
					   <a class="nav-link <?php
                       if ($curr_tab == 13) {
                           echo 'active';
                       }
                       ?>"  href="{{URL::to('/selections/13')}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">Contact Us Purpose</a>
					   
                </div>
            </div>
            <!-- container -->
        </div>
    </div>
</div>
<!-- content -->