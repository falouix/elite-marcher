@php
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
        'bread_title' => 'المخطط السنوي للشراءات',
        'bread_subtitle' => 'عرض تفاصيل مشروع شراء',
    ])
@endsection

@section('content')
    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>عرض تفاصيل مشروع شراء[المخطط التقديري السنوي]</h5>
                <div class="card-header-right">
                    <a href="{{ route('ppm.index') }}" class="btn btn-secondary">
                        العودة للمخطط السنوي للشراءات
                        <i class="feather icon-corner-down-left"></i>
                    </a>

                </div>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>{{ __('validation.v_title') }}</strong><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="annee_gestion"> السنة المالية </label>
                            <input type="number" class="form-control" id='annee_gestion' name="annee_gestion"
                                placeholder="أدخل السنة المالية" value='{{ $projet->annee_gestion }}' readonly>
                            @if ($errors->has('annee_gestion'))
                                <span class="text-danger">{{ $errors->first('annee_gestion') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label class="form-label">الموضوع</label>
                            <input type="text" class="form-control" name="objet" id="objet"
                                value="{{ $projet->objet }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">طبيعة الطلب</label>
                            <select class="form-control" id="type_demande" name="type_demande" disabled>
                                <option value="all">غير محددة</option>
                                <option value="1" @if ($projet->type_demande == 1) selected = true @endif>مواد وخدمات
                                </option>
                                <option value="2" @if ($projet->type_demande == 2) selected = true @endif>أشغال
                                </option>
                                <option value="3" @if ($projet->type_demande == 3) selected = true @endif>دراسات
                                </option>
                            </select>
                            <label id="type_demande-error"
                                class="error jquery-validation-error small form-text invalid-feedback"
                                for="libelle"></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">طريقة الإبرام</label>
                            <select class="form-control" id="nature_passation" name="nature_passation" disabled>

                                <option value="CONSULTATION" @if ($projet->nature_passation == 'CONSULTATION') selected = true @endif>
                                    استشارة عادية</option>
                                <option value="AOS" @if ($projet->nature_passation == 'AOS') selected = true @endif>صفقة إجراءات
                                    مبسطة </option>
                                <option value="AON" @if ($projet->nature_passation == 'AOS') selected = true @endif>صفقة إجراءات
                                    عادية</option>
                                <option value="AOGREGRE" @if ($projet->nature_passation == 'AOS') selected = true @endif>صفقة
                                    بالتفاوض المباشر</option>
                            </select>
                            <label id="nature_passation-error"
                                class="error jquery-validation-error small form-text invalid-feedback"
                                for="libelle"></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">مصدر التمويل</label>
                            <select class="form-control" id="source_finance" name="source_finance" disabled>
                                <option value="all">غير محدد</option>
                                <option value="1" @if ($projet->source_finance == 1) selected = true @endif>ميزانية
                                    الدولة
                                </option>
                                <option value="2" @if ($projet->source_finance == 2) selected = true @endif>قرض
                                </option>
                                <option value="3" @if ($projet->source_finance == 3) selected = true @endif>هبة
                                </option>
                            </select>
                            <label id="source_finance-error"
                                class="error jquery-validation-error small form-text invalid-feedback"
                                for="libelle"></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="duree_travaux_prvu">آجال الإنجاز</label>
                            <input type="number" class="form-control" id='duree_travaux_prvu' name="duree_travaux_prvu"
                                placeholder="آجال الإنجاز" value='{{ $projet->duree_travaux_prvu }}' readonly>
                            @if ($errors->has('duree_travaux_prvu'))
                                <span class="text-danger">{{ $errors->first('duree_travaux_prvu') }}</span>
                            @endif
                        </div>
                    </div>


                </div>
                <div class="card-body">

                    <h4>التاريخ التقديري ل :</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-cc_prvu"> إعداد كراس الشروط </label>
                                <input type="date" class="form-control" id='date_cc_prvu' name="date_cc_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_cc_prvu }}" readonly>
                                @if ($errors->has('date_cc_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_cc_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_avis_prvu">الإعلان عن المنافسة </label>
                                <input type="date" class="form-control" id='date_avis_prvu' name="date_avis_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_avis_prvu }}" readonly>
                                @if ($errors->has('date_avis_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_avis_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> فتح العروض </label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}" readonly>
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu">تعهد لجنة الشراءات بالملف</label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}" readonly>
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu">إحالة الملف على لجنة الصفقات</label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}" readonly>
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> إجابة لجنة الصفقات </label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}" readonly>
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> نشر نتائج المنافسة </label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}" readonly>
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> لتبليغ الصفقة</label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}" readonly>
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> لبداية الإنجاز </label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}" readonly>
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body">

                    <h4> محتوى المشروع</h4>

                    <div class="dt-responsive table-responsive">

                        <h6 style="color: red; text-align: left;">الكلفة الجمليةالتقديرية للحاجيات : <span id="coutTotal">
                            </span></h6>

                        <table id="table-cp" class="table table-striped table-bordered nowrap">
                            <thead>
                                <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                        class="select-checkbox not-export-col" /> </th>
                                <th class="not-export-col"></th>
                                <th>المادة</th>
                                <th>طبيعة الطلب</th>
                                <th>نوع الطلب</th>
                                <th>الكمية المطلوبة</th>
                                <th>الكمية المصادقة</th>
                                <th>الكلفة التقديرية للوحدة(بالدينار)</th>
                                <th>الكلفة التقديرية الجملية(بالدينار)</th>
                                <th class="not-export-col">قرار</th>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                            class="select-checkbox not-export-col" /> </th>
                                    <th class="not-export-col"></th>
                                    <th>المادة</th>
                                    <th>طبيعة الطلب</th>
                                    <th>نوع الطلب</th>
                                    <th>الكمية المطلوبة</th>
                                    <th>الكمية المصادقة</th>
                                    <th>الكلفة التقديرية للوحدة(بالدينار)</th>
                                    <th>الكلفة التقديرية الجملية(بالدينار)</th>
                                    <th class="not-export-col">قرار</th>
                                </tr>
                            </tfoot>
                        </table>
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
    <!-- jquery-validation Js -->
    <script src="{{ asset('/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('/plugins/data-tables/js/pdfmake.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/sum().js') }}"></script>`

    <!-- form-select-custom Js -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- pnotify Js -->
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>

    <script>
        'use strict';
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            var table = $('#table-cp').DataTable({
                dom: 'frltipB',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "{{ __('labels.all') }}"]
                ],
                buttons: [{
                        text: '{{ __('inputs.btn_copy') }}',
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: '{{ __('inputs.btn_excel') }}',
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: '{{ __('inputs.btn_pdf') }}',
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: '{{ __('inputs.btn_print') }}',
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                ],
                scrollY: true,
                scrollX: true,
                scrollCollapse: true,
                //paging: false,
                fixedColumns: {
                    leftColumns: 0,
                    rightColumns: 1
                },
                initComplete: function() {
                    // Apply the search
                    this.api().columns().every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change clear',
                            function() {
                                if (that.search() !== this.value) {
                                    that
                                        .search(this.value)
                                        .draw();
                                }
                            });
                    });
                },
                processing: true,
                //serverSide: true,
                serverMethod: 'POST',
                ajax: {
                    url: "{{ route('lignes-projets.data') }}",
                    data: function(data) {
                        data.projet_id = "{{ $projet->id }}"
                        data.mode = 'lignes-projets'
                    },
                },
                language: {
                    url: "{{ $lang }}"
                },
                columns: [{
                        data: "select",
                        className: "select-checkbox"
                    },
                    {
                        data: "id",
                        className: "id",
                    },
                    {
                        data: "libelle",
                        className: "libelle"
                    },
                    {
                        data: "type_demande",
                        className: "type_demande"
                    },
                    {
                        data: "nature_demandes_id",
                        className: "nature_demandes_id"
                    },
                    {
                        data: "qte",
                        className: "qte"
                    },
                    {
                        data: "qte",
                        className: "qte"
                    },
                    {
                        data: "cout_unite_ttc",
                        className: "cout_unite_ttc"
                    },
                    {
                        data: "cout_total_ttc",
                        className: "cout_total_ttc"
                    },
                    {
                        data: "actionPPM",
                        className: "actionPPM"
                    }
                ],
                columnDefs: [{
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    },
                    {
                        visible: false,
                        targets: 1
                    }
                ],
                drawCallback: function() {
                    var api = this.api();
                    $('#coutTotal').html(
                        api.column(8, {
                            page: 'current'
                        }).data().sum()
                    )
                },
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
            });



            $('.dataTables_length').addClass('bs-select');

            // Setup - add a text input to each footer cell

            addSearchFooterDataTable("#table-cp")

            $("#natures_demande").select2({
                dir: "{{ $rtl }}",
                // minimumInputLength: 3, // only start searching when the user has input 3 or more characters
                //placeholder: "{{ __('labels.choose') }} ",
                ajax: {
                    url: "{{ route('natures-demande.select') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: {
                        type: $('#type_demande').val()
                    },
                },
                processResults: function(response) {
                    // alert(JSON.stringify(response))
                    return {
                        results: response
                    };
                },
                cache: true

            });

            $("#services_id").select2({
                dir: "{{ $rtl }}",
                placeholder: "{{ __('labels.choose') }} ",
            });
        });
    </script>
@endsection
