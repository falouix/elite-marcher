@extends('layouts.app')
@section('page_title')
    {{ __('app.home_page') }}
@endsection

@section('head-script')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('/plugins/data-tables/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/data-tables/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/notification/css/notification.min.css') }}">
    <!-- pnotify css -->
    <link rel="stylesheet" href="{{ asset('/plugins/pnotify/css/pnotify.custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/pages/pnotify.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/animation/css/animate.min.css') }}">
@endsection
@section('content')
    <!-- [ sample-page ] start -->
    <div class="col-md-12">
        <div class="row">
            <!-- [ shadows ] start -->
            <div class="col-md-12">


                @if ($besoins_actif)
                    <div class="shadow-lg p-3 mb-1 bg-white rounded" style="text-align:center;">
                        <span style="color:rgb(231, 29, 29); font-weight:bold; font-size:20px;">منظومة متابعة الصفقات العمومية : فضاء المزود</span>
                        </br>
                        <span style="color:rgb(27, 25, 25); font-weight:bold; font-size:18px;"> يمكن هذا الفضاء المزود من متابعة ملفات ووثائق الصفقات المسندة إليه</span>
                    </div>
                @endif
            </div>
            <!-- [ shadows ] end -->
        </div>
        <div class="row mt-3">
            <!-- [ cards ] start -->

                <!-- [ Statistics ] Start-->
                <!-- [ Calendar ] Start-->
                 <!-- [ cards ] end -->
                 <div class="col-md-12">
                    <div class="row">
                        <!-- [ clients_count ] start -->
                        <div class="col-md-4">
                            <div class="card ticket-card">
                                <div class="card-body">
                                    <p class="m-b-25 bg-c-green lbl-card"><i class="fas fa-folder-open m-r-5"></i>
                                        ملفات بصدد الإنجاز</p>
                                    <div class="text-center">
                                        <h2 class="m-b-0 d-inline-block text-c-green">{{ $count_dossiersEncours }}</h2>
                                        <p class="m-b-0 d-inline-block"> ملف</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ clients_count ] end -->
                        <!-- [ session_count ] start -->
                        <div class="col-md-4">
                            <div class="card ticket-card">
                                <div class="card-body">
                                    <p class="m-b-25 bg-c-blue lbl-card"><i class="fas fa-file-archive m-r-5"></i>
                                        الملفات المنجزة
                                    </p>
                                    <div class="text-center">
                                        <h2 class="m-b-0 d-inline-block text-c-blue">{{ $count_dossiersFini }}</h2>
                                        <p class="m-b-0 d-inline-block"> ملف</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ session_count ] end -->
                        <!-- [ cases_count ] start -->
                        <div class="col-md-4">
                            <div class="card ticket-card">
                                <div class="card-body">
                                    <p class="m-b-25 bg-c-red lbl-card"><i class="fas fa-folder-minus m-r-5"></i>
                                        الملفات الملغاة
                                    </p>
                                    <div class="text-center">
                                        <h2 class="m-b-0 d-inline-block text-c-red">{{ $count_dossiersAnnuler }}</h2>
                                        <p class="m-b-0 d-inline-block">ملف</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ cases_count ] end -->


                    </div>
                    <!-- [ row 2 ] end -->
                </div>



                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <h5>ملفات الشراءات</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label> السنة المالية</label>
                                    <input type="text" class="form-control" id="annee_gestion" maxlength="4" id="pin"
                                        pattern="\d{4}" value="{{ strftime('%Y') }}" required />
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">وضعية الملف</label>
                                        <select class="form-control" id="situation_dossier" name="situation_dossier">
                                            <option value="all">الكل</option>
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
                                        <th>ملف عدد</th>
                                        <th>وضعية الملف</th>
                                        <th>الموضوع</th>

                                        <th>الكلفة</th>
                                        <th>تاريخ الختم</th>
                                        <th class="not-export-col">قرار</th>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                                    class="select-checkbox not-export-col" /> </th>
                                            <th class="not-export-col"> </th>
                                            <th>ملف عدد</th>
                                            <th>وضعية الملف</th>
                                            <th>الموضوع</th>

                                            <th>الكلفة</th>
                                            <th>تاريخ الختم</th>
                                            <th class="not-export-col">قرار</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

 <!-- [ Statistics ] End-->


        </div>

    </div>
@endsection

@section('srcipt-js')
    <!-- datatable Js -->
    <script src="{{ asset('/plugins/notification/js/bootstrap-growl.min.js') }}"></script>
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/pdfmake.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/vfs_fonts.js') }}"></script>
<!-- Vue JS AXIOS -->
<script src="{{ asset('/js/vue.js') }}"></script>
<script src="{{ asset('/js/axios.min.js') }}"></script>
<script src="{{ asset('/js/vue-axios.min.js') }}"></script>
    <!--
        <script src="https://unpkg.com/vue@2.5.17/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/vue-axios@2.1.4/dist/vue-axios.min.js"></script>
    -->

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
                    url: "{{ route('dossiers-clients.data') }}",
                    data: function(data) {
                        data.annee_gestion = $('#annee_gestion').val()
                        data.situation_dossier = $('#situation_dossier').val()
                        data.type_demande = 'all'
                        data.type_dossier = 'all'
                    },
                },
                deferRender: true,
                language: {
                    url: "{{ asset('/plugins/i18n/Arabic.json') }}"
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
                        data: "total_ttc",
                        className: "total_ttc"
                    },
                    {
                        data: "date_cloture",
                        className: "date_cloture"
                    },
                    {
                        data: 'dashboard_action',
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
            document.addEventListener('DOMContentLoaded', function() {
                if (Notification.permission !== "granted") {
                    Notification.requestPermission();
                }
            });

            // [ incomeing-scroll ] start
            var px = new PerfectScrollbar('.incomeing-scroll', {
                wheelSpeed: .5,
                swipeEasing: 0,
                wheelPropagation: 1,
                minScrollbarLength: 40,
            });
            showNotifG()

        });
        // Search button click event (reload dtatable)
        $('#btn_search_projets').on('click', (e) => {
            e.preventDefault();
            // var annee_gestion = $('#annee_gestion').val();
            $('#table-cp').DataTable().ajax.reload();
        })
    </script>
@endsection
