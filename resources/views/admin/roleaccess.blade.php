<?php
$sessionId = Session::get('user_id');
$users = DB::table('users')->where('id', $sessionId)->first();
?>

<link href="{{ asset('public/assets/css/page_css/home.css') }}" rel="stylesheet" type="text/css" />
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Dashboard</h4>
            </div>
        </div>


        <!--page start-->
        <div class="bredcram_sec topHeading_sec">
            <h4>Role Access</h4>

        </div>
        <div class="rolaccess-sec">
            <div class="form-group fw">
                <form id="role_form" name="role_form" method="post" action="{{ url('save-country-session') }}">
                    @csrf
                    <select name="country" class="form-control">

                        <option value="">Select Country</option>

                        <?php
                        if (Session::has('country_id')) {
                            $cont_first = DB::table('countries')->where('id', Session::get('country_id'))->first();
                            $countries = DB::table('countries')->where('id', '!=', Session::get('country_id'))->get();
                        ?>
                            <option value="{{$cont_first->id}}" selected>{{$cont_first->country}}</option>
                            <?php
                            foreach ($countries as $cont) {
                            ?>

                                <option value="{{$cont->id}}">{{$cont->country}}</option>
                            <?php
                            }
                        } else {
                            $countries = DB::table('countries')->get();
                            foreach ($countries as $cont) {
                            ?>

                                <option value="{{$cont->id}}">{{$cont->country}}</option>
                        <?php
                            }
                        }
                        ?>


                    </select>

                    <input formaction="{{url('get-roles')}}" type="submit" value="Get Roles" class="btn save-btn">

            </div>

            <div class="roleac-inputchrck-sec">
                <div class="row">
                    <div class="col-6">
                        <ul class="checkbox-content">

                            <?php
                            if (Session::has('country_id')) {
                                $roles = DB::table('roles')->get();
                                foreach ($roles as $data) {
                                    $res = DB::table('role_assignments')->where('country_id', Session::get('country_id'))->where('role_id', $data->id)->count();

                                    //echo '</pre>'; print_r($data); 
                            ?>

                                    <li>
                                        <span>

                                            <span class="checkbox-span">
                                                @if($res==1)
                                                <input type="checkbox" name="checkbox[]" value="{{$data->id}}" class="inputcheck" checked>
                                                @else
                                                <input type="checkbox" name="checkbox[]" value="{{$data->id}}" class="inputcheck">
                                                @endif
                                                <small></small>
                                            </span>
                                            {{$data->role}}
                                        </span>
                                    </li>

                                <?php
                                }
                            } else {
                                ?>
                                <li>
                                    <span>
                                        No Role Found.
                                    </span>
                                </li>
                            <?php
                            }
                            ?>



                        </ul>
                        <div class="role-acbtn-sec">
                            <!--<a  class="btn save-btn">Save</a>-->
                            <input type="submit" class="btn save-btn" name="submit" Value="Save">
                            <a href="#" class="btn default">Default</a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <style>
            .footer {
                background-color: #f9f9f9;
                border-top: 1px solid rgba(0, 0, 0, 0.05);
                bottom: 0px;
                color: #58666e;
                text-align: center;
                padding: 20px 30px;
                position: absolute;
                right: 0;
                left: 240px;
                display: none;
            }
        </style>
        <!--page end-->

        <script>
            function formSubmit() {
                alert(123);
                //document.getElementById('role_form').submit();
                document.role_form.submit();
            }
        </script>


    </div>
</div>