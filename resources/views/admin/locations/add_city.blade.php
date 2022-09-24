<div class="content add_adventure_users">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title"><a href="{{URL::to('cities')}}">Locations </a> > Create City</h4>
            </div>
        </div>
        <form action="{{ URL::to('cities/add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row" id="example-basic">
                <div class="col-md-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label ">Create City</label>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group"> 
                                        <?php
                                        $country = !empty(request('country')) ? request('country') : ''; ?>
                                        <select name="country" class="form-control">
                                            <option value="">Select Country</option>
                                            <?php
                                            foreach ($countries as $val) {
                                                $sel = '';
                                                if ($country == $val->id) {
                                                    $sel = 'selected';
                                                }
                                            ?>
                                                <option value="<?php echo $val->id; ?>" <?php echo $sel; ?>><?php echo $val->country; ?></option>
                                            <?php } ?>

                                        </select>
                                        <?php if (isset($validation['country'])) { ?>
                                            <label class="error">{{ $validation['country'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div> -->


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cities">Country</label>
                                        <?php
                                        $country = '';
                                        if (request('country')) {
                                            $country = request('country');
                                        } elseif (!empty($user_detail) && (request('country') == '')) {
                                            $country = $user_detail['country'];
                                        }
                                        ?>

                                        <select class="form-control" id="country" name="country">
                                            <option value="">Select Country</option>
                                            <?php
                                            foreach ($countries as $value) {
                                                $sel = '';
                                                if ($country == $value->id) {
                                                    $sel = 'selected';
                                                }
                                            ?>
                                                <option value="{{ $value->id }}" <?php echo $sel; ?>>{{ $value->country }}</option>
                                            <?php } ?>
                                        </select>
                                        <?php if (isset($validation['country'])) { ?>
                                            <label class="error">{{ $validation['country'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cities">Region</label>
                                        <?php $region = DB::table('regions')->get(); ?>
                                        <select class="form-control" id="region" name="region">

                                        </select>
                                        <?php if (isset($validation['region'])) { ?>
                                            <label class="error">{{ $validation['region'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        $city = !empty(request('city')) ? request('city') : '';
                                        ?>
                                        <input type="text" class="form-control" id="city" placeholder="City" name="city" aria-required="true" aria-invalid="true" value="<?php echo $city; ?>">
                                        <?php if (isset($validation['city'])) { ?>
                                            <label class="error">{{ $validation['city'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="cancel" class="btn btn-default cancel"><a href="{{url()->previous()}}">Cancel</a></button>
                                <button type="submit" class="btn btn-primary save">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

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

        $('#region').change(function() {
            base_url = '<?php echo URL::to('/'); ?>';
            $region_id = $('#region').val();
            $('#region').val($region_id);
            $.post(base_url + '/get_city/' + $region_id, {
                "_token": "{{ csrf_token() }}",
                count: $region_id
            }, function(data) {
                $('#cities').html(data);
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