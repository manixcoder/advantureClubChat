<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Banners </h4>
                <ul class="breadcrumb pull-right">
                    <li><a href="{{URL::to('banners/add')}}" class="waves-effect"><img src="{{ asset('/public/images/add_user.png')}}">&nbsp;&nbsp;<span>Add Banner</span></a>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Banner</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($usersdata as $key => $data) {
                                    ?>
                                    <tr class = "gradeX">
                                        <td><img src="{{ asset('/public/uploads/'.$data['thumbnail'])}}"></td>
                                        <td><?= $data['title'] ?></td>
                                        <td>
                                            <?php if ($data['status']) { ?>
                                                <img src="{{ asset('/public/images/ac_accept.png')}}">
                                            <?php } else { ?>
                                                <img src="{{ asset('/public/images/ac_decline.png')}}">
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- end card-body -->
                </div>
            </div>
            <!-- container -->
        </div>
    </div>
</div>
<!-- content -->