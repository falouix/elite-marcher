@php
    if ($locale == 'ar') {
        $lang = asset('/plugins/i18n/Arabic.json');
        $rtl = 'rtl';
    } else {
        $lang = '';
        $rtl = 'ltr';
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
        'bread_title' => 'المخطط السنوي للشراءات',
        'bread_subtitle' => 'تحيين مشروع شراء',
    ])
@endsection

@section('content')
    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>تحيين مشروع شراء[المخطط التقديري السنوي]</h5>
                <div class="card-header-right">
                    <a href="{{ route('ppm.index') }}" class="btn btn-secondary">
                        العودة للمخطط السنوي للشراءات
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
                {!! Form::open([
                    'route' => ['ppm.update', $projet->id],
                    'method' => 'PUT',
                ]) !!}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="annee_gestion"> السنة المالية </label>
                            <input type="number" class="form-control" id='annee_gestion' name="annee_gestion"
                                placeholder="أدخل السنة المالية" value='{{ $projet->annee_gestion }}' readonly>
                            @if ($errors->has('annee_gestion'))
                                <span class="text-danger">{{ $errors->first('annee_gestion') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label class="form-label">الموضوع</label>
                            <input type="text" class="form-control" name="objet" id="objet"
                                value="{{ $projet->objet }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">طبيعة الطلب</label>
                            <select class="form-control" id="type_demande" name="type_demande" >
                                <option value="all">الكل</option>
                                <option value="1" @if ($projet->type_demande == 1) selected = true @endif>مواد وخدمات
                                </option>
                                <option value="2" @if ($projet->type_demande == 2) selected = true @endif>أشغال
                                </option>
                                <option value="3" @if ($projet->type_demande == 3) selected = true @endif>دراسات
                                </option>
                            </select>
                            <label id="type_demande-error"
                                class="error jquery-validation-error small form-text invalid-feedback"
                                for="libelle"></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">طريقة الإبرام</label>
                            <select class="form-control" id="nature_passation" name="nature_passation">

                                <option value="CONSULTATION" @if ($projet->nature_passation == 'CONSULTATION') selected = true @endif>
                                    استشارة عادية</option>
                                <option value="AOS" @if ($projet->nature_passation == 'AOS') selected = true @endif>صفقة إجراءات
                                    مبسطة </option>
                                <option value="AON" @if ($projet->nature_passation == 'AOS') selected = true @endif>صفقة إجراءات
                                    عادية</option>
                                <option value="AOGREGRE" @if ($projet->nature_passation == 'AOS') selected = true @endif>صفقة
                                    بالتفاوض المباشر</option>
                            </select>
                            <label id="nature_passation-error"
                                class="error jquery-validation-error small form-text invalid-feedback"
                                for="libelle"></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">مصدر التمويل</label>
                            <select class="form-control" id="source_finance" name="source_finance" >
                                <option value="all">اختر مصدر التمويل</option>
                                <option value="1" @if ($projet->source_finance == 1) selected = true @endif>ميزانية الدولة
                                </option>
                                <option value="2" @if ($projet->source_finance == 2) selected = true @endif>قرض
                                </option>
                                <option value="3" @if ($projet->source_finance == 3) selected = true @endif>هبة
                                </option>
                            </select>
                            <label id="source_finance-error"
                                class="error jquery-validation-error small form-text invalid-feedback"
                                for="libelle"></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="duree_travaux_prvu">آجال الإنجاز  </label>
                            <input type="number" class="form-control" id='duree_travaux_prvu' name="duree_travaux_prvu"
                                placeholder="آجال الإنجاز" value='{{ $projet->duree_travaux_prvu }}'>
                            @if ($errors->has('duree_travaux_prvu'))
                                <span class="text-danger">{{ $errors->first('duree_travaux_prvu') }}</span>
                            @endif
                        </div>
                    </div>


                </div>
                <div class="card-body">

                    <h4>التاريخ التقديري ل :</h4>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-cc_prvu"> إعداد كراس الشروط </label>
                                <input type="date" class="form-control" id='date_cc_prvu' name="date_cc_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_cc_prvu }}">
                                @if ($errors->has('date_cc_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_cc_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_avis_prvu">الإعلان عن المنافسة </label>
                                <input type="date" class="form-control" id='date_avis_prvu' name="date_avis_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_avis_prvu }}">
                                @if ($errors->has('date_avis_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_avis_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> فتح العروض </label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu">تعهد لجنة الشراءات بالملف</label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu">إحالة الملف على لجنة الصفقات</label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> إجابة لجنة الصفقات </label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> نشر نتائج المنافسة </label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> لتبليغ الصفقة</label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> لبداية الإنجاز </label>
                                <input type="date" class="form-control" id='date_op_prvu' name="date_op_prvu"
                                    placeholder="أدخل التاريخ" value="{{ $projet->date_op_prvu }}">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>


                <div class="row mt-4">
                    <button type="submit" id="btn_create" class="btn btn-primary" style="float: right;">
                        <i class="feather icon-edit"></i>
                        {{ __('inputs.btn_edit') }}
                    </button>
                    <a href="{{ route('ppm.index') }}" class="btn btn-danger" style="float: left;">
                        <i class="feather icon-minus-circle"></i>
                        {{ __('inputs.btn_cancel') }}
                    </a>
                </div>
                {!! Form::close() !!}
                <!-- [ Form Validation ] end -->

            </div>
        </div>
    </div>
@endsection
@section('srcipt-js')
    >
    <!-- jquery-validation Js -->
    <script src="{{ asset('/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('/plugins/data-tables/js/pdfmake.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/vfs_fonts.js') }}"></script>

    <!-- form-select-custom Js -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- pnotify Js -->
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>

    <script>
        'use strict';
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endsection
