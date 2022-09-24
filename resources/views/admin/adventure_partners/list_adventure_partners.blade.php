<div class="content">
   <div class="container-fluid">
      <!-- Page-Title -->
      <div class="row">
         <div class="col-sm-12">
            <h4 class="pull-left page-title">Partners </h4>
            <ul class="breadcrumb pull-right">
               <li><a href="{{URL::to('add-adventure-partners')}}" class="waves-effect"><img src="{{ asset('/public/images/add_user.png')}}">&nbsp;&nbsp;<span>Add Partner</span></a>
            </ul>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card ">
               <div class="card-body">
                  <table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>User ID</th>
                           <th class="no-sort">Partner Name</th>
                           <th class="no-sort">Email Address</th>
                           <th class="no-sort">Mobile No.</th>
                           <th class="no-sort">Country</th>
                           <th class="no-sort">Services</th>
                           <th class="no-sort">Rating</th>
                           <th>Status</th>
                           <th class="no-sort">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $i = 1; ?>
                        @foreach($usersdata as $key => $data)
                        <?php 
                        $sevices = DB::table('services as s')->where('s.owner',$data->id)->get()->count();
                        ?>
                        <tr class="gradeX">
                           <td>#{{ $key+1 }}</td>
                           <td>{{ $data->name }}</td>
                           <td>{{ $data->email }}</td>
                           <td>{{ $data->mobile }}</td>
                           <td>{{ $data->country }}</td>
                           <td>{{ $sevices }}
                              <!-- @if($data->profile_image!='')
                              <img src="{{ asset('public/profile_image/').'/'.$data->profile_image }}" alt="profile image" height="50" width="50">
                              @else
                                 <img src="{{ asset('public/no-image.jpg')}}" alt="profile image" height="50" width="50">
                              @endif -->
                           </td>
                           <td><span class="fa fa-star"></span> Rating</td>

                           <?php
                           if ($data->is_approved == 1) {
                              $status = 'Active';
                              $class = 'badge-success';
                           } else {
                              $status = 'InActive';
                              $class = 'badge-danger';
                           }
                           ?>
                           <td>
                              <p class="mb-0">
                                 <span id="statusText_{{$data->id}}" class="badge <?php echo $class; ?>">
                                    {{ $status }}
                                 </span>
                              </p>
                           </td>
                           <td class="actions">
                              <ul class="edit_icon action_icons dashboard_icons">
                                 <li>
                                    <a href="{{URL::to('view-adventure-partner', $data->id )}}" class="waves-effect" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><img src="{{ asset('/public/images/ac_view.png')}}"></a>
                                 </li>
                                 <li>
                                    <label class="switch">
                                       <?php
                                       if ($data->is_approved == 1) {
                                          $statVal = 1;
                                          $checked = 'checked = checked';
                                       } else {
                                          $statVal = 0;
                                          $checked = '';
                                       }
                                       ?>
                                       <input type="checkbox" class="togBtn" id="togBtn_{{$data->id}}" name="togBtn_{{$data->id}}" value="{{ $statVal }}" <?php echo $checked; ?> />
                                       <span class="slider round"></span>
                                    </label>
                                 </li>
                                 <li>
                                    @if($sevices > 0)
                                    @else
                                    <a href="{{URL::to('/delete-adventure-partner/delete/'.$data->id)}}" onclick="return confirm('Are you sure you want to delete this request ?')" class="bg-red"><i class="fa fa-trash"></i></a>
                                    @endif
                                 </li>
                              </ul>
                           </td>
                        </tr>
                        <?php $i++; ?>
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

<script type="text/javascript">
   $(document).ready(function() {
      //Get the total rows
      $('#datatable-responsive1_wrapper').each(function() {
         var title = $(this).text();
         $(this).html('<input type="text" placeholder="' + title + ' Search" />');
      });
      var table = $('table').dataTable({
         searching: true,
         paging: true,
         info: false, // hide showing entries
         ordering: true, // hide sorting
         order: [
            [0, "desc"]
         ],
         columnDefs: [{
            orderable: true,
            targets: "no-sort"
         }],
         bLengthChange: false, // hide showing entries in dropdown
         "dom": '<"pull-left"f><"pull-right"l>tip', //align search to left
         "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search here...",
            "paginate": {
               previous: '&#x3c;', // or '<'
               next: '&#x3e;' // or '>' 
            }
         }

      });

      $('#datatable-responsive1_wrapper .pull-right ').append('<div class="dataTables_length"><label for="Total Partners">Total Partners : ' + table.fnGetData().length + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>');
      $('.pull-right .dataTables_length').css({
         'font-size': '15px',
         'color': '#fff'
      });
      $('#datatable-responsive1_wrapper').
      css({
         'background': '#7CA7BB',
         'padding': '10px 0px 0px 0px',
         'font-size': '18px',
         'color': '#fff',
         'border-radius': '8px 8px 0px 0px'
      });

      $('#datatable-responsive1').css({
         'border': '0px',
         'margin-bottom': '0px !important'
      });

      $('#datatable-responsive1_paginate').css({
         'background': '#fff'
      });

      $('.dataTables_filter input[type="search"]').
      css({
         'width': '250px'
      });
   });


   function editRecords(id) {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

      $.ajax({
         url: "{{url('user/role/edit/')}}" + '/' + id,
         method: "POST",
         contentType: 'application/json',
         success: function(data) {
            $('#unique-model').modal('show');
            document.getElementById("ids").value = data.id;
            document.getElementById("username").value = data.username;
            document.getElementById("email").value = data.email;
            document.getElementById("password").value = data.password;
            var val = data.status;

            if (val == 1) {
               $('input[name=status][value=' + val + ']').prop('checked', true);
            } else {
               $('input[name=status][value=' + val + ']').prop('checked', true);
            }
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
<script>
   $(window).load(function() {
      $('#datatable-responsive1').on("click", ".togBtn", function() {
         var btnId = $(this).attr('id');
         var ret = btnId.split("_");
         var id = ret[1];
         var status = $(this).val();
         if (status == 1) {
            var changedStatus = $(this).val('0');
            var statusNew = changedStatus.attr('value');
            // $('input[name='+btnId+'][value=' + statusNew + ']').prop('checked',false);
            var textStatus = $("#statusText_" + id).text("InActive");
            $("#statusText_" + id).removeClass("badge-success").addClass("badge-danger");
         } else {
            var changedStatus = $(this).val('1');
            var statusNew = changedStatus.attr('value');
            //$('input[name='+btnId+'][value=' + statusNew + ']').prop('checked',true);
            var textStatus = $('#statusText_' + id).text('Active');
            $("#statusText_" + id).removeClass("badge-danger").addClass("badge-success");
         }
         let _token = $('meta[name="csrf-token"]').attr('content');
         $.ajax({
            url: "{{url('update-partner-status')}}" + '/' + id,
            method: "GET",
            contentType: 'application/json',
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
               "id": id,
               "status": statusNew
            },
            success: function(response) {
               console.log(response);
            }
         });
      });
   });
</script>