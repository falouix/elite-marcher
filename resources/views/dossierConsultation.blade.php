@extends('layouts.app')
@section('title')
    <h5> ملف استشارة عدد : CO01 </h5>
@endsection

@section('content')
    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-auto">
                        المصلحة أو المؤسسة: المعهد العالي للدراسات التكنولوجية بجندوبة
                    </div>
                    <div class="col text-right">
                        السنةالمالية : 2021
                    </div>
                </div>
                <div><!--date('Y-m-d')-->
                    التاريخ : 01/03/2021
                </div>
            </div>

            <div class="col-md-12"> <br>
                <div class="row">
                    <div class="col-md-6">
                        <label>تاريخ اعتزام نشر الإعلان :</label>
                        <input class="mb-3 form-control form-control-lg" type="text" placeholder='01/05/2021'>
                        <label>الموضوع :</label>
                        <input class="mb-3 form-control form-control-lg" type="text" placeholder='اقتناء حواسيب وطابعات'>
                        <label>الإطار :</label>
                        <select class="mb-3 form-control  ">
                            <option>مواد وخدمات</option>
                            <option>أشغال</option>
                            <option>دراسات</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>وضعية الملف :</label>
                        <select class="mb-3 form-control  ">
                            <option>بصدد الإعداد</option>
                            <option>في انتظار العروض</option>
                            <option>في الفرز</option>
                            <option>بصدد الإنجاز</option>
                            <option>القبول الوقتي</option>
                            <option>القبول النهائي</option>
                            <option>ملف منتهي </option>
                            <option>ملغى</option>
                        </select>
                        <label>المشروع :</label>
                        <input class="mb-3 form-control form-control-lg" type="text" placeholder='اقتناء حواسيب وطابعات'>
                        <label>جهة التمويل :</label>
                        <input class="mb-3 form-control form-control-lg" type="text" placeholder='ميزانية الدولة'>
                        <label>طريقة التمويل :</label>
                        <select class="mb-3 form-control  ">
                            <option>ميزانية الدولة</option>
                            <option> قرض</option>
                            <option>هبة</option>
                        </select>
                        <label>طبيعة الأسعار :</label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="radio1 "checked>
                                <label class="custom-control-label" for="radio1">ضمان وقتي</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="radio2">
                                <label class="custom-control-label" for="radio2">ضمان نهائي</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="tableConsultation" class="table table-striped table-bordered nowrap">
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
        </div>
    </div>
@endsection
@section('srcipt-js')
    <script>
        $(document).ready(function() {

            var table = [
                ['', 'حاسوب ', '2', '1500', '3000'],
                ['', 'الة طابعة', '5', '500', '2500']
            ];
            $("#tableConsultation").DataTable({
                data: table,
                columns: [{

                        title: 'القسط عدد'
                    },
                    {
                        title: 'المادة'
                    },
                    {
                        title: 'الكمية '
                    },
                    {
                        title: 'الكلفة التقديرية للوحدة(بالدينار)'
                    },
                    {
                        title: 'الكلفة التقديرية الجملية(بالدينار)'
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json'
                }

            });
        });
    </script>
@endsection
