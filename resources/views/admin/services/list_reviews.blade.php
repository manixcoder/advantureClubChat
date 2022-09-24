<style>
   /* The Modal (background) */
   .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 95px;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.4);
   }

   /* Modal Content/Box */
   .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      /* 15% from the top and centered */
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      /* Could be more or less, depending on screen size */
   }

   /* The Close Button */
   .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
   }

   .close:hover,
   .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
   }
</style>
<div class="content">
   <div class="container-fluid">
      <!-- Page-Title -->
      <div class="row">
         <div class="col-sm-12">
            <h4 class="pull-left page-title">Reviews </h4>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card ">
               <div class="card-body">
                  <table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>Adventure</th>
                           <th>Country</th>
                           <th>Category</th>
                           <th>Sector</th>
                           <th>Type</th>
                           <th>User Name</th>
                           <th>Ratings</th>
                           <th>Date</th>
                           <th>Likes</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                       
                        @foreach($reviewdata as $key => $data)
                        <?php // echo"<pre>";print_r($data);exit;  ?>
                        <tr class="gradeX">
                           <td>#{{ $key+1 }} - <br /> {{ $data->adventure_name }}</td>
                           <td>{{ $data->countries }}</td>
                           <td>{{ $data->category }}</td>
                           <td>{{ $data->sector }}</td>
                           <td>{{ $data->service_types }}</td>
                           <td>{{ $data->users_name }}</td>
                           <td>
                              <?php
                              for ($i = 0; $i < 5; $i++) {
                                 $checked = '';
                                 if ($i < $data->star) {
                                    $checked = 'checked';
                                 }
                              ?>
                                 <span class="fa fa-star <?php echo $checked; ?>"></span>
                              <?php } ?>
                              
                           <td></td>
                           <td></td>

                           <td class="actions">
                              <ul class="edit_icon action_icons dashboard_icons">
                                 <li>
                                    <!-- <a href="" class="waves-effect" data-toggle="tooltip" data-placement="top" title="" data-original-title="reply">
                                       <img src="{{ asset('/public/images/reply.png')}}">
                                    </a> -->
                                    <button id="myBtn"><img src="{{ asset('/public/images/reply.png')}}"></button>
                                    <!-- <a href="{{URL::to('view-adventure-user',$data->id)}}" class="waves-effect" data-toggle="tooltip" data-placement="top" title="" data-original-title="reply"><img src="{{ asset('/public/images/reply.png')}}"></a> -->
                                 </li>
                                 <li>
                                    <?php ?>
                                    <a href="#" class="like-Unlike" id="like_<?php echo $data->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="like">
                                       <img src="{{ asset('/public/images/unlike.png')}}">
                                    </a>

                                 </li>
                                 <li>
                                    <?php
                                    $status = '';
                                    if ($status == '') {
                                       $status = 'active';
                                       $img = "/public/images/block_active.png";
                                    } else {
                                       $status = 'inactive';
                                       $img = "/public/images/block_inactive.png";
                                    } ?>
                                    <a href="#" class="block_<?php echo $status; ?>" id="status" class="waves-effect" data-toggle="tooltip" data-placement="top" title="" data-original-title="block"><img src="{{URL::to($img)}}"></a>
                                 </li>
                                 <!-- <a href="{{ URL::to('add-adventure-user',$data->id) }}" class="on-default edit-row"data-toggle="tooltip" data-modal="modal-12" data-placement="top" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a> 
                              &nbsp;&nbsp;&nbsp; -->

                                 <!-- <a href="{{ URL::to('delete-customer',$data->id)}}" class="on-default remove-row" onclick="return confirm('Are you sure you want to delete this item?');" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fas fa-trash"></i></a> -->

                           </td>
                        </tr>

                        @endforeach
                     </tbody>
                  </table>

                  <!-- The Modal -->
                  <div id="myModal" class="modal">
                     <!-- Modal content -->
                     <div class="modal-content">
                        <span class="close">&times;</span>
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="user">
                                 User Name
                              </div>
                              <div class="user">
                                 User Name
                              </div>
                              <div class="user">
                                 User Name
                              </div>
                              <div class="comment">
                                 <form action="#" method="POST" id="FormValidation" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id" value="">
                                    <div class="row" id="example-basic">
                                       <div class="col-md-12">
                                          <div class="card">
                                             <div class="card-body">
                                                <div class="row">
                                                   <div class="col-md-12">
                                                      <h5></h5>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="form-group">
                                                         <input type="text" id="titlenotify" name="titlenotify" class="form-control" aria-required="true" placeholder="Title to notify">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="form-group">
                                                         <textarea name="notifydescription" id="notifydescription" class="form-control" placeholder="Write message to notify...……..."></textarea>

                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer text-center">
                                       <button type="cancel" id="canceltbtn" class="btn btn-default cancel">
                                          <a href="{{url()->previous()}}">Cancel</a></button>
                                       <button type="submit" id="submitbtn" class="btn btn-primary save">Save</button>
                                    </div>
                              </div>

                              </form>

                           </div>
                           <h4 class="pull-left page-title">

                              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                           </h4>
                        </div>
                     </div>
                  </div>
               </div>
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
   // Get the modal
   var modal = document.getElementById("myModal");

   // Get the button that opens the modal
   var btn = document.getElementById("myBtn");

   // Get the <span> element that closes the modal
   var span = document.getElementsByClassName("close")[0];

   // When the user clicks on the button, open the modal
   btn.onclick = function() {
      modal.style.display = "block";
   }

   // When the user clicks on <span> (x), close the modal
   span.onclick = function() {
      modal.style.display = "none";
   }

   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function(event) {
      if (event.target == modal) {
         modal.style.display = "none";
      }
   }
