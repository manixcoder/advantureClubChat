<?php
$segment = Request::segment(2);
if (!$segment) {
    $segment = 1;
}
$base_url = URL::to('/');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Transactions</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="datatable-responsive" class="table table-striped table-bordered" style="border: none;">
                    <thead>
                        <tr>
                            <th>TXN. Id</th>
                            <th>User Name</th>
                            <th>TXN. Type</th>
                            <th>Date & Time</th>
                            <th>Debit/Credit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($result)) {
                            foreach ($result as $key => $res) {
                                ?>
                                <tr class = "gradeX">
                                    <td>#{{$res->transaction_id}}</td>
                                    <td>{{$res->name}}</td>
                                    <td>{{$res->transaction_id}}</td>
                                    <td>{{date('d M, Y | h:i a', strtotime($res->created_at))}}</td>
                                    <td>{{$res->amount}}</td>
                                    <td><span class="badge action_icons bg-green transaction_icons"><i class="fa fa-check"></i></span></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr class = "gradeX">
                                <td class="text-center" colspan="7">No record found</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>