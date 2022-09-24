
<div class="content add_adventure_users">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title"><a href="{{URL::to('countries')}}" >Locations </a> > Create Country</h4>
            </div>
        </div>
        <form  action="{{ URL::to('countries/add') }}" method="POST" enctype="multipart/form-data">
            @csrf
           
            <div class="row" id="example-basic">
                <div class="col-md-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">  
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <label for="field-1" class="control-label ">Create Country</label> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <?php
                                        $country = !empty(request('country')) ? request('country') : '';
                                        ?>
                                        <input type="text" class="form-control" id="country" placeholder="Country Name" name="country" aria-required="true" aria-invalid="true"value="<?php echo $country; ?>" >
                                        <?php if (isset($validation['country'])) { ?>
                                            <label class="error">{{ $validation['country'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">         
                                    <div class="form-group"> 
                                        <?php
                                        $code = !empty(request('code')) ? request('code') : '';
                                        ?>
                                        <input type="text" class="form-control" id="code" placeholder="Country Code" name="code" aria-required="true" aria-invalid="true" value="<?php echo $code; ?>" >
                                        <?php if (isset($validation['code'])) { ?>
                                            <label class="error">{{ $validation['code'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">         
                                    <div class="form-group"> 
                                        <?php
                                        $short_name = !empty(request('short_name')) ? request('short_name') : '';
                                        ?>
                                        <input type="text" class="form-control" id="short_name" placeholder="Nationality" name="short_name" aria-required="true" aria-invalid="true" value="<?php echo $short_name; ?>" >
                                        <?php if (isset($validation['short_name'])) { ?>
                                            <label class="error">{{ $validation['short_name'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">         
                                    <div class="form-group"> 
                                        <?php
                                        $currency = !empty(request('currency')) ? request('currency') : '';
                                        ?>
                                        <input type="text" class="form-control" id="currency" placeholder="Country's currency" name="currency" aria-required="true" aria-invalid="true" value="<?php echo $currency; ?>" >
                                        <?php if (isset($validation['currency'])) { ?>
                                            <label class="error">{{ $validation['currency'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-6">         
                                    <div class="form-group"> 
                                        <?php
                                        $flag = !empty(request('flag')) ? request('flag') : '';
                                        ?>
                                        <input type="file" class="form-control" id="flag"  name="flag" aria-required="true" aria-invalid="true">
                                        <?php if (isset($validation['flag'])) { ?>
                                            <label class="error">{{ $validation['flag'] }}</label>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="cancel"  class="btn btn-default cancel"><a href="{{url()->previous()}}">Cancel</a></button>
                                <button type="submit"  class="btn btn-primary save">Save</button>
                            </div> 
                        </div>   
                    </div>
                </div>
        </form>                           
    </div>
</div>
</div>


