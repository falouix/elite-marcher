@php
//dd($userService);
if ($locale == 'ar') {
    $lang = asset('/plugins/i18n/Arabic.json');
} else {
    $lang = '';
}

$breadcrumb = "ضبط الحاجيات";
$sub_breadcrumb = "المصادقة على الحاجيات الحاجيات";
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
    'bread_subtitle'=> $sub_breadcrumb
    ])
@endsection

@section('content')
    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $sub_breadcrumb }}</h5>
                <div class="card-header-right">
                    <a href="{{ route('besoins.index') }}" class="btn btn-secondary">
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
                        {!! Form::open(['route' =>  ['besoins.update', $besoin->id], 'method' => 'patch',
                        'files' => 'true','enctype'=>'multipart/form-data',
                        'id' => 'validation-client_form']) !!}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label> المصلحة/الدائرة/المؤسسة </label>
                                   <input type="text" class="form-control" value="{{$userService->libelle}}" readonly>
                                   <input type="hidden" name="services_id" value="{{ $userService->id }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_besoin"> التاريخ </label>
                                    <input type="date" class="form-control" id='date_besoin' name="date_besoin"
                                        placeholder="أدخل التاريخ" value="{{ $besoin->date_besoin}}">
                                    @if ($errors->has('date_besoin'))
                                        <span class="text-danger">{{ $errors->first('date_besoin') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
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
                        <button type="submit" id="btn_submit" class="btn btn-primary" style="float: right;" hidden>
                        </button>
                        {!! Form::close() !!}
                        {{-- Contact from company  start --}}
                        <form id="cp_form" action="#">
                            <input type="hidden" name="lignebesoin_id" id="lignebesoin_id" value="0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h3 class="form-label"> الحاجيات</h3>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            class="form-label">المادة (التسمية)</label>
                                        <input type="text" class="form-control" name="libelle"
                                            placeholder="المادة..."
                                            value="{{ old('libelle') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">الكمية المطلوية</label>
                                        <input type="number" class="form-control" name="qte_demande"
                                            placeholder="الكمية..."
                                            value="{{ old('qte_demande') }}" onchange="calculTotal()" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" style="color: red">الكمية المصادق عليها</label>
                                        <input type="number" class="form-control" name="qte_valide"
                                            placeholder="الكمية..."
                                            value="{{ old('qte_valide') }}" onchange="calculTotal()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">الكلفة التقديرية للوحدة</label>
                                        <input type="number" class="form-control" name="cout_unite_ttc"
                                            placeholder="كلفة الوحدة..."
                                            value="{{ old('cout_unite_ttc')  }}" onchange="calculTotal()"  readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">الكلفة التقديرية الجملية</label>
                                        <input type="number" class="form-control" name="cout_total_ttc"
                                            placeholder="الكلفة التقديرية الجملية..."
                                            value="0" readonly>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    @if($besoin->valider == false)
                                    <a href="javascript:void(0);" class="btn btn-rounded btn-info" id='add'
                                        for-table='#table-cp'>
                                        <i class="feather icon-plus"></i>
                                        إضافة إلى الجدول
                                    </a>
                                    @endif

                                    <div class="dt-responsive table-responsive">
                                        <h6 style="color: red; text-align: left;">الكلفة الجمليةالتقديرية للحاجيات : <span id="coutTotal"> </span></h6>

                                            <table id="table-cp" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <th class="not-export-col" style="width: 30px"><input type="checkbox" class="select-checkbox not-export-col" /> </th>
                                                <th class="not-export-col">id</th>
                                                <th>المادة</th>
                                                <th>الكمية المطلوبة</th>
                                                <th>الكمية المصادقة</th>
                                                <th>الكلفة التقديرية للوحدة</th>
                                                <th>الكلفة التقديرية الجملية</th>
                                                <th class="not-export-col">{{ $tbl_action }}</th>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th class="not-export-col" style="width: 30px"><input type="checkbox" class="select-checkbox not-export-col" /> </th>
                                                    <th class="not-export-col">id</th>
                                                    <th>المادة</th>
                                                    <th>الكمية المطلوبة</th>
                                                    <th>الكمية المصادقة</th>
                                                    <th>الكلفة التقديرية للوحدة</th>
                                                    <th>الكلفة التقديرية الجملية</th>
                                                    <th class="not-export-col">{{ $tbl_action }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- Contact from company  end --}}


                <div class="row mt-4">
                    @if($besoin->valider == false)
                    <button type="button" id="btn_create" class="btn btn-primary" style="float: right;">
                        <i class="feather icon-client-plus"></i>
                        {{ __('inputs.btn_edit') }}
                    </button>
                    @endif
                    <a href="{{ route('besoins.index') }}" class="btn btn-danger" style="float: left;">
                        <i class="feather icon-minus-circle"></i>
                        {{ __('inputs.btn_cancel') }}
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

    <script>
        'use strict';
        $(document).ready(function() {
            $(function() {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                // [ Initialize client-form validation ]
                $('#validation-client_form').validate({
                    ignore: '.ignore, .select2-input',
                    focusInvalid: false,
                    rules: {
                        'full_name': {
                            required: true,
                        },
                        'cp_registration': {
                            required: true,
                        },

                        'email': {
                            required: true,
                            email: true
                        },
                        'cp_contact_email': {
                            required: false,
                            email: true
                        },
                        'pr_mail': {
                            required: true,
                            email: true
                        },
                        'pr_name': {
                            required: true,
                        },

                    },

                    // Errors //

                    errorPlacement: function errorPlacement(error, element) {
                        var $parent = $(element).parents('.form-group');

                        // Do not duplicate errors
                        if ($parent.find('.jquery-validation-error').length) {
                            return;
                        }

                        $parent.append(
                            error.addClass(
                                'jquery-validation-error small form-text invalid-feedback')
                        );
                    },
                    highlight: function(element) {
                        var $el = $(element);
                        var $parent = $el.parents('.form-group');

                        $el.addClass('is-invalid');

                        // Select2 and Tagsinput
                        if ($el.hasClass('select2-hidden-accessible') || $el.attr(
                                'data-role') === 'tagsinput') {
                            $el.parent().addClass('is-invalid');
                        }
                    },
                    unhighlight: function(element) {
                        $(element).parents('.form-group').find('.is-invalid').removeClass(
                            'is-invalid');
                    }
                });
                // [ Initialize client-form validation ]
                $('#cp_form').validate({
                    ignore: '.ignore, .select2-input',
                    focusInvalid: false,
                    rules: {
                        'libelle': {
                            required: true,
                        },
                        'qte_demande': {
                            required: true,
                        },
                        'qte_valide': {
                            required: true,
                        },
                        'cout_unite_ttc': {
                            required: true,
                        },
                    },
                    // Errors //

                    errorPlacement: function errorPlacement(error, element) {
                        var $parent = $(element).parents('.form-group');

                        // Do not duplicate errors
                        if ($parent.find('.jquery-validation-error').length) {
                            return;
                        }

                        $parent.append(
                            error.addClass(
                                'jquery-validation-error small form-text invalid-feedback')
                        );
                    },
                    highlight: function(element) {
                        var $el = $(element);
                        var $parent = $el.parents('.form-group');

                        $el.addClass('is-invalid');

                        // Select2 and Tagsinput
                        if ($el.hasClass('select2-hidden-accessible') || $el.attr(
                                'data-role') === 'tagsinput') {
                            $el.parent().addClass('is-invalid');
                        }
                    },
                    unhighlight: function(element) {
                        $(element).parents('.form-group').find('.is-invalid').removeClass(
                            'is-invalid');
                    }
                });

                var table = $('#table-cp').DataTable({
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
               // serverSide: true,
                serverMethod: 'POST',
                ajax: {
                    url: "{{ route('ligne_besoin.datatable') }}",
                    data: function(data) {
                        data.besoins_id = "{{ $besoin->id }}";
                        data.mode = "validation";
                    },
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
                        className: "id",
                    },
                    {
                        data: "libelle",
                        className: "libelle"
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

            addSearchFooterDataTable("#table-cp")
            });

        });

        $('#btn_create').on("click", () => {
            $("#btn_submit").click()
        })

        $("#add").click(() => {
         //   if ($("#cp_form").valid()) { // test for validity
                let id = $("#lignebesoin_id").val();
                let libelle = $("input[name=libelle]").val()
                let qte_demande = $("input[name=qte_demande]").val()
                let cout_unite_ttc = $("input[name=cout_unite_ttc]").val()
                let cout_total_ttc = $("input[name=cout_total_ttc]").val()
                let qte_valide = $("input[name=qte_valide]").val()

                var $type = 'POST'
                var $url = "{{ route('lignes_besoin.store') }}"
                if (id != 0) {
                    $type = 'PUT'
                    $url = "{{ route('lignes_besoin.update') }}"

                }
                $.ajax({
                    url: $url,
                    type: $type,
                    data: {
                        libelle: libelle,
                        qte_demande: qte_demande,
                        cout_unite_ttc: cout_unite_ttc,
                        cout_total_ttc: cout_total_ttc,
                        qte_valide: qte_valide,
                        id: id,
                        besoins_id: {{ $besoin->id }},
                    },
                    success: function(response) {

                        $('#table-cp').DataTable().ajax.reload();
                        $('#cp_form')[0].reset()
                        //$("#cp_form").get(0).reset()
                        $('#add').html("{{ __('inputs.btn_add_row_cp') }}")
                        $('#libelle').removeClass('is-invalid')
                        PnotifyCustom(response)
                    },
                    error: function(errors) {
                        $('#libelle').removeClass('is-invalid')
                        //alert(JSON.stringify(errors.responseJSON.message.libelle))
                        if (errors.responseJSON.message.libelle != null) {
                            $('#libelle').addClass('is-invalid')
                            $('#libelle-error').text(errors.responseJSON.message.libelle);
                        }
                    }
                }); // ajax end
        //    }
        });

        function calculTotal(){
            let qte_demande = $("input[name=qte_valide]").val()
                let cout_unite_ttc = $("input[name=cout_unite_ttc]").val()
                let cout_total_ttc = qte_demande * cout_unite_ttc
                $("input[name=cout_total_ttc]").val(cout_total_ttc)

        }

        function editLigneBesoin(id){
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
                $("input[name=qte_demande]").val(response.qte_demande)
                $("input[name=qte_valide]").val(response.qte_valide)
                $("input[name=cout_unite_ttc]").val(response.cout_unite_ttc)
                $("input[name=cout_total_ttc]").val(response.cout_total_ttc)
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
