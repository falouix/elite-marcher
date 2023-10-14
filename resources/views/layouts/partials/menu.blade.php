<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menupos-fixed ">
    <div class="navbar-wrapper ">
        <div class="navbar-brand header-logo">
            <a href="{{ url('/') }}" class="b-brand">
                <div class="b-bg">
                    ج.ج
                </div>
                <span class="b-title"> @php
                    $userService = App\Models\Service::select('*')
                        ->where('id', \Auth::user()->services_id)
                        ->first();
                @endphp
                    @if ($userService)
                        {{ $userService->libelle }}
                    @endif
                </span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>{{ __('menu.navigation') }}</label>
                </li>
                @can('dashboard-list')
                    <li data-username="Dashboard" class="nav-item"><a href="{{ route('home') }}" class="nav-link"><span
                                class="pcoded-micon"><i class="feather icon-grid"></i></span><span
                                class="pcoded-mtext">{{ __('menu.dashboard') }}</span></a></li>
                @endcan
                @can('besoins')
                    @if ($besoins_actif == true)
                        <li data-username="Expenses ui" class="nav-item pcoded-hasmenu">
                            <a href="#" class="nav-link"><span class="pcoded-micon"><i
                                        class="feather icon-sliders"></i></span><span class="pcoded-mtext">تحديد
                                    الحاجيات</span></a>
                            <ul class="pcoded-submenu">
                                @can('besoins-list')
                                    <li class=""><a href=" {{ route('besoins.index') }}" class="">ضبط الحاجيات</a>
                                    </li>
                                @endcan


                                @can('besoin-validate')
                                    <li class="">
                                        <a href="{{ route('besoins-validation.index') }}" class="">المصادقة على
                                            الحاجيات</a>
                                    </li>
                                @endcan
                                @can('besoin-view')
                                    <li class=""><a href="{{ route('pais.index') }}" class="">المخطط السنوي
                                            للحاجيات</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif
                @endcan
                @can('projet-achat')
                    <li data-username="Expenses ui" class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link"><span class="pcoded-micon"><i
                                    class="feather icon-sliders"></i></span><span class="pcoded-mtext"> البرنامج السنوي
                                للشراءات</span></a>
                        <ul class="pcoded-submenu">
                            @can('projet-achat-list')
                                <li class="">
                                    <a href="{{ route('projets.index') }}" class="">مشاريع الشراءات</a>
                                </li>
                            @endcan

                            @can('projet-ppm')
                                <li class=""><a href=" {{ route('ppm.index') }}" class="">المخطط السنوي
                                        للشراءات</a></li>
                                <li class="">
                                @endcan
                        </ul>
                    </li>
                @endcan
                @can('dossier-achat')
                    <li data-username="Expenses ui" class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link"><span class="pcoded-micon"><i
                                    class="feather icon-sliders"></i></span><span class="pcoded-mtext">ملفات
                                الشراءات</span></a>
                        <ul class="pcoded-submenu">
                            @can('consultations-list')
                                <li class=""><a href="{{ route('consultations.index') }}" class="">الإستشارات</a>
                                </li>
                            @endcan
                            <li class="pcoded-hasmenu"><a href="#" class="">طلبات العروض </a>
                                <ul class="pcoded-submenu">
                                    @can('AOS-list')
                                        <li class=""><a href="{{ route('aos.index') }}" class="">إجراءات مبسطة
                                            </a></li>
                                    @endcan
                                    @can('AON-list')
                                        <li class=""><a href="{{ route('aon.index') }}" class="">إجراءات عادية </a>
                                        </li>
                                    @endcan
                                    @can('AOGREGRE-list')
                                        <li class=""><a href="{{ route('aogregre.index') }}" class="">التفاوض
                                                المباشر</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endcan
                {{--
                @can('comission-ao-achat')
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link">
                            <span class="pcoded-micon">
                                <i class="feather icon-folder"></i>
                            </span>
                            <span class="pcoded-mtext">اللجان المختصة</span>
                        </a>
                        <ul class="pcoded-submenu" style="display: none;">
                            @can('comission-ao-list')
                                <li class=""><a href="#" class="">لجنة الصفقات</a>
                                </li>
                            @endcan
                            @can('comission-achat-list')
                                <li class=""><a href="#" class="">لجنة الشراءات</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                --}}
                <!-- settings menu -->
                {{-- @can('settings-general') --}}

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
                                    <li class=""><a href="{{ route('roles.index') }}"
                                            class="">{{ __('menu.users_roles') }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif
                    <!-- settings menu end-->
                    <!-- case-settings menu -->

                    <li data-username="Expenses ui" class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link"><span class="pcoded-micon"><i
                                    class="feather icon-sliders"></i></span><span class="pcoded-mtext">إعدادات</span></a>
                        <ul class="pcoded-submenu">

                            <li data-username=" Settings ui">
                                <a href="{{ route('etablissements.index') }}" class="nav-link"><span
                                        class="pcoded-micon"><i class="feather icon-sliders"></i></span><span
                                        class="pcoded-mtext">إعدادات عامة</span></a>

                            </li>
                            <li data-username=" Settings ui">
                                <a href="{{ route('parambesoins.index') }}" class="nav-link"><span
                                        class="pcoded-micon"><i class="feather icon-sliders"></i></span><span
                                        class="pcoded-mtext">إعدادات ضبط الحاجيات</span></a>

                            </li>
                            <li class="pcoded-hasmenu"><a href="#" class="">المعطيات الأساسية</a>
                                <ul class="pcoded-submenu">
                                    <li class=""><a href={{ route('services.index') }}
                                            class="">المصالح/الدوائر/المؤسسات</a></li>
                                    <li class=""><a href="{{ route('natures-demande.index') }}"
                                            class="">أنواع
                                            الطلبات</a></li>
                                    <li class=""><a href="{{ route('articles.index') }}" class="">المواد أو
                                            الطلبات</a></li>
                                    <li class=""><a href="{{ route('types_docs.index') }}" class="">أنواع
                                            الوثائق</a></li>
                                    <li class=""><a href="{{ route('soumissionnaires.index') }}"
                                            class="">المتعهدين</a></li>
                                </ul>
                            </li>


                    </li>
                @endcan
            </ul>
            </li>
            <!-- case-settings menu end-->



            </ul>
        </div>

    </div>
</nav>
<!-- [ navigation menu ] end -->
