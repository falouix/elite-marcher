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
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
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
                    @can('besoins-list')
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
                                    placeholder="{{ __('labels.tbl_libelle') }}" required>
                                <label id="libelle-error"
                                    class="error jquery-validation-error small form-text invalid-feedback"
                                    for="libelle"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="lbl_contact"> {{ __('labels.tbl_contact') }} </label>
                                <input type="text" class="form-control" id='contact' name="contact"
                                    placeholder="{{ __('labels.tbl_contact') }}" required>
                                <label id="contact-error"
                                    class="error jquery-validation-error small form-text invalid-feedback"
                                    for="contact"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="lbl_responsable"> {{ __('labels.tbl_responsable') }} </label>
                                <input type="text" class="form-control" id='responsable' name="responsable"
                                    placeholder="{{ __('labels.tbl_responsable') }}" required>
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
   <!-- form-select-custom Js -->
   <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>


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


        // Create new case status from modal
        $('#btn_add_service').click(() => {
            let responsable = $('#responsable').val();
            let contact = $('#contact').val();
            let libelle = $("input[name=libelle]").val();
            let id = $("#service_id").val();
            var $url = "{{ route('services.store') }}"
            var $type = "POST";
            if (id != 0) {
                $url = "{{ route('services.update', ['service' => ':id']) }}"
                $url = $url.replace(':id', id);
                $type = "PUT";
            }
            $.ajax({
                url: $url,
                type: $type,
                data: {
                    libelle: libelle,
                    contact: contact,
                    responsable: responsable,
                },
                success: function(response) {
                    $('#libelle').removeClass('is-invalid')
                    $('#contact').removeClass('is-invalid')
                    $('#responsable').removeClass('is-invalid')
                    // refresh datatable
                    $('#service-table').DataTable().ajax.reload();
                    $('#add_service').modal('toggle');
                    PnotifyCustom(response)
                },
                error: function(errors) {
                    $('#libelle').removeClass('is-invalid')
                    if (errors.responseJSON.message.libelle != null) {
                        $('#libelle').addClass('is-invalid')
                        $('#libelle-error').text(errors.responseJSON.message.libelle);
                    }
                    $('#contact').removeClass('is-invalid')
                    if (errors.responseJSON.message.contact != null) {
                        $('#contact').addClass('is-invalid')
                        $('#contact-error').text(errors.responseJSON.message.contact);
                    }
                    $('#responsable').removeClass('is-invalid')
                    if (errors.responseJSON.message.responsable != null) {
                        $('#responsable').addClass('is-invalid')
                        $('#responsable-error').text(errors.responseJSON.message.responsable);
                    }
                }
            }); // ajax end

        })
        // OnClose Modal eventListener
        $('#add_service').on('hidden.bs.modal', function() {
            $("#form_id")[0].reset()
            var btn_title = "{{ __('inputs.btn_create') }}"
            $("#btn_add_service").html(btn_title)
            var modal_title = "{{ __('inputs.btn_create') }}"
            $("#modal-title").html(modal_title)
        })

        function editService(id) {
            $("#service_id").val(id)
            $url = "{{ route('services.edit', ['service' => ':id']) }}"
            $url = $url.replace(':id', id);
            // alert($url)
            $.ajax({
                url: $url,
                type: 'GET',
                success: function(response) {
                    var btn_title = "{{ __('inputs.btn_edit') }}"
                    $("#btn_add_service").html(btn_title)
                    var modal_title = "تحيين دائرة/مصلحة أو مؤسسة"
                    $("#modal-title").html(modal_title)

                    $("input[name=libelle]").val(response.libelle);
                    $("input[name=contact]").val(response.contact);
                    $("#responsable").val(response.responsable);
                    $('#add_service').modal('show');
                },
                error: function(response) {
                    alert(response.responseJSON.message)
                }
            }); // ajax end
        }

        function deleteFromDataTableBtn(id) {
            //  let id = $('#tbl_btn_delete').attr('data-id');

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
                            type: 'DELETE',
                            dataType: 'JSON',
                            url: url,
                            success: function(response) {
                                console.log(response)
                                //alert(JSON.stringify(response))
                                // refresh data or remove only tr
                                deleteSingleRowDataTable("#service-table")
                                PnotifyCustom(response)
                            },
                            error: function(jqXHR, exception) {
                                var msg = '';
                                if (jqXHR.status === 0) {
                                    msg = 'Not connect.\n Verify Network.';
                                } else if (jqXHR.status == 404) {
                                    msg = 'Requested page not found. [404]';
                                } else if (jqXHR.status == 500) {
                                    msg = 'Internal Server Error [500].';
                                } else if (exception === 'parsererror') {
                                    msg = 'Requested JSON parse failed.';
                                } else if (exception === 'timeout') {
                                    msg = 'Time out error.';
                                } else if (exception === 'abort') {
                                    msg = 'Ajax request aborted.';
                                } else {
                                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                                }
                                alert(msg);
                            },
                        }); // ajax end

                    }
                });
        }
    </script>
@endsection
