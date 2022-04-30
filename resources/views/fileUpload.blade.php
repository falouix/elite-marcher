@php

$breadcrumb = __('breadcrumb.bread_user');
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
@endsection

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', [
    'bread_title'=> $breadcrumb,
    'bread_subtitle'=> $breadcrumb
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
                <h5>{{ __('cards.user_list') }}</h5>
                <div class="card-header-right">
                    @can('user-delete')
                        <button class="btn btn-danger " id="btn_delete" onclick='return multipleDelete("{{ $locale }}");'>
                            <i class="feather icon-trash-2"></i>
                            {{ __('inputs.btn_delete') }}
                            <i id="btn_count"></i>
                        </button>
                    @endcan
                    @can('user-create')
                        <a class="btn btn-primary" href="{{ route('users.create') }}"> <i
                                class="feather icon-plus-circle"></i> {{ __('inputs.btn_create_user') }}</a>
                    @endcan
                </div>

            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('file.upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-10">
                        <input type="file" name="file" class="form-control">
                    </div>
         
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Column Selector table end -->


@endsection
@section('srcipt-js')
    <!-- datatable Js -->
    <script src="{{ asset('/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/dataTables.select.min.js') }}"></script>
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- pnotify Js -->
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>

@endsection
