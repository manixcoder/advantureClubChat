<div class="content add_adventure_users">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title"><a href="{{URL::to('banners')}}" >Banners</a> > Add New Banner</h4>
            </div>
        </div>
        <?php if (session('success')) { ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-success alert-dismissible">
                        <span id="success_msg">{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        <?php } ?>

        <form  action="{{ URL::to('banners/add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row" id="example-basic">
                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">  
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <label for="field-1" class="control-label ">Banner: <span style="color: red;">*</span></label> 
                                        <?php
                                        $banner = '';
                                        if (request('banner')) {
                                            $banner = request('banner');
                                        } elseif (!empty($banners_detail) && (request('banner') == '')) {
                                            $banner = $banners_detail['banner_name'];
                                        }
                                        ?>
                                        <input type="file" class="form-control error" id="banner" placeholder="Banner" name="banner" aria-required="true" aria-invalid="true">
                                        <?php if (isset($validation['banner'])) { ?>
                                            <label class="error">{{ $validation['banner'] }}</label>
                                            <?php
                                        }
                                        if (!empty($banners_detail) && (request('banner') == '')) {
                                            ?>
                                            <img src="{{asset('uploads/'.$banner)}}" alt="" class="image-responsive-height banner_thumb">
                                        <?php } ?>
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group">  
                                        <label for="field-1" class="control-label">Title: <span style="color: red;">*</span></label> 
                                        <?php
                                        $title = '';
                                        if (request('title')) {
                                            $title = request('title');
                                        } elseif (!empty($banners_detail) && (request('title') == '')) {
                                            $title = $banners_detail['title'];
                                        }
                                        ?>
                                        <input type="text" id="title" name="title" class="form-control" value="{{$title}}" placeholder="Title" > 
                                        <?php if (isset($validation['title'])) { ?>
                                            <label class="error">{{ $validation['title'] }}</label>
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
                    </form>
                </div>
            </div>
    </div>


