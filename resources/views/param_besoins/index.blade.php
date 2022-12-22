@php

    $breadcrumb = 'إعدادات آجال ضبط الحاجيات';
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
                <h5>قائمة آجال ضبط الحاجيات</h5>
                <div class="card-header-right">
                    {{-- @can('expense-type-create') --}}
                    <button type="button" class="btn btn-primary" href="{{ route('articles.create') }}" data-toggle="modal"
                        data-target="#add_param">
                        <i class="feather icon-plus-circle"></i> إضافة
                    </button>
                    {{-- @endcan --}}
                    {{-- @can('expense-type-delete') --}}
                    <button class="btn btn-danger " id="btn_delete" onclick='return multipleDelete("{{ $locale }}");'>
                        <i class="feather icon-trash-2"></i>
                        {{ __('inputs.btn_delete') }}
                        <i id="btn_count"></i>
                    </button>
                    {{-- @endcan --}}

                </div>

            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="param_datatable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th style="width: 30px"><input type="checkbox" class="select-checkbox" /> </th>
                            <th></th>
                            <th>السنة المالية</th>
                            <th>تاريخ البداية</th>
                            <th>تاريخ النهاية</th>
                            <th>{{ $tbl_action }}</th>
                        </thead>

                        <tfoot>
                            <tr>
                                <th style="width: 30px"><input type="checkbox" class="select-checkbox" /> </th>
                                <th></th>
                                <th>السنة المالية</th>
                                <th>تاريخ البداية</th>
                                <th>تاريخ النهاية</th>
                                <th>{{ $tbl_action }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Column Selector table end -->

    <!-- Modal Create or edit Article -->
    <div class="modal fade show" id="add_param" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
        style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"> إضافة آجال ضبط الحاجيات لسنة مالية جديدة </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_id">
                        <input type="text" name="article_id" id="parambesoins_id" value="0" hidden>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label for="annee_gestion"> السنة المالية </label>
                                    <input type="number" class="form-control" id='annee_gestion' name="annee_gestion"
                                placeholder="أدخل السنة المالية" value='{{ strftime('%Y') }}'>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">تاريخ البداية</label>

                                    <input type="datetime-local" class="form-control" id='date_debut' name="date_debut"
                                        placeholder="أدخل التاريخ">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">تاريخ النهاية</label>

                                    <input type="datetime-local" class="form-control" id='date_fin' name="date_fin"
                                        placeholder="أدخل التاريخ">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('inputs.btn_close') }}</button>
                    <button class="btn btn-primary" id='btn_add_param'> {{ __('inputs.btn_create') }}
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Create or edit Article-->
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
            var table = $('#param_datatable').DataTable({
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
                    url: "{{ route('parambesoins.data') }}"
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
                        data: "annee_gestion",
                        className: 'annee_gestion'
                    },
                    {
                        data: "date_debut",
                        className: 'date_debut'
                    },
                    {
                        data: "date_fin",
                        className: 'date_fin'
                    },
                    {
                        data: 'action',
                        className: 'action',
                        visible: 'false'
                    },
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

            addSearchFooterDataTable("#param_datatable")


        });

        // Create new case status from modal
        $('#btn_add_param').click(() => {
            let id = $('#parambesoins_id').val();
            let annee_gestion = $('#annee_gestion').val();
            let date_debut = $("input[name=date_debut]").val();
            let date_fin = $("input[name=date_fin]").val();
            var $url = "{{ route('parambesoins.store') }}"
            var $type = "POST";
            if (id != 0) {
                $url = "{{ route('parambesoins.update', ['parambesoin' => ':id']) }}"
                $url = $url.replace(':id', id);
                $type = "PUT";
            }
            $.ajax({
                url: $url,
                type: $type,
                data: {
                    annee_gestion: annee_gestion,
                    date_debut: date_debut,
                    date_fin: date_fin,
                },
                success: function(response) {
                    $('#annee_gestion').removeClass('is-invalid')
                    $('#date_debut').removeClass('is-invalid')
                    $('#date_fin').removeClass('is-invalid')

                    // refresh datatable
                    $('#param_datatable').DataTable().ajax.reload();
                    $('#add_param').modal('toggle');
                    PnotifyCustom(response)
                },
                error: function(errors) {
                    $('#annee_gestion').removeClass('is-invalid')
                    if (errors.responseJSON.message.annee_gestion != null) {
                        $('#annee_gestion').addClass('is-invalid')
                        $('#annee_gestion-error').text(errors.responseJSON.message.annee_gestion);
                    }
                    $('#date_debut').removeClass('is-invalid')
                    if (errors.responseJSON.message.date_debut != null) {
                        $('#date_debut').addClass('is-invalid')
                        $('#date_debut-error').text(errors.responseJSON.message.date_debut);
                    }
                    $('#date_fin').removeClass('is-invalid')
                    if (errors.responseJSON.message.date_fin != null) {
                        $('#date_fin').addClass('is-invalid')
                        $('#date_fin-error').text(errors.responseJSON.message.date_fin);
                    }
                }
            }); // ajax end

        })

        // OnClose Modal eventListener
        $('#add_param').on('hidden.bs.modal', function() {
            $('#annee_gestion').removeClass('is-invalid')
            $('#date_debut').removeClass('is-invalid')
            $('#date_fin').removeClass('is-invalid')
            $("#parambesoins_id").val(0)
            $("#annee_gestion").val('')
            $("#date_debut").val('')
            $("#date_fin").val('')
            var btn_title = "{{ __('inputs.btn_create') }}"
            $("#btn_add_param").html(btn_title)
            var modal_title = "إضافة آجال ضبط الحاجيات"
            $("#modal-title").html(modal_title)
        })

        function editParamBesoin(id) {
            $("input[name=parambesoins_id]").val(id)
            var btn_title = "{{ __('inputs.btn_edit') }}"
            $("#btn_add_param").html(btn_title)
            var modal_title = "تحيين آجال ضبط الحاجيات"
            $("#modal-title").html(modal_title)

            $url = "{{ route('parambesoins.edit', ['parambesoin' => ':id']) }}"
            $url = $url.replace(':id', id);
            // alert($url)
            $.ajax({
                url: $url,
                type: 'GET',
                success: function(response) {
alert(response.date_debut)
                    $("#parambesoins_id").val(response.id)
                    // Fetch the preselected item, and add to the control
                    $("input[name=annee_gestion]").val(response.annee_gestion);
                    $("input[name=date_debut]").val(response.date_debut);
                    $("input[name=date_fin]").val(response.date_fin);

                    $('#add_param').modal('show');

                },
                error: function(response) {
                    alert(JSON.stringify(response.responseJSON));
                }
            }); // ajax end


        }



        function deleteFromDataTableBtn(id) {
            //  let id = $('#tbl_btn_delete').attr('data-id');

            var url = "{{ route('parambesoins.destroy', ['parambesoin' => ':id']) }}";
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
                                deleteSingleRowDataTable("#param_datatable")
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
