@php

$breadcrumb = __('breadcrumb.bread_soumissionnaires_list');
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
                <h5>{{ __('cards.soumissionnaires_list') }}</h5>
                <div class="card-header-right">
                    @can('besoins-list')
                        <button class="btn btn-danger " id="btn_delete" onclick='return multipleDelete("{{ $locale }}");'>
                            <i class="feather icon-trash-2"></i>
                            {{ __('inputs.btn_delete') }}
                            <i id="btn_count"></i>
                        </button>
                    @endcan
                    @can('besoins-list')
                        <button type="button" class="btn btn-primary" href="" data-toggle="modal"
                            data-target="#add_soumissionnaire">
                            <i class="feather icon-plus-circle"></i> {{ __('inputs.btn_create') }}
                        </button>
                    @endcan
                </div>

            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="soumissionnaire-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th style="width: 30px"><input type="checkbox" class="select-checkbox" /> </th>
                            <th>id</th>
                            <th>الاسم</th>
                            <th>جهة الإتصال</th>gouvernorat
                            <th>العنوان</th>
                            <th>الترقيم البريدي</th>
                            <th>المدينة</th>
                            <th>المحافظة</th>
                            <th>الفاكس</th>
                            <th>العنوان الإلكتروني</th>
                            <th>المعرف الجبائي</th>
                            <th>{{ $tbl_action }}</th>
                        </thead>

                        <tfoot>
                            <tr>
                                <th style="width: 30px"></th>
                                <th>id</th>
                                <th>الاسم</th>
                                <th>جهة الإتصال</th>
                                <th>العنوان</th>
                                <th>الترقيم البريدي</th>
                                <th>المدينة</th>
                                <th>المحافظة</th>
                                <th>الفاكس</th>
                                <th>العنوان الإلكتروني</th>
                                <th>المعرف الجبائي</th>
                                <th>{{ $tbl_action }}</th>
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

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#soumissionnaire-table').DataTable({
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
                    url: "{{ route('soumissionnaires.datatable') }}"
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
                        data: "libelle",
                        className: "libelle"
                    },
                    {
                        data: "contact",
                        className: "contact"
                    },
                    {
                        data: "adresse",
                        className: "adresse"
                    },
                    {
                        data: "code_postal",
                        className: "code_postal"
                    },
                    {
                        data: "ville",
                        className: "ville"
                    },
                    {
                        data: "gouvernorat",
                        className: "gouvernorat"
                    },
                    {
                        data: "tel_fax",
                        className: "tel_fax"
                    },
                    {
                        data: "email",
                        className: "email"
                    },
                    {
                        data: "matricule_fiscale",
                        className: "matricule_fiscale"
                    },
                    {
                        data: 'action',
                        className: 'action',
                        visible: 'false'
                    }
                ],
                responsive: true,

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
            table
                .on('select', function(e, dt, type, indexes) {
                    SelectedRowCountBtnDelete(table)
                })
                .on('deselect', function(e, dt, type, indexes) {
                    SelectedRowCountBtnDelete(table)
                });

            $('.dataTables_length').addClass('bs-select');

            // Setup - add a text input to each footer cell

            addSearchFooterDataTable("#soumissionnaire-table")
        });

        // Edite soumissionnaire
        function editSoumissionnaire(id) {

            $.ajax({
                type: "GET",
                url: "soumissionnaires/" + id + "/edit",
                success: function(data) {
                    $('#add_soumissionnaire').modal('show');
                    $("#soumissionnaire_id").val(id);
                    $('#libelle').val(data.libelle);
                    $('#contact').val(data.contact);
                    $('#adresse').val(data.adresse);
                    $('#code_postal').val(data.code_postal);
                    $('#ville').val(data.ville);
                    $('#gouvernorat').val(data.gouvernorat);
                    $('#tel_fax').val(data.tel_fax);
                    $('#email').val(data.email);
                    $('#matricule_fiscale').val(data.matricule_fiscale);
                },
                error: function(response) {
                    alert(response.responseJSON.message)
                }
            }); // ajax end

        }

        function deleteFromDataTableBtn(id) {

            var url = "{{ route('soumissionnaires.destroy', ['soumissionnaire' => ':id']) }}";
            url = url.replace(':id', id);
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
                            url: url,
                            type: 'DELETE',
                            success: function(response) {
                                console.log(response);
                                deleteSingleRowDataTable("#soumissionnaire-table");
                                PnotifyCustom(response);
                            }
                        }); // ajax end

                    }
                });
        }

        /*
        function multipleDelete(locale) {
            var table = $('#soumissionnaire-table').DataTable();
            var ids = table.rows('.selected').data();
            var url = "";//soumissionnaires_datatable.multidestroy
            multipleDeleteG(locale, "#soumissionnaire-table", ids, url);
        }
        */
    </script>
@endsection
