@php

$breadcrumb = 'أنواع الوثائق';
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
                <h5>قائمة المواد</h5>
                <div class="card-header-right">
                    {{-- @can('expense-type-create') --}}
                    <button type="button" class="btn btn-primary" href="{{ route('articles.create') }}" data-toggle="modal"
                        data-target="#add_article">
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
                    <table id="article-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th style="width: 30px"><input type="checkbox" class="select-checkbox" /> </th>
                            <th></th>
                            <th>التسمية</th>
                            <th>الوضعية</th>
                            <th>{{ $tbl_action }}</th>
                        </thead>

                        <tfoot>
                            <tr>
                                <th style="width: 30px"><input type="checkbox" class="select-checkbox" /> </th>
                                <th></th>
                                <th>التسمية</th>
                                <th>المرحلة</th>
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
    <div class="modal fade show" id="add_article" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
        style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"> إضافة نوع وثيقة جديدة </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_id">
                        <input type="number" name="id" id="id" value="0" hidden>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">مرحلة الإنجاز </label>
                                    <select class="form-control" id="modal_type_doc" name="modal_type_doc">
                                        <option value="RECEPTION_OFFRES">وصول العروض</option>
                                        <option value="SESSION_OP">جلسات فتح الظروف</option>
                                        <option value="COM_OPTECH">جلسات الفرز</option>
                                        <option value="ENGAGEMENT">إسناد الصفقة</option>
                                        <option value="ENREGISTREMENT">تسجيل الصفقة</option>
                                        <option value="ORDRE_SERVICE"> إذن بداية الأشغال</option>
                                        <option value="RECEPTIONPROVISOIRE">القبول الوقتي</option>
                                        <option value="RECEPTIONDEFINITIVE">القبول النهائي</option>
                                        <option value="CLOTURE">التسوية النهائية</option>
                                        <option value="ANNULATION">إلغاء الصفقة</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="lbl_libelle"> إسم الوثيقة</label>
                                <input type="text" class="form-control" id='libelle' name="libelle"
                                    placeholder="إسم الوثيقة..." value="">
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
                    <button class="btn btn-primary" id='btn_add_article'> {{ __('inputs.btn_create') }}
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
                    url: "{{ route('types_docs.data') }}"
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
                        data: "type_doc",
                        className: 'type_doc'
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

            addSearchFooterDataTable("#article-table")
        });

         // Create new case status from modal
         $('#btn_add_article').click(() => {

            let libelle = $("input[name=libelle]").val();
            let type_doc = $("modal_type_doc").val();
            let id = $("#id").val();
            var $url = "{{ route('types_docs.store') }}"
            var $type = "POST";
            if (id != 0) {
                $url = "{{ route('types_docs.update', ['types_doc' => ':id']) }}"
                $url = $url.replace(':id', id);
                $type = "PUT";
            }
            $.ajax({
                url: $url,
                type: $type,
                data: {
                    libelle: libelle,
                    type_doc: type_doc,
                },
                success: function(response) {
                    $('#libelle').removeClass('is-invalid')

                    // refresh datatable
                    $('#article-table').DataTable().ajax.reload();
                    $('#add_article').modal('toggle');
                    PnotifyCustom(response)
                },
                error: function(errors) {
                    $('#libelle').removeClass('is-invalid')
                    if (errors.responseJSON.message.libelle != null) {
                        $('#libelle').addClass('is-invalid')
                        $('#libelle-error').text(errors.responseJSON.message.libelle);
                    }
                }
            }); // ajax end

        })

        // OnClose Modal eventListener
        $('#add_article').on('hidden.bs.modal', function() {
            $('#libelle').removeClass('is-invalid')

            $("#libelle").val('')
            var btn_title = "{{ __('inputs.btn_create') }}"
            $("#btn_add_article").html(btn_title)
            var modal_title = "إضافة نوع وثيقة"
            $("#modal-title").html(modal_title)
        })

        function editArticle(id) {
            $("input[name=id]").val(id)
            var btn_title = "{{ __('inputs.btn_edit') }}"
            $("#btn_add_article").html(btn_title)
            var modal_title = "تحيين توع وثيقة"
            $("#modal-title").html(modal_title)

            $url = "{{ route('types_docs.edit', ['types_doc' => ':id']) }}"
            $url = $url.replace(':id', id);
            // alert($url)
            $.ajax({
                url: $url,
                type: 'GET',
                success: function(response) {
                    $("input[name=libelle]").val(response.libelle);
                    $("#id").val(response.id)
                    $("#modal_type_doc").val(response.type_doc)
                    $('#add_article').modal('show');

                },
                error: function(response) {
                    alert(JSON.stringify(response.responseJSON));
                }
            }); // ajax end


        }




        function deleteFromDataTableBtn(id) {
            //  let id = $('#tbl_btn_delete').attr('data-id');

            var url = "{{ route('types_docs.destroy', ['type_doc' => ':id']) }}";
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
                                deleteSingleRowDataTable("#article-table")
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


        function multipleDelete(locale) {
            var table = $('#article-table').DataTable();
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
                                deleteSingleRowDataTable("#article-table")
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
