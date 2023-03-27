@php
if ($locale == 'ar') {
    $name = 'name_' . $locale;
    $rtl = 'rtl';
} else {
    $name = 'name';
    $rtl = 'ltr';
}
$breadcrumb = __('breadcrumb.bread_etablissements');
$sub_breadcrumb = __('breadcrumb.bread_etablissements');

@endphp

@extends('layouts.app')
@section('head-script')
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
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

            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>{{ __('validation.v_title') }}</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                @endif

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase" id="reglagesGeneraux-tab" data-toggle="tab"
                            href="#reglagesGeneraux" role="tab" aria-controls="reglagesGeneraux"
                            aria-selected="false"><i class="fas fa-file-alt m-2"></i>
                            {{ __('labels.tbl_reglagesGeneraux') }}
                            <!--labels.etablissement_reglagesGeneraux-->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="codification-tab" data-toggle="tab" href="#codification"
                            role="tab" aria-controls="codification" aria-selected="true"><i
                                class="fas fa-file-alt m-2"></i>
                            إعدادات ترقيم الملفات </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="parametreAvertissement-tab" data-toggle="tab"
                            href="#parametreAvertissement" role="tab" aria-controls="parametreAvertissement"
                            aria-selected="true"><i class="fas fa-file-alt m-2"></i>
                            {{ __('labels.tbl_parametreAvertissement') }} </a>
                        <!--labels.etablissement_parametreAvertissement-->
                    </li>
                </ul>

                <!-- [ Form Validation ] start -->
                {!! Form::open(['route' => 'etablissements.store', 'method' => 'POST', 'id' => 'validation-etablissement_form']) !!}
                <div class="tab-content" id="myTabContent">
                    {{-- etablissement reglagesGenerauxs Tab start --}}
                    <div class="tab-pane fade show active" id="reglagesGeneraux" role="tabpanel"
                        aria-labelledby="reglagesGeneraux-tab">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> معرف المؤسسة</label>
                                    <input type="text" class="form-control" name="matricule_fiscale"
                                        placeholder=" المعرف..." value="{{ $settings->matricule_fiscale }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{ __('labels.tbl_libelle') }}</label>
                                    <input type="text" class="form-control" name="libelle"
                                        placeholder="{{ __('labels.tbl_libelle') }}..." value="{{ $settings->libelle }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> {{ __('labels.tbl_responsable') }}</label>
                                    <input type="responsable" class="form-control" name="responsable"
                                        placeholder=" {{ __('labels.tbl_responsable') }}..."
                                        value="{{ $settings->responsable }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> {{ __('labels.tbl_email') }} </label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder=" {{ __('labels.tbl_adresse') }} ..." value="{{ $settings->email }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">{{ __('labels.tbl_adresse') }}</label>
                                    <input type="text" class="form-control" name="adresse"
                                        placeholder="{{ __('labels.tbl_adresse') }}..." value="{{ $settings->adresse }}">
                                </div>
                            </div>

                        </div>

                    </div>
                    {{-- etablissement reglagesGenerauxs Tab end --}}
                    {{-- etablissement Codifications Tab start --}}
                    <div class="tab-pane fade show " id="codification" role="tabpanel" aria-labelledby="codification-tab">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> {{ __('labels.tbl_code_pa') }}</label>
                                    <input type="text" class="form-control" name="code_pa"
                                        placeholder=" {{ __('labels.tbl_code_pa') }}..."
                                        value="{{ $settings->code_pa }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{ __('labels.tbl_code_consult') }}</label>
                                    <input type="text" class="form-control" name="code_consult"
                                        placeholder="{{ __('labels.tbl_code_consult') }}..."
                                        value="{{ $settings->code_consult }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">طلب عروض إجراءات عادية </label>
                                    <input type="text" class="form-control" name="code_aon"
                                        placeholder="ترقيم ..."
                                        value="{{ $settings->code_aon }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">طلب عروض إجراءات مبسطة </label>
                                    <input type="text" class="form-control" name="code_aos"
                                        placeholder="ترقيم ..."
                                        value="{{ $settings->code_aos }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">طلب عروض بالتفاوض المباشر </label>
                                    <input type="text" class="form-control" name="code_gg"
                                        placeholder="ترقيم التفاوض المباشر..."
                                        value="{{ $settings->code_gg }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="ajouter_annee"
                                        name="ajouter_annee" {{ $settings->ajouter_annee ? 'checked' : '' }}>

                                    <label class="form-check-label" for="ajouter_annee">
                                        {{ __('labels.tbl_ajouter_annee') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-6 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="reset_code" name="reset_code"
                                         {{ $settings->reset_code ? 'checked' : '' }}>
                                    <label class="form-check-label" for="reset_code">
                                        {{ __('labels.tbl_reset_code') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- etablissement Codifications Tab end --}}
                    {{-- etablissement parametreAvertissement Tab start --}}
                    <div class="tab-pane fade " id="parametreAvertissement" role="tabpanel"
                        aria-labelledby="parametreAvertissement-tab">
                        <div class="row">
                            <div class="col-sm-4 ">
                                <div class="form-group">
                                    <input id="notif_validation_besoins" name="notif_validation_besoins" type="checkbox"
                                        {{ $settings->notif_validation_besoins ? 'checked' : '' }}>
                                    <label> {{ __('labels.tbl_validation_besoins') }} </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- CC --}}
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <label> تفعيل التنبيهات المتعلقة بكراس الشروط </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input"
                                                name="notif_cc" {{ $settings->notif_cc ? 'checked' : ''  }}>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" aria-label="Text input with checkbox"
                                        name="notif_duree_cc" value="{{ $settings->notif_duree_cc }}" min="1" max="99">
                                    </div>
                                </div>
                            </div>
                            {{-- Fin CC --}}
                            {{-- Avis publication --}}
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <label> تفعيل تنبيه للإعلان عن المنافسة قبل</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input"
                                                name="notif_avis_pub" {{ $settings->notif_avis_pub ? 'checked' : ''  }}>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" aria-label="Text input with checkbox"
                                        name="notif_duree_pub" value="{{ $settings->notif_duree_pub }}" min="1" max="99">
                                    </div>
                                </div>
                            </div>
                            {{-- Fin publication --}}
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <label> تفعيل تنبيه لجلسة الفرز قبل  </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input"
                                                name="notif_publication_achat" {{ $settings->notif_session_op ? 'checked' : ''  }}>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" aria-label="Text input with checkbox"
                                        name="notif_duree_session_op" value="{{ $settings->notif_duree_session_op }}" min="1" max="99">
                                    </div>
                                </div>
                            </div>
                            {{-- Caution Provisoire --}}
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <label>تفعيل تنبيه بحلول آجال الضمان الوقتي قبل </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input"
                                                name="notif_caution_provisoire" value="{{ $settings->notif_caution_provisoire }}">
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" aria-label="Text input with checkbox"
                                        name="notif_duree_caution_provisoire" value="{{ $settings->notif_duree_caution_provisoire }}" min="1" max="99">
                                    </div>
                                </div>
                            </div>
                            {{-- Fin Caution Provisoire --}}
                            {{-- Caution final --}}
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <label>تنبيه يحلول آجال الضمان النهائي قبل </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input"
                                                name="notif_caution_final" value="{{ $settings->notif_caution_final }}">
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" aria-label="Text input with checkbox"
                                        name="notif_duree_caution_final" value="{{ $settings->notif_duree_caution_final }}" min="1" max="99">
                                    </div>
                                </div>
                            </div>
                            {{-- Fin Caution final --}}
                             {{-- Reception Provisoire --}}
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <label>{{ __('labels.tbl_notif_duree_rp') }}</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input"
                                                name="notif_delais_rp" value="{{ $settings->notif_delais_rp }}">
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" aria-label="Text input with checkbox"
                                        name="notif_duree_rp" value="{{ $settings->notif_duree_rp }}" min="1" max="99">
                                    </div>
                                </div>
                            </div>
                             {{-- Fin Reception Provisoire --}}
                              {{-- Reception Defenitive --}}
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <label> تفعيل تنبيه بحلول آجال الإستلام الوقتي قبل </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input"
                                                name="notif_delais_rd" value="{{ $settings->notif_delais_rd }}">
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" aria-label="Text input with checkbox"
                                        name="notif_duree_rd" value="{{ $settings->notif_duree_rd }}" min="1" max="99">
                                    </div>
                                </div>
                            </div>
                             {{-- Fin Reception Defenitive --}}
                        </div>



                    </div>
                    {{-- etablissement parametreAvertissement Tab end --}}
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary" style="float: right;">
                        <i class="feather icon-client-plus"></i>
                        {{ __('inputs.btn_save_changes') }}

                    </button>

                    <a href="{{ route('settings.index') }}" class="btn btn-danger" style="float: left;">
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
    <!-- jquery-validation Js -->
    <script src="{{ asset('/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/plugins/inputmask/js/jquery.inputmask.min.js') }}"></script>
    <!-- form-select-custom Js -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
    <!--rich text editor  -->
    <script src="{{ asset('/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('entete');
        'use strict';
        $(document).ready(function() {
            $(function() {
                // [ Initialize validation ]
                $('#validation-etablissement_form').validate({
                    ignore: '.ignore, .select2-input',
                    focusInvalid: false,
                    rules: {
                        'libelle': {
                            required: true,
                        },
                        'code_pa': {
                            required: true,
                        },
                        'code_consult': {
                            required: true,
                        },
                        'code_aon': {
                            required: true,
                        },
                        'code_aos': {
                            required: true,
                        },
                        'code_gg': {
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
        });
    </script>
@endsection
