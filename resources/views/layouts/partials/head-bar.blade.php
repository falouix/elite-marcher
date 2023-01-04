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
                    <div >
                        <h5 class="m-b-10" >
                           @php $userService = App\Models\Service::select('*')->where('id', \Auth::user()->services_id)->first(); @endphp
                            @if($userService) {{ $userService->libelle }} @endif</h5>
                    </div>
                    <!-- [ breadcrumb ] end -->
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <input type="text" class="form-control" id="g_annee_gestion" maxlength="4" pattern="\d{4}" value="2022" required="">
                </li>

                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
                         @component('components.notifs')

                         @endcomponent
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
