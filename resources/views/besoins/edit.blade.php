@php
//dd($userService);
if ($locale == 'ar') {
    $lang = asset('/plugins/i18n/Arabic.json');
    $rtl = 'rtl';
} else {
    $lang = '';
}

$breadcrumb = 'ضبط الحاجيات';
$sub_breadcrumb = 'تحيين الحاجيات';
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
        'bread_subtitle' => $sub_breadcrumb,
    ])
@endsection

@section('content')
    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $sub_breadcrumb }}</h5>
                <div class="card-header-right">

                    @if($besoin->valider == false)
                        @can('besoins-list')
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#add_article">
                            <i class="feather icon-plus-circle"></i> إضافة مادة جديدة
                        </button>
                        @endcan
                    @endif
                    <a href="{{ route('besoins.index') }}" class="btn btn-secondary">
                        العودة لضبط الحاجيات
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
                <!-- [ Form Validation ] start -->



                {{-- Case Other Parties --}}
                {!! Form::open(['route' => ['besoins.update', $besoin->id], 'method' => 'patch', 'id' => 'validation-client_form']) !!}

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label> المصلحة/الدائرة/المؤسسة </label>
                            <input type="text" class="form-control" value="{{ $userService->libelle }}" readonly>
                            <input type="hidden" name="services_id" value="{{ $userService->id }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_besoin"> التاريخ </label>
                            <input type="date" class="form-control" id='date_besoin' name="date_besoin"
                                placeholder="أدخل التاريخ" value="{{ $besoin->date_besoin }}">
                            @if ($errors->has('date_besoin'))
                                <span class="text-danger">{{ $errors->first('date_besoin') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="annee_gestion"> السنة المالية </label>
                            <input type="number" class="form-control" id='annee_gestion' name="annee_gestion"
                                placeholder="أدخل السنة المالية" value='{{ $besoin->annee_gestion }}' readonly>
                            {{-- @if ($errors->has('annee_gestion'))
                                        <span class="text-danger">{{ $errors->first('annee_gestion') }}</span>
                                    @endif --}}
                        </div>
                    </div>
                </div>
                <button type="submit" id="btn_submit" class="btn btn-primary" style="float: right;" hidden>
                </button>
                {!! Form::close() !!}
                {{-- Contact from company  start --}}
                <form id="cp_form" action="#">
                    <input type="hidden" name="lignebesoin_id" id="lignebesoin_id" value="0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h3 class="form-label"> الحاجيات</h3>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">طبيعة الطلب</label>
                                <select class="form-control" id="type_demande">
                                    <option value="1">مواد وخدمات</option>
                                    <option value="2">أشغال</option>
                                    <option value="3">دراسات</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">نوع الطلب</label>
                                <select class="form-control " id="natures_demande" name="natures_demande">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">المادة (التسمية)</label>
                                    <select class="form-control " id="articles_id" name="articles_id">
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">الكمية المطلوية</label>
                                <input type="number" class="form-control" name="qte_demande" placeholder="الكمية..."
                                    value="{{ old('qte_demande') }}" onchange="calculTotal()">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">الكلفة التقديرية للوحدة</label>
                                <input type="number" class="form-control" name="cout_unite_ttc"
                                    placeholder="كلفة الوحدة..." value="{{ old('cout_unite_ttc') }}"
                                    onchange="calculTotal()">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">الكلفة التقديرية الجملية</label>
                                <input type="number" class="form-control" name="cout_total_ttc"
                                    placeholder="الكلفة التقديرية الجملية..." value="0" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> إسم الملف المرفق (الخصائص الفنية) </label>
                            <input type="text" class="form-control" name="file_name" id="file_name"
                                placeholder="إسم الملف المرفق" value="">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">الملف/الوثيقة</label>
                            <input type="file" id="file" name="file" class="form-control form-control-file"
                                id="file">
                            <label id="file-error" class="error jquery-validation-error small form-text invalid-feedback"
                                for="file"></label>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> الملاحظات </label>
                            <input type="text" class="form-control" name="description" id="description"
                                placeholder="الملاحظات" value="">

                        </div>

                        <div class="col-md-12">
                            @if ($besoin->valider == false)
                                <a href="javascript:void(0);" class="btn btn-rounded btn-info" id='add'
                                    for-table='#table-cp'>
                                    <i class="feather icon-plus"></i>
                                    <span class="spinner-border spinner-border-sm" role="status" hidden></span>
                                    <span id="btn_add_poa_title">إضافة إلى الجدول</span>

                                </a>
                            @endif

                            <div class="dt-responsive table-responsive">
                                <h6 style="color: red; text-align: left;">الكلفة الجمليةالتقديرية للحاجيات : <span
                                        id="coutTotal"> </span></h6>

                                <table id="table-cp" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                                class="select-checkbox not-export-col" /> </th>
                                        <th class="not-export-col">id</th>
                                        <th>المادة</th>
                                        <th>طبيعة الطلب</th>
                                        <th>نوع الطلب</th>
                                        <th>الكمية المطلوبة</th>
                                        <th>الكلفة التقديرية للوحدة</th>
                                        <th>الكلفة التقديرية الجملية</th>
                                        <th>الملاحظات</th>
                                        <th>الملف/الوثيقة</th>
                                        <th class="not-export-col">{{ $tbl_action }}</th>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                                    class="select-checkbox not-export-col" /> </th>
                                            <th class="not-export-col">id</th>
                                            <th>المادة</th>
                                            <th>طبيعة الطلب</th>
                                            <th>نوع الطلب</th>
                                            <th>الكمية المطلوبة</th>
                                            <th>الكلفة التقديرية للوحدة</th>
                                            <th>الكلفة التقديرية الجملية</th>
                                            <th>الملاحظات</th>
                                            <th>الملف/الوثيقة</th>
                                            <th class="not-export-col">{{ $tbl_action }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- Contact from company  end --}}


                <div class="row mt-4">
                    @if ($besoin->valider == false)
                        <button type="button" id="btn_create" class="btn btn-primary" style="float: right;">
                            <i class="feather icon-client-plus"></i>
                            {{ __('inputs.btn_edit') }}
                        </button>
                    @endif
                    <a href="{{ route('besoins.index') }}" class="btn btn-danger" style="float: left;">
                        <i class="feather icon-minus-circle"></i>
                        {{ __('inputs.btn_cancel') }}
                    </a>
                </div>
                <!-- [ Form Validation ] end -->

            </div>
        </div>
    </div>


     <!-- Modal Create or edit status -->
     <div class="modal fade show" id="add_article" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
     style="display: none;">
     <div class="modal-dialog ">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modal-title"> إضافة مادة جديدة </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form id="form_id">

                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">طبيعة الطلب</label>
                                <select class="form-control" id="modal_type_demande" name="modal_type_demande">
                                    <option value="1">مواد وخدمات</option>
                                    <option value="2">أشغال</option>
                                    <option value="3">دراسات</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">نوع الطلب</label>

                                <select class="form-control" id="modal_natures_demande">
                                </select>
                                <label id="modal_natures_demande-error"
                                class="error jquery-validation-error small form-text invalid-feedback"
                                for="libelle"></label>
                            </div>
                        </div>
                         <div class="form-group col-md-12">
                             <label for="lbl_libelle"> المادة</label>
                             <input type="text" class="form-control" id='modal_libelle' name="modal_libelle"
                                 placeholder="إسم المادة..." value="">
                             <label id="libelle-error"
                                 class="error jquery-validation-error small form-text invalid-feedback"
                                 for="libelle"></label>
                         </div>
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">
                     {{ __('inputs.btn_close') }}</button>
                 <button  class="btn btn-primary" id='btn_add_article'> {{ __('inputs.btn_create') }}
                 </button>
             </div>

         </div>
     </div>
 </div>
 <!-- Modal Create or edit status end-->
@endsection
@section('srcipt-js')
    <!-- jquery-validation Js -->
    <script src="{{ asset('/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/plugins/inputmask/js/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('/plugins/inputmask/js/autoNumeric.js') }}"></script>
    <!-- datatable Js -->
    <script src="{{ asset('/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/dataTables.select.min.js') }}"></script>
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- pnotify Js -->
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
    <!-- form-select-custom Js -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/pdfmake.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/vfs_fonts.js') }}"></script>

    <script>
        'use strict';
        $(document).ready(function() {
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // [ Initialize client-form validation ]
                $('#validation-client_form').validate({
                    ignore: '.ignore, .select2-input',
                    focusInvalid: false,
                    rules: {
                        'full_name': {
                            required: true,
                        },
                        'cp_registration': {
                            required: true,
                        },

                        'email': {
                            required: true,
                            email: true
                        },
                        'cp_contact_email': {
                            required: false,
                            email: true
                        },
                        'pr_mail': {
                            required: true,
                            email: true
                        },
                        'pr_name': {
                            required: true,
                        },

                    },

                    // Errors //

                    errorPlacement: function errorPlacement(error, element) {
                        var $parent = $(element).parents('.form-group');

                        // Do not duplicate errors
                        if ($parent.find('.jquery-validation-error').length) {
                            return;
                        }

                        $parent.append(
                            error.addClass(
                                'jquery-validation-error small form-text invalid-feedback')
                        );
                    },
                    highlight: function(element) {
                        var $el = $(element);
                        var $parent = $el.parents('.form-group');

                        $el.addClass('is-invalid');

                        // Select2 and Tagsinput
                        if ($el.hasClass('select2-hidden-accessible') || $el.attr(
                                'data-role') === 'tagsinput') {
                            $el.parent().addClass('is-invalid');
                        }
                    },
                    unhighlight: function(element) {
                        $(element).parents('.form-group').find('.is-invalid').removeClass(
                            'is-invalid');
                    }
                });
                // [ Initialize client-form validation ]
                $('#cp_form').validate({
                    ignore: '.ignore, .select2-input',
                    focusInvalid: false,
                    rules: {
                        'libelle': {
                            required: true,
                        },
                        'qte_demande': {
                            required: true,
                        },
                        'cout_unite_ttc': {
                            required: true,
                        },
                    },
                    // Errors //

                    errorPlacement: function errorPlacement(error, element) {
                        var $parent = $(element).parents('.form-group');

                        // Do not duplicate errors
                        if ($parent.find('.jquery-validation-error').length) {
                            return;
                        }

                        $parent.append(
                            error.addClass(
                                'jquery-validation-error small form-text invalid-feedback')
                        );
                    },
                    highlight: function(element) {
                        var $el = $(element);
                        var $parent = $el.parents('.form-group');

                        $el.addClass('is-invalid');

                        // Select2 and Tagsinput
                        if ($el.hasClass('select2-hidden-accessible') || $el.attr(
                                'data-role') === 'tagsinput') {
                            $el.parent().addClass('is-invalid');
                        }
                    },
                    unhighlight: function(element) {
                        $(element).parents('.form-group').find('.is-invalid').removeClass(
                            'is-invalid');
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
                    paging: false,
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
                    // serverSide: true,
                    serverMethod: 'POST',
                    ajax: {
                        url: "{{ route('ligne_besoin.datatable') }}",
                        data: function(data) {

                            data.besoins_id = "{{ $besoin->id }}";
                            data.mode = "all";
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
                            data: "qte_demande",
                            className: "qte_demande"
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
                            data: 'description',
                            className: 'description',
                        },
                        {
                            data: 'action_file',
                            className: 'action_file',
                            visible: 'false'
                        },

                        {
                            data: 'action',
                            className: 'action',
                            visible: 'false'
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
                    select: {
                        style: 'os',
                        selector: 'td:first-child'
                    },
                    // select: { style: 'multi+shift' },

                });
                table
                    .on('select', function(e, dt, type, indexes) {
                        // var rowData = table.rows( indexes ).data().toArray();
                        //console.log( rowData );
                        SelectedRowCountBtnDelete(table)
                    })
                    .on('deselect', function(e, dt, type, indexes) {
                        SelectedRowCountBtnDelete(table)
                    });

                $('.dataTables_length').addClass('bs-select');
                // Setup - add a text input to each footer cell
                addSearchFooterDataTable("#table-cp")

                $("#natures_demande").select2({
                    dir: "{{ $rtl }}",
                    // minimumInputLength: 3, // only start searching when the user has input 3 or more characters
                    placeholder: "{{ __('labels.choose') }} ",
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
                    //cache: true
                });
                $("#articles_id").select2({
                    dir: "{{ $rtl }}",
                    // minimumInputLength: 3, // only start searching when the user has input 3 or more characters
                    placeholder: "{{ __('labels.choose') }} ",
                    ajax: {
                        url: "{{ route('articles.select') }}",
                        type: "post",
                        delay: 250,
                        dataType: 'json',
                        data: {
                            natures_demande_id : $('#natures_demande').val()
                        },
                    },
                    processResults: function(response) {
                        // alert(JSON.stringify(response))
                        return {
                            results: response
                        };
                    },
                    //cache: true
                });
                $("#modal_natures_demande").select2({
                    dir: "{{ $rtl }}",
                    // minimumInputLength: 3, // only start searching when the user has input 3 or more characters
                    placeholder: "{{ __('labels.choose') }} ",
                    dropdownParent: $("#add_article"),
                    ajax: {
                        url: "{{ route('natures-demande.select') }}",
                        type: "post",
                        delay: 250,
                        dataType: 'json',
                        data: {
                            type: $('#modal_type_demande').val()
                        },
                    },
                    processResults: function(response) {
                        // alert(JSON.stringify(response))
                        return {
                            results: response
                        };
                    },
                    //cache: true

                });

            });

        });


        $('#type_demande').on('change', function(e) {
            var type = e.target.value;
            $.ajax({
                url: "{{ route('natures-demande.select') }}",
                type: "POST",

                data: {
                    type: type
                },
                success: function(data) {
                    $('#natures_demande').empty();
                    $('#natures_demande').append('<option value="NULL">إختر من القائمة</option>');
                    $.each(data.results, function(index, naturdemande) {
                        $('#natures_demande').append('<option value="' + naturdemande.id +
                            '">' +
                            naturdemande.text + '</option>');
                    })
                    $('#natures_demande').select2({
                        dir: "{{ $rtl }}",
                    });
                }
            })
        });
        $('#natures_demande').on('change', function(e) {
            var type = e.target.value;
            $.ajax({
                url: "{{ route('articles.select') }}",
                type: "POST",
                data: {
                    natures_demande_id: type
                },
                success: function(data) {
                    $('#articles_id').empty();
                    $('#articles_id').append('<option value="NULL">إختر من القائمة</option>');
                    $.each(data.results, function(index, article) {
                        $('#articles_id').append('<option value="' + article.id +
                            '">' +
                            article.text + '</option>');
                    })
                    $('#articles_id').select2({
                        dir: "{{ $rtl }}",
                    });
                }
            })
        });
        $('#modal_type_demande').on('change', function(e) {
            var type = e.target.value;
            $.ajax({
                url: "{{ route('natures-demande.select') }}",
                type: "POST",

                data: {
                    type: type
                },
                success: function(data) {
                    $('#modal_natures_demande').empty();
                    $.each(data.results, function(index, naturdemande) {
                        $('#modal_natures_demande').append('<option value="' + naturdemande.id +
                            '">' +
                            naturdemande.text + '</option>');
                    })
                    $('#modal_natures_demande').select2({
                        dir: "{{ $rtl }}",
                        dropdownParent: $("#add_article"),
                    });
                }
            })
        });

        $('#add').click(() => {
            //$('#libelle').removeClass('is-invalid')
            $('.spinner-border').removeAttr('hidden');
            var article = $('#articles_id').select2('data')
            if(!article){
                swal("{{ __('labels.swal_warning_title') }}", 'الرجاء تحديد المادة',
                        "warning");
                return false;
            }
            let id = $("#lignebesoin_id").val();
            let libelle = article.text
            let type_demande = $("#type_demande").val()
            let natures_demande = $("#natures_demande").val()
            let articles_id = article.id
            let file_name = $("input[name=file_name]").val();
            let qte_demande = $("input[name=qte_demande]").val()
            let cout_unite_ttc = $("input[name=cout_unite_ttc]").val()
            let cout_total_ttc = $("input[name=cout_total_ttc]").val()
            let description = $("input[name=description]").val()
            let file = document.getElementById("file").files[0];
            var formData = new FormData();
            formData.append('libelle', libelle)
            formData.append('type_demande', type_demande)
            formData.append('nature_demandes_id', natures_demande)
            formData.append('articles_id', natures_demande)
            formData.append('description', description)
            formData.append('file_name', file_name)
            formData.append('qte_demande', qte_demande)
            formData.append('cout_unite_ttc', cout_unite_ttc)
            formData.append('cout_unite_ttc', cout_unite_ttc)
            formData.append('besoins_id', {{ $besoin->id }})
            formData.append('id', id)
            formData.append('file', file)
            //alert(file)
            var $type = 'POST'
            var $url = "{{ route('lignes_besoin.store') }}"
            if (id != 0) {
                $type = 'PUT'
                $url = "{{ route('lignes_besoin.update') }}"
                formData.append('_method', 'PUT');
            }
            $.ajax({
                url: $url,
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    console.log(response)
                    $('.spinner-border').attr('hidden', 'hidden');
                    $('#table-cp').DataTable().ajax.reload();
                    $('#cp_form')[0].reset()
                    //$("#cp_form").get(0).reset()
                    $('#add').html("إضافة إلى الجدول")
                    PnotifyCustom(response)


                },
                error: function(response) {
                    $('.spinner-border').attr('hidden', 'hidden');
                    console.log(JSON.stringify(response.responseJSON));
                    $('.spinner-border').attr('hidden', 'hidden');
                    //  $('#file_name-error').html('')
                    $('#libelle-error').html('')
                    $('#file-error').html('')
                    // alert(JSON.stringify(response.responseJSON.message))
                    if (response.responseJSON.message.libelle != null) {
                        $('#libelle').addClass('is-invalid')
                        $('#libelle-error').text(response.responseJSON.message.poa_title);
                    }

                }
            }); // ajax end
        })
        $('#btn_create').on("click", () => {
            $("#btn_submit").click()
        })

        $('#btn_add_article').click(() => {
            let natures_demande_id = $("#modal_natures_demande").val();
            let libelle = $("input[name=modal_libelle]").val();
            $.ajax({
                url: "{{ route('articles.store')}}",
                type: "POST",
                data: {
                    'natures_demande_id': $("#modal_natures_demande").val(),
                    'libelle':  $("input[name=modal_libelle]").val(),
                },
                success: function(response) {
                    $('#libelle').removeClass('is-invalid')
                    $('#modal_natures_demande').removeClass('is-invalid')
                    $('#add_article').modal('toggle');
                    PnotifyCustom(response)

                },
                error: function(errors) {
                    $('#libelle').removeClass('is-invalid')
                    if (errors.responseJSON.message.libelle != null) {
                        $('#libelle').addClass('is-invalid')
                        $('#libelle-error').text(errors.responseJSON.message.libelle);
                    }
                    $('#modal_natures_demande').removeClass('is-invalid')
                    if (errors.responseJSON.message.natures_demande_id != null) {
                        $('#modal_natures_demande').addClass('is-invalid')
                        $('#modal_natures_demande-error').text(errors.responseJSON.message.natures_demande_id);
                    }
                }
            }); // ajax end
        })
        // OnClose Modal eventListener
        $('#add_article').on('hidden.bs.modal', function() {
            $("#form_id")[0].reset()
        })

        function calculTotal() {
            let qte_demande = $("input[name=qte_demande]").val()
            let cout_unite_ttc = $("input[name=cout_unite_ttc]").val()
            let cout_total_ttc = qte_demande * cout_unite_ttc
            $("input[name=cout_total_ttc]").val(cout_total_ttc)

        }

        function editLigneBesoin(id) {
            $.ajax({
                url: "{{ route('ligne_besoins.edit') }}",
                type: 'GET',
                data: {
                    id: id,
                },
                success: function(response) {
                    // alert(JSON.stringify(response))
                    $("#lignebesoin_id").val(response.id);
                    //$("input[name=libelle]").val(response.libelle)
                    $("input[name=description]").val(response.description)
                    $("input[name=qte_demande]").val(response.qte_demande)
                    $("input[name=cout_unite_ttc]").val(response.cout_unite_ttc)
                    $("input[name=cout_total_ttc]").val(response.cout_total_ttc)
                    // Set selected
                    $("#type_demande").val(response.type_demande)
                    $('#type_demande').trigger('change');
                    console.log("dfdf " +response.nature_demandes_id);
                    var natures_demandeSelect = $('#natures_demande');
                    $.ajax({
                        type: 'GET',
                        url: '/natures_demande/Select2/' + response.nature_demandes_id
                    }).then(function(data) {
                        // create the option and append to Select2
                        var option = new Option(data.libelle, data.id, true, true);
                        natures_demandeSelect.append(option).trigger('change');
                        // manually trigger the `select2:select` event
                        natures_demandeSelect.trigger({
                            type: 'select2:select',
                            params: {
                                data: data
                            }
                        });
                    });
                    var article_Select = $('#articles_id');
                     // create the option and append to Select2
                     var option = new Option(response.libelle, response.articles_id, true, true);
                     article_Select.append(option).trigger('change');
                        // manually trigger the `select2:select` event
                        article_Select.trigger({
                            type: 'select2:select',
                            /*params: {
                                data: data
                            }*/
                        });
                    if (response.document) {
                        $("input[name=file_name]").val(response.document.libelle);
                    }
                    $('#add').html("تحيين الجدول")


                },
                error: function(errors) {
                    $('#add').html("{{ __('inputs.btn_add_row_cp') }}")

                    swal("{{ __('labels.swal_warning_title') }}", errors.responseJSON.message,
                        "warning");
                }
            }); // ajax end
        }

        // Delete session + event
        function deleteFile(id) {
            swal({
                    title: "{{ __('labels.swal_delete_title') }}",
                    text: "{{ __('labels.swal_delete_text') }}",
                    icon: "warning",
                    buttons: ["{{ __('labels.swal_cancel_btn') }}", "{{ __('labels.swal_confirm_btn') }}"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            type: 'DELETE',
                            dataType: 'JSON',
                            data: {
                                id: id,
                                param: 'besoin_documents'
                            },
                            url: "{{ route('files.delete') }}",
                            success: function(response) {
                                //console.log(response)
                                //alert(JSON.stringify(response))
                                // refresh data or remove only tr
                                $('#table-cp').DataTable().ajax.reload();
                                PnotifyCustom(response)


                            }
                        }); // ajax end

                    }
                });
        }


        // Delete contact_cp
        function deleteFromDataTableLigneBesoinBtn(id) {
            //  let id = $('#tbl_btn_delete').attr('data-id');
            var url = "{{ route('ligne_besoins_datatable.destroy') }}";
            swal({
                    title: "{{ __('labels.swal_delete_title') }}",
                    text: "{{ __('labels.swal_delete_text') }}",
                    icon: "warning",
                    buttons: ["{{ __('labels.swal_cancel_btn') }}", "{{ __('labels.swal_confirm_btn') }}"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'DELETE',
                            dataType: 'JSON',
                            url: url,
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                console.log(response)
                                //alert(JSON.stringify(response))
                                // refresh data or remove only tr
                                $('#table-cp').DataTable().ajax.reload();
                                PnotifyCustom(response)
                            }
                        }); // ajax end
                    }
                });
        }
    </script>
@endsection
