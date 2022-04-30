@extends('layouts.app')
@section('content')
@section('title')
<h5>المصادقة على الطلب عدد 2</h5>
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
                                <h5>المصلحة أو المؤسسة الطالبة : مصلحة الإعلامية</h5>
                                <p style="text-align: left">السنة المالية:2021 </p>
                                <p>التاريخ:05/01/2020</p>
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


                                                </thead>
                                            </table>
                                            <div class="col-sm-12 col-md-6">
                                                <button type="button" class="btn btn-primary" data-toggle="tooltip">تسجيل</button>
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
                ['حاسوب','<td><select class="form-control" id="exampleFormControlSelect1"><option value="10" selected>مواد أو الخدمات </option><option value="25">الأشغال </option><option value="50">دراسات </option></select></td>','10','10','1800','180000'],
                ['منظومة التصرف في الموارد البشرية','<td><select class="form-control" id="exampleFormControlSelect1"><option value="10" selected>مواد أو الخدمات </option><option value="25">الأشغال </option><option value="50">دراسات </option></select></td>','1','1','100000','100000'],
                ['تصميم موقع واب لجامعة جندوبة','<td><select class="form-control" id="exampleFormControlSelect1"><option value="10" selected>مواد أو الخدمات </option><option value="25">الأشغال </option><option value="50">دراسات </option></select></td>','1','1','40000','40000'],

                ];
            $("#recommandations-table").DataTable({
                data:table,
                columns: [{

                       title:'المادة'
                    },
                    {
                        title:'تحديد الموضوع'
                    },
                    {
                        title:'الكمية المطلوبة'
                    },
                    {
                        title:'الكمية المصادق عليها'
                    },
                    {
                        title:'الكلفة التقديرية للوحدة'
                    },
                    {
                        title:'الكلفة التقديرية الجملي'
                    }

                ]

            });
        });
    </script>

@endsection




