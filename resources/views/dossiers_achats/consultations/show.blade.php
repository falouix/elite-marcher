@php

$breadcrumb = 'الإستشارات';
$subreadcrumb = 'عرض تفاصيل الإستشارة';

if ($locale == 'ar') {
    $lang = asset('/plugins/i18n/Arabic.json');
    $rtl = 'rtl';
} else {
    $lang = '';
    $rtl = 'ltr';
}
$tbl_action = __('labels.tbl_action');
@endphp

@extends('layouts.app')
@section('head-script')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('/plugins/data-tables/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/data-tables/css/select.dataTables.min.css') }}">
    <!-- pnotify css -->
    <link rel="stylesheet" href="{{ asset('/plugins/pnotify/css/pnotify.custom.min.css') }}">
    <!-- pnotify-custom css -->
    <link rel="stylesheet" href="{{ asset('/css/pages/pnotify.css') }}">
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
@endsection

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', [
        'bread_title' => $breadcrumb,
        'bread_subtitle' => $subreadcrumb,
    ])
@endsection

@section('content')
    <div class="col-xl-4 col-lg-12 task-detail-right">
        <div class="card">
            <div class="card-body bg-c-blue">
                <div class="counter text-center">
                    <h4 id="timer" class="text-white m-0">
                        <i class="fas fa-gavel" style="font-size: 30px; color:white"></i>
                        إستشارة عدد : {{ $dossier->code_dossier }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>وضعية الملف</h5>

                <div class="card-header-right">
                    {!! App\Common\Utility::getSituationDossierLabel($dossier->situation_dossier) !!}
                </div>
            </div>
            <div class="card-body task-details">

                <div class="pl-0">
                    <div class="main-profile-overview">

                        <div class=" justify-content-between ">

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td style="padding: 0.3rem; border-top:white;">
                                            <h6> السنة المالية </h6>
                                        </td>
                                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                            {{ $dossier->annee_gestion }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.3rem; border-top:white;">
                                            <h6>
                                                مشروع عدد :
                                            </h6>
                                        </td>
                                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                            {{ $dossier->code_projet }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.3rem; border-top:white;">
                                            <h6>
                                                الإطار :
                                            </h6>
                                        </td>
                                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                            {{ $dossier->type_demande }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="padding: 0.3rem; border-top:white;">
                                            <h6>
                                                جهة التمويل :
                                            </h6>
                                        </td>
                                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                            {{ $dossier->organisme_financier }}
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="padding: 0.3rem; border-top:white;">
                                            <h6>
                                                طريقة التمويل :
                                            </h6>
                                        </td>
                                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                            {{ $dossier->source_finance }}
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="padding: 0.3rem; border-top:white;">
                                            <h6>
                                                طبيعة الأسعار :
                                            </h6>
                                        </td>
                                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                            {{ $dossier->nature_finance }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <hr class="mg-y-20">
                            <h6>الموضوع </h6>
                            <div class="main-profile-social-list">

                                <div class="media">
                                    <p style="line-height: 27px">
                                        {{ $dossier->objet_dossier }}
                                    </p>
                                </div>
                            </div>

                        </div>

                        <hr class="mg-y-20">
                        <h6>المتعهد</h6>
                        <hr class="mg-y-20">
                        <div class=" justify-content-between ">

                            <table class="table">

                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>{{ __('labels.tbl_client_name') }} </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">

                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>
                                            {{ __('labels.tbl_client_phone') }} :

                                        </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">

                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>
                                            {{ __('labels.tbl_email_abr') }} :
                                        </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">

                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>
                                            {{ __('labels.tbl_client_adress') }} :
                                        </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">

                                    </td>
                                </tr>

                            </table>
                        </div>




                    </div><!-- main-profile-overview -->
                </div>
            </div>
        </div>


    </div>
    <div class="col-xl-8 col-lg-12">

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-border-c-blue">
                    <div class="card-header">
                        <a href="#" class="text-secondary">تفاصيل الإستشارة</a>
                        <div class="card-header-right">
                            <a href="{{ route('consultations.index') }}" class="btn btn-secondary">
                                العودة لقائمة الإستشارات
                                <i class="feather icon-corner-down-left"></i>
                            </a>

                        </div>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="contenu-tab" data-toggle="tab" href="#contenu"
                                role="tab" aria-controls="contenu" aria-selected="true"><i
                                    class="fas fa-business-time m-2"></i>محتوى الإستشارة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="cahiercharges-tab" data-toggle="tab"
                                href="#cahiercharges" role="tab" aria-controls="cahiercharges" aria-selected="false"><i
                                    class="fas fa-file-alt m-2"></i>كراس الشروط</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="offres-tab" data-toggle="tab" href="#offres"
                                role="tab" aria-controls="offres" aria-selected="false"><i
                                    class="fas fa-business-time m-2"></i>
                                العروض
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="sessions-tab" data-toggle="tab" href="#sessions"
                                role="tab" aria-controls="sessions" aria-selected="false"><i
                                    class="fas fa-business-time m-2"></i>
                                الجلسات
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="soumission-tab" data-toggle="tab" href="#soumission"
                                role="tab" aria-controls="soumission" aria-selected="false"><i
                                    class="fas fa-business-time m-2"></i>
                                التعهد واسناد الصفقة
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="docs-tab" data-toggle="tab" href="#docs"
                                role="tab" aria-controls="docs" aria-selected="false"><i
                                    class="fas fa-file-alt m-2"></i>الوثائق و الملفات</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        {{-- contenu consultation start --}}
                        <div class="tab-pane fade show active" id="contenu" role="tabpanel"
                            aria-labelledby="contenu-tab">
                            <div class="col-md-12">

                                <table id="contenu-cp" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                                class="select-checkbox not-export-col" /> </th>
                                        <th class="not-export-col">id</th>
                                        <th>المادة</th>
                                        <th>طبيعة الطلب</th>
                                        <th>نوع الطلب</th>
                                        <th>الكمية </th>
                                        <th>الكلفة التقديرية للوحدة</th>
                                        <th>الكلفة التقديرية الجملية</th>
                                        <th>الملاحظات</th>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                                    class="select-checkbox not-export-col" /> </th>
                                            <th class="not-export-col">id</th>
                                            <th>المادة</th>
                                            <th>طبيعة الطلب</th>
                                            <th>نوع الطلب</th>
                                            <th>الكمية </th>
                                            <th>الكلفة التقديرية للوحدة</th>
                                            <th>الكلفة التقديرية الجملية</th>
                                            <th>الملاحظات</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        {{-- contenu consultation end --}}
                        {{-- Cahier Charges Tab start --}}
                        <div class="tab-pane fade" id="cahiercharges" role="tabpanel"
                            aria-labelledby="cahiercharges-tab">
                            <div class="col-md-12"> <br>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>تاريخ اعتزام نشر الإعلان :</label>
                                        <input class="form-control" type="text" value='01/05/2022' readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>ثمن اقتناء كراس الشروط :</label>
                                        <input class="form-control" type="text" value='0' readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>طريقة قبول العروض :</label>
                                        <select class="form-control" readonly>
                                            <option>منظومة الشراءات على الخط</option>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>طريقة فتح الظروف :</label>
                                        <select class="form-control" readonly>
                                            <option selected>مالية وفنية غير علنية</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-md-4">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">ضمان وقتي</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>مدة الضمان الوقتي :</label>
                                        <input type="text" class="form-control" id="inputPassword2b" value="120"
                                            readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>المبلغ :</label>
                                        <input type="text" class="form-control" id="inputPassword2b" value="120"
                                            readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="custom-control-label" for="customCheck2">ضمان نهائي</label>
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>مدة الضمان النهائي :</label>
                                        <input type="text" class="form-control" id="inputPassword2b" value="120"
                                            readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>المبلغ :</label>
                                        <input type="text" class="form-control" id="inputPassword2b1" value="45"
                                            readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>مدة الإنجاز باليوم : </label>
                                        <input class="mb-3 form-control form-control-lg" type="text" value='90' readonly>
                                    </div>


                                </div>


                                <div class="dt-responsive table-responsive">
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="documents" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <th></th>
                                                    <th></th>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- Cahier Charges Tab end --}}
                        {{-- Cahier Charges Tab start --}}
                        <div class="tab-pane fade" id="offres" role="tabpanel" aria-labelledby="offres-tab">
                            <div class="col-md-12"> <br>
                                <div class="dt-responsive table-responsive">
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="offres-table" class="table table-striped table-bordered nowrap">
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
                        {{-- Cahier Charges Tab end --}}

                        {{-- Sessions Tab start --}}
                        <div class="tab-pane fade" id="sessions" role="tabpanel" aria-labelledby="sessions-tab">
                            <div class="row" id="session-container">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card card-border-c-green">
                                        <div class="card-header">

                                            <a href="#!" class="text-secondary">
                                                جلسة
                                            </a>
                                            <span class="label label-primary float-right">
                                                فتح الضروف
                                            </span>
                                        </div>
                                        <div class="card-body card-task">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="task-detail">
                                                        تجربة تعديل تفصيل جلسة
                                                    </p>
                                                    <p class="task-due">
                                                        <strong class="label label-primary">
                                                            <strong>
                                                                تاريخ الجلسة :
                                                            </strong>
                                                            08-12-2022
                                                        </strong>


                                                        <strong class="label label-danger">
                                                            <strong>
                                                                تاريخ الجلسة القادمة :
                                                            </strong>
                                                            01-01-2023
                                                        </strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="task-board">
                                                <a href="#" class="btn btn-secondary btn-sm b-none txt-muted"
                                                    type="button" data-id="23" id="btn_session_edit">
                                                    <i class="feather icon-eye"></i>
                                                    عرض التفاصيل
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card card-border-c-green">
                                        <div class="card-header">

                                            <a href="#!" class="text-secondary">
                                                جلسة
                                            </a>
                                            <span class="label label-primary float-right">
                                                فرز
                                            </span>
                                        </div>
                                        <div class="card-body card-task">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="task-detail">
                                                        تجربة تعديل تفصيل جلسة
                                                    </p>
                                                    <p class="task-due">
                                                        <strong class="label label-primary">
                                                            <strong>
                                                                تاريخ الجلسة :
                                                            </strong>
                                                            08-12-2022
                                                        </strong>


                                                        <strong class="label label-danger">
                                                            <strong>
                                                                تاريخ الجلسة القادمة :
                                                            </strong>
                                                            01-01-2023
                                                        </strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="task-board">
                                                <a href="#" class="btn btn-secondary btn-sm b-none txt-muted"
                                                    type="button" data-id="23" id="btn_session_edit">
                                                    <i class="feather icon-eye"></i>
                                                    عرض التفاصيل
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Sessions Tab end --}}
                        {{-- Annexes Tab start --}}
                        <div class="tab-pane fade" id="soumission" role="tabpanel" aria-labelledby="soumission-tab">
                            <div class="col-md-12"> <br>

                            </div>
                        </div>
                        {{-- Annexes Tab end --}}
                        {{-- Sessions Tab end --}}


                        <div class="tab-pane fade" id="docs" role="tabpanel" aria-labelledby="docs-tab">
                            <div class="m-t-30">
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1"> {{ __('labels.tbl_file_libelle') }} </label>
                                        <input type="text" class="form-control" name="file_name" id="file_name"
                                            placeholder="{{ __('labels.tbl_file_libelle') }}" value="">
                                        <label id="file_name-error"
                                            class="error jquery-validation-error small form-text invalid-feedback"
                                            for="file_name"></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">{{ __('labels.tbl_file_file') }}</label>
                                        <input type="file" id="file" name="file"
                                            class="form-control form-control-file" id="file">
                                        <label id="file-error"
                                            class="error jquery-validation-error small form-text invalid-feedback"
                                            for="file"></label>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit" id="btn_add_file">
                                        <span class="spinner-border spinner-border-sm" role="status" hidden></span>
                                        {{ __('inputs.btn_create') }}
                                    </button>
                                </div>
                            </div>

                            <div class="dt-responsive table-responsive">
                                <table id="docs-table" class="table table-striped table-bordered nowrap"
                                    style="width: 100%">
                                    <thead>
                                        <th style="width: 30px"><input type="checkbox" class="select-checkbox" /> </th>
                                        <th>id</th>
                                        <th>{{ __('labels.tbl_file_libelle') }}</th>
                                        <th>{{ $tbl_action }}</th>
                                        <th>{{ __('labels.tbl_created_at') }}</th>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th style="width: 30px"><input type="checkbox" class="select-checkbox" />
                                            </th>
                                            <th>id</th>
                                            <th>{{ __('labels.tbl_file_libelle') }}</th>
                                            <th>{{ $tbl_action }}</th>
                                            <th>{{ __('labels.tbl_created_at') }}</th>
                                        </tr>
                                    </tfoot>
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
    <!-- datatable Js -->
    <script src="{{ asset('/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/dataTables.select.min.js') }}"></script>
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- pnotify Js -->
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>

    <!-- jquery-validation Js -->
    <script src="{{ asset('/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <!-- form-select-custom Js -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = [
                ['الشروط الإدارية',''],
                ['الفنية','']
            ];
            $("#documents").DataTable({
                data: table,
                columns: [{

                    title: 'الوثائق المكونة لكراس الشروط'
                }],
                language: {
                    url: "{{ asset('/plugins/i18n/Arabic.json') }}"
                }

            });

        });

        var offre_table = [
            ['15/05/2021', '10:00', '', '01245', '16/05/2021',
                '<a class="btn btn-success feather icon-edit" href="#" role="button">تحيين</a><a class="btn btn-danger feather icon-trash-2" role="button">حذف</a>'
            ],
            ['17/05/2021', '08:00', '', '01254', '18/05/2021',
                '<a class="btn btn-success feather icon-edit" href="#" role="button">تحيين</a><a class="btn btn-danger feather icon-trash-2" role="button">حذف</a>'
            ],
            ['18/05/2021', '09:00', '', '01260', '18/05/2021',
                '<a class="btn btn-success feather icon-edit" href="#" role="button">تحيين</a><a class="btn btn-danger feather icon-trash-2" role="button">حذف</a>'
            ]
        ];
        $("#offres-table").DataTable({
            data: offre_table,
            columns: [{

                    title: 'تاريخ وصول العرض'
                },
                {
                    title: 'الساعة'
                },
                {
                    title: 'المرجع'
                },
                {
                    title: 'عدد التسجيل بمكتب الضبط'
                },
                {
                    title: 'تاريخ التسجيل'
                },
                {
                    title: 'تعديلات'
                },

            ],
            language: {
                url: "{{ asset('/plugins/i18n/Arabic.json') }}"
            }
        });
        $("#docs-table").DataTable({
            language: {
                url: "{{ asset('/plugins/i18n/Arabic.json') }}"
            }
        });
        $("#ordres-table").DataTable({
            language: {
                url: "{{ asset('/plugins/i18n/Arabic.json') }}"
            }
        });
    </script>
@endsection
