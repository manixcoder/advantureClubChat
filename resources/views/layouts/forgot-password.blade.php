<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    
    <title>{{__('Adventure World')}}-{{__('Reset Password') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />

    <meta content="Coderthemes" name="author" />
    
    <link rel="shortcut icon" href="{{asset('public/assets/images/favicon_1.ico')}}">
    <!-- Custom Files -->
    <link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('public/assets/js/modernizr.min.js')}}"></script>
    <!-- Alert -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script>
        history.pushState(null, null, null); 
        window.addEventListener('popstate', function() {
            history.pushState(null, null, null);
        });
    </script>
</head>
<body class="login">
    @include('layouts.alert')
    <div class="wrapper-page">
        <div class="card card-pages">
            <div class="card-header">
                <a href="#" class="logo"><img src="{{asset('public/images/logo.jpg')}}"></a>
            </div>
            <div class="card-body">
                 <!-- @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif -->
                @yield('content')
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
    <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/assets/js/detect.js')}}"></script>
    <script src="{{asset('public/assets/js/fastclick.js')}}"></script>
    <script src="{{asset('public/assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/assets/js/jquery.blockUI.js')}}"></script>
    <script src="{{asset('public/assets/js/waves.js')}}"></script>
    <script src="{{asset('public/assets/js/wow.min.js')}}"></script>
    <script src="{{asset('public/assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('public/assets/js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('public/assets/js/jquery.app.js')}}"></script>
    <!--form validation-->
    <script src="{{ asset('public/assets/plugins/jquery-validation/dist/jquery.validate.min.js')}}"></script>

    <!--form validation init-->
    <script src="{{ asset('public/assets/pages/form-validation-init.js')}}"></script>
</body>
</html>