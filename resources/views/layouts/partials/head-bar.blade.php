<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
    
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            <a href="index.html" class="b-brand">
                <div class="b-bg">
                    E
                </div>
                <span class="b-title">{{ __('app.app_name') }}</span>
            </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <a href="#!" class="mob-toggler"></a>
            <ul class="navbar-nav mr-auto">
                <li>
                    <!-- ============================================================================================= -->
                    <!-- remove .page-header div if you want breadcumb in bottom of header -->
                    <!-- ============================================================================================= -->
                    <!-- [ breadcrumb ] start -->
                    <div class="page-header">
                    </div>
                    <!-- [ breadcrumb ] end -->
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li> 
                    @if (LaravelLocalization::getCurrentLocale() == 'ar')
                    <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" >
                        English
                    </a>  
                    @else
                    <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}">
                        العربية
                    </a>
                    @endif
                </li>
                <li class="nav-item">
                    <div class="main-search">
                        <div class="input-group">
                            <input type="text" id="m-search" class="form-control" placeholder="{{ __('inputs.search') }}">
                            <a href="#!" class="input-group-append search-close">
                                <i class="feather icon-x input-group-text"></i>
                            </a>
                            <span class="input-group-append search-btn btn btn-primary">
                                <i class="feather icon-search input-group-text"></i>
                            </span>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">Notifications</h6>
                                <div class="float-right">
                                    <a href="#!" class="m-r-10">mark as read</a>
                                    <a href="#!">clear all</a>
                                </div>
                            </div>
                            <ul class="noti-body">
                                <li class="n-title">
                                    <p class="m-b-0">NEW</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <div class="media-body">
                                            <p><strong>John Doe</strong>
                                                <span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span>
                                            </p>
                                            <p>New ticket Added</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="n-title">
                                    <p class="m-b-0">EARLIER</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="{{ asset('/images/user/avatar-2.jpg') }}" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="{{ asset('/images/user/avatar-3.jpg') }}" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>
                                            <p>currently login</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="{{ asset('/images/user/avatar-1.jpg') }}" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="{{ asset('/images/user/avatar-3.jpg') }}" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>1 hour</span></p>
                                            <p>currently login</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="{{ asset('/images/user/avatar-1.jpg') }}" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>2 hour</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="noti-footer">
                                <a href="#!">show all</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li><a href="{{ url('/chatify') }}" class="ddisplayChatbox" target="_blank"><i class="icon feather icon-mail"></i></a></li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather icon-settings"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="{{ asset('/images/user/avatar-1.jpg') }}" class="img-radius" alt="User-Profile-Image">
                                <span>{{ auth::user()->full_name }}</span>
                                <a href="{{ route('logout') }}" class="dud-logout" title="{{ __('app.logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                >
                                    <i class="feather icon-log-out"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            <ul class="pro-body">
                              {{--    <li><a href="#!" class="dropdown-item"><i class="feather icon-settings"></i> {{ __('app.user_settings') }}</a></li>
                                <li><a href="#!" class="dropdown-item"><i class="feather icon-user"></i> {{ __('app.user_profile') }}</a></li>  --}}
                                <li><a href="{{ url('/chatify') }}" class="dropdown-item" target="__blank"><i class="feather icon-mail"></i> {{ __('app.user_messages') }}</a></li>
                                <li><a href="{{ route('logout') }}" class="dropdown-item" target="__blank" 
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="feather icon-log-out"></i> {{ __('app.logout') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        
</header>
<!-- [ Header ] end -->