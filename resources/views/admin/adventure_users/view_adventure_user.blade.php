<style type="text/css">
    .colerclass {
        color: #317eeb;
    }

    .menustyle {
        margin: 10px;
    }



    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 70%;
        height: 70%;
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
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title"><a href="{{URL::to('list-adventure-users')}}">Users </a> > #{{$editdata->id}}</h4>
            </div>
        </div>
        <?php
        // dd($editdata);
        ?>
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
                                    <h3>{{$editdata->mobile_code}} - {{$editdata->mobile}}</h3>
                                </li>
                                <li>
                                    <p>Nationality :</p>
                                    <h3>{{$editdata->short_name }}</h3>
                                </li>
                                <li>
                                    <p>Country :</p>
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
                                    @if($editdata->profile_image!='')
                                    <img src="{{ asset('public/').'/'.$editdata->profile_image }}" alt="image" width="100" height="100">
                                    @else
                                    <img src="{{ asset('public/images/avatar-5.png') }}" alt="image" width="100" height="100">
                                    @endif

                                    <div class="col-md-6 chatwithhime">
                                        <a href="">Chat with him</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>
                                    <p>Health Conditions :</p>
                                    <ul class="health-conditions">
                                        <?php foreach ($editdata->health_conditions as $hc) { ?>
                                            <li>{{$hc->name}}</li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li>
                                    <p>Weight in Kg :</p>
                                    <h3>{{$editdata->weight}}</h3>
                                </li>
                                <li>
                                    <p>Height in CM :</p>
                                    <h3>{{$editdata->height}}</h3>
                                </li>

                                <li>
                                    <p>Activities Count :</p>
                                    <h3>{{ $editdata->bookingscount}}  Activity</h3>
                                </li>
                                <li>
                                    <p>Status :</p>
                                    <h3>
                                        <label class="switch">
                                            <?php
                                            if ($editdata->status == 1) {
                                                $statVal = 1;
                                                $checked = 'checked = checked';
                                                $stat = 'Active';
                                            } else {
                                                $statVal = 0;
                                                $checked = '';
                                                $stat = 'InActive';
                                            }
                                            ?>
                                            <input type="checkbox" class="togBtn" id="togBtn_{{$editdata->id}}" name="togBtn_{{$editdata->id}}" value="{{ $statVal}}" <?php echo $checked; ?> />
                                            <span class="slider round"></span>
                                        </label>
                                    </h3>
                                </li>
                                
                                <li>
                                    <div id="cometchat" class="cometchat">
                                        <img src="{{ asset('/public/images/button_notify.png')}}">
                                        Notify
                                    </div>
                                    <?php
                                    if($editdata->bookingscount == '0'){
                                        $url = URL::to('delete-adventure-user/delete/').'/'.$editdata->id;
                                    }else{
                                        $url =""; 
                                    }
                                    if($editdata->bookingscount =='0'){
                                       $url = URL::to('delete-adventure-user/delete/').'/'.$editdata->id; 
                                   }else{
                                    $url =""; 
                                   }
                                   ?>
                                  
                                    <a href="{{ $url}}" id="delete" class="delete">
                                        <img src="{{ asset('/public/images/button_notify.png')}}">
                                        Delete
                                    </a>
                                    
                                </li>


                                <!-- The Modal -->
                                <div id="myModal" class="modal">
                                    <!-- Modal content -->
                                    <div class="modal-content">
                                        <div>

                                        </div>
                                        <span class="close">&times;</span>
                                        <div class="hedding">Notify to</div>
                                        <div class="users_data">
                                            <div>Name : {{$editdata->name}}</div>
                                            <div>Name : @if($editdata->profile_image!='')
                                                <img src="{{ asset('public/').'/'.$editdata->profile_image }}" alt="image" width="100" height="100">
                                                @else
                                                <img src="{{ asset('public/images/avatar-5.png') }}" alt="image" width="100" height="100">
                                                @endif
                                            </div>
                                        </div>
                                        <div>{{$editdata->mobile_code}} - {{$editdata->mobile}}</div>
                                        <div>{{$editdata->email}}</div>
                                        <form action="{{ URL::to('notify-user') }}" method="POST" id="FormValidation" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $editdata->id }}">
                                            
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
                                                                        <input type="text" id="title" name="title" class="form-control" aria-required="true" placeholder="Title to notify">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <textarea name="message" id="message" class="form-control" placeholder="Write message to notify...……..."></textarea>
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

                                    </form><!-- Form End -->


                                </div>
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
        $('.togBtn').click(function() {
            var btnId = $(this).attr('id');
            var ret = btnId.split("_");
            var id = ret[1];
            var status = $(this).val();
            if (status == 1) {
                var changedStatus = $(this).val('0');
                var statusNew = changedStatus.attr('value');
                var textStatus = $("#statusText_" + id).text("InActive");
                $("#statusText_" + id).removeClass("badge-success").addClass("badge-danger");
            } else {
                var changedStatus = $(this).val('1');
                var statusNew = changedStatus.attr('value');
                var textStatus = $('#statusText_' + id).text('Active');
                $("#statusText_" + id).removeClass("badge-danger").addClass("badge-success");
            }
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{url('update-user-status')}}" + '/' + id,
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

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        var logged_in_id = <?php echo Auth::id(); ?>;
        var url = window.location.href;
        console.log(url);
        var url_param = url.split('/');
        var UID = url_param[5];
        console.log(UID);
        var chat_name = '<?php echo $editdata->name; ?>';
        console.log(chat_name);
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
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("cometchat");

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