@php
//dd($userService);
if ($locale == 'ar') {
    $lang = asset('/plugins/i18n/Arabic.json');
    $rtl = 'rtl';
} else {
    $lang = '';
}

$breadcrumb = 'تحديد الحاجيات';
$sub_breadcrumb = 'المصادقة على الحاجيات';
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
    <style>
        .qte_valide, .cout_unite_ttc {
            background-color: lightgoldenrodyellow;
        }

        <style>.my-input-class {
            padding: 3px 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .my-confirm-class {
            padding: 3px 6px;
            font-size: 12px;
            color: white;
            text-align: center;
            vertical-align: middle;
            border-radius: 4px;
            background-color: #337ab7;
            text-decoration: none;
        }
        .my-cancel-class {
            padding: 3px 6px;
            font-size: 12px;
            color: white;
            text-align: center;
            vertical-align: middle;
            border-radius: 4px;
            background-color: #a94442;
            text-decoration: none;
        }
        .error {
            border: solid 1px;
            border-color: #a94442;
        }
        .destroy-button {
            padding: 5px 10px 5px 10px;
            border: 1px blue solid;
            background-color: lightgray;
        }
    </style>
@endsection


@section('breadcrumb')
    @include('layouts.partials.breadcrumb', [
        'bread_title' => $breadcrumb,
        'bread_subtitle' => $sub_breadcrumb,
    ])
@endsection

@section('content')
    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $sub_breadcrumb }}</h5>
                <div class="card-header-right">
                    <a href="{{ route('besoins-validation.index') }}" class="btn btn-secondary">
                        العودة لضبط الحاجيات
                        <i class="feather icon-corner-down-left"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>{{ __('validation.v_title') }}</strong><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                @endif
                <!-- [ Form Validation ] start -->
                {{-- Case Other Parties --}}

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> المصلحة/الدائرة/المؤسسة </label>
                            <input type="text" class="form-control" value="{{ $userService->libelle }}" readonly>
                            <input type="hidden" name="services_id" value="{{ $userService->id }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_besoin"> التاريخ </label>
                            <input type="date" class="form-control" id='date_besoin' name="date_besoin"
                                placeholder="أدخل التاريخ" value="{{ $besoin->date_besoin }}" readonly>
                            @if ($errors->has('date_besoin'))
                                <span class="text-danger">{{ $errors->first('date_besoin') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="annee_gestion"> السنة المالية </label>
                            <input type="number" class="form-control" id='annee_gestion' name="annee_gestion"
                                placeholder="أدخل السنة المالية" value='{{ $besoin->annee_gestion }}' readonly>
                            {{-- @if ($errors->has('annee_gestion'))
                                        <span class="text-danger">{{ $errors->first('annee_gestion') }}</span>
                                    @endif --}}
                        </div>
                    </div>
                </div>
                {{-- Contact from company  start --}}


                <div class="col-md-12">
                    <div class="dt-responsive table-responsive">
                        <h6 style="color: red; text-align: left;">الكلفة الجمليةالتقديرية للحاجيات : <span
                            id="coutTotal"> </span></h6>
                        <table id="table-cp" class="table table-striped table-bordered nowrap">
                            <thead>
                                <th class="not-export-col">id</th>
                                <th>المادة</th>
                                <th>طبيعة الطلب</th>
                                <th>نوع الطلب</th>
                                <th>الكمية المطلوبة</th>
                                <th>الكمية المصادقة</th>
                                <th>الكلفة التقديرية للوحدة</th>
                                <th>الكلفة التقديرية الجملية</th>
                                <th>الملاحظات</th>
                                <th class="not-export-col">الملف/الوثيقة</th>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th class="not-export-col">id</th>
                                    <th>المادة</th>
                                    <th>طبيعة الطلب</th>
                                    <th>نوع الطلب</th>
                                    <th>الكمية المطلوبة</th>
                                    <th>الكمية المصادقة</th>
                                    <th>الكلفة التقديرية للوحدة</th>
                                    <th>الكلفة التقديرية الجملية</th>
                                    <th>الملاحظات</th>
                                    <th class="not-export-col">الملف/الوثيقة</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
                {{-- Contact from company  end --}}


                <div class="row mt-4">
                    <a href="{{ route('besoins-validation.index') }}" id="btn_create" class="btn btn-primary"
                        style="float: right;">
                        <i class="feather icon-client-plus"></i>
                        العودة لقائمة الحاجيات
                    </a>
                </div>
                <!-- [ Form Validation ] end -->

            </div>
        </div>
    </div>
@endsection
@section('srcipt-js')
    <!-- jquery-validation Js -->
    <script src="{{ asset('/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/plugins/inputmask/js/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('/plugins/inputmask/js/autoNumeric.js') }}"></script>
    <!-- datatable Js -->
    <script src="{{ asset('/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/dataTables.select.min.js') }}"></script>
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- pnotify Js -->
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
    <!-- form-select-custom Js -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/pdfmake.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/dataTables.cellEdit.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/sum().js') }}"></script>`


    <script>
        'use strict';

        $(document).ready(function() {
            $(function() {
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
                    paging: false,
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
                        url: "{{ route('ligne_besoin.datatable') }}",
                        data: function(data) {
                            data.besoins_id = "{{ $besoin->id }}";
                            data.mode = "all";
                        },
                    },
                    language: {
                        url: "{{ $lang }}"
                    },

                    columns: [{
                            data: "id",
                            className: "id",
                        },
                        {
                            data: "libelle",
                            className: "libelle"
                        },
                        {
                            data: "type_demande",
                            className: "type_demande"
                        },
                        {
                            data: "nature_demandes_id",
                            className: "nature_demandes_id"
                        },
                        {
                            data: "qte_demande",
                            className: "qte_demande"
                        },
                        {
                            data: "qte_valide",
                            className: "qte_valide"
                        },
                        {
                            data: "cout_unite_ttc",
                            className: "cout_unite_ttc"
                        },
                        {
                            data: "cout_total_ttc",
                            className: "cout_total_ttc"
                        },
                        {
                            data: 'description',
                            className: 'description',
                        },
                        {
                            data: 'action_file',
                            className: 'action_file',
                            visible: 'false'
                        },

                    ],
                    columnDefs: [{
                        visible: false,
                        targets: 0
                    }],
                    drawCallback: function() {
                        var api = this.api();
                        $('#coutTotal').html(
                            api.column(7, {
                                page: 'current'
                            }).data().sum()
                        )
                    },
                    // select: { style: 'multi+shift' },
                });


                table.on('click', 'tr', function(e, dt, type, indexes) {

                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                    } else {
                        table.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                    }
                });
                $('.dataTables_length').addClass('bs-select');
                // Setup - add a text input to each footer cell
                addSearchFooterDataTable("#table-cp")

                $("#natures_demande").select2({
                    dir: "{{ $rtl }}",
                    // minimumInputLength: 3, // only start searching when the user has input 3 or more characters
                    placeholder: "{{ __('labels.choose') }} ",
                    ajax: {
                        url: "{{ route('natures-demande.select') }}",
                        type: "post",
                        delay: 250,
                        dataType: 'json',
                        data: {
                            type: $('#type_demande').val()
                        },
                    },
                    processResults: function(response) {
                        // alert(JSON.stringify(response))
                        return {
                            results: response
                        };
                    },
                    cache: true

                });
                let besoins_valider = "{{ $besoin->valider }}"

                if (besoins_valider != 1) {
                    table.MakeCellsEditable({
                        "onValidate": validationCallbackFunction,
                        "onUpdate": updateCallbackFunction,

                        "inputCss": 'my-input-class',
                        "columns": [5, 6],
                        "allowNulls": {
                            "columns": [5, 6],
                            "errorClass": 'error'

                        },
                        "confirmationButton": {
                            "confirmCss": 'my-confirm-class',
                            "cancelCss": 'my-cancel-class'
                        },
                        "inputTypes": [{
                                "column": 5,
                                "type": "number",
                                "options": null
                            },
                            {
                                "column": 6,
                                "type": "number",
                                "options": null
                            },
                        ]
                    });
                }


            });

        });

        function updateCallbackFunction(updatedCell, updatedRow, oldValue) {
           // console.log("The new value for the cell is: " + updatedCell.data());
           // console.log("The values for each cell in that row are: " + JSON.stringify(updatedRow.data()));
            //ajax call to update lignebesoin by id
            $.ajax({
                url: "{{ route('lignes_besoin_v.update') }}",
                type: "PUT",
                data: {
                    id: updatedRow.data().id,
                    qte_valide: updatedRow.data().qte_valide,
                    cout_unite_ttc: updatedRow.data().cout_unite_ttc,
                },
                success: function(response) {
                    $('#table-cp').DataTable().ajax.reload();
                    PnotifyCustom(response)
                }
            })


        }

        function validationCallbackFunction(cell, row, newValue, cellName) {
            switch (cellName) {
                case ' qte_valide':
                    if (newValue < 0) {
                        swal("{{ __('labels.swal_warning_title') }}", 'الرجاء التثبت من الكمية المصادق عليها',
                            "warning");
                        return false;
                    }
                    if (newValue > row.data().qte_demande) {
                        swal("{{ __('labels.swal_warning_title') }}", 'الكمية المصادق عليها لا يكمن ان تتجاوز : ' + row
                            .data()
                            .qte_demande,
                            "warning");
                        return false;
                    }
                    break;

                case ' cout_unite_ttc':
                //console.log("On Validation; The old value for the cell [cout_unit_ttc] is: " + row.data().cout_unite_ttc);
                //console.log("On Validation; The new value for the cell [cout_unit_ttc] is: " + newValue);
                    if (newValue < 0) {
                        swal("{{ __('labels.swal_warning_title') }}",
                            'الرجاء التثبت من الكلفة التقديرية للوحدة المصادق عليها',
                            "warning");
                        return false;
                    }
                    if ((row.data().cout_unite_ttc != 0)) {
                        if(newValue > row.data().cout_unite_ttc){
                            swal("{{ __('labels.swal_warning_title') }}",
                            'الكلفة التقديرية للوحدة المصادق عليها لا يكمن ان تتجاوز : ' + row
                            .data()
                            .cout_unite_ttc,
                            "warning");
                        return false;
                        }
                    }
                    break;
            }

            //ajax call to update lignebesoin by id
            //console.log("Validation; The values for each cell in that row are: " + JSON.stringify(row.data()));
            return true;

        }

        $('#type_demande').on('change', function(e) {
            var type = e.target.value;
            $.ajax({
                url: "{{ route('natures-demande.select') }}",
                type: "POST",

                data: {
                    type: type
                },
                success: function(data) {
                    $('#natures_demande').empty();
                    $('#natures_demande').append('<option value="NULL">إختر من القائمة</option>');
                    $.each(data.results, function(index, naturdemande) {
                        $('#natures_demande').append('<option value="' + naturdemande.id +
                            '">' +
                            naturdemande.text + '</option>');
                    })
                    $('#natures_demande').select2({
                        dir: "{{ $rtl }}",
                    });
                }
            })
        });




        function editLigneBesoin(id) {
            $.ajax({
                url: "{{ route('ligne_besoins.edit') }}",
                type: 'GET',
                data: {
                    id: id,
                },
                success: function(response) {
                    // alert(JSON.stringify(response))
                    $("#lignebesoin_id").val(response.id);
                    $("input[name=libelle]").val(response.libelle)
                    $("input[name=description]").val(response.description)
                    $("input[name=qte_demande]").val(response.qte_demande)
                    $("input[name=cout_unite_ttc]").val(response.cout_unite_ttc)
                    $("input[name=cout_total_ttc]").val(response.cout_total_ttc)
                    // Set selected
                    $('#natures_demande').val(response.nature_demandes_id);
                    $('#natures_demande').select2().trigger('change');
                    $("#type_demande").val(response.type_demande)
                    if (response.document) {
                        $("input[name=file_name]").val(response.document.libelle);
                    }
                    $('#add').html("تحيين الجدول")
                },
                error: function(errors) {
                    $('#add').html("{{ __('inputs.btn_add_row_cp') }}")

                    swal("{{ __('labels.swal_warning_title') }}", errors.responseJSON.message,
                        "warning");
                }
            }); // ajax end
        }

        // Delete contact_cp
        function deleteFromDataTableLigneBesoinBtn(id) {
            //  let id = $('#tbl_btn_delete').attr('data-id');
            var url = "{{ route('ligne_besoins_datatable.destroy') }}";
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
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                console.log(response)
                                //alert(JSON.stringify(response))
                                // refresh data or remove only tr
                                $('#table-cp').DataTable().ajax.reload();
                                PnotifyCustom(response)
                            }
                        }); // ajax end
                    }
                });
        }
    </script>
@endsection
