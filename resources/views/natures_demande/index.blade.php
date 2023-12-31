@php

$breadcrumb = 'طبيعة وأنواع الطلبات';
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
                <h5>قائمة أنواع الطلبات</h5>
                <div class="card-header-right">
                    {{-- @can('expense-type-create') --}}
                        <button type="button" class="btn btn-primary" href="{{ route('natures-demande.create') }}"
                            data-toggle="modal" data-target="#add_expense_type">
                            <i class="feather icon-plus-circle"></i> إضافة
                        </button>
                    {{-- @endcan --}}
                </div>

            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="natures-demande-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th style="width: 30px"><input type="checkbox" class="select-checkbox" /> </th>
                            <th>id</th>
                            <th>نوع الطلب</th>
                            <th>طبيعة الطلب</th>
                            <th>{{ $tbl_action }}</th>
                        </thead>

                        <tfoot>
                            <tr>
                                <th style="width: 30px"></th>
                                <th>id</th>
                                <th>نوع الطلب</th>
                                <th>طبيعة الطلب</th>
                                <th>{{ $tbl_action }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Column Selector table end -->

    <!-- Modal Create or edit Expense Type -->
    <div class="modal fade show" id="add_expense_type" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
        style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"> إضافة نوع طلب </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="number" id="natures_demande_id" name="natures_demande_id" hidden value="0">

                    <div class="form-group">
                        <label for="lbl_libelle"> نوع الطلب</label>
                        <input type="text" class="form-control" id='libelle' name="libelle"
                            placeholder="نوع الطلب " value="">
                        <label id="libelle-error" class="error jquery-validation-error small form-text invalid-feedback"
                            for="libelle"></label>

                    </div>
                    <div class="form-group">
                        <label for="lbl_libelle"> طبيعةالطلب</label>
                        <select class="form-control" id="type">
                            <option value="1">مواد وخدمات</option>
                            <option value="2">أشغال</option>
                            <option value="3">دراسات</option>
                        </select>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ __('inputs.btn_close') }}</button>
                        <button type="submit" class="btn btn-primary" id='btn_add_nature_demande'>
                            {{ __('inputs.btn_create') }} </button>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- Modal Create or edit Expense Type-->


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
            var table = $('#natures-demande-table').DataTable({
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
                    url: "{{ route('natures-demande.data') }}"
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
                        className: 'libelle'
                    },
                    {
                        data: "type",
                        className: 'type'
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

            addSearchFooterDataTable("#natures-demande-table")
        });

        // Create new Expense Type from modal
        $('#btn_add_nature_demande').click(() => {
            $('#libelle').removeClass('is-invalid')
            let libelle = $("input[name=libelle]").val();
            let type = $("#type").val();
            let id = $("#natures_demande_id").val()
            var $url = "{{ route('natures-demande.store') }}"
            var $type = "POST";
            if (id != 0) {
                $url = "{{ route('natures-demande.update', ['natures_demande' => ':id']) }}"
                $url = $url.replace(':id', id);
                $type = "PUT";
            }
            $.ajax({
                url: $url,
                type: $type,
                data: {
                    libelle: libelle,
                    type : type
                },
                success: function(response) {
                    console.log(response)
                    //alert(JSON.stringify(response))
                    // refresh data or remove only tr
                    $('#natures-demande-table').DataTable().ajax.reload();
                    $('#add_expense_type').modal('toggle');
                    PnotifyCustom(response)
                },
                error: function(response) {
                    // alert(JSON.stringify(errors.responseJSON.message))
                    $('#libelle').removeClass('is-invalid')
                    if (response.responseJSON.message.libelle != null) {
                        $('#libelle').addClass('is-invalid')
                        $('#libelle-error').text(response.responseJSON.message.libelle);
                    }

                }
            }); // ajax end

        })

        // OnClose Modal eventListener
        $('#add_expense_type').on('hidden.bs.modal', function() {
            $('#libelle').removeClass('is-invalid')
            $("#natures_demande_id").val(0)
            $("#libelle").val('')
            var btn_title = "{{ __('inputs.btn_create') }}"
            $("#btn_add_nature_demande").html(btn_title)
            var modal_title = "إضافة نوع الطلب"
            $("#modal-title").html(modal_title)
        })

        function editExpenseType(id) {
            $("input[name=natures_demande_id]").val(id)
            var btn_title = "{{ __('inputs.btn_edit') }}"
            $("#btn_add_nature_demande").html(btn_title)
            var modal_title = "تحيين نوع الطلب"
            $("#modal-title").html(modal_title)

            $url = "{{ route('natures-demande.edit', ['natures_demande' => ':id']) }}"
            $url = $url.replace(':id', id);
            // alert($url)
            $.ajax({
                url: $url,
                type: 'GET',
                success: function(response) {
                    $("input[name=libelle]").val(response.libelle);
                    $("#natures_demande_id").val(response.id)
                    $('#add_expense_type').modal('show');


                },
                error: function(response) {
                    alert(JSON.stringify(response.responseJSON));
                }
            }); // ajax end


        }


        function deleteFromDataTableBtn(id) {
            //  let id = $('#tbl_btn_delete').attr('data-id');

            var url = "{{ route('natures-demande.destroy', ['natures_demande' => ':id']) }}";
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
                                deleteSingleRowDataTable("#natures-demande-table")
                                PnotifyCustom(response)


                            }
                        }); // ajax end

                    }
                });
        }

        function multipleDelete(locale) {
            var table = $('#natures-demande-table').DataTable();
            var ids = table.rows('.selected').data();
            if (ids.length <= 0) {
                swal("{{ __('labels.swal_warning_title') }}", "{{ __('labels.swal_delete_users_warning_text') }}",
                    "warning");
                return;
            } else {
                if (locale == 'ar') {
                    var stack_top_left = {
                        "dir1": "down",
                        "dir2": "right",
                        "push": "top"
                    };
                    var PnClass = "stack-top-left bg-primary";
                } else {
                    var stack_top_left = {
                        "dir1": "down",
                        "dir2": "left",
                        "push": "top"
                    };
                    var PnClass = "bg-primary";
                }
                // Progress loader
                var cur_value = 1,
                    valuePB = 1,
                    progress;
                var idsArr = [];
                // Make a loader.
                var loader = new PNotify({
                    title: "{{ __('labels.pnotify_title') }}",
                    text: '<div class="progress progress-striped active" style="margin:0">\
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0">\
                            <span class="sr-only">0%</span>\
                            </div>\
                            </div>',
                    addclass: PnClass,
                    stack: stack_top_left,
                    icon: 'icon-spinner4 spinner',
                    hide: false,
                    buttons: {
                        closer: false,
                        sticker: false
                    },
                    history: {
                        history: false
                    },
                    before_open: function(PNotify) {
                        progress = PNotify.get().find("div.progress-bar");
                        progress.width(cur_value + "%").attr("aria-valuenow", cur_value).find("span").html(
                            cur_value + "%");
                        // Pretend to do something.
                        ids.each((el) => {
                            console.log('ids : ' + el.id)
                            idsArr.push(el.id);
                        })
                        //idsArr.join(",")
                        //console.log("id arr : " +idsArr)
                        $.ajax({
                            type: 'DELETE',
                            dataType: 'JSON',
                            url: "{{ route('natures-demandes-datatable.multidestroy') }}",
                            data: {
                                ids: idsArr,
                            },
                            success: function(response) {
                                // refresh data or remove only tr
                                deleteSingleRowDataTable("#natures-demande-table")
                                $("#btn_count").html('')
                                //console.log('id : '+ el.id, cur_value, ids.length)
                                PnotifyCustom(response)
                            },
                            error: function(error) {
                                alert(JSON.stringify(error))
                            }
                        });
                        var timer = setInterval(function() {
                            if (valuePB >= 100) {

                                // Remove the interval.
                                window.clearInterval(timer);
                                loader.remove();
                                return;
                            }
                            valuePB = ((cur_value + 1) / ids.length) * 100;
                            cur_value += 1;
                            progress.width(Math.round(valuePB) + "%").attr("aria-valuenow", Math.round(
                                    valuePB))
                                .find("span")
                                .html(Math.round(valuePB) + "%");
                        }, 65);
                    }
                });

                return;
            }


        }
    </script>
@endsection
