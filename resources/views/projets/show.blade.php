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
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
@endsection


@section('breadcrumb')
    @include('layouts.partials.breadcrumb', [
        'bread_title' => 'مشروع شراء',
        'bread_subtitle' => 'عرض تفاصيل مشروع شراء',
    ])
@endsection

@section('content')
    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>عرض تفاصيل مشروع شراء</h5>
                <div class="card-header-right">
                    <a href="{{ route('besoins.index') }}" class="btn btn-secondary">
                        العودة لقائمة مشاريع الشراءات
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

                {{-- Case Other Parties --}}

                <input type="text" name="lignesprjt" id="lignesprjt" hidden>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="annee_gestion"> السنة المالية </label>
                            <input type="number" class="form-control" id='annee_gestion' name="annee_gestion"
                                placeholder="أدخل السنة المالية" value='{{ $projet->annee_gestion }}' readonly>

                        </div>
                    </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">طبيعة الطلب</label>
                            <select class="form-control" id="type_demande" name="type_demande" disabled="true">
                                <option value="all">الكل</option>
                                <option value="1"  @if ($projet->type_demande ==1) selected = true @endif >مواد وخدمات</option>
                                <option value="2"  @if ($projet->type_demande ==2) selected = true @endif >أشغال</option>
                                <option value="3"  @if ($projet->type_demande ==3) selected = true @endif >دراسات</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">طريقة الإبرام</label>
                            <select class="form-control" id="nature_passation" name="nature_passation"  disabled="true">
                                <option value="all">الكل</option>
                                <option value="CONSULTATION" @if ($projet->nature_passation =="CONSULTATION") selected = true @endif >استشارة عادية</option>
                                <option value="AOS" @if ($projet->nature_passation =="AOS") selected = true @endif >صفقة إجراءات مبسطة </option>
                                <option value="AON" @if ($projet->nature_passation =="AOS") selected = true @endif>صفقة إجراءات عادية</option>
                                <option value="AOGREGRE" @if ($projet->nature_passation =="AOS") selected = true @endif>صفقة بالتفاوض المباشر</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">الموضوع</label>
                            <input type="text" class="form-control" name="objet" id="objet" value="{{ $projet->objet }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <h4> محتوى المسشروع</h4>

                    <div class="dt-responsive table-responsive">

                        <h6 style="color: red; text-align: left;">الكلفة الجمليةالتقديرية للحاجيات : <span id="coutTotal">
                            </span></h6>

                        <table id="table-cp" class="table table-striped table-bordered nowrap">
                            <thead>
                                <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                        class="select-checkbox not-export-col" /> </th>
                                <th class="not-export-col">id</th>
                                <th>المادة</th>
                                <th>طبيعة الطلب</th>
                                <th>نوع الطلب</th>
                                <th>الكمية المطلوبة</th>
                                <th>الكمية المصادقة</th>
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
                                    <th>الكمية المطلوبة</th>
                                    <th>الكمية المصادقة</th>
                                    <th>الكلفة التقديرية للوحدة</th>
                                    <th>الكلفة التقديرية الجملية</th>
                                    <th>الملاحظات</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="row mt-4">
                    <a href="{{ route('projets.index') }}" class="btn btn-danger" style="float: left;">
                        <i class="feather icon-minus-circle"></i>
                        {{ __('inputs.btn_cancel') }}
                    </a>
                </div>
                <!-- [ Form Validation ] end -->

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

    <!-- form-select-custom Js -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        'use strict';
        $(document).ready(function() {
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
                    'annee_gestion': {
                        required: true,
                    },
                    'date_action_prevu': {
                        required: true,
                        date: true,
                    },
                },
                messages: {
                    annee_gestion: {
                        required: "هذا الحقل إجباري",
                        min_length: "السنة لا تقل عن 4 أرقام",
                        max_length: "السنة لا تفوق أربعة أرقام"
                    },
                    date_action_prevu: {
                        required: "هذا الحقل إجباري",
                        date: "الرجاء الثبت من صحةالتاريخ",
                    }
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
                    url: "{{ route('pais.datatable') }}",
                    data: function(data) {
                        data.annee_gestion = $('#annee_gestion').val()
                        data.services_id = $('#services_id').val()
                        data.type_demande = $('#type_demande').val()
                        data.nature_demande = 'all'
                        data.mode = 'projets'
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
                        data: "qte_valide",
                        className: "qte_valide"
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
                        data: "libelle",
                        className: "libelle"
                    },
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
