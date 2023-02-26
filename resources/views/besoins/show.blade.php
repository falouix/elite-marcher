@php
//dd($userService);
if ($locale == 'ar') {
    $lang = asset('/plugins/i18n/Arabic.json');
    $rtl = 'rtl';
} else {
    $lang = '';
}

$breadcrumb = 'ضبط الحاجيات';
$sub_breadcrumb = 'عرض تفاصيل الحاجيات';
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
                <h5>{{ $sub_breadcrumb }} [{{$besoin->service->libelle ?? '' }}]</h5>
                <div class="card-header-right">
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

                    <input type="hidden" name="lignebesoin_id" id="lignebesoin_id" value="0">
                    <div class="row">
                        <div class="col-md-12">
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
            </div>
        </div>
    </div>

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
    <script src="{{ asset('/plugins/data-tables/js/sum().js') }}"></script>

    <script>
        'use strict';
        $(document).ready(function() {
            $(function() {
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
                    drawCallback: function() {
                        var api = this.api();
                        $('#coutTotal').html(
                            api.column(7, {
                                page: 'current'
                            }).data().sum()
                        )
                    },
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

            });

        });

        function calculTotal() {
            let qte_demande = $("input[name=qte_demande]").val()
            let cout_unite_ttc = $("input[name=cout_unite_ttc]").val()
            let cout_total_ttc = qte_demande * cout_unite_ttc
            $("input[name=cout_total_ttc]").val(cout_total_ttc)

        }
    </script>
@endsection
