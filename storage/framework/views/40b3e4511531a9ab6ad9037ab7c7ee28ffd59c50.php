<div class="content">
   <div class="container-fluid">
      <!-- Page-Title -->
      <div class="row">
         <div class="col-sm-12">
            <h4 class="pull-left page-title">Question Reports </h4>
            <ul class="breadcrumb pull-right">
               <!--<li><a href="<?php echo e(URL::to('add-admin-user')); ?>" class="waves-effect"><img src="<?php echo e(asset('/public/images/add_user.png')); ?>">&nbsp;&nbsp;<span>Add User</span></a>-->
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
                           <th class="no-sort">Question ID</th>
                           <th class="no-sort">User Name</th>
                           <th class="no-sort">Email Address</th>
                           <th class="no-sort">Mobile No</th>
                           <th class="no-sort">Country</th>
                           <th class="no-sort">Purpose</th>
                           <th class="no-sort">Question</th>
                           <th class="no-sort">Actions</th>
                           
                        </tr>
                     </thead>
                     <tbody>
                       
                        <?php $__currentLoopData = $usersdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                        //die('-------');					
                        // echo"<pre>";print_r($data);die; 
                         ?>	
                        <tr class="gradeX">
                           <td>#<?php echo e($key+1); ?></td>
                           <td><?php echo e($data->name); ?></td>
                           <td><?php echo e($data->email); ?></td>
                           <td><?php echo e($data->mobile_code); ?>- <?php echo e($data->mobile_number); ?></td>
                           <td><?php echo e($data->subject); ?></td>
                           <td><?php echo e($data->purpose); ?></td>
                            <td><?php echo substr($data->message, 0, 25) ."..."?></td>
                           <td class="actions"> 
                              <a href="<?php echo e(URL::to('question_report',$data->id)); ?>" >Delete</a>
                           </td>
                        </tr>
                       
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
         columnDefs: [{
            orderable: false,
            targets: "no-sort"
         }],
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

     $('#datatable-responsive1_wrapper .pull-right ').append('<div class="dataTables_length"><label for="Total Reports">Total Reports : '+table.fnGetData().length+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>');
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
    $('.togBtn').click(function(){
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
             url:"<?php echo e(url('update-user-status')); ?>"+'/'+id,    
             method:"GET",
             contentType : 'application/json',
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
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
         url:"<?php echo e(url('user/role/edit/')); ?>"+'/'+id,    
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
</script><?php /**PATH E:\xampp\htdocs\advantureClub\resources\views/admin/transactions/question_report.blade.php ENDPATH**/ ?>