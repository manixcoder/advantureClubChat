<div class="content">
   <div class="container-fluid">
      <!-- Page-Title -->
      <div class="row">
         <div class="col-sm-12">
            <h4 class="pull-left page-title">Requests</h4>
            <!-- <ol class="breadcrumb pull-right">
               <li><a href="{{ URL::to('home') }}">Home</a></li>
               <li class="active">Requests</li>
            </ol> -->
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="my_services vendor-request">
              <table id="datatable-responsive" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                  <thead>
                    <tr>
                      <th>Requests ID</th>
                      <th>Company Name</th>
                      <th>Official Address</th>
                      <th>Licensed</th>                            
                      <th>Partnership</th>
                      <th>Payment</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($userdata as $key => $data)
                    <!-- echo"<pre>";{{print_r($userdata)}};exit; -->
                    <tr class="gradeX">
                       <td>#{{ $data->id }}</td>
                       <td>{{ $data->company_name }}</td>
                       <td>{{ $data->company_address }}</td>
                       @if($data->license_status == 1)
                       <td>Yes</td>
                       @else
                       <td>No</td>
                       @endif
                       <td>{{ $data->subscription_id }}</td>
                       <td>{{ $data->payment_mode }}</td>

                       <td class="actions">
                          <!-- <a href="{{ URL::to('user-edit',$data->id)}}" class="on-default edit-row"  data-toggle="tooltip" data-modal="modal-12" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>  -->
                          <a href="{{ URL::to('user-view',$data->id)}}" class="on-default eye-row"  data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><img src="{{ asset('/public/images/ac_view.png')}}"></a>
                          <a href="{{ URL::to('user-approve',$data->id)}}" class="badge badge-success on-default eye-row"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Approve"><img src="{{ asset('/public/images/ac_accept.png')}}"></a>
                          <a href="{{ URL::to('vendor-request-decline',$data->id)}}" class="badge badge-danger on-default eye-row"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Declined"><img src="{{ asset('/public/images/ac_decline.png')}}"></a>
                          <!-- <a href="{{ URL::to('delete-user',$data->id)}}" class="on-default remove-row" onclick="return confirm('Are you sure you want to delete this item?');" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a> -->
                       </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
         </div>
         <!-- container -->
      </div>
   </div>
</div>
<!-- content -->
<script>
$(function () {
    $('#datatable-responsive').DataTable({
        responsive: true,
        searching: true,
        paging: true,
        info: false,
        ordering: false
    });
});
</script>