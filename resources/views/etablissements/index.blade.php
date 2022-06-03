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
                            href="#reglagesGeneraux" role="tab" aria-controls="reglagesGeneraux" aria-selected="false"><i
                                class="fas fa-file-alt m-2"></i>
                            {{ __('labels.tbl_reglagesGeneraux') }}
                            <!--labels.etablissement_reglagesGeneraux-->
                        </a>
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

                @if (isset($etablissement))
                    {{ Form::model($etablissement, ['route' => ['etablissements.update', $etablissement->id], 'method' => 'patch', 'id' => 'validation-etablissement_form']) }}
                @else
                    {!! Form::open(['route' => 'etablissements.store', 'method' => 'POST', 'id' => 'validation-etablissement_form']) !!}
                @endif
                <div class="tab-content" id="myTabContent">
                    {{-- etablissement reglagesGenerauxs Tab start --}}
                    <div class="tab-pane fade show active" id="reglagesGeneraux" role="tabpanel"
                        aria-labelledby="reglagesGeneraux-tab">

                        <div id="soumissionnaire" class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> {{ __('labels.tbl_matricule_fiscale') }}</label>
                                    <input type="text" class="form-control" name="matricule_fiscale"
                                        placeholder=" {{ __('labels.tbl_matricule_fiscale') }}..."
                                        value="{{ old('matricule_fiscale') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{ __('labels.tbl_libelle') }}</label>
                                    <input type="text" class="form-control" name="libelle"
                                        placeholder="{{ __('labels.tbl_libelle') }}..." value="{{ old('libelle') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> {{ __('labels.tbl_email') }} </label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder=" {{ __('labels.tbl_adresse') }} ..." value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{ __('labels.tbl_adresse') }}</label>
                                    <input type="text" class="form-control" name="adresse"
                                        placeholder="{{ __('labels.tbl_adresse') }}..." value="{{ old('adresse') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> {{ __('labels.tbl_responsable') }}</label>
                                    <input type="responsable" class="form-control" name="responsable"
                                        placeholder=" {{ __('labels.tbl_responsable') }}..."
                                        value="{{ old('responsable') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> {{ __('labels.tbl_code_pa') }}</label>
                                    <input type="text" class="form-control" name="code_pa"
                                        placeholder=" {{ __('labels.tbl_code_pa') }}..." value="{{ old('code_pa') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{ __('labels.tbl_code_consult') }}</label>
                                    <input type="text" class="form-control" name="code_consult"
                                        placeholder="{{ __('labels.tbl_code_consult') }}..."
                                        value="{{ old('code_consult') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">{{ __('labels.tbl_code_ao') }} </label>
                                    <input type="text" class="form-control" name="code_ao"
                                        placeholder="{{ __('labels.tbl_code_ao') }} ..." value="{{ old('code_ao') }}">
                                </div>
                            </div>

                            <div class="col-sm-4 ">
                                <div class="form-check">
                                    <input type="hidden" name="ajouter_annee" value="0">
                                    <input class="form-check-input" type="checkbox" id="ajouter_annee" name="ajouter_annee"
                                        value="1" {{ old('ajouter_annee' ? 'checked' : '') }} checked>

                                    <label class="form-check-label" for="ajouter_annee">
                                        {{ __('labels.tbl_ajouter_annee') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-4 ">
                                <div class="form-check">
                                    <input type="hidden" name="reset_code" value="0">
                                    <input class="form-check-input" type="checkbox" id="reset_code" name="reset_code"
                                        value="1" {{ old('reset_code' ? 'checked' : '') }} checked>
                                    <label class="form-check-label" for="reset_code">
                                        {{ __('labels.tbl_reset_code') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">{{ __('labels.tbl_entete') }}</label>
                                    <textarea type="text" class="form-control" name="entete" id='entete' placeholder="{{ __('labels.tbl_entete') }}..."
                                        value="{{ old('entete') }}">
                                     </textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- etablissement reglagesGenerauxs Tab end --}}
                    {{-- etablissement parametreAvertissement Tab start --}}
                    <div class="tab-pane fade " id="parametreAvertissement" role="tabpanel"
                        aria-labelledby="parametreAvertissement-tab">
                        <input type="hidden" id="parametreAvertissement" name="parametreAvertissement">
                        <div class="row">
                            <div class="col-sm-4 ">
                                <div class="form-group">
                                    <input name="notif_validation_besoins" type="hidden" value="0">
                                    <input id="notif_validation_besoins" name="notif_validation_besoins" type="checkbox"
                                        value="1" {{ old('notif_validation_besoins' ? 'checked' : '') }}>
                                    <label> {{ __('labels.tbl_validation_besoins') }} </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 ">
                                <div class="form-group">
                                    <input name="notif_pa" type="hidden" value="0">
                                    <input id="notif_pa" name="notif_pa" type="checkbox" value="1"
                                        {{ old('notif_pa' ? 'checked' : '') }}>
                                    <label>{{ __('labels.tbl_notif_pa') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-7 ">
                                <div class="form-group">
                                    <input id="notif_duree_pa" name="notif_duree_pa" type="number"
                                        class="form-control form-control-sm"
                                        placeholder=" {{ __('labels.tbl_notif_duree_pa') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 ">
                                <div class="form-group">
                                    <input name="notif_publication_achat" type="hidden" value="0">
                                    <input id="notif_publication_achat" name="notif_publication_achat" type="checkbox"
                                        value="1" {{ old('notif_publication_achat' ? 'checked' : '') }}>
                                    <label>{{ __('labels.tbl_notif_publication_achat') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-7 ">
                                <div class="form-group">
                                    <input id="notif_duree_publication" name="notif_duree_publication" type="number"
                                        class="form-control form-control-sm"
                                        placeholder=" {{ __('labels.tbl_notif_duree_publication') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 ">
                                <div class="form-group">
                                    <input name="notif_reglagesGeneraux_op" type="hidden" value="0">
                                    <input id="notif_reglagesGeneraux_op" name="notif_reglagesGeneraux_op" type="checkbox"
                                        value="1" {{ old('notif_reglagesGeneraux_op' ? 'checked' : '') }}>
                                    <label>{{ __('labels.tbl_notif_reglagesGeneraux_op') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-7 ">
                                <div class="form-group">
                                    <input id="notif_duree_reglagesGeneraux_op" name="notif_duree_reglagesGeneraux_op"
                                        type="number" class="form-control form-control-sm"
                                        placeholder="{{ __('labels.tbl_notif_duree_reglagesGeneraux_op') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 ">
                                <div class="form-group">
                                    <input name="notif_date_caution_final" type="hidden" value="0">
                                    <input id="notif_date_caution_final" name="notif_date_caution_final" type="checkbox"
                                        value="1" {{ old('notif_date_caution_final' ? 'checked' : '') }}>
                                    <label> {{ __('labels.tbl_notif_date_caution_final') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-7 ">
                                <div class="form-group">
                                    <input id="notif_duree_caution_final" name="notif_duree_caution_final" type="number"
                                        class="form-control form-control-sm"
                                        placeholder="{{ __('labels.tbl_notif_duree_caution_final') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 ">
                                <div class="form-group">
                                    <input name="notif_delais_rp" type="hidden" value="0">
                                    <input id="notif_delais_rp" name="notif_delais_rp" type="checkbox" value="1"
                                        {{ old('notif_delais_rp' ? 'checked' : '') }}>
                                    <label>{{ __('labels.tbl_notif_delais_rp') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-7 ">
                                <div class="form-group">
                                    <input id="notif_duree_rp" name="notif_duree_rp" type="number"
                                        class="form-control form-control-sm"
                                        placeholder="{{ __('labels.tbl_notif_duree_rp') }}">
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- etablissement parametreAvertissement Tab end --}}
                </div>
                <div class="form-group col-md-12 text-center">
                    <button type="submit" class="btn btn-primary"> إضافة </button>
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
                        'code_ao': {
                            required: true,
                        },
                        'ajouter_annee': {
                            required: true,
                        },
                        'reset_code': {
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endsection
