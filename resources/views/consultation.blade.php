@extends('layouts.app')
@section('content')
@section('title')
<h5>استشارات</h5>

@endsection

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <!-- [ breadcrumb ] start -->

                <!-- [ breadcrumb ] end -->
                <!-- [ Main Content ] start -->
                <div class="row">
                    <!-- Zero config table start -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto">
                                        <h5>المعهد العالي للدراسات التكنولوجية بجندوبة</h5>
                                    </div>
                                    <div class="col text-right">
                                       السنةالمالية : 2021
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <nav class="navbar m-b-30 p-10">
                                            <ul class="nav">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle text-secondary" href="#" id="bydate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> مراحل الإنجاز</a>
                                                    <div class="dropdown-menu" aria-labelledby="bydate">
                                                        <a class="dropdown-item" href="{{route('enregistrementCahierCharges')}}">كراس الشروط  </a>
                                                        <a class="dropdown-item" href="{{route('enregistrementPub')}}">الإعلان الإشهاري</a>
                                                        <a class="dropdown-item" href="{{route('recevoirOffresConsultation')}}">وصول العروض</a>
                                                        <a class="dropdown-item" href="{{route('ouvrirEnveloppesConsultation')}}">جلسات فتح الظروف</a>
                                                        <a class="dropdown-item" href="{{route('RapportSelctionOffresConsultation')}}">جلسات الفرز</a>
                                                        <a class="dropdown-item" href="{{route('entrependreConsultation')}}">اسناد الصفقة</a>
                                                        <a class="dropdown-item" href="{{route('enregistrementMarche')}}">تسجيل الصفقة </a>
                                                        <a class="dropdown-item" href="{{route('autorisationDebutTravaux')}}">إذن بداية الأشغال</a>
                                                        <a class="dropdown-item" href="{{route('acceptationTemporaire')}}">القبول الوقتي</a>
                                                        <a class="dropdown-item" href="{{route('acceptationFinale')}}">القبول النهائي</a>
                                                        <a class="dropdown-item" href="{{route('reglementFinal')}}">التسوية النهائية</a>
                                                        <a class="dropdown-item" href="{{route('annulationConsultation')}}">الغاء الصفقة</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>



                                <div class="card-body">
                                    <div class="dt-responsive table-responsive">
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="recommandations-table" class="table table-striped table-bordered nowrap">
                                                   <thead>
                                                        <th style="width: 30px">  </th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>

                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                @endsection
                                @section('srcipt-js')
                                <script>
                                $(document).ready(function() {

                                var table=[

                                ['C001','بصدد الإعداد','01/03/2021','اقتناء حواسيب وطابعات','مواد وخدمات','اقتناء حواسيب وطابعات','ميزانية الدولة','ميزانية الدولة','ثابتة','5500'],
                                ];
                                $("#recommandations-table").DataTable({
                                data:table,
                                columns: [{

                                title:'استشارة عدد'
                                },
                                {
                                title:'وضعية الملف'
                                },
                                {
                                title:'التاريخ'
                                },
                                {
                                title:'الموضوع'
                                },
                                {
                                title:'الإطار'
                                },
                                {
                                title:'المشروع'
                                },
                                {
                                title:'جهة التمويل'
                                },
                                {
                                title:'جهة التمويل'
                                },
                                {
                                title:'طبيعة الأسعار '
                                },
                                {
                                title:'الكلفة التقديرية للمشروع'
                                }

                                ]

                                });
                                });
                                </script>

                                @endsection

