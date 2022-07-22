@extends('layouts.app')
@section('title')
<h5>مشروع شراء عدد PA001 إضافة أو تحيين</h5>
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

                                <p>التاريخ:01/01/2021</p>
                                <div class="row"><!--style="width: 30px"-->
                                    <div class="col-auto mb-3"><br>

                                        <h6>الموضوع :</h6><input  class="form-control" value='اقتناء حواسيب وطابعات  ' style='width:380px;'>
                                        <h6>تاريخ اعتزام التنفيذ:</h6><input   value="01/03/2021" class="form-control" style='width:380px;'>
                                        <h6>طريقة الإبرام:</h6>
                                        <select class="form-control" style='width:380px;'>
                                            <option selected>استشارة عادية</option>
                                            <option >صفقة إجراءات مبسطة </option>
                                            <option >صفقة إجراءات عادية</option>
                                            <option >صفقة بالتفاوض المباشر</option>
                                        </select>
                                        <h6 style="color: red;">الكلفة الجملية المختارة : 5500</h6>


                                    </div>


                                    <div class="col mb-3"><br>

                                        <h6>طبيعة الطلب  :</h6>
                                        <select class="form-control"style='width:380px;' >
                                            <option selected>مواد وخدمات</option>
                                            <option>أشغال</option>
                                            <option>دراسات</option>
                                        </select>

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

                                                    </thead>
                                                </table>
                                                <div class="col-sm-12 col-md-6">
                                                    <button type="button" class="btn btn-primary"  data-toggle="tooltip">تسجيل</button>
                                                   </div>
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
                    ['1','','حاسوب','2','1500','3000','<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>'],
                    ['1','','الة طابعة','5','500','2500','<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>']
                    ];
                $("#recommandations-table").DataTable({
                    data:table,
                    columns: [{

                           title:'طلب عدد'
                        },
                        {
                            title:'القسط عدد'
                        },
                        {
                            title:'المادة'
                        },
                        {
                            title:'الكمية'
                        },
                        {
                            title:'الكلفة التقديرية للوحدة'
                        },
                        {
                            title:'الكلفة التقديرية الجملية'
                        },
                        {
                            title:'الإختيار'
                        },

                    ]

                });
            });
        </script>


@endsection
