<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menupos-fixed ">
    <div class="navbar-wrapper ">
        <div class="navbar-brand header-logo">
            <a href="{{ url('/') }}" class="b-brand">
                <div class="b-bg">
                    L
                </div>
                <span class="b-title">{{ __('app.app_name') }}</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#"><span></span></a>
        </div>
        <div class="navbar-content scroll-div   ">
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>{{ __('menu.navigation') }}</label>
                </li>
                @can('dashboard-list')
                <li data-username="Dashboard" class="nav-item"><a href="{{ route('home') }}"
                    class="nav-link"><span class="pcoded-micon"><i
                            class="feather icon-grid"></i></span><span
                        class="pcoded-mtext">{{ __('menu.dashboard') }}</span></a></li>
                @endcan
                @can('besoins-list')
                @if ($besoins_actif ==true)
                    <li data-username="Expenses ui" class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link"><span class="pcoded-micon"><i
                                    class="feather icon-sliders"></i></span><span class="pcoded-mtext">تحديد
                                الحاجيات</span></a>
                        <ul class="pcoded-submenu">

                            <li class=""><a href=" {{ route('besoins.index') }}" class="">ضبط الحاجيات</a>
                            </li>
                            <li class="">

                                @can('besoin-validate')
                                    <a href="{{ route('besoins-validation.index') }}" class="">المصادقة على الحاجيات</a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endif
                @endcan
                @can('pai')
                    <li data-username="Expenses ui" class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link"><span class="pcoded-micon"><i
                                    class="feather icon-sliders"></i></span><span class="pcoded-mtext"> البرنامج السنوي
                                للشراءات</span></a>
                        <ul class="pcoded-submenu">
                            @can('besoins-list')
                                <li class=""><a href=" {{ route('pais.index') }}" class="">المخطط السنوي
                                        للشراءات</a></li>
                                <li class="">
                                @endcan

                            <li class="">
                                <a href="{{ route('approvisionnement') }}" class="">مشاريع الشراءات</a>
                            </li>
                            <li class="">
                                <a href="{{ route('Dossier_achat') }}" class="">إعداد ملف شراءات </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('dossier-achat')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-folder"></i>
                        </span>
                        <span class="pcoded-mtext">ملفات الشراءات</span>
                    </a>
                    <ul class="pcoded-submenu" style="display: none;">
                        <li class=""><a href="{{ route('consultations') }}" class="">الإستشارات</a></li>
                        <li class="pcoded-hasmenu"><a href="#!" class="">طلبات العروض </a>
                            <ul class="pcoded-submenu" style="display: none;">
                                <li class=""><a href="{{ route('simplifiées') }}" class="">إجراءات مبسطة
                                    </a></li>
                                <li class=""><a href="{{ route('normales') }}" class="">إجراءات عادية </a>
                                </li>
                                <li class=""><a href="{{ route('négociations_directes') }}"
                                        class="">التفاوض المباشر</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('user-list')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-folder"></i>
                        </span>
                        <span class="pcoded-mtext">الجداول والطباعة</span>
                    </a>
                    <ul class="pcoded-submenu" style="display: none;">
                        <li class=""><a href="layout-static.html" class="">قائمة تحضيرية للجان الصفقات</a>
                        </li>
                        <li class=""><a href="layout-fixed.html" class="">قائمة في الصفقات النشطة</a></li>
                        <li class=""><a href="layout-menu-fixed.html" class="">قائمة في الصفقات حسب
                                السنة</a></li>
                        <li class=""><a href="layout-mini-menu.html" class="">قائمة في الصفقات حسب
                                المصلحة</a></li>
                        <li class=""><a href="layout-mini-menu.html" class="">قائمة في الصفقات حسب
                                الاطار</a></li>
                        <li class=""><a href="layout-mini-menu.html" class="">قائمة في الصفقات المختتمة</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-folder"></i>
                        </span>
                        <span class="pcoded-mtext">المعطيات الأساسية</span>
                    </a>
                    <ul class="pcoded-submenu" style="display: none;">
                        <li class=""><a href={{ route('services.index') }}
                                class="">المصالح/الدوائر/المؤسسات</a></li>
                                <li class=""><a href={{ route('natures-demande.index') }}
                                    class="">أنواع الطلبات</a></li>
                        <li class=""><a href="{{ route('soumissionnaires.index') }}"
                                class="">المتعهدين</a></li>
                    </ul>
                </li>
                @endcan
                <!-- settings menu -->
                @can('settings-general')
                    <li class="nav-item pcoded-menu-caption">
                        <label>{{ __('menu.settings_menu') }}</label>
                    </li>
                    @if (\Auth::user()->can('settings-update') || \Auth::user()->can('user-list') || \Auth::user()->can('role-list'))
                        <li data-username="Settings ui" class="nav-item pcoded-hasmenu">
                            <a href="#" class="nav-link"><span class="pcoded-micon"><i
                                        class="feather icon-sliders"></i></span><span
                                    class="pcoded-mtext">{{ __('menu.user-settings') }}</span></a>
                            <ul class="pcoded-submenu">
                                @can('user-list')
                                    <li class=""><a href=" {{ route('users.index') }}"
                                            class="">{{ __('menu.users_list') }}</a></li>
                                @endcan
                                @can('role-list')
                                    <li class=""><a href="
                          {{ route('roles.index') }}"
                                            class="">{{ __('menu.users_roles') }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif
                    <!-- settings menu end-->
                    <!-- case-settings menu -->
                    @if (\Auth::user()->can('case-type-list') || \Auth::user()->can('case-status-list') || (\Auth::user()->can('case-stage-list') && \Auth::user()->can('court-list')))
                        <li data-username=" Settings ui">
                            <a href="{{ route('etablissements.index') }}" class="nav-link"><span class="pcoded-micon"><i
                                        class="feather icon-sliders"></i></span><span
                                    class="pcoded-mtext">{{ __('menu.settings') }}</span></a>

                        </li>
                    @endif
                    <!-- case-settings menu end-->

                @endcan

            </ul>
        </div>

    </div>
</nav>
<!-- [ navigation menu ] end -->
