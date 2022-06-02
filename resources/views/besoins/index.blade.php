@php

$breadcrumb = __('breadcrumb.bread_besoins_list');
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
    'bread_title'=> $breadcrumb,
    'bread_subtitle'=> $breadcrumb
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
                <h5>{{ __('cards.besoins_list') }}</h5>
                <div class="card-header-right">
                    @can('case-delete')
                        <button class="btn btn-danger " id="btn_delete" onclick='return multipleDelete("{{ $locale }}");'>
                            <i class="feather icon-trash-2"></i>
                            {{ __('inputs.btn_delete') }}
                            <i id="btn_count"></i>
                        </button>
                    @endcan
                    @can('case-type-create')
                        <button type="button" class="btn btn-primary" href="{{ route('besoins.create') }}" data-toggle="modal"
                            data-target="#add_besoin">
                            <i class="feather icon-plus-circle"></i> {{ __('inputs.btn_create') }}
                        </button>
                    @endcan
                </div>

            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="besoins-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th class="not-export-col" style="width: 30px"><input type="checkbox" class="select-checkbox" /> </th>
                            <th>id</th>
                            <th>التاريخ</th>
                            <th>السنة المالية</th>
                            <th class="not-export-col">{{ $tbl_action }}</th>
                        </thead>

                        <tfoot>
                            <tr>
                                <th class="not-export-col" style="width: 30px"></th>
                                <th class="not-export-col">id</th>
                                <th>التاريخ</th>
                                <th>السنة المالية</th>
                                <th class="not-export-col">{{ $tbl_action }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Column Selector table end -->

    <!-- Modal Create or edit status -->
    <div class="modal fade show" id="add_besoin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
        style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"> {{ __('inputs.btn_create_besoin') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_id">
                        <input type="text" name="besoin_id" id="besoin_id" value="0" hidden>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="lbl_besoin_num"> {{ __('labels.tbl_besoin_type') }} </label>
                                <select name="besoin_type" id="besoin_type" class="form-control">
                                    <option value="0">{{ __('labels.besoin_type') }}</option>
                                    <option value="1">{{ __('labels.circle_type') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lbl_besoin_num"> {{ __('labels.tbl_besoin_num') }} </label>
                                <input type="text" class="form-control" id='besoin_num' name="besoin_num"
                                    placeholder="{{ __('labels.tbl_besoin_num') }}" value="">
                                <label id="besoin_num-error"
                                    class="error jquery-validation-error small form-text invalid-feedback"
                                    for="besoin_num"></label>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="lbl_libelle"> {{ __('labels.tbl_libelle') }} </label>
                                <input type="text" class="form-control" id='libelle' name="libelle"
                                    placeholder="{{ __('labels.tbl_libelle') }}" value="">
                                <label id="libelle-error"
                                    class="error jquery-validation-error small form-text invalid-feedback"
                                    for="libelle"></label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('inputs.btn_close') }}</button>
                    <button  class="btn btn-primary" id='btn_add_besoin'> {{ __('inputs.btn_create') }}
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
            var table = $('#besoins-table').DataTable({
                dom: 'frltipB',
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "{{ __('labels.all')}}"]],
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
                    url: "{{ route('besoin.datatable') }}"
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
                        data: "date_besoin",
                        className: "date_besoin"
                    },
                    {
                        data: "annee_gestion",
                        className: "annee_gestion"
                    },
                    {
                        data: "created_at",
                        className: 'created_at'
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

            addSearchFooterDataTable("#besoins-table")
        });
        // Create new case status from modal
        $('#btn_add_besoin').click(() => {
            let besoin_type = $('#besoin_type').val();
            let besoin_num = $("input[name=besoin_num]").val();
            let libelle = $("input[name=libelle]").val();
            let id = $("input[name=besoin_id]").val();
            var $url = "{{ route('besoins.store') }}"
            var $type = "POST";
            if (id != 0) {
                $url = "{{ route('besoins.update', ['besoin' => ':id']) }}"
                $url = $url.replace(':id', id);
                $type = "PUT";
            }
            $.ajax({
                url: $url,
                type: $type,
                data: {
                    besoin_num: besoin_num,
                    libelle: libelle,
                    besoin_type: besoin_type,
                },
                success: function(response) {
                    $('#libelle').removeClass('is-invalid')
                    $('#besoin_num').removeClass('is-invalid')
                    // refresh datatable
                    $('#besoins-table').DataTable().ajax.reload();
                    $('#add_besoin').modal('toggle');
                    PnotifyCustom(response)
                },
                error: function(errors) {
                    $('#libelle').removeClass('is-invalid')
                    if (errors.responseJSON.message.libelle != null) {
                        $('#libelle').addClass('is-invalid')
                        $('#libelle-error').text(errors.responseJSON.message.libelle);
                    }
                    $('#besoin_num').removeClass('is-invalid')
                    if (errors.responseJSON.message.besoin_num != null) {
                        $('#besoin_num').addClass('is-invalid')
                        $('#besoin_num-error').text(errors.responseJSON.message.besoin_num);
                    }
                }
            }); // ajax end

        })
        // OnClose Modal eventListener
        $('#add_besoin').on('hidden.bs.modal', function() {
            $("#form_id")[0].reset()
            var btn_title = "{{ __('inputs.btn_create') }}"
            $("#btn_add_besoin").html(btn_title)
            var modal_title = "{{ __('inputs.btn_create_besoin') }}"
            $("#modal-title").html(modal_title)
        })

        function editbesoin(id) {
            $("input[name=besoin_id]").val(id)
            $url = "{{ route('besoins.edit', ['besoin' => ':id']) }}"
            $url = $url.replace(':id', id);
            // alert($url)
            $.ajax({
                url: $url,
                type: 'GET',
                success: function(response) {
                    var btn_title = "{{ __('inputs.btn_edit') }}"
                    $("#btn_add_besoin").html(btn_title)
                    var modal_title = "{{ __('inputs.btn_edit_besoin') }}"
                    $("#modal-title").html(modal_title)

                    $("input[name=besoin_num]").val(response.besoin_num);
                    $("input[name=libelle]").val(response.libelle);
                    $("#besoin_type").val(response.besoin_type);
                    $('#add_besoin').modal('show');
                },
                error: function(response) {
                    alert(response.responseJSON.message)
                }
            }); // ajax end
        }

        function deleteFromDataTableBtn(id) {
            //  let id = $('#tbl_btn_delete').attr('data-id');

            var url = "{{ route('besoins.destroy', ['besoin' => ':id']) }}";
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
                                deleteSingleRowDataTable("#besoins-table")
                                PnotifyCustom(response)


                            }
                        }); // ajax end

                    }
                });
        }


         function multipleDelete(locale) {
            var table = $('#besoins-table').DataTable();
            var ids = table.rows('.selected').data();
            var url = "{{ route('besoins_datatable.multidestroy') }}";
            multipleDeleteG(locale, "#besoins-table", ids, url);
        }

    </script>
@endsection
