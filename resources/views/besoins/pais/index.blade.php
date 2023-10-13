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
                <h5>المخطط السنوي للحاجيات</h5>
                <div class="card-header-right">
                    @can('besoins-list')
                        <button class="btn btn-danger " id="btn_delete" onclick='return multipleDelete("{{ $locale }}");'>
                            <i class="feather icon-trash-2"></i>
                            {{ __('inputs.btn_delete') }}
                            <i id="btn_count"></i>
                        </button>
                    @endcan
                    @can('besoins-list')
                        <a type="button" class="btn btn-primary" href="{{ route('besoins.create') }}">
                            <i class="feather icon-plus-circle"></i> {{ __('inputs.btn_create') }}
                        </a>
                    @endcan
                </div>

            </div>
            <div class="card-body">
                <div class="row">

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
                            <label class="form-label">نوع الطلب</label>

                            <select class="form-control " id="natures_demande" name="natures_demande">
                                <option value="all">الكل</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="exampleFormControlSelect1">المؤسسة/المصلحة</label>
                        <select class="js-example-basic-multiple-limit col-sm-12" multiple="multiple" id="services_id"
                            name="services_id">
                            <option value="all">الكل</option>
                            @foreach ($services as $item)
                                <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary-gradient " id="btn_search_besoins" type="submit"
                            style="margin-top: 32px">
                            {{ __('inputs.btn_search') }}
                        </button>
                    </div>
                </div>

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
                            <th>الكلفة التقديرية للوحدة(بالدينار)</th>
                            <th>الكلفة التقديرية الجملية(بالدينار)</th>
                            <th>الملاحظات</th>
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
                                <th>الكمية المصادقة</th>
                                <th>الكلفة التقديرية للوحدة(بالدينار)</th>
                                <th>الكلفة التقديرية الجملية(بالدينار)</th>
                                <th>الملاحظات</th>
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
            var annee_gestion = $('#g_annee_gestion').val()
            var services_id = $('#services_id').val()
            var type_demande = $('#type_demande').val()
            var natures_demande = $('#natures_demande').val()
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
                    url: "{{ route('pais.datatable') }}",
                    data: function(data) {
                        data.annee_gestion = $('#g_annee_gestion').val()
                        if ($("#services_id").val()[0] === undefined) {
                            data.services_id = 'all';
                        } else {
                            data.services_id = $("#services_id").val()[0]
                        }
                        // data.services_id = $('#services_id').val()
                        data.type_demande = $('#type_demande').val()
                        data.nature_demande = $('#natures_demande').val()
                        data.mode = "pais";
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
                        api.column(8, {
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
                maximumSelectionLength: 1,
                placeholder: "{{ __('labels.choose') }} ",

            });
        });
        // Get Dropdown Cascade
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
                    $('#natures_demande').append('<option value="all">الكل</option>');
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


        // Search button click event (reload dtatable)
        $('#btn_search_besoins').on('click', (e) => {
            e.preventDefault();
            // var annee_gestion = $('#annee_gestion').val();

            $('#table-cp').DataTable().ajax.reload();

        })
    </script>
@endsection
