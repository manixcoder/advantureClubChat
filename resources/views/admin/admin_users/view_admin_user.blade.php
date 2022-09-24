<style type="text/css">
    .colerclass{
        color: #317eeb;
    }
    .menustyle{
        margin: 10px;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title"><a href="{{URL::to('list-admin-users')}}">Users </a>  > #{{$editdata->id}}</h4>
            </div>
        </div>

        <div class="content partner_details">
            <div class="container-fluid">

                <div class="partners">
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li>
                                    <p>User ID :</p>
                                    <h3>{{$editdata->id }}</h3>
                                </li>
                                <li>
                                    <p>User Name :</p>
                                    <h3>{{$editdata->name}}</h3>
                                </li>
                                <li>
                                    <p>Email Address :</p>
                                    <h3>{{$editdata->email}}</h3>
                                </li>
                                <li>
                                    <p>Mobile No. :</p>
                                    <h3>+{{$editdata->mobile_code}}- {{$editdata->mobile}}</h3>
                                </li>
                                <li>
                                    <p>Nationality :</p>
                                    <h3>{{$editdata->country }}</h3>
                                </li>
                                <li>
                                    <p>City/State :</p>
                                    <h3>{{$editdata->region}}</h3>
                                </li>
                                <li>
                                    <p>Date of Birth :</p>
                                    <h3>{{date('d M, Y',strtotime($editdata->dob))}}</h3>
                                </li>
                                <li>
                                    <p>Profile Pic :</p>
                                    <h3>
                                        @if($editdata->profile_image!='')
                                        <img src="{{ asset('public/images').'/'.$editdata->profile_image }}" alt="image" width="100" height="100">
                                        @else
                                        <img src="{{ asset('public/images/avatar-5.png') }}" alt="image" width="100" height="100">
                                        @endif
                                    </h3>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                
                                <li>
                                    <p>Weight in Kg :</p>
                                    <h3>{{$editdata->weight}}</h3>                     
                                </li>
                                <li>
                                    <p>Height in CM :</p>
                                    <h3>{{$editdata->height}}</h3>                     
                                </li>
                                <li>
                                    <p>Status :</p>
                                    <h3>
                                        <label class="switch">
                                        <?php 
                                         if($editdata->status == 1){
                                            $statVal = 1;
                                            $checked = 'checked = checked';
                                            $stat = 'Active';
                                         }else{
                                            $statVal = 0;
                                            $checked = '';
                                            $stat = 'InActive';
                                         }
                                            ?>
                                      <input type="checkbox" class="togBtn" id="togBtn_{{$editdata->id}}" name="togBtn_{{$editdata->id}}" value="{{ $statVal}}" <?php echo $checked;?> />
                                      <span class="slider round"></span>
                                      </label>
                                    </h3>
                                </li>
                                <li>
                                   <div id="cometchat" class="cometchat"><img src="{{ asset('/public/images/button_notify.png')}}">Notify</div>
                                </li>
                                <li>
                                   <div id="cometchat" class="cometchat"><a href="{{URL::to('delete-adminuser',$editdata->id)}}" >Delete</a> &nbsp;&nbsp;&nbsp;</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- container -->
</div>
<script>
$(window).load(function() {
   $('.togBtn').click(function(){
   var btnId = $ (this).attr ('id');
   var ret = btnId.split("_");
   var id = ret[1]; 
   var status=$(this).val();
   if(status == 1){
      var changedStatus = $(this).val('0');
      var statusNew = changedStatus.attr('value');
      var textStatus = $("#statusText_"+id).text("InActive");
      $("#statusText_"+id).removeClass("badge-success").addClass("badge-danger");
   }else{
      var changedStatus = $(this).val('1'); 
      var statusNew = changedStatus.attr('value');
      var textStatus = $('#statusText_'+id).text('Active');
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
</script>

<script>
   window.addEventListener('DOMContentLoaded', (event) => {
      var logged_in_id = <?php echo Auth::id();?>; 
      var url = window.location.href;console.log(url);
      var url_param = url.split('/');
      var UID = url_param[5];console.log(UID);
      var chat_name = '<?php  echo $editdata->name;?>';console.log(chat_name);
      var chat_id = UID;
      var chat_avatar = 'https://www.yoursite.com/avatars/1.png';
      var chat_link = 'https://www.yoursite.com/john-doe';


  CometChatWidget.init({
   "appID": "191362c7d608a14c",
            "appRegion": "us",
            "authKey": "c24adfb75af8133ff1118e1dc47c7a72fa9601c2"
   }).then((response) => {

  /**
   * Create user once initialization is successful
   */
  const user = new CometChatWidget.CometChat.User(UID);
  user.setName(chat_name);
  user.setAvatar(chat_avatar);
  user.setLink(chat_link);
  CometChatWidget.createOrUpdateUser(user).then((user) => {

    // Proceed with user login
    CometChatWidget.login({
      uid: UID,
    }).then((loggedInUser) => {

      // Proceed with launching your Chat Widget
      CometChatWidget.launch({
        // Embedded or docked layout configuration
       "widgetID": "9085e4df-84ca-4b31-a84a-8e7256eb2a03",
        //"widgetID": "bac0c741-ea70-4755-bf65-ad636a99d150",
                    "target": "#cometchat",
                    "docked": "true",
                    "alignment": "right", //left or right
                    "roundedCorners": "true",
                    "height": "450px",
                    "width": "400px",
      });
    });
  });
});
});
</script>
