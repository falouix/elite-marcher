@extends('layouts.app')
@section('content')
@section('title')
<h5>مشاريع الشراءات</h5>
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

                                <div style="text-align: left">
                                    <a href="#!"><button type="button" class="btn btn-info feather icon-plus-circle">إضافة</button></a>

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
                ['PA001','01/01/2021','المعهد العالي للدراسات التكنولوجية بجندوبة','01/03/2021','اقتناء حواسيب وطابعات','مواد وخدمات','استشارة عادية','5500','2021',' <a class="btn btn-success feather icon-edit" href="{{route('approvisionnement_edit1')}}" role="button">تحيين</a><a class="btn btn-danger feather icon-trash-2" role="button">حذف</a>'],
                ['PA002','02/01/2021','مصلحة الإعلامية','01/02/2021','اقتناء حواسيب وتصميم منظومات','مواد وخدمات','طلب عروض إجراءات مبسطة','158000','2021',' <a class="btn btn-success feather icon-edit" href="{{route('approvisionnement_edit2')}}" role="button">تحيين</a> <a class="btn btn-danger feather icon-trash-2" role="button">حذف</a>']


                ];
            $("#recommandations-table").DataTable({
                data:table,
                columns: [{

                       title:'مشروع عدد'
                    },
                    {
                        title:'التاريخ'
                    },
                    {
                        title:'المصلحة أو المؤسسة '
                    },
                    {
                        title:'تاريخ اعتزام التنفيذ'
                    },
                    {
                        title:'الموضوع'
                    },
                    {
                        title:'طبيعة الطلب'
                    },
                    {
                        title:'طريقة الإبرام'
                    },
                    {
                        title:'الكلفة التقديرية الجملية للمشروع'
                    },
                    {
                        title:'السنة المالية'
                    },
                    {
                        title:'تعديلات'
                    }
                ]

            });
        });
    </script>

@endsection

