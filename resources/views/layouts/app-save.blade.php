<!DOCTYPE html>
<html lang="en">

<head>

    <title>{{ __('app.app_name') }} - 
      
  @if ($locale =='ar')
      تسجيل الدخول
  @else
  Sign in
  @endif
    </title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Elite Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, Elite Able, Elite Able bootstrap admin template">
    <meta name="author" content="Phoenixcoded" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel=" stylesheet" href="{{ asset('/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('/plugins/animation/css/animate.min.css') }}">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <!-- RTL css -->
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('/css/layouts/rtl.css') }}">
    @endif


</head>

<!-- [ signin-img-slider2 ] start -->

<body class="auth-prod-slider">
    <div class="blur-bg-images"></div>
    <div class="auth-wrapper">
        <div class="auth-content container">
            @yield('content')
        </div>
    </div>
    <!-- [ signin-img-slider2 ] end -->

    <!-- Required Js -->
    <script src="{{ asset('/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.min.js') }}"></script>


    <div class="footer-fab">
        <div class="b-bg">
            <i class="fas fa-question"></i>
        </div>
        <div class="fab-hover">
            <ul class="list-unstyled">
                <li><a href="../doc/index-bc-package.html" target="_blank" data-text="UI Kit"
                        class="btn btn-icon btn-rounded btn-info m-0"><i class="feather icon-layers"></i></a></li>
                <li><a href="../doc/index.html" target="_blank" data-text="Document"
                        class="btn btn-icon btn-rounded btn-primary m-0"><i
                            class="feather icon feather icon-book"></i></a></li>
                <li>
                    <a href="#!" target="_blank" data-text="Buy now"
                        class="btn btn-icon btn-rounded btn-success btn-envato m-0 p-0">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            id="Capa_1" x="0px" y="0px" viewBox="0 0 512.16 512.16"
                            style="enable-background:new 0 0 512.16 512.16;margin-right:5px;" xml:space="preserve"
                            width="18px" height="18px"
                            class="">
                            <g>
                                <path
                                    d="
                            M428.669,22.858l-3.029-6.101C419.692,5.442,407.467-1.126,394.749,0.16
                            c-75.456,0-249.344,116.608-265.451,302.763c-17.138-41.848-24.984-86.918-22.997-132.096c0.004-8.828-5.615-16.678-13.973-19.52
                            c-8.423-2.955-17.794-0.259-23.36,6.72c-31.163,40.288-47.907,89.867-47.552,140.8c0,102.741,73.429,213.333,234.667,213.333
                            c173.205,0,234.667-137.899,234.667-256C489.945,174.417,468.597,94.19,428.669,22.858z"
                            data-original="#4CAF50" class="active-path" data-old_color="#ffffff" fill="#ffffff">
                            </path>
                            </g>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>


</body>
</body>

</html>
