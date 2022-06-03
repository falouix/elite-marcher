@php
if ($locale == 'ar') {
    $name = 'name_' . $locale;
} else {
    $name = 'name';
}
$breadcrumb = __('breadcrumb.bread_soumissionnaires');
$sub_breadcrumb = __('breadcrumb.bread_soumissionnaires_create');

@endphp

@extends('layouts.app')


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
                    <a href="{{ route('soumissionnaires.index') }}" class="btn btn-secondary">
                        {{ __('inputs.btn_back_soumissionnaires') }}
                        <i class="feather icon-corner-down-left"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
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

                {!! Form::open(['route' => 'soumissionnaires.store', 'method' => 'POST', 'id' => 'validation-soumissionnaire_form']) !!}

                <div class="row">

                    <div id="soumissionnaire" class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> {{ __('labels.tbl_libelle') }}</label>
                                <input type="text" class="form-control" name="libelle"
                                    placeholder=" {{ __('labels.tbl_libelle') }}..." value="{{ old('libelle') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('labels.tbl_contact') }}</label>
                                <input type="text" class="form-control" name="contact"
                                    placeholder="{{ __('labels.tbl_contact') }}..." value="{{ old('contact') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> {{ __('labels.tbl_adresse') }} </label>
                                <input type="text" class="form-control" name="adresse"
                                    placeholder=" {{ __('labels.tbl_adresse') }} ..." value="{{ old('adresse') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('labels.tbl_code_postal') }}</label>
                                <input type="text" class="form-control" name="code_postal"
                                    placeholder="{{ __('labels.tbl_code_postal') }}..."
                                    value="{{ old('code_postal') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> {{ __('labels.tbl_ville') }}</label>
                                <input type="text" class="form-control" name="ville"
                                    placeholder=" {{ __('labels.tbl_ville') }}..." value="{{ old('ville') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">{{ __('labels.tbl_gouvernorat') }}</label>
                                <input type="text" class="form-control" name="gouvernorat"
                                    placeholder="{{ __('labels.tbl_gouvernorat') }}..."
                                    value="{{ old('gouvernorat') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">{{ __('labels.tbl_tel_fax') }} </label>
                                <input type="text" class="form-control" name="tel_fax"
                                    placeholder="{{ __('labels.tbl_tel_fax') }} ..." value="{{ old('tel_fax') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> {{ __('labels.tbl_email') }}</label>
                                <input type="email" class="form-control" name="email"
                                    placeholder=" {{ __('labels.tbl_email') }}..." value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('labels.tbl_matricule_fiscale') }}</label>
                                <input type="text" class="form-control" name="matricule_fiscale"
                                    placeholder="{{ __('labels.tbl_matricule_fiscale') }}..."
                                    value="{{ old('matricule_fiscale') }}">
                            </div>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary" style="float: right;">
                    <i class="feather icon-soumissionnaire-plus"></i>
                    {{ __('inputs.btn_create') }}

                </button>

                <a href="{{ route('soumissionnaires.index') }}" class="btn btn-danger" style="float: left;">
                    <i class="feather icon-minus-circle"></i>
                    {{ __('inputs.btn_cancel') }}
                </a>
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

    <script>
        'use strict';
        $(document).ready(function() {
            $(function() {
                // [ Initialize validation ]
                $('#validation-soumissionnaire_form').validate({
                    ignore: '.ignore, .select2-input',
                    focusInvalid: false,
                    rules: {
                        'libelle': {
                            required: true,
                        },
                        'contact': {
                            required: true,
                        },
                        'adresse': {
                            required: true,
                        },
                        'email': {
                            required: true,
                            email: true
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
    </script>
@endsection
