<style type="text/css">
    .colerclass {
        color: #317eeb;
    }

    .menustyle {
        margin: 10px;
    }
</style>
<?php $segment = Request::segment(2); ?>
<div class="content add_adventure_users">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title"><a href="{{ URL::to('list-adventure-users') }}">Announcement</a> > Add New Announcement</h4>
            </div>
        </div>

        <form action="{{ URL::to('add-announcements') }}" method="POST" id="FormValidation" enctype="multipart/form-data">
            @csrf
            <!--<form  action="{{ URL::to('add-adventure-user') }}" method="POST"  enctype="multipart/form-data">-->
            <!--    @csrf-->
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
                                        <input type="text" id="title" name="title" class="form-control" aria-required="true" placeholder="Announcement Title">
                                        <?php if (isset($validation['title'])) { ?>
                                            <label class="error">{{ $validation['title'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" id="country" name="country">
                                            <option value="">Select Country</option>
                                            <?php
                                            $countries = DB::table('countries')->get();
                                            foreach ($countries as $value) { ?>
                                                <option value="{{ $value->id }}">{{ $value->country }}</option>
                                            <?php } ?>
                                        </select>
                                        <?php if (isset($validation['country'])) { ?>
                                            <label class="error">{{ $validation['country'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="control-label"><b>Partners</b>
                                            <font color="red">*</font>
                                        </p>
                                        <div class="radio radio-info form-check-inline">
                                            <input type="radio" id="licensed" value="1" name="licensed">
                                            <label for="inlineRadio1"> Licensed </label>
                                        </div>
                                        <div class="radio radio-info form-check-inline">
                                            <input type="radio" id="None licensed" value="0" name="licensed">
                                            <label for="inlineRadio1"> None licensed </label>
                                        </div>

                                        <div class="radio radio-info form-check-inline">
                                            <input type="radio" id="licensedBoth" value="2" name="licensed">
                                            <label for="inlineRadio1"> Both </label>
                                        </div>

                                        <?php if (isset($validation['licensed'])) { ?>
                                            <label class="error">{{ $validation['licensed'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="control-label"><b>Users</b>
                                            <font color="red">*</font>
                                        </p>
                                        <div class="radio radio-info form-check-inline">
                                            <input type="radio" id="male" value="1" name="gender">
                                            <label for="inlineRadio1"> Male </label>
                                        </div>
                                        <div class="radio radio-info form-check-inline">
                                            <input type="radio" id="female" value="0" name="gender">
                                            <label for="inlineRadio1"> Female </label>
                                        </div>

                                        <div class="radio radio-info form-check-inline">
                                            <input type="radio" id="genderboth" value="2" name="gender">
                                            <label for="inlineRadio1"> Both </label>
                                        </div>

                                        <?php if (isset($validation['gender'])) { ?>
                                            <label class="error">{{ $validation['gender'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea name="messages" id="messages" cols="130" rows="10"></textarea>
                                    </div>
                                </div>



                            </div>

                            <div class="modal-footer text-center">
                                <button type="cancel" id="canceltbtn" class="btn btn-default cancel"><a href="{{url()->previous()}}">Cancel</a></button>
                                <button type="submit" id="submitbtn" class="btn btn-primary save">Send</button>
                            </div>
                        </div><!-- End card-body -->
                    </div> <!-- End card -->
        </form><!-- Form End -->
    </div><!-- container -->
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#dob").datepicker({
            format: 'yyyy-mm-dd',
            // startDate: '+1d',
            autoclose: true,
            // showOn: "button",
            // buttonImage: "public/images/calender.png",
            // buttonImageOnly: true,
            // buttonText: "Select date",
        });
        $('#country').change(function() {
            base_url = '<?php echo URL::to('/'); ?>';
            $country_id = $('#country').val();
            $('#currency').val($country_id);
            $.post(base_url + '/get_regions/' + $country_id, {
                "_token": "{{ csrf_token() }}",
                count: $country_id
            }, function(data) {
                $('#region').html(data);
            });
        });
    });
    <?php if (request('country')) { ?>
        base_url = '<?php echo URL::to('/'); ?>';
        $country_id = <?php echo request('country'); ?>;
        $region = <?php echo request('region') ?? 0; ?>;
        $('#currency').val($country_id);
        $.post(base_url + '/get_regions/' + $country_id, {
            "_token": "{{ csrf_token() }}",
            count: $country_id,
            region: $region
        }, function(data) {
            $('#region').html(data);
        });
    <?php } ?>
</script>