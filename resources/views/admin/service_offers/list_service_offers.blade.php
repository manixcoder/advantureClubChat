<div class="content">
   <div class="container-fluid">
      <!-- Page-Title -->
      <div class="row">
         <div class="col-sm-12">
            <h4 class="pull-left page-title">Service Offers </h4>
            <ul class="breadcrumb pull-right">
               <li><a href="{{URL::to('add-service-offer')}}" class="waves-effect"><img src="{{ asset('/public/images/add_user.png')}}">&nbsp;&nbsp;<span>Create Service Offer</span></a>
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
                           <th class="no-sort">Offer ID</th>
                           <th class="no-sort">Adventure Name</th>
                           <th class="no-sort">Banner</th>
                           <th class="no-sort">Offer Name</th>
                           <th class="no-sort">Start Date</th>
                           <th class="no-sort">End Date</th>
                           <th class="no-sort">Discount</th>
                           <th class="no-sort">Status</th>
                           <th class="no-sort">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($usersdata as $key => $data) 
                         <!-- echo"<pre>";{{print_r($data)}};exit;  -->
                        <tr class="gradeX">
                           <td>#{{ $data->id }}</td>
                           <td>#{{ $data->adventure_name }}</td>
                           <td>
                           <img src="{{ asset('public/').'/'.$data->banner }}" alt="image" width="35" height="25"></td>
                           <td>{{ $data->name }}</td>
                           <td>{{ $data->start_date }}</td>
                           <td>{{ $data->end_date}}</td>
                           <?php if($data->discount_type == 'A'){

                           }?>
                           <td>{{ $data->discount_amount}}</td>
                           <?php 
                              if($data->status == 1){
                                 $status = 'Active';
                                 $class='badge-success';
                              }else{
                                 $status = 'InActive';
                                 $class='badge-danger';
                              }
                           ?>
                           <td >
                              <p class="mb-0">
                                 <span id="statusText_{{$data->id}}" class="badge <?php echo $class;?>">{{ $status }}</span>
                              </p>
                           </td>
                           <td class="actions">      
                           <ul class="edit_icon action_icons dashboard_icons">
                              <li>              
                                 <label class="switch">
                                    <?php 
                                    if($data->status == 1){
                                       $statVal = 1;
                                       $checked = 'checked = checked';
                                    }else{
                                       $statVal = 0;
                                       $checked = '';
                                    }
                                       ?>
                                 <input type="checkbox" class="togBtn" id="togBtn_{{$data->id}}" name="togBtn_{{$data->id}}" value="{{ $statVal}}" <?php echo $checked;?> />
                                 <!-- <input type="checkbox" class="togBtn" id="togBtn_{{$data->id}}" name="togBtn_{{$data->id}}" value="{{ $statVal}}" <?php //echo $checked;?> onchange="changeUserStatus({{$data->id}},{{$statVal}})" /> -->
                                 <span class="slider round"></span>
                                 </label>
                              </li>
                                 <li>
                                    <a href="{{URL::to('/service-offer/delete/'.$data->id)}}" onclick="return confirm('Are you sure you want to delete this request ?')" class="bg-red"><i class="fa fa-trash"></i></a>
                                 </li>
                              </ul>
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

<script type="text/javascript">
$(document).ready(function(){
 //Get the total rows
 $('#datatable-responsive1_wrapper').each( function () {
		var title = $(this).text();
		$(this).html( '<input type="text" placeholder="'+title+' Search" />' );
	} );
 var table =  $('table ').dataTable({
         searching: true,
         paging: true,
         info: false,      // hide showing entries
         ordering: true,  // hide sorting
         order: [[ 0, "desc" ]],
         // columnDefs: [{
         //    orderable: false,
         //    targets: "no-sort"
         // }],
         bLengthChange : false,  // hide showing entries in dropdown
         "dom": '<"pull-left"f><"pull-right"l>tip', //align search to left
         "language": {
         "search": "_INPUT_",
         "searchPlaceholder": "Search here...",
         "paginate": {
            previous: '&#x3c;', // or '<'
            next: '&#x3e;' // or '>' 
         },
         }
    });

     $('#datatable-responsive1_wrapper .pull-right ').append('<div class="dataTables_length"><label for="Total Users">Total Users : '+table.fnGetData().length+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>');
     $('.pull-right .dataTables_length').css({'font-size':'15px','color':'#fff'});
    $('#datatable-responsive1_wrapper').
    css({
            'background': '#7CA7BB' ,
            'background-repeat': 'no-repeat',
            'padding':'10px 0px 0px 0px' ,
            'font-size':'18px',
            'color':'#fff',
            'border-radius':'8px 8px 0px 0px',
         });

      $('#datatable-responsive1').css({
         "border":"0px",
         "margin-bottom": "0px !important",
      });

      $('#datatable-responsive1_paginate').css({'background':'#fff'});

      $('.dataTables_filter input[type="search"]').
         css({'width':'250px'});   
});
   
   /* Status toggle starts */
$(window).load(function() {
   $('#datatable-responsive1').on("click", ".togBtn", function(){
       var btnId = $ (this).attr ('id'); 
       var ret = btnId.split("_");
       var id = ret[1]; 
       var status=$('#'+btnId).val();
       if(status == 1){
          var changedStatus = $(this).val('0');
          var statusNew = changedStatus.attr('value');
          $('#'+btnId).val(statusNew);
          var textStatus = $("#statusText_"+id).text("InActive");
          $("#statusText_"+id).removeClass("badge-success").addClass("badge-danger");
       }else{
          var changedStatus = $(this).val('1'); 
          var statusNew = changedStatus.attr('value');
          $('#'+btnId).val(statusNew);
          $('input[name='+btnId+'][value=' + statusNew + ']').prop('checked',true);
          var textStatus = $('#statusText_'+id).text('Active');
          $("#statusText_"+id).removeClass("badge-danger").addClass("badge-success");
       }
       
       $.ajax({   
             url:"{{url('update-offer-status')}}"+'/'+id,    
             method:"GET",
             contentType : 'application/json',
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
               "_token": "{{ csrf_token() }}",
                "id": id,
                "status": statusNew 
               },
             success: function( response ) 
             {console.log(response); 
             }
         });
      });
   });
/* Status toggle ends */
   function editRecords(id) 
   { 
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
   
      $.ajax({   
         url:"{{url('user/role/edit/')}}"+'/'+id,    
         method:"POST",
         contentType : 'application/json',
         success: function( data ) 
         {
            $('#unique-model').modal('show');
            document.getElementById("ids").value = data.id;
            document.getElementById("username").value = data.username;
            document.getElementById("email").value = data.email;
            document.getElementById("password").value = data.password;            
            var val = data.status;
   
            if( val == 1)
            {
               $('input[name=status][value=' + val + ']').prop('checked',true);
            }else
            {
               $('input[name=status][value=' + val + ']').prop('checked',true);
            }
               document.getElementById("submitbtn").innerText ='UPDATE';
         }
      });
   }
   
   function addRecords() { 
      document.getElementById("FormValidation").reset();
      document.getElementById("submitbtn").innerText ='Save';
      $('#unique-model').modal('show');
   }
</script>