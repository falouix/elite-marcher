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
                            <th>جهة الإتصال</th>
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
    <!-- Modal create or update soumissionnaire -->
    <div class="modal fade show" id="add_soumissionnaire" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-modal="true" style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-header"> إضافة متعهد جديد </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id='form_id' name='form_id'>
                        <input type="hidden" name="id" id="id" value="0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="libelle">الاسم</label>
                                    <input type="text" class="form-control" id='libelle' name="libelle"
                                        placeholder="أدخل الاسم" value=''>
                                    <span class="text-danger error-text libelle_err"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">المعرف الجبائي</label>
                                    <input type="text" class="form-control" id='matricule_fiscale'
                                        name="matricule_fiscale" placeholder=" أدخل المعرف الجبائي " value=''>
                                    <span class="text-danger error-text  matricule_fiscale_err"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">العنوان</label>
                                    <input type="text" class="form-control" id='adresse' name="adresse"
                                        placeholder="أدخل العنوان" value=''>
                                    <span class="text-danger error-text adresse_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">المدينة</label>
                                    <input type="text" class="form-control" id='ville' name="ville"
                                        placeholder=" أدخل المدينة" value=''>
                                    <span class="text-danger error-text ville_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">الترقيم البريدي</label>
                                    <input type="number" class="form-control" id='code_postal' name="code_postal"
                                        placeholder="أدخل الترقيم البريدي" value=''>
                                    <span class="text-danger error-text code_postal_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">الهاتف</label>
                                    <input type="number" class="form-control" id='tel' name="tel"
                                        placeholder="أدخل الهاتف " value=''>
                                    <span class="text-danger error-text tel_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">الفاكس</label>
                                    <input type="number" class="form-control" id='tel_fax' name="tel_fax"
                                        placeholder=" أدخل الفاكس " value=''>
                                    <span class="text-danger error-text tel_fax_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">العنوان الإلكتروني</label>
                                    <input type="email" class="form-control" id='email' name="email"
                                        placeholder="أدخل العنوان الإلكتروني" value=''>
                                    <span class="text-danger error-text email_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">جهة الإتصال</label>
                                    <input type="text" class="form-control" id='contact' name="contact"
                                        placeholder=" أدخل جهة الإتصال " value=''>
                                    <span class="text-danger error-text contact_err"></span>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> إغلاق</button>
                            <button type="submit" class="btn btn-primary" id='saveBtn'> إضافة </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal create or update soumissionnaire end-->
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

        function createCustomerAccount(id) {

            swal({
                    title: "{{ __('labels.swal_create_account') }}",
                    text: "{{ __('labels.swal_create_account_info_text') }}",
                    icon: "info",
                    buttons: ["{{ __('labels.swal_cancel_btn') }}", "{{ __('labels.swal_create_account_btn') }}"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "{{ route('clients.createAccount') }}",
                            type: 'POST',
                            data: {
                                clients_id: id
                            },
                            success: function(response) {
                                // console.log(response)
                                $('#soumissionnaire-table').DataTable().ajax.reload();
                                PnotifyCustom(response)
                            }
                        }); // ajax end

                    }
                });

        }

        function suspendCustomerAccount(id) {
            swal({
                    title: "{{ __('labels.swal_suspend_account') }}",
                    text: "{{ __('labels.swal_suspend_account_info_text') }}",
                    icon: "info",
                    buttons: ["{{ __('labels.swal_cancel_btn') }}", "{{ __('labels.swal_suspend_account_btn') }}"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "{{ route('clients.suspendAccount') }}",
                            type: 'POST',
                            data: {
                                clients_id: id
                            },
                            success: function(response) {
                                // console.log(response)
                                $('#soumissionnaire-table').DataTable().ajax.reload();
                                PnotifyCustom(response)
                            }
                        }); // ajax end

                    }
                });

        }
    </script>
@endsection
