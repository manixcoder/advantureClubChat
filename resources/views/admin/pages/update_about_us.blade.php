<div class="content add_adventure_users">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title"><a href="{{URL::to('about-us')}}">About Us</a> > Edit</h4>
            </div>
        </div>
        <form action="{{ URL::to('about-us/add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="title-div">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="file" name="image" class="form-control">
                                            <?php if (isset($validation['image'])) { ?>
                                                <label class="error">{{ $validation['image'] }}</label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <img src="{{ url('/public/') }}/{{  $terms->image }}">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <?php
                                            $description = '';
                                            if (request('description')) {
                                                $description = request('description');
                                            } elseif (!empty($terms) && (request('description') == '')) {
                                                $description = $terms->content;
                                            }
                                            ?>
                                            <textarea type="text" name="description" rows='6' class="form-control" placeholder="Description">{{ $description }}</textarea>
                                            <?php if (isset($validation['description'])) { ?>
                                                <label class="error">{{ $validation['description'] }}</label>
                                            <?php } ?>
                                        </div>
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