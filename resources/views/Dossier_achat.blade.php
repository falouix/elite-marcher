@extends('layouts.app')
@section('title')
    <h5>إعداد ملف شراءات </h5>
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
                                    <h5>المعهد العالي للدراسات التكنولوجية بجندوبة</h5>
                                    <p style="text-align: left">السنة المالية:2021 </p>
                                    <p>التاريخ:{{ date('Y-m-d') }}</p>
                                    <div style="text-align: left">

                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="dt-responsive table-responsive">
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="recommandations-table"
                                                    class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                        <th style="width: 30px"> </th>
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
                    <!--Modal1-->
                    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="card-body">
                                    <div class="dt-responsive table-responsive">
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="recommandations-table1"
                                                    class="table table-striped table-bordered nowrap">
                                                    <thead>

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

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!--Modal2-->
                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="card-body">
                                    <div class="dt-responsive table-responsive">
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="recommandations-table2"
                                                    class="table table-striped table-bordered nowrap">
                                                    <thead>

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

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>

                                </div>
                            </div>
                        </div>

                    </div>
                @endsection
                @section('srcipt-js')
                    <script>
                        $(document).ready(function() {

                            var table = [
                                ['PA001', '01/01/2021', 'المعهد العالي للدراسات التكنولوجية بجندوبة', '01/03/2021',
                                    'اقتناء حواسيب وطابعات', 'مواد وخدمات', 'استشارة عادية', '5500',
                                    ' <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">التفصيل</button>',
                                    ' <a href="{{ route('dossierConsultation') }}"> <button type="button" class="btn btn-success feather icon-check-circle">اعداد الملف</button></a>'
                                ],
                                ['PA002', '02/01/2021', 'مصلحة الإعلامية', '01/02/2021', 'اقتناء حواسيب وتصميم منظومات',
                                    'مواد وخدمات', 'طلب عروض إجراءات مبسطة', '158000',
                                    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">التفصيل</button>',
                                    ' <a href="{{ route('dossierAppelOffreS') }}"> <button type="button" class="btn btn-success feather icon-check-circle">اعداد الملف</button></a>'
                                ]
                            ];
                            $("#recommandations-table").DataTable({
                                data: table,
                                columns: [{

                                        title: 'مشروع عدد'
                                    },
                                    {
                                        title: 'التاريخ'
                                    },
                                    {
                                        title: 'المصلحة أو المؤسسة '
                                    },
                                    {
                                        title: 'تاريخ اعتزام التنفيذ'
                                    },
                                    {
                                        title: 'الموضوع'
                                    },
                                    {
                                        title: 'طبيعة الطلب'
                                    },
                                    {
                                        title: 'طريقة الإبرام'
                                    },
                                    {
                                        title: 'الكلفة التقديرية الجملية(بالدينار) للمشروع'
                                    },
                                    {
                                        title: 'التفصيل'
                                    },
                                    {
                                        title: 'تعديلات'
                                    }
                                ]

                            });
                        });


                        //---- script Modal1----
                        $(document).ready(function() {

                            var table = [
                                ['1', 'حاسوب', '2', '1500', '3000'],
                                ['1', 'الة طابعة', '5', '500', '2500']
                            ];
                            $("#recommandations-table1").DataTable({
                                data: table,
                                columns: [{
                                        title: 'القسط عدد'
                                    },
                                    {
                                        title: 'المادة'
                                    },
                                    {
                                        title: 'الكمية'
                                    },
                                    {
                                        title: 'الكلفة التقديرية للوحدة(بالدينار)'
                                    },
                                    {
                                        title: 'الكلفة التقديرية الجملية(بالدينار)'
                                    },


                                ]

                            });
                        });

                        //-----Script Modal2----
                        $(document).ready(function() {

                            var table = [
                                ['2', 'حاسوب', '10', '1800', '18000'],
                                ['2', 'منظومة التصرف في الموارد البشرية', '1', '100000', '1000000'],
                                ['2', 'تصميم موقع واب لجامعة جندوبة', '1', '40000', '40000']
                            ];
                            $("#recommandations-table2").DataTable({
                                data: table,
                                columns: [{
                                        title: 'القسط عدد'
                                    },
                                    {
                                        title: 'المادة'
                                    },
                                    {
                                        title: 'الكمية'
                                    },
                                    {
                                        title: 'الكلفة التقديرية للوحدة(بالدينار)'
                                    },
                                    {
                                        title: 'الكلفة التقديرية الجملية(بالدينار)'
                                    },
                                ]

                            });
                        });
                    </script>
                @endsection
