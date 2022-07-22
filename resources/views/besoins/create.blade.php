@php
//dd($userService);
if ($locale == 'ar') {
    $name = 'name_' . $locale;
} else {
    $name = 'name';
}
$breadcrumb = 'ضبط الحاجيات';
$sub_breadcrumb = 'إضافة الحاجيات';
@endphp

@extends('layouts.app')
@section('head-script')
    <!-- Bootstrap datetimepicker css -->
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-datetimepicker/css/bootstrap-datepicker3.min.css') }}">

    <style>
        .datepicker>.datepicker-days {
            display: block;
        }

        ol.linenums {
            margin: 0 0 0 -8px;
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
                    <a href="{{ route('besoins.index') }}" class="btn btn-secondary">
                        العودة لضبط الحاجيات
                        <i class="feather icon-corner-down-left"></i>
                    </a>
                    @can('besoins-list')
                        <a type="button" class="btn btn-primary" href="{{ route('articles.create') }}">
                            <i class="feather icon-plus-circle"></i>  إضافة مادة جديدة
                        </a>
                    @endcan
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
                {!! Form::open(['route' => 'besoins.store', 'method' => 'POST', 'files' => 'true', 'enctype' => 'multipart/form-data', 'id' => 'validation-client_form']) !!}
                <input type="hidden" name="ligne_besoin" id="ligne_besoin" value="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label> المصلحة/الدائرة/المؤسسة </label>
                            <input type="text" class="form-control" value="{{ $userService->libelle }}" readonly>
                            <input type="hidden" name="services_id" value="{{ $userService->id }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_besoin"> التاريخ </label>
                            <input type="date" class="form-control" id='date_besoin' name="date_besoin"
                                placeholder="أدخل التاريخ" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                            @if ($errors->has('date_besoin'))
                                <span class="text-danger">{{ $errors->first('date_besoin') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="annee_gestion"> السنة المالية </label>
                            <input type="number" class="form-control" id='annee_gestion' name="annee_gestion"
                                placeholder="أدخل السنة المالية" value='{{ strftime('%Y') }}' readonly>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h3 class="form-label"> الحاجيات</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">طبيعة الطلب</label>
                                <select class="form-control" id="type_demande">
                                    <option value="1">مواد وخدمات</option>
                                    <option value="2">أشغال</option>
                                    <option value="3">دراسات</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">نوع الطلب</label>
                                <select class="form-control" id="type_demande">
                                    <option value="1">مواد وخدمات</option>
                                    <option value="2">أشغال</option>
                                    <option value="3">دراسات</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">المادة (التسمية)</label>
                                <input type="text" class="form-control" name="libelle" placeholder="المادة..."
                                    value="{{ old('libelle') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">الكمية المطلوية</label>
                                <input type="number" class="form-control" name="qte_demande" placeholder="الكمية..."
                                    value="{{ old('qte_demande') }}" onchange="calculTotal()">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">الكلفة التقديرية للوحدة</label>
                                <input type="number" class="form-control" name="cout_unite_ttc"
                                    placeholder="كلفة الوحدة..." value="{{ old('cout_unite_ttc') }}"
                                    onchange="calculTotal()">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">الكلفة التقديرية الجملية</label>
                                <input type="number" class="form-control" name="cout_total_ttc"
                                    placeholder="الكلفة التقديرية الجملية..." value="0" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> إسم الملف المرفق (الخصائص الفنية) </label>
                            <input type="text" class="form-control" name="file_name" id="file_name"
                                placeholder="إسم الملف المرفق" value="">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">الملف/الوثيقة</label>
                            <input type="file" id="file" name="file" class="form-control form-control-file"
                                id="file">
                            <label id="file-error" class="error jquery-validation-error small form-text invalid-feedback"
                                for="file"></label>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> المبررات </label>
                            <input type="text" class="form-control" name="description" id="description"
                                placeholder="المبررات" value="">

                        </div>


                        <div class="col-md-12">
                            <a href="javascript:void(0);" class="btn btn-rounded btn-info" id='add'
                                for-table='#table-cp'>
                                <i class="feather icon-plus"></i>
                                إضافة إلى الجدول
                            </a>
                            <div class="table-responsive">
                                <h6 style="color: red; text-align: left;">الكلفة الجمليةالتقديرية للحاجيات : <span
                                        id="coutTotal"> 0</span></h6>
                                <table class="table table-striped table-bordered" id="table-cp">
                                    <thead>
                                        <tr>
                                            <thead>
                                                <th>المادة</th>
                                                <th>الكمية المطلوبة</th>
                                                <th>الكلفة التقديرية للوحدة</th>
                                                <th>الكلفة التقديرية الجملية</th>
                                                <th>حذف</th>
                                            </thead>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- Contact from company  end --}}


                <div class="row mt-4">
                    <button type="button" id="btn_create" class="btn btn-primary" style="float: right;">
                        <i class="feather icon-client-plus"></i>
                        {{ __('inputs.btn_create') }}
                    </button>
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
    <!-- datepicker js -->
    <script src="{{ asset('/plugins/bootstrap-datetimepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- editable Js -->
    <script src="{{ asset('/plugins/editable/js/jquery.tabledit.js') }}"></script>

    <script>
        'use strict';
        $(document).ready(function() {
            $(function() {

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
            });
            // [ day-week ]
            $('#start_date').datepicker({
                daysOfWeekDisabled: "2"
            });
            // [ day-week ]
            $('#end_date').datepicker({
                daysOfWeekDisabled: "2"
            });
        });
        $("#table-cp").on("click", ".tabledit-confirm-button", function() {
            $(this).closest("tr").remove();
            var myTableArray = [];
            myTableArray = add_cp();
            $('#ligne_besoin').val(JSON.stringify(myTableArray))
        });
        $("#table-cp").on("click", ".tabledit-delete-button", function() {
            $(".tabledit-confirm-button").show();
        });
        $('#btn_create').on("click", () => {
            var myTableArray = [];
            myTableArray = add_cp();
            $('#ligne_besoin').val(JSON.stringify(myTableArray))
            $("#btn_submit").click()
        })

        $("#add").click(function(e) {

            let libelle = $("input[name=libelle]").val()
            let qte_demande = $("input[name=qte_demande]").val()
            let cout_unite_ttc = $("input[name=cout_unite_ttc]").val()
            let cout_total_ttc = $("input[name=cout_total_ttc]").val()
            if (qte_demande === "0") {
                return false;
            }
            var myTableArray = [];
            var verif = true;
            myTableArray = add_cp();
            myTableArray.find(function(value, index) {

                if (value[0] == libelle) {
                    verif = false;
                    return;
                }

                if (value[1] === 0) {
                    verif = false;
                    return;
                }

            })
            if (verif) {
                //  alert(JSON.stringify(myTableArray));
                var table = $(this).attr('for-table'); //get the target table selector
                $(table + ">tbody").append(newRow()); //add the row to the table
                //alert(JSON.stringify(myTableArray));
                // Calcul Total TTC
                var coutTotal = 0;
                $(".tabledit-total").each(function() {
                    coutTotal += parseFloat($(this).text());
                });
                $('#coutTotal').text(coutTotal);
                // Clear form
                $("#cp_form")[0].reset()
            }



        });

        function newRow() {
            if ($("#cp_form").valid()) { // test for validity
                // do stuff if form is valid
                let libelle = $("input[name=libelle]").val()
                let qte_demande = $("input[name=qte_demande]").val()
                let cout_unite_ttc = $("input[name=cout_unite_ttc]").val()
                let cout_total_ttc = $("input[name=cout_total_ttc]").val()

                var text = "<tr>" +
                    "<td class='tabledit-view-mode'><span class='tabledit-span'>" + libelle + "</span>" +
                    "<td class='tabledit-view-mode'><span class='tabledit-span'>" + qte_demande + "</span>" +
                    "<td class='tabledit-view-mode'><span class='tabledit-span'>" + cout_unite_ttc + "</span>" +
                    "<td class='tabledit-view-mode'><span class='tabledit-total'>" + cout_total_ttc + "</span></td>" +
                    "<td style='white-space: nowrap; width: 1%;'>" +
                    "<div class='tabledit-toolbar btn-toolbar' style='text-align: left;'>" +
                    "<div class='btn-group btn-group-sm' style='float: none;'>" +
                    "<button type='button' class='tabledit-delete-button btn btn-sm btn-default' style='float: none;'>" +
                    "<span class='feather icon-trash-2'></span></button></div>" +
                    "<button type='button' class='tabledit-confirm-button btn btn-sm btn-danger' style='display: none; float: none;'>Confirm</button>" +
                    "</div>" +
                    "</td></tr>";

                return text;

            } else {
                return false;
            }
        }

        function add_cp() {
            var myTableArray = [];
            $("table#table-cp tr").each(function() {
                var arrayOfThisRow = [];
                var tableData = $(this).find('td');

                if (tableData.length > 0) {
                    tableData.each(function() {
                        arrayOfThisRow.push($(this).text());

                    });
                    myTableArray.push(arrayOfThisRow);
                }
            });

            return (myTableArray);
        }

        function calculTotal() {
            let qte_demande = $("input[name=qte_demande]").val()
            let cout_unite_ttc = $("input[name=cout_unite_ttc]").val()
            let cout_total_ttc = qte_demande * cout_unite_ttc
            $("input[name=cout_total_ttc]").val(cout_total_ttc)

        }
    </script>
@endsection
