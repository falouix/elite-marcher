@php

    $breadcrumb = 'قائمة الإشعارات';
    if ($locale == 'ar') {
        $lang = asset('/plugins/i18n/Arabic.json');
    } else {
        $lang = '';
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
        'bread_title' => $breadcrumb,
        'bread_subtitle' => $breadcrumb,
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
                <h5>قائمة الإشعارات</h5>
                <div class="card-header-right">

                </div>

            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="article-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th style="width: 30px"><input type="checkbox" class="select-checkbox" /> </th>
                            <th></th>
                            <th>نص الإشعار</th>
                            <th>النوع</th>
                            <th>تاريخ التثبيت</th>
                            <th>{{ $tbl_action }}</th>
                        </thead>

                        <tfoot>
                            <tr>
                                <th style="width: 30px"><input type="checkbox" class="select-checkbox" /> </th>
                                <th></th>
                                <th>نص الإشعار</th>
                                <th>النوع</th>
                                <th>تاريخ التثبيت</th>
                                <th>{{ $tbl_action }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-header">
                <h5>تفاصيل الإشعارات</h5>
                <div class="card-header-right">

                </div>

            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="lignesnotif-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th>المستخدم</th>
                            <th>تاريخ الإطلاع</th>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>المستخدم</th>
                                <th>تاريخ الإطلاع</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <input type="hidden" id="notifs_id" value="0">
        </div>
    </div>
@endsection
@section('srcipt-js')
    <!-- datatable Js -->
    <script src="{{ asset('/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/dataTables.select.min.js') }}"></script>
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- pnotify Js -->
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></scrip
    <script src="{{ asset('/js/axios.min.js') }}"></script>
    <script src="{{ asset('/js/vue-axios.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            window.axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#article-table').DataTable({
                //dom: 'Bfrtip',
                initComplete: function() {
                    // Apply the search
                    this.api().columns().every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    });
                },
                processing: true,
                serverSide: true,
                serverMethod: 'POST',
                ajax: {
                    url: "{{ route('notifs.data') }}"
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
                        className: "id"
                    },
                    {
                        data: "texte",
                        className: 'texte'
                    },
                    {
                        data: "type_notif",
                        className: 'type_notif'
                    },
                    {
                        data: "date_traitement",
                        className: 'date_traitement'
                    },
                    {
                        data: 'action',
                        className: 'action',
                        visible: 'false'
                    },
                ],
                responsive: true,
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                // select: { style: 'multi+shift' },

            });
            table
                .on('select', function(e, dt, type, indexes) {
                    if (table.$(".selected").length > 1) {
                        table.$(".selected").removeClass('selected');
                        $(this).addClass("selected");
                    }
                    var rowData = table.rows(indexes).data().toArray();
                    //console.log( rowData[0].id );
                    $('#notifs_id').val(rowData[0].id)
                    // refresh datatable
                    $('#lignesnotif-table').DataTable().ajax.reload();

                })
                .on('deselect', function(e, dt, type, indexes) {
                    $('#notifs_id').val(0)
                    // refresh datatable
                    $('#lignesnotif-table').DataTable().ajax.reload();
                });

            // Setup - add a text input to each footer cell

            addSearchFooterDataTable("#article-table")

            // LignesNotifDataTable
            var tableligneNotif = $('#lignesnotif-table').DataTable({
                //dom: 'Bfrtip',
                initComplete: function() {
                    // Apply the search
                    this.api().columns().every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
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
                    url: "{{ route('lignes-notifs.data') }}",
                    data: function(data) {
                        data.notifs_id = $('#notifs_id').val()
                    },
                },
                deferRender: true,

                language: {
                    url: "{{ $lang }}"
                },
                columns: [
                    {
                        data: "user_name",
                        className: 'user_name'
                    },
                    {
                        data: "read_at",
                        className: 'read_at'
                    },
                ],
                responsive: true,
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                // select: { style: 'multi+shift' },

            });
            tableligneNotif
                .on('select', function(e, dt, type, indexes) {
                    // var rowData = table.rows( indexes ).data().toArray();
                    //console.log( rowData );

                })
                .on('deselect', function(e, dt, type, indexes) {

                });



            // Setup - add a text input to each footer cell

            addSearchFooterDataTable("#lignesnotif-table")
            $('.dataTables_length').addClass('bs-select');
        })
    </script>
@endsection
