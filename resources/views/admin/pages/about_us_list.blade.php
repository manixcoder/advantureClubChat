<div class="content">
    <div class="container-fluid terms-condition-page">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">About Us</h4>
                <ul class="breadcrumb pull-right">
                    <li>
                        <a href="{{URL::to('about-us/add')}}" class="waves-effect">
                            <i class="fa fa-plus-circle"></i>
                            &nbsp;&nbsp;<span>Edit</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <?php
                        if ($terms) {
                            ?>
                            <div class="para">
                                <p class="title"><?php // echo $val->title ?></p>
                                <p class="description"><?php echo $terms->content ?></p>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>