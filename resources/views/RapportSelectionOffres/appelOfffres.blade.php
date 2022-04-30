@extends('layouts.app')
@section('title')
<h5>المصادقة على تقرير فرز العروض طلب عروض عدد: AO001</h5>
@endsection
@section('content')
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
                                    <div class="col-md-12">
                                    <h5>المصلحة أو المؤسسة : مصلحة الإعلامية</h5>
                                    <p style="text-align: left">السنة المالية:2021 </p>
                                    </div>
                                </div>


                                <div class="row"><!--style="width: 30px"-->
                                    <div class="col-auto mb-3"><br>

                                        <h6>الموضوع :</h6><input  class="form-control" value='اقتناء حواسيب وتصميم منظومات' style='width:380px;'>


                                        <h6>الإطار :</h6>
                                        <select class="form-control"style='width:380px;' >
                                            <option selected>مواد وخدمات</option>
                                            <option>أشغال</option>
                                            <option>دراسات</option>
                                        </select>
                                        <h6>لجنة الصفقات :</h6>
                                        <select name="" id="" class="form-control" style='width:380px;'>
                                            <option value="">محلية</option>
                                            <option value="" selected>جهوية</option>
                                            <option value="">وطنية</option>
                                        </select>
                                        <h6>جلسة عدد :</h6> <input type="text" class="form-control" style='width:380px;' value="2021/02">
                                        <h6>توصيات اللجنة :</h6> <input type="text" class="form-control" style='width:380px;'>

                                    </div>


                                    <div class="col mb-3"><br>
                                        <h6>المشروع  :</h6><input  class="form-control" value=' اقتناء حواسيب وتصميم منظومات' style='width:380px;'>
                                        <h6>وضعية الملف :</h6>
                                        <select class="form-control" style='width:380px;'>
                                            <option >بصدد الإعداد</option>
                                            <option >في انتظار العروض </option>
                                            <option selected>في الفرز</option>
                                            <option >بصدد الإنجاز</option>
                                            <option value="">القبول الوقتي</option>
                                            <option value="">القبول النهائي</option>
                                            <option value="">ملف منتهي </option>
                                            <option value="">ملغى</option>
                                        </select>
                                        <h6>الحضور:</h6> <input type="text" class="form-control" style='width:380px;'>


                                        <h6>التاريخ  :</h6> <input type="text" class="form-control" style='width:380px;' value="10/04/2021">
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
                                                    </thead>
                                                </table>
                                                <button type="button" class="btn btn-primary"  data-toggle="tooltip">تسجيل</button>
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
                    ['02/04/2021','10:00','','شركة TECHNO','2','145000','<select><option value="" selected >الموافقة</option><option value="" >الرفض</option></select>','<select><option value="" selected >الموافقة</option><option value="" >الرفض</option></select>',''],
                    ['02/04/2021','09:00','','SIBE','2','170000','<select><option value="" selected >الموافقة</option><option value="" >الرفض</option></select>','',''],
                    ['03/04/2021','08:00','','H2i','2','176000','<select><option value="" selected >الموافقة</option><option value="" >الرفض</option></select>','','']
                   ];
                $("#recommandations-table").DataTable({
                    data:table,
                    columns: [{

                           title:'تاريخ وصول العرض'
                        },
                        {
                            title:'الساعة'
                        },
                        {
                            title:'المرجع'
                        },
                        {
                            title:'المتعهد'
                        },
                        {
                            title:'عدد الاقساط'
                        },
                        {
                            title:'مبلغ العرض'
                        },
                        {
                            title:'قرار لجنة فتح الظروف'
                        },
                        {
                            title:'قرار لجنة الصفقات'
                        },
                        {
                            title:'الملاحظات'
                        }
                    ]

                });
            });
        </script>

@endsection

