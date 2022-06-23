@php
if ($locale == 'ar') {
    $name = 'name_' . $locale;
} else {
    $name = 'name';
}
$breadcrumb = __('breadcrumb.bread_user');
if (isset($user)) {
    $sub_breadcrumb = __('breadcrumb.bread_user_edit');
    $userType = $user->user_type;
} else {
    $sub_breadcrumb = __('breadcrumb.bread_user_create');
}
if (!isset($userRole)) {
    $userRole = [];
    $userType = null;
}
$mode = isset($user);
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
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        {{ __('inputs.btn_back_users') }}
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
                @if (isset($user))
                    {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch', 'id' => 'validation-user_form']) }}
                @else
                    {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'id' => 'validation-user_form']) !!}
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('labels.tbl_name') }}</label>
                            <input type="text" class="form-control" name="name"
                                placeholder="{{ __('labels.tbl_name') }}..."
                               @if (isset($user))  value="{{ $user->name }}" @else value="{{ old('name') }}" @endif>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('inputs.user_status') }}</label>
                        <div class="form-group">
                            <div class="checkbox checkbox-primary checkbox-fill d-inline">
                                @if (!isset($user))
                                    <input class="form-control" type="checkbox" name="active" id="active" checked>
                                @endif
                                @if (isset($user) && $user->active == '1')
                                    <input class="form-control" type="checkbox" name="active" id="active" checked>
                                @endif
                                @if (isset($user) && $user->active == '0')
                                    <input class="form-control" type="checkbox" name="active" id="active">
                                @endif


                                <label for="active" class="cr">{{ __('labels.tbl_active') }} </label>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('labels.tbl_email') }}</label>
                            <input type="email" class="form-control" name="email"
                                placeholder="{{ __('labels.tbl_email') }}..." value="@if (isset($user)) {{ $user->email }} @else {{ old('email') }} @endif">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('labels.tbl_phone') }}</label>
                            <input type="text" class="form-control" name="phone_num" placeholder="Phone: 999 9999-9999"
                                data-mask="999 9999-9999" value="@if (isset($user)) {{ $user->phone_num == null ? '' : $user->phone_num }} @else {{ old('phone_num') }} @endif">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('labels.tbl_start_date') }}</label>
                        <input type="date" class="form-control text-left "
                            placeholder="{{ __('labels.tbl_start_date') }}..." name="start_date" id="start_date"
                            value="@if (isset($user)) {{ $user->start_date == null ? '' : $user->start_date }} @else {{ old('start_date') }} @endif">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('labels.tbl_end_date') }}</label>
                        <input type="date" class="form-control text-left"
                            placeholder="{{ __('labels.tbl_end_date') }}..." name="end_date" id="end_date"
                            value="@if (isset($user)) {{ $user->end_date == null ? '' : $user->end_date }} @else {{ old('end_date') }} @endif">
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('labels.tbl_client_adress') }}</label>
                            <textarea class="form-control" name="adress" placeholder="{{ __('labels.tbl_client_adress') }}...">@if (isset($user)) @if($user->adress) {{ $user->adress }} @endif @else {{ old('adress') }} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('labels.tbl_description') }}</label>
                            <textarea class="form-control" name="drescription"
                                placeholder="{{ __('labels.tbl_description') }}...">@if (isset($user)) {{ $user->description == null ? '' : $user->description }} @else {{ old('description') }} @endif</textarea>
                        </div>
                    </div>

                    {{--
                      <div class="col-md-6">
                       @component('components.user_type', ['userType' => $userType])
                       @endcomponent
                    </div>
                    --}}
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="form-label">المصلحة/ المؤسسة</label>
                            <select class="form-control" name="services_id">
                                <option value="NULL" selected>المصلحة أو المؤسسة ...</option>

                                @foreach ($services as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->libelle }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        @component('components.user_role', ['roles' => $roles, 'name' => $name, 'userRole' => $userRole])
                        @endcomponent
                    </div>

                  {{--    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('labels.tbl_password') }}</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="{{ __('labels.tbl_password') }}...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('labels.tbl_confirm_password') }}</label>
                            <input type="password" class="form-control" name="confirm-password"
                                placeholder="{{ __('labels.tbl_confirm_password') }}...">
                        </div>
                    </div>  --}}
                </div>
                @if (isset($user))
                    <button type="submit" class="btn btn-primary" style="float: right;">
                        <i class="feather icon-user-check"></i>
                        {{ __('inputs.btn_save_changes') }}

                    </button>
                @else
                    <button type="submit" class="btn btn-primary" style="float: right;">
                        <i class="feather icon-user-plus"></i>
                        {{ __('inputs.btn_create') }}

                    </button>
                @endif

                <a href="{{ route('users.index') }}" class="btn btn-danger" style="float: left;">
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
    <!-- datepicker js -->
    <script src="{{ asset('/plugins/bootstrap-datetimepicker/js/bootstrap-datepicker.min.js') }}"></script>


    <script>
        'use strict';
        $(document).ready(function() {
            $(function() {
                    // [ Initialize validation ]
                    $('#validation-user_form').validate({
                            ignore: '.ignore, .select2-input',
                            focusInvalid: false,
                            rules: {
                                'name': {
                                    required: true,
                                },
                                'qin': {
                                    required: true,
                                },
                                'email': {
                                    required: true,
                                    email: true
                                },
                                'phone': {
                                    required: true,
                                    phone_format: true
                                },
                                'user_type': {
                                    required: true
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
