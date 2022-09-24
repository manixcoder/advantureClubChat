<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Adventures Club</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="<?php echo e(asset('public/assets/images/favicon_1.ico')); ?>">
        <!-- Custom Files -->
        <link href="<?php echo e(asset('public/assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('public/assets/css/icons.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('public/assets/css/style.css')); ?>" rel="stylesheet" type="text/css" />
        <script src="<?php echo e(asset('public/assets/js/modernizr.min.js')); ?>"></script>
        <!-- Alert -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />

        <script>
    history.pushState(null, null, null);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, null);
    });
        </script>
    </head>
    <body class="login">
        <?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="wrapper-page">
            <div class="card card-pages">
                <div class="card-header">
                    <a href="#" class="logo"><img src="<?php echo e(asset('public/images/logo.jpg')); ?>"></a>
                </div>
                <div class="card-body">
                    <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <div class="form">
                        <h1>Login to Panel</h1>
                        <form class="cmxform form-horizontal tasi-form" id="loginForm" method="POST" action="<?php echo e(route('login')); ?>" novalidate="novalidate">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <div class="col-12">
                                    <input id="username" type="text" class="form-control input-lg <?php if ($errors->has('username')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('username'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email" value="<?php echo e(old('username')); ?>" autocomplete="username" required="" aria-required="true" autofocus placeholder="Email Address">
                                    <?php if ($errors->has('username')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('username'); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-12">
                                    <input type="password" id="password" class="form-control input-lg <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" required="" aria-required="true" autocomplete="current-password" placeholder="Password">
                                    <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>
                            <div class="form-group retrieve_btn">
                                <div class="col-6">
                                    <a href="<?php echo e(url('/forgot-password')); ?>">Retrieve Password</a>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-primary btn-lg w-lg waves-effect waves-light" type="submit"> <?php echo e(__('Login')); ?></button> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <h3 style="text-align: center; color: #317eeb;">Looking to give feedback about our products? Click here</h3> -->
            <!-- <footer class="footer">
               © Adventure World 2020 - 2021. All rights reserved.
            </footer> -->
            <style type="text/css">
                .footer {
                    background-color: #f5f5f5;
                    border-top: 0;
                    right: 222px;
                }
            </style>
        </div>
        <script>
            var resizefunc = [];
        </script>
        <!-- Main  -->
        <script src="<?php echo e(asset('public/assets/js/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/bootstrap.bundle.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/detect.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/fastclick.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/jquery.slimscroll.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/jquery.blockUI.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/waves.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/wow.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/jquery.nicescroll.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/jquery.scrollTo.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/jquery.app.js')); ?>"></script>
        <!--form validation-->
        <script src="<?php echo e(asset('public/assets/plugins/jquery-validation/dist/jquery.validate.min.js')); ?>"></script>

        <!--form validation init-->
        <script src="<?php echo e(asset('public/assets/pages/form-validation-init.js')); ?>"></script>
    </body>
</html><?php /**PATH E:\xampp\htdocs\advantureClub\resources\views/admin/admin-login.blade.php ENDPATH**/ ?>