</script>
<script type="text/javascript">
   $(document).ready(function() {
      //Get the total rows
      $('#datatable-responsive1_wrapper').each(function() {
         var title = $(this).text();
         $(this).html('<input type="text" placeholder="' + title + ' Search" />');
      });
      var table = $('table ').dataTable({
         searching: true,
         paging: true,
         info: false, // hide showing entries
         ordering: true, // hide sorting
         order: [
            [0, "desc"]
         ],
         columnDefs: [{
            orderable: false,
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
            },
         }
      });

      $('#datatable-responsive1_wrapper .pull-right ').append('<div class="dataTables_length"><label for="Total Users">Total Users : ' + table.fnGetData().length + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>');
      $('.pull-right .dataTables_length').css({
         'font-size': '15px',
         'color': '#fff'
      });
      $('#datatable-responsive1_wrapper').
      css({
         'background': '#7CA7BB',
         'background-repeat': 'no-repeat',
         'padding': '10px 0px 0px 0px',
         'font-size': '18px',
         'color': '#fff',
         'border-radius': '8px 8px 0px 0px',
      });

      $('#datatable-responsive1').css({
         "border": "0px",
         "margin-bottom": "0px !important",
      });

      $('#datatable-responsive1_paginate').css({
         'background': '#fff'
      });

      $('.dataTables_filter input[type="search"]').
      css({
         'width': '250px'
      });

      $('#status').click(function() {
         $('.status_active').not(this).removeClass('status_active');
         $(this).toggleClass('status_active');
         $.ajax({
            url: "{{url('update-review-status')}}" + '/' + id,
            method: "GET",
            contentType: 'application/json',
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
               "_token": "{{ csrf_token() }}",
               "id": id,
               "status": statusNew
            },
            success: function(response) {
               console.log(response);
            }
         });
      });

      $(".like-Unlike").click(function(e) {
         var text = $(this).html();
         var btnId = $(this).attr('id');
         var ret = btnId.split("_");
         var id = ret[1];
         $(this).toggleClass('like');
         var changedText = $(this).hasClass('like') ? 'like' : 'unlike';
         if (changedText == 'like') {
            $(this).html(text.replace("unlike.png", "like.png"));
         } else {
            $(this).html(text.replace("like.png", "unlike.png"));
         }
         $.ajax({
            url: "{{url('update-like-status')}}" + '/' + id,
            method: "GET",
            data: {
               "id": id,
               "status": changedText
            },
            success: function(response) {
               console.log(response);
            }
         });
      });
   });

   /* Status toggle starts */
   $(window).load(function() {
      $('#datatable-responsive1').on("click", ".togBtn", function() {
         var btnId = $(this).attr('id');
         var ret = btnId.split("_");
         var id = ret[1];
         var status = $('#' + btnId).val();
         if (status == 1) {
            var changedStatus = $(this).val('0');
            var statusNew = changedStatus.attr('value');
            $('#' + btnId).val(statusNew);
            var textStatus = $("#statusText_" + id).text("InActive");
            $("#statusText_" + id).removeClass("badge-success").addClass("badge-danger");
         } else {
            var changedStatus = $(this).val('1');
            var statusNew = changedStatus.attr('value');
            $('#' + btnId).val(statusNew);
            $('input[name=' + btnId + '][value=' + statusNew + ']').prop('checked', true);
            var textStatus = $('#statusText_' + id).text('Active');
            $("#statusText_" + id).removeClass("badge-danger").addClass("badge-success");
         }

         $.ajax({
            url: "{{url('update-user-status')}}" + '/' + id,
            method: "GET",
            contentType: 'application/json',
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
               "_token": "{{ csrf_token() }}",
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