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
        'bread_title' => 'البرنامج السنوي للشراءات',
        'bread_subtitle' => 'المخطط السنوي للشراءات',
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
                <h5>المخطط التقديري السنوي للشراءات</h5>
                <div class="card-header-right">
                        <form action="{{ route('ppm.print') }}" method="post" target="_blank">
                            @csrf
                            <input type="text" id="print_annee_gestion" name="print_annee_gestion" hidden>
                            <input type="text" id="print_type_demande" name="print_type_demande" hidden>
                            <input type="submit" value="Submit"  id="btn_submit" name="btn_submit" hidden >
                            <button type="button" class="btn btn-primary" id="btn_print">
                                طباعة
                            </button>
                          </form>
                </div>

            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-4">
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

                            <th>الموضوع</th>
                            <th>آجال الإنجاز</th>
                            <th>طريقة الإبرام</th>
                            <th>مصدر التمويل</th>
                            <th>ت.ت لإعداد كراس الشروط</th>
                            <th>ت.ت للإعلان عن المنافسة</th>
                            <th>ت.ت لفتح العروض</th>
                            <th>ت.ت لتعهد لجنة الشراءات بالملف</th>
                            <th>ت.ت لإحالة الملف على لجنة الصفقات</th>
                            <th>ت.ت لإجابة لجنة الصفقات</th>
                            <th>ت.ت لنشر نتائج المنافسة</th>
                            <th>ت.ت لتبليغ الصفقة</th>
                            <th>ت.ت لبداية الإنجاز</th>

                            <th class="not-export-col">قرار</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                        class=" not-export-col"/> </th>
                                <th class="not-export-col"> </th>
                                <th>الموضوع</th>
                                <th>آجال الإنجاز</th>
                                <th>طريقة الإبرام</th>
                                <th>مصدر التمويل</th>
                                <th>ت.ت لإعداد كراس الشروط</th>
                                <th>ت.ت للإعلان عن المنافسة</th>
                                <th>ت.ت لفتح العروض</th>
                                <th>ت.ت لتعهد لجنة الشراءات بالملف</th>
                                <th>ت.ت لإحالة الملف على لجنة الصفقات</th>
                                <th>ت.ت لإجابة لجنة الصفقات</th>
                                <th>ت.ت لنشر نتائج المنافسة</th>
                                <th>ت.ت لتبليغ الصفقة</th>
                                <th>ت.ت لبداية الإنجاز</th>

                                <th class="not-export-col">قرار</th>
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
    <script src="{{ asset('/plugins/notification/js/bootstrap-growl.min.js') }}"></script>
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/pdfmake.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/vfs_fonts.js') }}"></script>

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
                        },
                    },
                    {
                        text: '{{ __('inputs.btn_print') }}',
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col):not(.select-checkbox)'
                           // columns: [6,7,8,9,10,11,12,13]
                        },
                        /*customize: function ( win ) {
                          //  alert(JSON.stringify(win))
                            $(win.document.body).css('direction', 'rtl');
                        },*/
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
                    url: "{{ route('ppm.data') }}",
                    data: function(data) {
                        data.annee_gestion = $('#g_annee_gestion').val()
                        data.services_id = 'all';
                        // data.services_id = $('#services_id').val()
                        data.type_demande = $('#type_demande').val()
                        data.natures_passation = 'all'
                        data.mode ="ppm"
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
                        data: "objet",
                        className: "objet"
                    },
                    {
                        data: "duree_travaux_prvu",
                        className: "duree_travaux_prvu"
                    },
                    {
                        data: "nature_passationL",
                        className: "nature_passationL"
                    },
                    {
                        data: "source_finance",
                        className: "source_finance"
                    },
                    {
                        data: "date_cc_prvu",
                        className: "date_cc_prvu"
                    },
                    {
                        data: "date_avis_prvu",
                        className: "date_avis_prvu"
                    },
                    {
                        data: "date_op_prvu",
                        className: "date_op_prvu"
                    },
                    {
                        data: "date_trsfert_ca_prvu",
                        className: "date_trsfert_ca_prvu"
                    },
                    {
                        data: "date_trsfert_cao_prvu",
                        className: "date_trsfert_cao_prvu"
                    },
                    {
                        data: "date_repca_prvu",
                        className: "date_repca_prvu"
                    },
                    {
                        data: "date_pub_reslt_prvu",
                        className: "date_pub_reslt_prvu"
                    },
                    {
                        data: "date_avis_soumissionaire_prvu",
                        className: "date_avis_soumissionaire_prvu"
                    },
                    {
                        data: "date_ordre_serv_prvu",
                        className: "date_ordre_serv_prvu"
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
            $("#services_id").select2({
                dir: "{{ $rtl }}",
                maximumSelectionLength: 1,
                placeholder: "{{ __('labels.choose') }}",
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
        $('#btn_search_projets').on('click', (e) => {
            e.preventDefault();
            // var annee_gestion = $('#annee_gestion').val();
            $('#table-cp').DataTable().ajax.reload();
        })
        $('#btn_print').on("click", () => {
            $('#print_annee_gestion').val($('#g_annee_gestion').val())
            $('#print_type_demande').val($('#type_demande').val())
            $("#btn_submit").click()
        })
    </script>
@endsection
