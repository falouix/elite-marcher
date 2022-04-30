@php

$breadcrumb = __('breadcrumb.bread_user');
$lang ="https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json";

@endphp

@extends('layouts.app')
@section('head-script')

    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('/plugins/data-tables/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/data-tables/css/select.dataTables.min.css') }}">
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
                @can('user-create')
                    <a class="btn btn-danger float-right" href="#"> <i class="feather icon-trash-2"></i>
                        {{ __('inputs.btn_delete') }}</a>
                @endcan
                @can('user-create')
                    <a class="btn btn-primary float-right" href="{{ route('users.create') }}"> <i
                            class="feather icon-plus-circle"></i> {{ __('inputs.btn_create') }}</a>
                @endcan

            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    {!! $dataTable->table([], true) !!}

                  
                </div>
            </div>
        </div>
    </div>
    <!-- Column Selector table end -->


@endsection
@section('srcipt-js')
    <!-- datatable Js -->
    <script src="{{ asset('/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/dataTables.select.min.js') }}"></script>
  {!! $dataTable->scripts() !!}

@endsection
