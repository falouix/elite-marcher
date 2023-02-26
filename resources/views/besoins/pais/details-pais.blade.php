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
    <script src="{{ asset('/plugins/data-tables/js/sum().js') }}"></script>`
    <style>
        .qte_valide,
        .cout_unite_ttc {
            background-color: lightgoldenrodyellow;
        }
    </style>
@endsection

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', [
        'bread_title' => 'تحديد الحاجيات',
        'bread_subtitle' => 'المخطط السنوي للحاجيات',
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
                <h5>المخطط السنوي للحاجيات [تفصيل الحاجيات المدرجة في مشروع شراء عدد {{$codeProjet}}]</h5>
                <div class="card-header-right">

                </div>

            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <h6 style="color: red; text-align: left;">الكلفة الجمليةالتقديرية للحاجيات : <span id="coutTotal">
                        </span></h6>

                    <table id="table-cp" class="table table-striped table-bordered nowrap">
                        <thead>

                            <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                    class="select-checkbox not-export-col" /> </th>
                            <th>المصلحة/المؤسسة</th>
                            <th>المادة</th>
                            <th>طبيعة الطلب</th>
                            <th>نوع الطلب</th>
                            <th>الكمية المطلوبة</th>
                            <th>الكمية المصادقة</th>
                            <th>الكلفة التقديرية الجملية</th>
                        </thead>
                        <tbody>
                            @foreach ($lignesBesoins as $ligneBesoins)
                                <tr>
                                    <td></td>
                                    <td>{{ $ligneBesoins->service }}</td>
                                    <td>{{ $ligneBesoins->libelle }}</td>
                                    <td>{{ $ligneBesoins->type_demande }}</td>
                                    <td>{{ $ligneBesoins->nature_demande }}</td>
                                    <td>{{ $ligneBesoins->qte_demande }}</td>
                                    <td>{{ $ligneBesoins->qte_valide }}</td>
                                    <td>{{ $ligneBesoins->cout_total_ttc }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                        class="select-checkbox not-export-col" /> </th>
                                <th>المصلحة/المؤسسة</th>
                                <th>المادة</th>
                                <th>طبيعة الطلب</th>
                                <th>نوع الطلب</th>
                                <th>الكمية المطلوبة</th>
                                <th>الكمية المصادقة</th>
                                <th>الكلفة التقديرية الجملية</th>
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
    <script src="{{ asset('/plugins/data-tables/js/sum().js') }}"></script>`

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
                    }
                ],
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
                scrollY: '750px',
                scrollCollapse: true,
                processing: true,
                language: {
                    url: "{{ $lang }}"
                },
                //responsive: true,
                columnDefs: [{
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    },

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

            $('.dataTables_length').addClass('bs-select');

            // Setup - add a text input to each footer cell

            addSearchFooterDataTable("#table-cp")
        });
    </script>
@endsection
