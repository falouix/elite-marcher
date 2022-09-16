@php

$breadcrumb = 'الإستشارات';
$subreadcrumb = 'مراحل إنجاز الإستشارة';

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
                        <a href="#" class="text-secondary">مراحل إنجاز الإستشارة</a>
                        <div class="card-header-right">
                            <a href="{{ route('consultations.index') }}" class="btn btn-secondary">
                                العودة لقائمة الإستشارات
                                <i class="feather icon-corner-down-left"></i>
                            </a>

                        </div>
                    </div>
                   <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-sm-6 col-md-3 mb-2">
                                <a href="#" class="btn btn-primary-gradient btn-block">
                                    <i class="fe fe-users tx-20 pl-2"></i>
                                    كراس الشروط
                                </a>
                            </div>

                            <div class="col-sm-6 col-md-3 mb-2">
                                <a href="#" class="btn btn-danger-gradient btn-block">
                                    <i class="fas fa-gavel tx-20 pl-2" aria-hidden="true"></i>
                                    الإعلان الإشهاري
                                </a>
                            </div>

                            <div class="col-sm-6 col-md-3 mb-2">
                                <a href="#" class="btn btn-warning-gradient btn-block">
                                    <i class="fas fa-gavel tx-20 pl-2" aria-hidden="true"></i>
                                    وصول العروض
                                </a>
                            </div>

                            <div class="col-sm-6 col-md-3 mb-2">
                                <a href="#" class="btn btn-success-gradient btn-block">
                                    <i class="far fa-clock tx-20 pl-2" aria-hidden="true"></i>
                                    جلسات فتح الظروف
                                </a>
                            </div>


                            <div class="col-sm-6 col-md-3 mb-2">
                                <a href="#" class="btn btn-secondary-gradient btn-block">
                                    <i class="fe fe-dollar-sign tx-20 pl-2"></i>
                                    جلسات الفرز
                                </a>
                            </div>

                            <div class="col-sm-6 col-md-3 mb-2">
                                <a href="#" class="btn btn-success-gradient btn-block">
                                    <i class="fe fe-dollar-sign tx-20 pl-2"></i>
                                    اسناد الصفقة
                                </a>
                            </div>

                            <div class="col-sm-6 col-md-3 mb-2">
                                <a href="#" class="btn btn-info-gradient btn-block">
                                    <i class="fas fa-sort-amount-up-alt tx-20 pl-2" aria-hidden="true"></i>
                                    تسجيل الصفقة
                                </a>
                            </div>

                            <div class="col-sm-6 col-md-3 mb-2">
                                <a href="#" class="btn btn-dark-gradient btn-block">
                                    <i class="fas fa-sort-amount-up-alt tx-20 pl-2" aria-hidden="true"></i>
                                    إذن بداية الأشغال
                                </a>
                            </div>

                            <div class="col-sm-6 col-md-3 mb-2">
                                <a href="#" class="btn btn-danger-gradient btn-block">
                                    <i class="fas fa-sort-amount-up-alt tx-20 pl-2" aria-hidden="true"></i>
                                    القبول الوقتي
                                </a>
                            </div>

                            <div class="col-sm-6 col-md-3 mb-2">
                                <a href="#" class="btn btn-warning-gradient btn-block">
                                    <i class="fas fa-sort-amount-up-alt tx-20 pl-2" aria-hidden="true"></i>
                                    القبول النهائي
                                </a>
                            </div>

                            <div class="col-sm-6 col-md-3 mb-2">
                                <a href="#" class="btn btn-secondary-gradient btn-block">
                                    <i class="fas fa-cogs tx-20 pl-2" aria-hidden="true"></i>
                                    التسوية النهائية
                                </a>
                            </div>

                            <div class="col-sm-6 col-md-3 mb-2">
                                <a href="#" class="btn btn-danger-gradient btn-block">
                                    <i class="fas fa-cogs tx-20 pl-2" aria-hidden="true"></i>
                                    الغاء الصفقة
                                </a>
                            </div>



                        </div>
                    </div>
                   </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Modal Create or edit cahier charges -->
    <div class="modal fade show" id="add_cahier_charges" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
        style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"> تسجيل كراس الشروط  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>تاريخ اعتزام نشر الإعلان :</label>
                            <input class="form-control" type="text"  >
                        </div>
                        <div class="form-group col-md-6">
                            <label>ثمن اقتناء كراس الشروط :</label>
                            <input class="form-control" type="text" value='0' >
                        </div>
                        <div class="form-group col-md-6">
                            <label>طريقة قبول العروض :</label>
                            <select class="form-control" >
                                <option>منظومة الشراءات على الخط</option>
                                <option value="2">مكتب الضبط</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">

                            <label>طريقة فتح الظروف :</label>
                            <select class="form-control" >
                                <option value="1">مالية علنية</option>
                                <option value="2"> مالية وفنية علنية</option>
                                <option value="3">مالية وفنية غير علنية</option>

                            </select>
                        </div>


                        <div class="form-group col-md-4">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">ضمان وقتي</label>
                        </div>
                        <div class="form-group col-md-4">
                            <label>مدة الضمان الوقتي :</label>
                            <input type="number" class="form-control" id="inputPassword2b" value=""
                                >
                        </div>
                        <div class="form-group col-md-4">
                            <label>المبلغ :</label>
                            <input type="number" class="form-control" id="inputPassword2b" value=""
                                >
                        </div>
                        <div class="form-group col-md-4">
                            <label class="custom-control-label" for="customCheck2">ضمان نهائي</label>
                            <input type="checkbox" class="custom-control-input" id="customCheck2">

                        </div>
                        <div class="form-group col-md-4">
                            <label>مدة الضمان النهائي :</label>
                            <input type="number" class="form-control" id="inputPassword2b" value="0"
                                >
                        </div>
                        <div class="form-group col-md-4">
                            <label>المبلغ :</label>
                            <input type="number" class="form-control" id="inputPassword2b1" value="0"
                                >
                        </div>
                        <div class="form-group col-md-4">
                            <label>مدة الإنجاز باليوم : </label>
                            <input class="mb-3 form-control form-control-lg" type="number" value='0' readonly>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('inputs.btn_close') }}</button>
                    <button class="btn btn-primary" id='btn_add_dossierAchat'> إنشاء ملف شراء
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Create or edit  cahier charges end-->
<!-- Modal Create or edit Avisdossier -->
<div class="modal fade show" id="add_avis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
style="display: none;">
<div class="modal-dialog ">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-title"> تسجيل كراس الشروط  </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>تاريخ اعتزام نشر الإعلان :</label>
                    <input class="form-control" type="text"  >
                </div>
                <div class="form-group col-md-6">
                    <label>ثمن اقتناء كراس الشروط :</label>
                    <input class="form-control" type="text" value='0' >
                </div>
                <div class="form-group col-md-6">
                    <label>طريقة قبول العروض :</label>
                    <select class="form-control" >
                        <option>منظومة الشراءات على الخط</option>
                        <option value="2">مكتب الضبط</option>
                    </select>
                </div>

                <div class="form-group col-md-6">

                    <label>طريقة فتح الظروف :</label>
                    <select class="form-control" >
                        <option value="1">مالية علنية</option>
                        <option value="2"> مالية وفنية علنية</option>
                        <option value="3">مالية وفنية غير علنية</option>

                    </select>
                </div>


                <div class="form-group col-md-4">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">ضمان وقتي</label>
                </div>
                <div class="form-group col-md-4">
                    <label>مدة الضمان الوقتي :</label>
                    <input type="number" class="form-control" id="inputPassword2b" value=""
                        >
                </div>
                <div class="form-group col-md-4">
                    <label>المبلغ :</label>
                    <input type="number" class="form-control" id="inputPassword2b" value=""
                        >
                </div>
                <div class="form-group col-md-4">
                    <label class="custom-control-label" for="customCheck2">ضمان نهائي</label>
                    <input type="checkbox" class="custom-control-input" id="customCheck2">

                </div>
                <div class="form-group col-md-4">
                    <label>مدة الضمان النهائي :</label>
                    <input type="number" class="form-control" id="inputPassword2b" value="0"
                        >
                </div>
                <div class="form-group col-md-4">
                    <label>المبلغ :</label>
                    <input type="number" class="form-control" id="inputPassword2b1" value="0"
                        >
                </div>
                <div class="form-group col-md-4">
                    <label>مدة الإنجاز باليوم : </label>
                    <input class="mb-3 form-control form-control-lg" type="number" value='0' readonly>
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                {{ __('inputs.btn_close') }}</button>
            <button class="btn btn-primary" id='btn_add_dossierAchat'> إنشاء ملف شراء
            </button>
        </div>

    </div>
</div>
</div>
<!-- Modal Create or edit Avisdossier end-->

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
