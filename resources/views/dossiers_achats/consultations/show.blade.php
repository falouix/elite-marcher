@php

$breadcrumb = الإستشارات;
$subreadcrumb = عرض تفاصيل الإستشارة;

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
    'bread_title'=> $breadcrumb,
    'bread_subtitle'=> $subreadcrumb
    ])
@endsection

@section('content')
    <div class="col-xl-4 col-lg-12 task-detail-right">
        <div class="card">
            <div class="card-body bg-c-blue">
                <div class="counter text-center">
                    <h4 id="timer" class="text-white m-0">
                        <i class="fas fa-gavel" style="font-size: 30px; color:white"></i>
                        {{ __('labels.tbl_case_code') }} : {{ $case->case_code }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>{{ __('cards.case_details') }}</h5>
                @if ($case->caseStatus)
                    <div class="card-header-right">
                        <span class="label label-primary float-right"> {{ $case->caseStatus->libelle }}</span>
                    </div>
                @endif
            </div>
            <div class="card-body task-details">

                <div class="pl-0">
                    <div class="main-profile-overview">

                        <div class=" justify-content-between ">

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td style="padding: 0.3rem; border-top:white;">
                                            <h6>{{ __('labels.tbl_case_date') }} </h6>
                                        </td>
                                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                            {{ date('d-m-Y', strtotime($case->case_date)) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.3rem; border-top:white;">
                                            <h6>
                                                {{ __('labels.tbl_case_num') }} :

                                            </h6>
                                        </td>
                                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                            {{ $case->case_num }}
                                        </td>
                                    </tr>
                                    @if ($case->caseType)
                                        <tr>
                                            <td style="padding: 0.3rem; border-top:white;">
                                                <h6>
                                                    {{ __('labels.tbl_case_type_id') }} :
                                                </h6>
                                            </td>
                                            <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                                {{ $case->caseType->libelle }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($case_court_circle)
                                        <tr>
                                            <td style="padding: 0.3rem; border-top:white;">
                                                <h6>
                                                    {{ __('labels.tbl_court_num') }} :
                                                </h6>
                                            </td>
                                            <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                                {{ $case_court_circle->libelle }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($case->court)
                                        <tr>
                                            <td style="padding: 0.3rem; border-top:white;">
                                                <h6>
                                                    {{ __('labels.tbl_court_id') }} :
                                                </h6>
                                            </td>
                                            <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                                {{ $case->court->libelle }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>


                        </div>

                        <hr class="mg-y-20">
                        <h6>{{ __('cards.case_client') }}</h6>
                        <hr class="mg-y-20">
                        <div class=" justify-content-between ">

                            <table class="table">

                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>{{ __('labels.tbl_client_name') }} </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                        {{ $case->client->full_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>
                                            {{ __('labels.tbl_client_phone') }} :

                                        </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                        {{ $case->client->phone_num }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>
                                            {{ __('labels.tbl_email_abr') }} :
                                        </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                        {{ $case->client->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>
                                            {{ __('labels.tbl_client_nationality') }} :
                                        </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                        {{ $case->client->nationality }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>
                                            {{ __('labels.tbl_client_adress') }} :
                                        </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                        {{ $case->client->contact }}
                                    </td>
                                </tr>

                            </table>
                        </div>


                        <hr class="mg-y-20">
                        <h6>{{ __('labels.tbl_description') }} </h6>
                        <div class="main-profile-social-list">

                            <div class="media">
                                <p style="line-height: 27px">
                                    {{ $case->description }}
                                </p>
                            </div>
                        </div>

                    </div><!-- main-profile-overview -->
                </div>
            </div>
        </div>


    </div>
    <div class="col-xl-8 col-lg-12">

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-border-c-blue">
                    <div class="card-header">
                        <a href="#" class="text-secondary">{{ __('cards.case_details_title') }}</a>
                        <div class="card-header-right">
                            <a href="{{ route('cases.index',['category'=>$case->category]) }}" class="btn btn-secondary">
                                {{ __('inputs.btn_back_cases') }}
                                <i class="feather icon-corner-down-left"></i>
                            </a>

                        </div>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="parties-tab" data-toggle="tab" href="#parties"
                                role="tab" aria-controls="parties" aria-selected="true"><i
                                    class="fas fa-business-time m-2"></i>{{ __('labels.case_parties') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="session-tab" data-toggle="tab" href="#session" role="tab"
                                aria-controls="session" aria-selected="false"><i class="fas fa-business-time m-2"></i>
                                {{ __('labels.case_session') }}
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="contact-tab" data-toggle="tab" href="#boost" role="tab"
                                aria-controls="boost" aria-selected="false"><i
                                    class="fas fa-file-alt m-2"></i>{{ __('labels.case_docs') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        {{-- Case Parties Tab start --}}
                        <div class="tab-pane fade show active" id="parties" role="tabpanel" aria-labelledby="parties-tab">
                            {{-- Case Other Parties --}}
                            {{-- @can('add-case-parties') --}}
                            <div class="col-md-12">
                                <form id="cp_form" name="cp_form">
                                    <div class="form-row">

                                        <input type="number" name="party_id" id="party_id" value="0" hidden>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> {{ __('labels.party_name') }} </label>
                                            <input type="text" class="form-control" id="party_name" name="party_name"
                                                placeholder="{{ __('labels.party_name') }}">
                                            <label id="party_name-error"
                                                class="error jquery-validation-error small form-text invalid-feedback"
                                                for="party_name"></label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> {{ __('labels.type_party') }} </label>
                                            <select class='tabledit-input form-control input-sm' name="type_party"
                                                id="type_party">
                                                <option value='0' selected='selected'>
                                                    {{ __('labels.with_client_partie') }}</option>
                                                <option value='1'>{{ __('labels.with_other_partie') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> {{ __('labels.tbl_phone') }} </label>
                                            <input class="form-control" name="party_phone"
                                                placeholder="{{ __('labels.tbl_phone') }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"> {{ __('labels.tbl_client_adress') }}
                                            </label>

                                            <textarea class="form-control" id="party_address" name="party_address"
                                                rows="4"></textarea>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"> {{ __('labels.tbl_description') }} </label>
                                            <textarea class="form-control" id="client_details" name="client_details"
                                                rows="4"></textarea>
                                        </div>
                                    </div>
                                </form>
                                <a href="javascript:void(0);" class="btn btn-rounded btn-info" id='add'
                                    for-table='#table-cp'>
                                    <i class="feather icon-plus"></i>
                                    {{ __('inputs.btn_create_case_partie') }}
                                </a>
                            </div>
                            {{-- @endcan --}}
                            <div class="col-md-12">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-cp" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px"><input type="checkbox" class="select-checkbox" /></th>
                                                <th>id</th>
                                                <th> {{ __('labels.party_name') }}</th>
                                                <th>{{ __('labels.tbl_phone') }}</th>
                                                <th>{{ __('labels.type_party') }}</th>
                                                <th>{{ __('labels.tbl_client_adress') }}</th>
                                                <th>{{ __('labels.tbl_description') }}</th>
                                                <th style="display:none;"></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th style="width: 30px"><input type="checkbox" class="select-checkbox" /></th>
                                                <th>id</th>
                                                <th> {{ __('labels.party_name') }}</th>
                                                <th>{{ __('labels.tbl_phone') }}</th>
                                                <th>{{ __('labels.type_party') }}</th>
                                                <th>{{ __('labels.tbl_client_adress') }}</th>
                                                <th>{{ __('labels.tbl_description') }}</th>
                                                <th style="display:none;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                            {{-- Case Other Parties end --}}
                        </div>
                        {{-- Case Parties Tab end --}}
                        {{-- Case Sessions Tab start --}}
                        <div class="tab-pane fade" id="session" role="tabpanel" aria-labelledby="session-tab">
                            <div style="margin-bottom: 30px;">
                                <button type="button" class="btn btn-rounded btn-success" data-toggle="modal"
                                    data-target="#add_case_session">
                                    <i class="feather icon-plus-circle"></i>
                                    {{ __('inputs.btn_create_session') }}
                                </button>
                            </div>
                            <div class="row" id="session-container">
                                @if ($case->caseSessions)
                                    @foreach ($case->caseSessions as $session)
                                        <div class="col-md-6 col-sm-12">
                                            <div class="card card-border-c-green">
                                                <div class="card-header">

                                                    <a href="#!" class="text-secondary">
                                                        {{ $session->session_libelle }}
                                                    </a>
                                                    @if ($session->sessionStatus)
                                                        <span class="label label-primary float-right">
                                                            {{ $session->sessionStatus->libelle }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="card-body card-task">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <p class="task-detail">
                                                                {{ $session->description }}
                                                            </p>
                                                            <p class="task-due">
                                                                <strong class="label label-primary">
                                                                    <strong>
                                                                        {{ __('labels.tbl_session_date') }} :
                                                                    </strong>
                                                                    {{date('d-m-Y', strtotime($session->session_date))}}
                                                                </strong>

                                                            @if($session->session_second_date)

                                                                <strong class="label label-danger">
                                                                    <strong>
                                                                        {{ __('labels.tbl_session_seond_date') }} :
                                                                    </strong>
                                                                    {{date('d-m-Y', strtotime($session->session_second_date))}}
                                                                </strong>
                                                            </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="task-board">
                                                        <a href="{{ route('cases-sessions.show', ['cases_session' =>  $session->id ]) }}" class="btn btn-secondary btn-sm b-none txt-muted"
                                                            type="button" data-id="{{ $session->id }}"
                                                            id="btn_session_edit">
                                                            <i class="feather icon-eye"></i>
                                                            {{ __('inputs.btn_view') }}
                                                        </a>
                                                        <button class="btn btn-success btn-sm b-none txt-muted"
                                                            type="button" data-id="{{ $session->id }}"
                                                            id="btn_session_edit"
                                                            onclick="editSession({{ $session->id }})">
                                                            <i class="feather icon-edit"></i>
                                                            {{ __('inputs.btn_edit') }}
                                                        </button>
                                                        <button class="btn btn-danger btn-sm b-none txt-muted" type="button"
                                                            data-id="{{ $session->id }}" id="btn_session_delete"
                                                            onclick="deleteFromDataTableBtn({{ $session->id }})">
                                                            <i class="feather icon-trash-2"></i>
                                                            {{ __('inputs.btn_delete') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                        {{-- Case Sessions Tab end --}}


                        <div class="tab-pane fade" id="boost" role="tabpanel" aria-labelledby="boost-tab">
                            <div class="m-t-30">
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1"> {{ __('labels.tbl_file_libelle') }} </label>
                                        <input type="text" class="form-control" name="file_name" id="file_name"
                                            placeholder="{{ __('labels.tbl_file_libelle') }}" value="">
                                        <label id="file_name-error"
                                            class="error jquery-validation-error small form-text invalid-feedback"
                                            for="file_name"></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">{{ __('labels.tbl_file_file') }}</label>
                                        <input type="file" id="file" name="file" class="form-control form-control-file"
                                            id="file">
                                        <label id="file-error"
                                            class="error jquery-validation-error small form-text invalid-feedback"
                                            for="file"></label>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit" id="btn_add_file">
                                        <span class="spinner-border spinner-border-sm" role="status" hidden></span>
                                        {{ __('inputs.btn_create') }}
                                    </button>
                                </div>
                            </div>

                            <div class="dt-responsive table-responsive">
                                <table id="case-docs-table" class="table table-striped table-bordered nowrap"
                                    style="width: 100%">
                                    <thead>
                                        <th style="width: 30px"><input type="checkbox" class="select-checkbox" /> </th>
                                        <th>id</th>
                                        <th>{{ __('labels.tbl_file_libelle') }}</th>
                                        <th>{{ $tbl_action }}</th>
                                        <th>{{ __('labels.tbl_created_at') }}</th>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th style="width: 30px"><input type="checkbox" class="select-checkbox" /> </th>
                                            <th>id</th>
                                            <th>{{ __('labels.tbl_file_libelle') }}</th>
                                            <th>{{ $tbl_action }}</th>
                                            <th>{{ __('labels.tbl_created_at') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Modal Create or edit Session -->
    <div class="modal fade show" id="add_case_session" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"> {{ __('inputs.btn_create_case_session') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="number" name="session_id" id="session_id" value=0 hidden>
                    <div class="row">


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> {{ __('labels.tbl_session_date') }} </label>
                            <input type="datetime-local" class="form-control" id="session_date" name="session_date">
                            <label id="session_date-error"
                                class="error jquery-validation-error small form-text invalid-feedback"
                                for="session_date"></label>
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="exampleFormControlSelect1"> {{ __('labels.tbl_session_status_id') }}
                            </label>
                            <select class="form-control" id="session_status_id" name="session_status_id"></select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="lbl_libelle"> {{ __('labels.tbl_session_libelle') }} </label>
                            <input type="text" class="form-control" id="session_libelle" name="session_libelle">
                            <label id="session_libelle-error"
                                class="error jquery-validation-error small form-text invalid-feedback"
                                for="session_libelle"></label>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> {{ __('labels.tbl_session_description') }} </label>
                            <textarea class="form-control" id="session_description" name="session_description"
                                rows="3">  </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ __('inputs.btn_close') }}</button>
                        <button type="submit" class="btn btn-primary" id='btn_add_case_session'>
                            {{ __('inputs.btn_create') }} </button>
                    </div>


                </div>

            </div>
        </div>
    </div>
    <!-- Modal Create or edit Party end-->



@endsection
@section('srcipt-js')
    <!-- datatable Js -->
    <script src="{{ asset('/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/dataTables.select.min.js') }}"></script>
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- pnotify Js -->
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>

    <!-- jquery-validation Js -->
    <script src="{{ asset('/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <!-- form-select-custom Js -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // [ Initialize cp-form validation ]
            $('#cp_form').validate({
                ignore: '.ignore, .select2-input',
                focusInvalid: false,
                rules: {
                    'party_name': {
                        required: true,
                    },
                    'party_phone': {
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
            var table = $('#case-docs-table').DataTable({
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
                    url: "{{ route('files.datatable') }}",
                    data: {
                        id: {{ $case->id }},
                        param: 'case_documents'
                    }
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
                        data: "file_name",
                        className: 'file_name'
                    },
                    {
                        data: 'action',
                        className: 'action',
                        visible: 'false'
                    },
                    {
                        data: "created_at",
                        className: 'created_at'
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

            addSearchFooterDataTable("#case-docs-table")
            var table_partie = $('#table-cp').DataTable({
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
                    url: "{{ route('cases_parties_datatable.data') }}",
                    data: function(p) {
                        p.case_id = "{{ $case->id }}";
                        //p.start_date = $('#start-date').val();
                        // p.end_date = $('#end-date').val();
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
                        className: "id"
                    },
                    {
                        data: "party_name",
                        className: 'party_name'
                    },
                    {
                        data: "party_phone",
                        className: 'party_phone'
                    },
                    {
                        data: "client_party",
                        className: 'client_party'
                    },
                    {
                        data: "party_adress",
                        className: 'party_adress'
                    },
                    {
                        data: "client_details",
                        className: 'client_details'
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
            table_partie
                .on('select', function(e, dt, type, indexes) {
                    // var rowData = table.rows( indexes ).data().toArray();
                    //console.log( rowData );
                    SelectedRowCountBtnDelete(table_partie)
                })
                .on('deselect', function(e, dt, type, indexes) {
                    SelectedRowCountBtnDelete(table_partie)
                });

            $('.dataTables_length').addClass('bs-select');

            // Setup - add a text input to each footer cell

            addSearchFooterDataTable("#table-cp")

            // Create new file_documents
            $('#btn_add_file').click((e) => {
                e.preventDefault();
                $('#btn_add_file').attr('disabled', 'disabled');
                $('.spinner-border').removeAttr('hidden');
                $('#file_name').removeClass('is-invalid')
                $('#file').removeClass('is-invalid')
                let cases_id = {{ $case->id }};
                let path = "case_documents";
                let file_name = $("input[name=file_name]").val();
                let file = document.getElementById("file").files[0];
                var formData = new FormData();
                formData.append('cases_id', cases_id)
                formData.append('path', path)
                formData.append('file', file)
                formData.append('file_name', file_name)
                $.ajax({
                    url: "{{ route('file.upload.post') }}",
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: formData,
                    dataType: 'json',
                    success: function(response) {

                        $('#file_name').val('')
                        $('#file').val('')
                        //refreshSessions()
                        PnotifyCustom(response)
                        $('#btn_add_file').removeAttr('disabled');
                        $('.spinner-border').attr('hidden', 'hidden');
                        $('#case-docs-table').DataTable().ajax.reload();


                    },
                    error: function(response) {
                        console.log(JSON.stringify(response))
                        $('#btn_add_file').removeAttr('disabled');
                        $('.spinner-border').attr('hidden', 'hidden');
                        $('#file_name-error').html('')
                        $('#file-error').html('')
                        // alert(JSON.stringify(response.responseJSON.message))
                        if (response.responseJSON.message.file_name != null) {
                            $('#file_name').addClass('is-invalid')
                            $('#file_name-error').text(response.responseJSON.message.file_name);
                        }
                        if (response.responseJSON.message.file != null) {
                            $('#file').addClass('is-invalid')
                            $('#file-error').text(response.responseJSON.message.file);
                        }


                    }
                }); // ajax end

            })
             // Initialize Case Status select2
             $("#session_status_id").select2({
                dir: "{{ $rtl }}",
                 // minimumInputLength: 3, // only start searching when the user has input 3 or more characters
                 placeholder: "{{ __('labels.choose') }} ",
                 dropdownParent: $("#add_case_session"),
                // minimumInputLength: 3, // only start searching when the user has input 3 or more characters
                placeholder: "{{ __('labels.choose') }} ",
                ajax: {
                    url: "{{ route('sessions_status.sessionStatusListToSelect') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            search: params.term // search term
                        };
                    },
                },
                processResults: function(response) {
                    //alert(JSON.stringify(response))
                    return {
                        results: response
                    };
                },
                cache: true

            });

        });
        // Create new Session+event from modal
        $('#btn_add_case_session').click(() => {
            $('#session_libelle').removeClass('is-invalid')
            $('#session_date').removeClass('is-invalid')
            let case_id = {{ $case->id }};
            let session_id = $("#session_id").val();
            let session_status_id = $("#session_status_id").val();
            let libelle = $("#session_libelle").val();
            let description = $("#session_description").val();
            let date = $("#session_date").val();
            var $type = 'POST'
            var $url = "{{ route('cases-sessions.store') }}"
            if (session_id != 0) {
                $type = 'PUT'
                $url = "{{ route('cases-sessions.update', ['cases_session' => ':id']) }}"
                $url = $url.replace(':id', session_id)
            }
            $.ajax({
                url: $url,
                type: $type,
                data: {
                    cases_id: case_id,
                    session_libelle: libelle,
                    session_status_id: session_status_id,
                    session_date: date,
                    description: description
                },
                success: function(response) {
                    $('#add_case_session').modal('toggle');
                    refreshSessions()
                    PnotifyCustom(response)
                },
                error: function(errors) {
                    $('#session_libelle').removeClass('is-invalid')
                    $('#session_date').removeClass('is-invalid')
                    if (errors.responseJSON.message.session_date != null) {
                        $('#session_date').addClass('is-invalid')
                        $('#session_date-error').text(errors.responseJSON.message.session_date);
                    }
                    if (errors.responseJSON.message.session_libelle != null) {
                        $('#session_libelle').addClass('is-invalid')
                        $('#session_libelle-error').text(errors.responseJSON.message.session_libelle);
                    }

                }
            }); // ajax end

        })
        // Delete session + event
        function deleteFromDataTableBtn(id) {
            //  let id = $('#tbl_btn_delete').attr('data-id');

            var url = "{{ route('cases-sessions.destroy', ['cases_session' => ':id']) }}";
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
                                refreshSessions()
                                PnotifyCustom(response)


                            }
                        }); // ajax end

                    }
                });
        }
        // Delete Case Party
        function deleteFromDataTablePartyBtn(id) {
            //  let id = $('#tbl_btn_delete').attr('data-id');
            var url = "{{ route('cases_parties_datatable.destroy') }}";
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
        // Refresh sessions after edit/delete
        function refreshSessions() {
            var url = "{{ route('case_sessions.load') }}";
             //url = url.replace(':case_id', {{ $case->id }});
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    case_id: {{ $case->id }},
                },
                success: function(data) {
                    $('#session-container').empty();
                    $('#session-container').append(data);
                }
            }); // ajax end
        }

        // Delete session + event
        function deleteFile(id) {
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
                            data: {
                                id: id,
                                param: 'case_documents'
                            },
                            url: "{{ route('files.delete') }}",
                            success: function(response) {
                                console.log(response)
                                //alert(JSON.stringify(response))
                                // refresh data or remove only tr
                                $('#case-docs-table').DataTable().ajax.reload();
                                PnotifyCustom(response)


                            }
                        }); // ajax end

                    }
                });
        }

        function multipleDelete(locale) {
            var table = $('#cases-status-table').DataTable();
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
                            url: "{{ route('cases_status_datatable.multidestroy') }}",
                            data: {
                                ids: idsArr,
                            },
                            success: function(response) {

                                // refresh data or remove only tr
                                deleteSingleRowDataTable("#cases-status-table")
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

        $("#add").click(() => {
            if ($("#cp_form").valid()) { // test for validity
                $('#session_libelle').removeClass('is-invalid')
                $('#session_date').removeClass('is-invalid')
                let party_id = $("#party_id").val();
                let party_name = $("input[name=party_name]").val()
                let party_phone = $("input[name=party_phone]").val()
                let client_party = $("#type_party").val()
                let party_address = $("#party_address").val()
                let client_details = $("#client_details").val()

                var $type = 'POST'
                var $url = "{{ route('cases_parties.store') }}"
                if (party_id != 0) {
                    $type = 'PUT'
                    $url = "{{ route('cases_parties.update') }}"
                }
                $.ajax({
                    url: $url,
                    type: $type,
                    data: {
                        party_name: party_name,
                        party_phone: party_phone,
                        client_party: client_party,
                        party_address: party_address,
                        client_details: client_details,
                        case_id: {{ $case->id }},
                        id: party_id,
                    },
                    success: function(response) {
                        $('#party_name').removeClass('is-invalid')
                        $('#table-cp').DataTable().ajax.reload();
                        $('#cp_form')[0].reset()
                        $('#add').html("{{ __('inputs.btn_create_case_partie') }}")
                        PnotifyCustom(response)
                    },
                    error: function(errors) {
                        $('#party_name').addClass('is-invalid')
                        swal("{{ __('labels.swal_warning_title') }}", errors.responseJSON.message,
                            "warning");
                    }
                }); // ajax end
            }
        });

        function editCaseParty(id) {

            $.ajax({
                url: "{{ route('cases_parties.edit') }}",
                type: 'GET',
                data: {
                    id: id,
                },
                success: function(response) {
                    $("#party_id").val(response.id);
                    $("input[name=party_name]").val(response.party_name)
                    $("input[name=party_phone]").val(response.party_phone)
                    $("#type_party").val(response.client_party)
                    $("#party_address").val(response.party_adress)
                    $("#client_details").val(response.client_details)
                    $('#add').html("{{ __('inputs.btn_edit_case_partie') }}")
                },
                error: function(errors) {
                    $('#add').html("{{ __('inputs.btn_create_case_partie') }}")
                    $('#party_name').addClass('is-invalid')
                    swal("{{ __('labels.swal_warning_title') }}", errors.responseJSON.message,
                        "warning");
                }
            }); // ajax end
        }

        $('#add_case_session').on('hidden.bs.modal', function () {
            $("#session_status_id").empty().trigger('change')
           // $('#form_id')[0].reset()
           $('.modal-body').find('input:text').val('');
           $('#session_date').val('');
          })
        // Edit Session
        function editSession(id) {
            $("#session_id").val(id)
            var btn_title = "{{ __('inputs.btn_edit') }}"
            $("#btn_add_case_session").html(btn_title)
            var modal_title = "{{ __('inputs.btn_edit_case_session') }}"
            $("#modal-title").html(modal_title)
            var $url = "{{ route('cases-sessions.edit',['cases_session'=>':id']) }}"
            $url = $url.replace(':id', id)

            $.ajax({
                url: $url,
                type: 'GET',
                success: function(response) {
                    console.log(response)
                    $("#session_id").val(response.id);
                    $("#session_libelle").val(response.session_libelle)
                    $("#session_date").val( response.session_date)
                    $("#session_description").val(response.description)

                    //$('#clients_id').val(response.clients_id);
                    // Fetch the preselected item, and add to the control
                    var SessionStatusSelect = $('#session_status_id');
                    $.ajax({
                        type: 'GET',
                        url: "{{ route('session-status.statusByIdToSelect') }}",
                        data :{
                            id : response.session_status_id,
                        },
                    }).then(function(data) {
                        //alert(JSON.stringify(data))
                        // create the option and append to Select2
                        var option = new Option(data.libelle, data.id, true, true);
                        SessionStatusSelect.append(option).trigger('change');

                        // manually trigger the `select2:select` event
                        SessionStatusSelect.trigger({
                            type: 'select2:select',
                            params: {
                                data: data
                            }
                        });
                    });
                    $('#add_case_session').modal('show');
                },
                error: function(response) {
                    console.log(JSON.stringify(response.responseJSON));

                }
            }); // ajax end


        }

    </script>
@endsection
