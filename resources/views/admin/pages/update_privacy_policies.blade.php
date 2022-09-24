<div class="content add_adventure_users">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title"><a href="{{URL::to('privacy-policy')}}" >Privacy Policy</a> > Edit</h4>
            </div>
        </div>

        <form  action="{{ URL::to('privacy-policy/add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <?php
                                if (request('title')) {
                                    $title = request('title');
                                    $description = request('description');
                                    $saved_rec = count($terms) ?? 0;
                                    $cntr = 0;
                                    ?>
                                    <div class="title-div">
                                        <?php
                                        foreach ($title as $key => $val) {
                                            $tit = $title[$key];
                                            $des = $description[$key];
                                            ?>

                                            <?php if (($cntr >= $saved_rec) && ($cntr > 0)) { ?>
                                                <div class="alert close-program-btn">
                                                    <button type="button" class="close remove-program-btn">×</button>
                                                </div>
                                            <?php } ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" id="title" name="title[]" class="form-control" value="{{$tit}}" placeholder="Title" > 
                                                    <?php if (isset($validation['title.' . $key])) { ?>
                                                        <label class="error">{{ $validation['title.'.$key] }}</label>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea type="text" name="description[]" rows='6' class="form-control" placeholder="Description" >{{$des}}</textarea> 
                                                    <?php if (isset($validation['description.' . $key])) { ?>
                                                        <label class="error">{{ $validation['description.'.$key] }}</label>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php
                                            ++$cntr;
                                        }
                                        ?>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="title-div">
                                        <?php
                                        if (count($terms)) {
                                            foreach ($terms as $val) {
                                                ?>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <?php
                                                        $title = [];
                                                        if (request('title')) {
                                                            $title = request('title');
                                                        } elseif (!empty($terms) && (request('title') == '')) {
                                                            $title = $val->title;
                                                        }
                                                        ?>
                                                        <input type="text" id="title" name="title[]" class="form-control" value="{{$title}}" placeholder="Title" > 
                                                        <?php if (isset($validation['title'])) { ?>
                                                            <label class="error">{{ $validation['title'] }}</label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <?php
                                                        $description = [];
                                                        if (request('description')) {
                                                            $description = request('description');
                                                        } elseif (!empty($terms) && (request('description') == '')) {
                                                            $description = $val->description;
                                                        }
                                                        ?>
                                                        <textarea type="text" name="description[]" rows='6' class="form-control" placeholder="Description" >{{$description}}</textarea> 
                                                        <?php if (isset($validation['description'])) { ?>
                                                            <label class="error">{{ $validation['description'] }}</label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" id="title" name="title[]" class="form-control" placeholder="Title" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea type="text" name="description[]" rows='6' class="form-control" placeholder="Description" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                <?php }
                                ?>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default pull-right add-more-btn"><i class="fa fa-plus-circle"></i>&nbsp;Add more</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="cancel"  class="btn btn-default cancel"><a href="{{url()->previous()}}">Cancel</a></button>
                        <button type="submit"  class="btn btn-primary save">Save</button>
                    </div>                     
                </div><!-- End card-body -->
            </div> <!-- End card -->
        </form><!-- Form End -->
    </div><!-- container -->
</div>
<div class="add-more-div-content" style="display:none">
    <div class="row">
        <div class="col-md-12">
            <div class="alert close-program-btn">
                <button type="button" class="close remove-program-btn">×</button>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" id="title" name="title[]" class="form-control" placeholder="Title" >
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <textarea type="text" name="description[]" rows='6' class="form-control" placeholder="Description" ></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.add-more-btn').click(function () {
            $('.title-div').append($('.add-more-div-content').html());
        });
    });
    $(document).on('click', '.remove-program-btn', function () {
        $(this).parent().parent().remove();
    });
</script>