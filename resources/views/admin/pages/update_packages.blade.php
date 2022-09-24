<div class="content add_adventure_users">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title"><a href="{{URL::to('sub-packages')}}">Subscriptions Packages</a> > Create Subscription Package</h4>
            </div>
        </div>

        <form action="{{ URL::to('sub-packages/add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row" id="example-basic">
                <div class="col-md-10 offset-1">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="pull-left page-title heading-title">Subscriptions Packages</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        $title = '';
                                        if (request('title')) {
                                            $title = request('title');
                                        } elseif (!empty($title) && (request('title') == '')) {
                                            $title = $package_detail['title'];
                                        }
                                        ?>
                                        <input type="text" name="title" class="form-control" value="{{$title}}" placeholder="Package Name">
                                        <?php if (isset($validation['title'])) { ?>
                                            <label class="error">{{ $validation['title'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                     <?php 
                                        $duration = '';
                                       ?>
                                    <div class="form-group">
                                       <input type="number" name="duration" class="form-control" value="{{$duration}}" placeholder="Duration in days" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        <?php if (isset($validation['duration'])) { ?>
                                            <label class="error">{{ $validation['duration'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        $package_cost = '';
                                        if (request('package_cost')) {
                                            $package_cost = request('package_cost');
                                        } elseif (!empty($package_detail) && (request('package_cost') == '')) {
                                            $package_cost = $package_detail['package_cost'];
                                        }
                                        ?>
                                        <input type="number" name="package_cost" class="form-control" value="{{$package_cost}}" placeholder="Package Cost in $" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        <?php if (isset($validation['package_cost'])) { ?>
                                            <label class="error">{{ $validation['package_cost'] }}</label>
                                        <?php 
                                        
                                        } ?>
                                    </div>
                                </div>
                               
                                <!-- <div class="col-md-6">
                                     <?php 
                                        $days = '';
                                       ?>
                                    <div class="form-group">
                                       <input type="text" name="days" class="form-control" value="{{$days}}" placeholder="Days">
                                        <?php if (isset($validation['days'])) { ?>
                                            <label class="error">{{ $validation['days'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div> -->
                                <!-- <div class="col-md-6">
                                     <?php 
                                        $symbol = '';
                                       ?>
                                    <div class="form-group">
                                       <input type="text" name="symbol" class="form-control" value="$" placeholder="Symbol $" disabled>
                                        <?php if (isset($validation['symbol'])) { ?>
                                            <label class="error">{{ $validation['symbol'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div> -->
                                <!-- <div class="col-md-6">
                                     <?php 
                                        $cost = '';
                                       ?>
                                    <div class="form-group">
                                       <input type="text" name="cost" class="form-control" value="{{$cost}}" placeholder="Cost ">
                                        <?php if (isset($validation['cost'])) { ?>
                                            <label class="error">{{ $validation['cost'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                     <?php 
                                        $offer_cost = '';
                                       ?>
                                    <div class="form-group">
                                       <input type="number" name="offer_cost" class="form-control" value="{{$offer_cost}}" placeholder="Offer Cost in $" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        <?php if (isset($validation['offer_cost'])) { ?>
                                            <label class="error">{{ $validation['offer_cost'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        // $package_duration = '';
                                        // if (request('package_duration')) {
                                        //     $package_duration = request('package_duration');
                                        // } elseif (!empty($package_detail) && (request('package_duration') == '')) {
                                        //     $package_duration = $package_detail['package_duration'];
                                        // }
                                        // $packages = DB::table('packages')->get();
                                        ?>
                                        <select class="form-control" name='package_duration'>
                                            <option value="">Package Duration</option>
                                            @forelse($packages as $package)
                                             <option value="{{ $package->id}}" <?php
                                                                if (request('package_duration') == $package->id) {
                                                                    echo 'selected';
                                                                }
                                                                ?>>{{ $package->title}}</option>
                                                    @empty
                                                    <option value="">Package Duration</option>
                                                    @endforelse            
                                                                
                                            
                                        </select>
                                        <?php if (isset($validation['package_duration'])) { ?>
                                            <label class="error">{{ $validation['package_duration'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <h4 class="pull-left page-title heading-title">What Includes</h4>
                                    </div>
                                    <div class="includes-parent-div">
                                        <?php
                                        if (request('includes')) {
                                            $includes = request('includes');
                                            $saved_rec = isset($package_includes) && count($package_includes) ?? 0;
                                            $cntr = 0;
                                            foreach ($includes as $key => $inc) {
                                                $tit = $includes[$key];
                                        ?>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="includes[]" class="form-control" value="{{$tit}}" placeholder="Enter text...">
                                                        <?php if (($cntr >= $saved_rec) && ($cntr > 0)) { ?>
                                                            <button type="button" class="close sub-pkg-remove-program-btn">×</button>
                                                        <?php
                                                        }
                                                        if (isset($validation['includes.' . $key])) {
                                                        ?>
                                                            <label class="error">{{ $validation['includes.'.$key] }}</label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php
                                                ++$cntr;
                                            }
                                        } else {
                                            ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="includes[]" class="form-control" placeholder="Enter text...">
                                                </div>
                                            </div> <?php }
                                                    ?>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-default pull-right add-more-inc"><i class="fa fa-plus-circle"></i>&nbsp;Add row</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <h4 class="pull-left page-title heading-title">What Not Includes</h4>
                                    </div>
                                    <div class="excludes-parent-div">
                                        <?php
                                        if (request('excludes')) {
                                            $excludes = request('excludes');
                                            $saved_rec = isset($package_excludes) && count($package_excludes) ?? 0;
                                            $cntr = 0;
                                            foreach ($excludes as $key => $inc) {
                                                $tit = $excludes[$key];
                                        ?>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="excludes[]" class="form-control" value="{{$tit}}" placeholder="Enter text...">
                                                        <?php if (($cntr >= $saved_rec) && ($cntr > 0)) { ?>
                                                            <button type="button" class="close sub-pkg-remove-program-btn">×</button>
                                                        <?php }
                                                        if (isset($validation['excludes.' . $key])) { ?>
                                                            <label class="error">{{ $validation['excludes.'.$key] }}</label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php
                                                ++$cntr;
                                            }
                                        } else {
                                            ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="excludes[]" class="form-control" placeholder="Enter text...">
                                                </div>
                                            </div> <?php }
                                                    ?>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-default pull-right add-more-exc"><i class="fa fa-plus-circle"></i>&nbsp;Add row</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="cancel" class="btn btn-default cancel"><a href="{{url()->previous()}}">Cancel</a></button>
                            <button type="submit" class="btn btn-primary save">Save</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>
<div class="add-more-program-div-content" style="display:none">
    <div class="includes-copy-div">
        <div class="col-md-12">
            <div class="form-group">
                <input type="text" name="includes[]" class="form-control" placeholder="Enter text...">
                <button type="button" class="close sub-pkg-remove-program-btn">×</button>
            </div>
        </div>
    </div>
    <div class="excludes-copy-div">
        <div class="col-md-12">
            <div class="form-group">
                <input type="text" name="excludes[]" class="form-control" placeholder="Enter text...">
                <button type="button" class="close sub-pkg-remove-program-btn">×</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.add-more-inc').click(function() {
            $('.includes-parent-div').append($('.includes-copy-div').html());
        });
        $('.add-more-exc').click(function() {
            $('.excludes-parent-div').append($('.excludes-copy-div').html());
        });
    });
    $(document).on('click', '.sub-pkg-remove-program-btn', function() {
        $(this).parent().parent().remove();
    });
</script>