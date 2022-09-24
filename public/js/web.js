/* Status toggle starts */
$(window).load(function() {
    $('.togBtn').click(function(){
       var btnId = $ (this).attr ('id');
       var ret = btnId.split("_");
       var id = ret[1]; 
       var status=$(this).val();
       if(status == 1){
          var changedStatus = $(this).val('0');
          var statusNew = changedStatus.attr('value');
         // $('input[name='+btnId+'][value=' + statusNew + ']').prop('checked',false);
          var textStatus = $("#statusText_"+id).text("InActive");console.log("text"+textStatus.text());
          $("#statusText_"+id).removeClass("badge-success").addClass("badge-danger");
       }else{
          var changedStatus = $(this).val('1'); 
          var statusNew = changedStatus.attr('value');
          //$('input[name='+btnId+'][value=' + statusNew + ']').prop('checked',true);
          var textStatus = $('#statusText_'+id).text('Active');console.log("text_in"+textStatus.text());
          $("#statusText_"+id).removeClass("badge-danger").addClass("badge-success");
       }
       let _token = $('meta[name="csrf-token"]').attr('content');
       $.ajax({   
             url:"{{url('update-user-status')}}"+'/'+id,    
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

/* Datatable starts */



 //Get the total rows
//  $('#datatable-responsive1_wrapper').each( function () {
// 		var title = $(this).text();
// 		$(this).html( '<input type="text" placeholder="'+title+' Search" />' );
// 	} );
//  var table =  $('table ').dataTable({
//          searching: true,
//          paging: true,
//          info: false,      // hide showing entries
//          ordering: true,  // hide sorting
//          columnDefs: [{
//             orderable: false,
//             targets: "no-sort"
//          }],
//          bLengthChange : false,  // hide showing entries in dropdown
//          "dom": '<"pull-left"f><"pull-right"l>tip', //align search to left
//          "language": {
//          "search": "_INPUT_",
//          "searchPlaceholder": "Search here...",
//          "paginate": {
//             previous: '&#x3c;', // or '<'
//             next: '&#x3e;' // or '>' 
//          },
//          }
//     });

//      $('#datatable-responsive1_wrapper .pull-right ').append('<div class="dataTables_length"><label for="Total Users">Total Users : '+table.fnGetData().length+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>');
//      $('.pull-right .dataTables_length').css({'font-size':'15px','color':'#fff'});
//     $('#datatable-responsive1_wrapper').
//     css({
//             'background': '#7CA7BB' ,
//             'background-repeat': 'no-repeat',
//             'padding':'10px 0px 0px 0px' ,
//             'font-size':'18px',
//             'color':'#fff',
//             'border-radius':'8px 8px 0px 0px',
//          });

//       $('#datatable-responsive1').css({
//          "border":"0px",
//          "margin-bottom": "0px !important",
//       });

//       $('#datatable-responsive1_paginate').css({'background':'#fff'});

//       $('.dataTables_filter input[type="search"]').
//          css({'width':'250px'});   

/*Datatables ends */