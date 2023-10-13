<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menupos-fixed ">
    <div class="navbar-wrapper ">
        <div class="navbar-brand header-logo">
            <a href="index.html" class="b-brand">
                <div class="b-bg">
                    L
                </div>
                <span class="b-title">Elite Marché </span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        </div>
        <div class="navbar-content scroll-div   ">



            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>{{ __('menu.navigation') }}</label>
                </li>
                <!--  menu -->
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-folder"></i>
                        </span>
                        <span class="pcoded-mtext">المخطط السنوي للشراءات</span>
                    </a>
                    <ul class="pcoded-submenu" style="display: none;">
                        <li class=""><a href="{{ route('besoin') }}" class="">ضبط الحاجيات </a></li>
                        <li class=""><a href="{{ route('confirmationBudget') }}" class="">المصادقة على
                                الحاجيات</a></li>
                        <li class=""><a href="{{ route('approvisionnement') }}" class="">مشاريع شراءات</a>
                        </li>
                        <li class=""><a href="{{ route('Dossier_achat') }}" class="">إعداد ملف شراءات </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-folder"></i>
                        </span>
                        <span class="pcoded-mtext">ملفات الشراءات</span>
                    </a>
                    <ul class="pcoded-submenu" style="display: none;">
                        <li class=""><a href="{{ route('consultations') }}" class="">استشارات</a></li>
                        <li class="pcoded-hasmenu"><a href="#!" class="">طلبات العروض </a>
                            <ul class="pcoded-submenu" style="display: none;">
                                <li class=""><a href="{{ route('simplifiées') }}" class="">إجراءات مبسطة
                                    </a></li>
                                <li class=""><a href="{{ route('normales') }}" class="">إجراءات عادية </a>
                                </li>
                                <li class=""><a href="{{ route('négociations_directes') }}" class="">التفاوض
                                        المباشر</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
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
                        <li class=""><a href={{ route('service') }} class="">المصالح/الدوائر/المؤسسات</a>
                        </li>
                        <li class=""><a href="{{ route('soumissionnaire') }}" class="">المتعهدين</a></li>
                        <li class=""><a href="{{ route('soumissionnaire') }}" class="">المتعهدين</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-settings"></i>
                        </span>
                        <span class="pcoded-mtext">الإعدادات</span>
                    </a>
                    <ul class="pcoded-submenu" style="display: none;">
                        <li class=""><a href="layout-static.html" class="">مستعملي التطبيقة </a></li>
                        <li class=""><a href={{ route('parametreAvertissement') }} class="">اعداد
                                التنبيهات</a></li>
                        <li class=""><a href="{{ route('reglages') }}" class="">اعدادات عامة</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</nav>
<!-- [ navigation menu ] end -->
