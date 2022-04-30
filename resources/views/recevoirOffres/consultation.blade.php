@extends('layouts.app')
@section('title')
<h5>وصول العروض استشارة عدد : CO01</h5>
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
                                    <h5>المصلحة أو المؤسسة : المعهد العالي للدراسات التكنولوجية بجندوبة</h5>
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
                                        <h6>المشروع  :</h6><input  class="form-control" value='اقتناء حواسيب وطابعات' style='width:380px;'>
                                        <h6>وضعية الملف :</h6>
                                        <select class="form-control" style='width:380px;'>
                                            <option >بصدد الإعداد</option>
                                            <option selected>في انتظار العروض </option>
                                            <option >في الفرز</option>
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
                    ['15/05/2021','10:00','','01245','16/05/2021','<a class="btn btn-success feather icon-edit" href="{{route('recevoirOffresN1')}}" role="button">تحيين</a><a class="btn btn-danger feather icon-trash-2" role="button">حذف</a>'],
                    ['17/05/2021','08:00','','01254','18/05/2021','<a class="btn btn-success feather icon-edit" href="{{route('recevoirOffresN2')}}" role="button">تحيين</a><a class="btn btn-danger feather icon-trash-2" role="button">حذف</a>'],
                    ['18/05/2021','09:00','','01260','18/05/2021','<a class="btn btn-success feather icon-edit" href="{{route('recevoirOffresN3')}}" role="button">تحيين</a><a class="btn btn-danger feather icon-trash-2" role="button">حذف</a>']
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
                            title:'عدد التسجيل بمكتب الضبط'
                        },
                        {
                            title:'تاريخ التسجيل'
                        },
                        {
                            title:'تعديلات'
                        },

                    ]

                });
            });
        </script>

@endsection

