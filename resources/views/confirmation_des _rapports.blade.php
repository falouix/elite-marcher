@extends('layouts.app')
@section('content')
@section('title')
<h5>المصادقة على تقارير فرز العروض <br>
    استشارة أو طلب عروض عدد .....
</h5>
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
                                <h5>المعهد العالي للدراسات التكنولوجية بجندوبة</h5>
                                <p style="text-align: left">السنة المالية:2020 </p>
                                <p>التاريخ:{{ date('Y-m-d') }}</p>
                                <div class="row"><!--style="width: 30px"-->
                                    <div class="col-auto mb-3"><br>




                                        <h6>الموضوع :</h6><input  class="form-control" value='إقتناء حواسيب ' style='width:380px;'>
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

                                        <h6>جلسة:</h6>
                                            <select class="form-control" style='width:380px;'>
                                                <option value="">فنية</option>
                                                <option value="">مالية</option>
                                                <option value="">فنية ومالية</option>
                                            </select>

                                        <h6>توصيات اللجنة:</h6><input  value="" class="form-control" style='width:380px;'>

                                    </div>


                                    <div class="col mb-3"><br>

                                        <h6>الإطار :</h6>
                                        <select class="form-control"style='width:380px;' >
                                            <option>مواد وخدمات</option>
                                            <option>أشغال</option>
                                            <option>دراسات</option>
                                        </select>


                                        <h6>التاريخ:</h6><input  type='date' class="form-control" style='width:380px;'>
                                        <h6>جلسة عدد:</h6><input  value="" class="form-control" style='width:380px;'>
                                        <h6>الحضور:</h6><input  class="form-control" value=' ' style='width:380px;'>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="dt-responsive table-responsive">
                                    <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_length" id="simpletable_length">
                                                    <label>تبين <select class="form-control" id="exampleFormControlSelect1">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option  value="100">100</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div id="simpletable_filter" class="dataTables_filter">
                                                <label>بحث:
                                                    <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="simpletable">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="simpletable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 150.906px;">تاريخ وصول العرض</th>
                                                <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 225.953px;">الساعة</th>
                                                <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 107.328px;">المرجع</th>
                                                <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 107.328px;">المتعهد</th>
                                                <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 107.328px;">عدد الاقساط</th>
                                                <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 107.328px;">مبلغ العرض</th>
                                                <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 107.328px;">قرار لجنة فتح الظروف</th>
                                                <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 107.328px;">قرار لجنة المصادقة</th>
                                                <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 107.328px;">الملاحظات</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        <tr role="row" class="odd">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <select id="exampleFormControlSelect1">
                                                    <option value="">الموافقة</option>
                                                    <option value="">الرفض</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="exampleFormControlSelect1">
                                                    <option value="">الموافقة</option>
                                                    <option value="">الرفض</option>
                                                </select>
                                            </td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row"><div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="simpletable_info" role="status" aria-live="polite">إظهار 1 إلى 10 من أصل 20 مُدخل</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="simpletable_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled" id="simpletable_previous">
                                    <a href="#" aria-controls="simpletable" data-dt-idx="0" tabindex="0" class="page-link">سابق</a>
                                </li>
                                <li class="paginate_button page-item active">
                                    <a href="#" aria-controls="simpletable" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="simpletable" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                                </li>
                                <li class="paginate_button page-item next" id="simpletable_next">
                                    <a href="#" aria-controls="simpletable" data-dt-idx="3" tabindex="0" class="page-link">التالي</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
    </div>
</div>
@endsection

