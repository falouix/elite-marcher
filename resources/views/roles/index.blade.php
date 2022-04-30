@php
if ($locale == 'ar') {
    $name = 'name_' . $locale;
    $lang = asset('/plugins/i18n/Arabic.json');
} else {
    $name = 'name';
    $lang = '';
}
$breadcrumb = __('breadcrumb.bread_role');
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

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">

            <div class="card-header">
                <h5>{{ __('cards.role_list') }}</h5>
                @can('role-create')
                <a class="btn btn-danger float-right" href="#"> <i class="feather icon-trash-2"></i> {{ __('inputs.btn_delete') }}</a>
                @endcan
                @can('role-create')
                <a class="btn btn-primary float-right" href="{{ route('roles.create') }}"> <i class="feather icon-plus-circle"></i> {{ __('inputs.btn_create') }}</a>
                @endcan
               
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="colum-select" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th></th>
                            <th>{{ __('labels.tbl_libelle') }}</th>
                            <th >{{ __('labels.tbl_created_at') }}</th>
                            <th>{{ $tbl_action }}</th>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>

                                    <td></td>
                                    <td>{{ $role->$name }}</td>
                                    <td>{{ $role->created_at->format('Y-m-d')}}</td>
                                    <td>
                                        @can('role-edit')
                                            <a class="btn btn-icon btn-rounded btn-success" href="{{ route('roles.edit', $role->id) }}" 
                                                title="{{ __('inputs.btn_edit') }}">
                                                <i class="feather icon-edit"></i>
                                            </a>
                                        @endcan
                                        @can('role-delete')
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}

                                            <button type="submit" class="btn btn-icon btn-rounded btn-danger" title="{{ __('inputs.btn_delete') }}">
                                                <i class="feather icon-trash-2"></i>
                                            </button>
                                           
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>{{ __('labels.tbl_libelle') }}</th>
                            <th >{{ __('labels.tbl_created_at') }}</th>
                            <th>{{ $tbl_action }}</th>
                            </tr>
                        </tfoot>
                    </table>
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
    <!-- pnotify Js -->
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#colum-select').DataTable({
         
          columnDefs: [{
            orderable: true,
            className: 'select-checkbox',
            targets: 0
          }],
          language: {
            url: "{{ $lang }}"
        },
          select: {
            style: 'os',
            selector: 'td:first-child'
          }
        });
        $('.dataTables_length').addClass('bs-select');
      });
      
</script>

@endsection
