@php

$breadcrumb = __('breadcrumb.bread_services_list');
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
                <h5>{{ __('cards.services_list') }}</h5>
                <div class="card-header-right">
                    @can('case-delete')
                        <button class="btn btn-danger " id="btn_delete" onclick='return multipleDelete("{{ $locale }}");'>
                            <i class="feather icon-trash-2"></i>
                            {{ __('inputs.btn_delete') }}
                            <i id="btn_count"></i>
                        </button>
                    @endcan
                    @can('case-type-create')
                        <button type="button" class="btn btn-primary" href="" data-toggle="modal" data-target="#add_service">
                            <i class="feather icon-plus-circle"></i> {{ __('inputs.btn_create') }}
                        </button>
                    @endcan
                </div>

            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="service-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th style="width: 30px"><input type="checkbox" class="select-checkbox" /> </th>
                            <th>id</th>
                            <th>المصلحة/الدائرة/ المؤسسة</th>
                            <th>جهة الإتصال</th>
                            <th>المسؤول</th>
                            <th>{{ $tbl_action }}</th>
                        </thead>

                        <tfoot>
                            <tr>
                                <th style="width: 30px"></th>
                                <th>id</th>
                                <th>المصلحة/الدائرة/ المؤسسة</th>
                                <th>جهة الإتصال</th>
                                <th>المسؤول</th>
                                <th>{{ $tbl_action }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Column Selector table end -->
    <!-- Modal Create or edit status -->
    <div class="modal fade show" id="add_service" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
        style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"> {{ __('modals.service_modal') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_id">
                        <input type="text" name="service_id" id="service_id" value="0" hidden>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="lbl_libelle"> {{ __('labels.tbl_libelle') }} </label>
                                <input type="text" class="form-control" id='libelle' name="libelle"
                                    placeholder="{{ __('labels.tbl_libelle') }}" value="">
                                <label id="libelle-error"
                                    class="error jquery-validation-error small form-text invalid-feedback"
                                    for="libelle"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="lbl_contact"> {{ __('labels.tbl_contact') }} </label>
                                <input type="text" class="form-control" id='contact' name="contact"
                                    placeholder="{{ __('labels.tbl_contact') }}" value="">
                                <label id="contact-error"
                                    class="error jquery-validation-error small form-text invalid-feedback"
                                    for="contact"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="lbl_responsable"> {{ __('labels.tbl_responsable') }} </label>
                                <input type="text" class="form-control" id='responsable' name="responsable"
                                    placeholder="{{ __('labels.tbl_responsable') }}" value="">
                                <label id="responsable-error"
                                    class="error jquery-validation-error small form-text invalid-feedback"
                                    for="responsable"></label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('inputs.btn_close') }}</button>
                    <button class="btn btn-primary" id='btn_add_service'> {{ __('inputs.btn_create') }}
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Create or edit status end-->
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
            var table = $('#service-table').DataTable({
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
                    url: "{{ route('services.datatable') }}"
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
                        data: "responsable",
                        className: "responsable"
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

            addSearchFooterDataTable("#service-table")
        });

        // Create new service from modal
        $('#btn_add_service').click(() => {
            var id = $("#service_id").val()
            var libelle = $('#libelle').val();
            var contact = $('#contact').val();
            var responsable = $('#responsable').val();

            var url = "{{ route('services.store') }}";
            var type = 'POST';
            if (id != 0) {
                url = "{{ route('services.update', ['service' => ':id']) }}"
                url = url.replace(':id', id);
                type = 'PUT';
            }
            $.ajax({
                data: {
                    libelle: libelle,
                    contact: contact,
                    responsable: responsable
                },
                url: url,
                type: type,
                success: function(response) {
                    $('#service-table').DataTable().ajax.reload();
                    $('#add_service').modal('toggle');
                    $("#service_id").val('0');
                    $('#form_id').trigger("reset");
                    PnotifyCustom(response);
                }
            }); // ajax end
        });
        // Edite service
        function editService(id) {

            $.ajax({
                type: "GET",
                url: "services/" + id + "/edit",
                success: function(data) {
                    $('#add_service').modal('show');
                    $('#libelle').val(data.libelle);
                    $('#contact').val(data.contact);
                    $('#responsable').val(data.responsable);
                    $("#service_id").val(id);
                },
                error: function(response) {
                    alert(response.responseJSON.message)
                }
            }); // ajax end
            
        }

        function deleteFromDataTableBtn(id) {
            var url = "{{ route('services.destroy', ['service' => ':id']) }}";
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
                                console.log(response)
                                deleteSingleRowDataTable("#service-table");
                                PnotifyCustom(response);
                            }
                        }); // ajax end

                    }
                });
        }

        /*
        function multipleDelete(locale) {
            var table = $('#service-table').DataTable();
            var ids = table.rows('.selected').data();
            var url = "";//services_datatable.multidestroy
            multipleDeleteG(locale, "#service-table", ids, url);
        }
        */
    </script>
@endsection
