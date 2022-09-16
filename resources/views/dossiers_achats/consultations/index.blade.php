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


@endsection

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', [
        'bread_title' => '  ملفات الشراءات',
        'bread_subtitle' => 'الإستشارات',
    ])
@endsection

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

@section('content')
    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">

            <div class="card-header">
                <h5>قائمة الإستشارات</h5>
                <div class="card-header-left" style="float: left;">
                    @can('besoins-list')
                        <button class="btn btn-danger " id="btn_delete" onclick='return multipleDelete("{{ $locale }}");'>
                            <i class="feather icon-trash-2"></i>
                            {{ __('inputs.btn_delete') }}
                            <i id="btn_count"></i>
                        </button>
                    @endcan
                    @can('besoins-list')
                        <a type="button" class="btn btn-primary" href="{{ route('projets.create') }}">
                            <i class="feather icon-plus-circle"></i> {{ __('inputs.btn_create') }}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1">
                        <label> السنة المالية</label>
                        <input type="text" class="form-control" id="annee_gestion" maxlength="4" id="pin"
                            pattern="\d{4}" value="{{ strftime('%Y') }}" required />
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">طبيعة الطلب</label>
                            <select class="form-control" id="type_demande">
                                <option value="all">الكل</option>
                                <option value="1">مواد وخدمات</option>
                                <option value="2">أشغال</option>
                                <option value="3">دراسات</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">وضعية الملف</label>
                            <select class="form-control" id="situation_dossier" name="situation_dossier">
                                <option value="all">الكل</option>
                                <option value="1">بصدد الإعداد</option>
                                <option value="2">في انتظار العروض</option>
                                <option value="3">في الفرز</option>
                                <option value="4">بصدد الإنجاز</option>
                                <option value="5">القبول الوقتي</option>
                                <option value="6">القبول النهائي</option>
                                <option value="7">ملف منتهي </option>
                                <option value="8">ملغى</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary-gradient " id="btn_search_projets" type="submit"
                            style="margin-top: 32px">
                            {{ __('inputs.btn_search') }}
                        </button>
                    </div>
                </div>

                <div class="dt-responsive table-responsive">

                    <table id="table-cp" class="table table-striped table-bordered nowrap">
                        <thead>
                        <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                class="select-checkbox not-export-col" /> </th>
                        <th class="not-export-col"> </th>
                        <th>إستشارة عدد</th>
                        <th>وضعية الملف</th>
                        <th>الموضوع</th>
                        <th>الإطار</th>
                        <th>مشروع عدد</th>
                        <th>جهة التمويل</th>
                        <th>طريقة التمويل</th>
                        <th>طبيعة الأسعار</th>
                        <th>الكلفة التقديرية</th>
                        <th>تاريخ الختم</th>
                        <th class="not-export-col">{{ $tbl_action }}</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                    class="select-checkbox not-export-col" /> </th>
                            <th class="not-export-col"> </th>
                            <th>إستشارة عدد</th>
                            <th>وضعية الملف</th>
                            <th>الموضوع</th>
                            <th>الإطار</th>
                            <th>مشروع عدد</th>
                            <th>جهة التمويل</th>
                            <th>طريقة التمويل</th>
                            <th>طبيعة الأسعار</th>
                            <th>الكلفة التقديرية</th>
                            <th>تاريخ الختم</th>
                            <th class="not-export-col">{{ $tbl_action }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Column Selector table end -->
@endsection
@section('srcipt-js')

    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- pnotify Js -->
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>

     <!-- datatable Js -->
     <script src="{{ asset('/plugins/data-tables/js/datatables.min.js') }}"></script>
     <script src="{{ asset('/plugins/data-tables/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/pdfmake.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/vfs_fonts.js') }}"></script>

    <script>
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
                // serverSide: true,
                serverMethod: 'POST',
                ajax: {
                    url: "{{ route('dossiers.data') }}",
                    data: function(data) {
                        data.annee_gestion = $('#annee_gestion').val()

                         data.situation_dossier = $('#situation_dossier').val()
                        data.type_demande = $('#type_demande').val()
                        data.type_dossier = 'CONSULTATION'
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
                        data: "code_dossier",
                        className: "code_dossier"
                    },
                    {
                        data: "situationDA",
                        className: "situationDA"
                    },
                    {
                        data: "objet_dossier",
                        className: "objet_dossier"
                    },
                    {
                        data: "type_demandeL",
                        className: "type_demandeL"
                    },
                    {
                        data: "code_projet",
                        className: "code_projet"
                    },
                    {
                        data: "organisme_financier",
                        className: "organisme_financier"
                    },
                    {
                        data: "source_financeL",
                        className: "source_financeL"
                    },
                    {
                        data: "nature_financeL",
                        className: "nature_financeL"
                    },
                    {
                        data: "total_ttc",
                        className: "total_ttc"
                    },
                    {
                         data: "date_cloture",
                        className: "date_cloture"
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

        });


        // Search button click event (reload dtatable)
        $('#btn_search_projets').on('click', (e) => {
            e.preventDefault();
            // var annee_gestion = $('#annee_gestion').val();
            $('#table-cp').DataTable().ajax.reload();
        })

    </script>
@endsection
