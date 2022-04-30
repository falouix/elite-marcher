@extends('layouts.app')
@section('content')
@section('title')
<h5>التعهد واسناد الصفقة طلب عروض عدد: AO001</h5>
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
                                <h5>المصلحة أو المؤسسة : مصلحة الإعلامية</h5>
                                <p style="text-align: left">السنة المالية:2020 </p>

                                <div class="row"><!--style="width: 30px"-->
                                    <div class="col-auto mb-3"><br>
                                        <h6>الموضوع :</h6><input  class="form-control" value='اقتناء حواسيب وتصميم منظومات' style='width:380px;'>
                                        <h6>وضعية الملف :</h6>
                                        <select class="form-control" style='width:380px;'>
                                            <option >بصدد الإعداد</option>
                                                <option >في انتظار العروض</option>
                                                <option selected>في الفرز</option>
                                                <option value="">بصدد الإنجاز</option>
                                                <option value="">القبول الوقتي</option>
                                                <option value="">القبول النهائي</option>
                                                <option value="">ملف منتهي </option>
                                                <option value="">ملغى</option>
                                        </select>
                                        <h6>تاريخ اسناد الصفقة :</h6><input  type='text' value="10/04/2021" class="form-control" style='width:380px;'>
                                        <h6>موقع الاشهار:</h6>
                                        <select class="form-control" style='width:380px;'>
                                                <option value="" selected>Tuneps</option>
                                                <option value="">موقع المؤسسة</option>
                                                <option value="">مواقع أخرى</option>
                                             </select>
                                             <h6>رقم البطاقة الوصفية:</h6><input  class="form-control" value=' ' style='width:380px;'>
                                             <h6>تاريخ التأشيرة:</h6><input  class="form-control" type='date' style='width:380px;'>
                                             <h6>الضمان النهائي:</h6><input  class="form-control" value=' ' style='width:380px;'>
                                    </div>


                                    <div class="col mb-3"><br>
                                       <h6> المشروع :</h6><input  class="form-control" value="اقتناء حواسيب وتصميم منظومات" type='text' style='width:380px;'>
                                        <h6>الإطار :</h6>
                                        <select class="form-control"style='width:380px;' >
                                            <option selected>مواد وخدمات</option>
                                            <option>أشغال</option>
                                            <option>دراسات</option>
                                        </select>

                                        <h6>لمتعهد :</h6><input type="text" value="شركة TECHNO " class="form-control" style="width:380px;" >

                                        <h6>تاريخ اشهار الإسناد:</h6><input  type='text' value="12/04/2021" class="form-control" style='width:380px;'>
                                        <h6>مرجع الاشهار:</h6><input  class="form-control" value=' ' style='width:380px;'>
                                        <h6>نوع البطاقة  :</h6>
                                        <select class="form-control" style='width:380px;'>
                                                <option value="">وصفية أولى</option>
                                                <option value="">محينة</option>
                                             </select>

                                             <h6>رقم التأشيرة:</h6><input  class="form-control" value=' ' style='width:380px;'>
                                             <h6>تاريخ تقديم الضمان النهائي:</h6><input  class="form-control" type='date' style='width:380px;'>


                                    </div>
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
                ['1','15','20000','2','02','0101','0112','100'],
                ['2','140','125000','2','02','0201','0213','','100']
               ];
            $("#recommandations-table").DataTable({
                data:table,
                columns: [{

                       title:'القسط'
                    },
                    {
                        title:'مدة الانجاز'
                    },
                    {
                        title:'المبلغ'
                    },
                    {
                        title:'العنوان'
                    },
                    {
                        title:'الفصل'
                    },
                    {
                        title:'الفقرة'
                    },
                    {
                        title:'الفقرة الفرعية'
                    },
                    {
                        title:'نسبة ميزانية الدولة%'
                    },
                    {
                        title:'نسبة التمويل الخارجي %'
                    }
                ]

            });
        });
    </script>
@endsection


