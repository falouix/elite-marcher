<title>{{ __('app.app_name') }} - @yield('page_title')</title>
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
    content="Legal Aid" />
<meta name="keywords"
    content="Legal, Aid, مكتب, محمامي">
    <meta name="author" content="CDF Center- Chedli Elhaj Ali" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Favicon icon
{{-- <linkrel="icon"href="asset('/images/favicon.ico')" type="image/x-icon"> --}}
<!-- fontawesome icon -->
<link rel="stylesheet" href="{{ asset('/fonts/fontawesome/css/fontawesome-all.min.css') }}">
<!-- animation css -->
<link rel="stylesheet" href="{{ asset('/plugins/animation/css/animate.min.css') }}">

<!-- vendor css -->
<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
<!-- vendor css -->
<link rel="stylesheet" href="{{ asset('/css/pages/pages.css') }}">
<!-- RTL css -->
@if (LaravelLocalization::getCurrentLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('/css/layouts/rtl.css') }}">
@endif


