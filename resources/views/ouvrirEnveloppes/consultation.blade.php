@extends('layouts.app')
@section('title')
<h5>جلسات فتح الظروف استشارة عدد : CO01</h5>
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
                                    <h5>المصلحة أو المؤسسة :المعهد العالي للدراسات التكنولوجية بجندوبة</h5>
                                    <p style="text-align: left">السنة المالية:2021 </p>
                                    </div>
                                </div>


                                <div class="row"><!--style="width: 30px"-->
                                    <div class="col-auto mb-3"><br>

                                        <h6>الموضوع :</h6><input  class="form-control" value='اقتناء حواسيب وطابعات' style='width:380px;'>


                                        <h6>الإطار :</h6>
                                        <select class="form-control"style='width:380px;' >
                                            <option selected>مواد وخدمات</option>
                                            <option>أشغال</option>
                                            <option>دراسات</option>
                                        </select>


                                    </div>


                                    <div class="col mb-3"><br>
                                        <h6>المشروع  :</h6><input  class="form-control" value=' اقتناء حواسيب وطابعات' style='width:380px;'>
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



                                    </div>
                                    <div style="text-align: left">
                                        <a href="">  <button type="button" class="btn btn-info feather icon-plus-circle">إضافة</button></a>

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
                    ['2021/06','15/05/2021','<select><option value="">فنية</option><option value="">مالية</option><option value="" selected>فنية ومالية</option> </select>','3','','<select><option value="" selected>الموافقة</option><option value="">الرفض</option></select>','','<a class="btn btn-success feather icon-edit" href="{{route('consultationOuvertureEnveloppesN06')}}" role="button">تحيين</a><a class="btn btn-danger feather icon-trash-2" role="button">حذف</a>']
                   ];
                $("#recommandations-table").DataTable({
                    data:table,
                    columns: [{

                           title:'جلسة عدد'
                        },
                        {
                            title:'تاريخ الجلسة'
                        },
                        {
                            title:'فتح الظروف'
                        },
                        {
                            title:'عدد العروض'
                        },
                        {
                            title:'محضر الجلسة'
                        },
                        {
                            title:'توصيات اللجنة'
                        },
                        {
                            title:'الأعضاء الموقعين'
                        },
                        {
                            title:'تعديلات'
                        },

                    ]

                });
            });
        </script>

@endsection

