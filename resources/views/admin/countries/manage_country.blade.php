<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Manage countries </h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{ URL::to('home') }}">Home</a></li>
                    <li class="active">Manage countries </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="m-b-30">
                                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="addRecords()" > Add <i class="md md-add-circle-outline"></i></button>
                                </div>
                            </div>
                        </div>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Code</th>
                                    <th>PH. NO. Code</th>
                                    <th>Country Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($countrydata as $key => $data)
                                <tr class="gradeX">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $data->country }}</td>
                                    <td>{{ $data->short_name }}</td>
                                    <td>{{ $data->code }}</td>
                                    @if($data->status == 1)
                                    <td>
                                        <p class="mb-0">
                                            <span class="badge badge-success">Active</span>
                                        </p>
                                    </td>
                                    @else
                                    <td>
                                        <p class="mb-0">
                                            <span class="badge badge-danger">Inactive</span>
                                        </p>
                                    </td>
                                    @endif
                                    <td class="actions">
                                        <a href="#" class="on-default edit-row" onclick="editRecords({{ $data->id}})"  data-toggle="tooltip" data-modal="modal-12" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a> 
                                        &nbsp;&nbsp;&nbsp;

                                        <a href="{{ URL::to('countries-delete', $data->id)}}" class="on-default remove-row" onclick="return confirm('Are you sure you want to delete this item?');" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
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
<!--- MODEL CALL--->
<div id="unique-model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Country Define</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  action="{{ url('add-countries') }}" method="POST" id="FormValidation" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ids" id="ids">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="control-label"><b>Short Name :</b> <font color="red">*</font></p>
                                <input  type="text" id="short_name" name="short_name" class="form-control" required="" aria-required="true" placeholder=""> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="control-label"><b>Code :</b> <font color="red">*</font></p>
                                <input  type="text" id="code" name="code" class="form-control" required="" aria-required="true" placeholder=""> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="control-label"><b>Country :</b> <font color="red">*</font></p>
                                <input  type="text" id="country" name="country" class="form-control" required="" aria-required="true" placeholder=""> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="control-label"><b>Status :</b> <font color="red">*</font></p>
                                <div class="radio radio-info form-check-inline">
                                    <input type="radio" id="active" value="1" name="status" checked="">
                                    <label for="inlineRadio1"> Active </label>
                                </div>
                                <div class="radio radio-info form-check-inline">
                                    <input type="radio" id="inactive" value="0" name="status">
                                    <label for="inlineRadio1"> Inactive </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">  
                                <label class="control-label"> Description : <font color="red">*</font></label>
                                <textarea class="form-control rounded-0" name="description" id="descriptions" rows="3" required="" ></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitbtn" class="btn btn-primary">Submit</button> 
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button> 
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal eND -->
<script type="text/javascript">
    function editRecords(id)
    {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
    url:"{{url('countries-edit/')}}" + '/' + id,
            method:"POST",
            contentType : 'application/json',
            success: function(data)
            {
            $('#unique-model').modal('show');
            document.getElementById("ids").value = data.id;
            document.getElementById("short_name").value = data.short_name;
            document.getElementById("code").value = data.code;
            document.getElementById("country").value = data.country;
            document.getElementById("descriptions").value = data.description;
            document.getElementById("submitbtn").innerText = 'UPDATE';
            }
    });
    }

    function addRecords() {
    document.getElementById("FormValidation").reset();
    document.getElementById("submitbtn").innerText = 'Save';
    $('#unique-model').modal('show');
    }
</script>