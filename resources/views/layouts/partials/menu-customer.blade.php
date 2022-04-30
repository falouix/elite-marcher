<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menupos-fixed ">
    <div class="navbar-wrapper ">
        <div class="navbar-brand header-logo">
            <a href="index.html" class="b-brand">
                <div class="b-bg">
                    L
                </div>
                <span class="b-title">{{ __('app.app_name') }}</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        </div>
        <div class="navbar-content scroll-div   ">
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>{{ __('menu.navigation') }}</label>
                </li>
                <li data-username="Dashboard" class="nav-item"><a href="/customer" class="nav-link"><span
                            class="pcoded-micon"><i class="feather icon-grid"></i></span><span
                            class="pcoded-mtext">{{ __('menu.dashboard') }}</span></a></li>
                <!-- Poas menu start-->
                <li data-username="Settings Users Roles&Permissions ui" class="nav-item">
                    <a href="{{ route('client-cases.index') }}" class="nav-link"><span class="pcoded-micon"><i
                                class="feather icon-briefcase"></i></span><span
                            class="pcoded-mtext">{{ __('menu.cases_list') }}</span></a>
                </li>
                <!-- case menu end-->
            </ul>
        </div>

    </div>
</nav>
<!-- [ navigation menu ] end -->
