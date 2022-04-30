@php

$breadcrumb = __('breadcrumb.bread_user');
if($locale =='ar'){
    $lang = asset('/plugins/i18n/Arabic.json');
}else{
    $lang ="";
}
$tbl_action =  __('labels.tbl_action') ;


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
                    <button class="btn btn-danger float-right" id="btn_delete"> 
                        <i class="feather icon-trash-2"></i>
                        {{ __('inputs.btn_delete') }} 
                        <i id="btn_count"></i>
                    </button>
                @endcan
                @can('user-create')
                    <a class="btn btn-primary float-right" href="{{ route('users.create') }}"> <i
                            class="feather icon-plus-circle"></i> {{ __('inputs.btn_create') }}</a>
                @endcan

            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="users-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th style="width: 30px"><input type="checkbox" class="select-checkbox"/> </th>
                            <th>id</th>
                            <th>{{ __('labels.tbl_qin') }}</th>
                            <th>{{ __('labels.tbl_name') }}</th>
                            <th>{{ __('labels.tbl_email') }}</th>
                            <th>{{ __('labels.tbl_phone') }}</th>
                            <th>{{ __('labels.tbl_role') }}</th>
                            <th>{{ __('labels.tbl_created_at') }}</th>
                            <th>{{ $tbl_action }}</th>
                        </thead>
                     
                        <tfoot>
                            <tr>
                                <th style="width: 30px"></th> 
                                <th>id</th>  
                                 <th>{{ __('labels.tbl_qin') }}</th>
                                <th>{{ __('labels.tbl_name') }}</th>
                                <th>{{ __('labels.tbl_email') }}</th>
                                <th>{{ __('labels.tbl_phone') }}</th>
                                <th>{{ __('labels.tbl_role') }}</th>
                                <th>{{ __('labels.tbl_created_at') }}</th>
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

    <script>
        
        $(document).ready(function() {
              $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 
            var table = $('#users-table').DataTable({
                //dom: 'Bfrtip',
                initComplete: function () {
                    // Apply the search
                    this.api().columns().every( function () {
                        var that = this;
         
                        $( 'input', this.footer() ).on( 'keyup change clear', function () {
                            if ( that.search() !== this.value ) {
                                that
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } );
                },
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ $lang }}"
                },    
                serverMethod: 'get',
                ajax: {
                    url:"{{ route('datatables.data') }}"
                },
                language: {
                    url: "{{ $lang }}"
                },  
                columns: [
                    {data : "select", className : "select-checkbox"},
                    {data : "id", className : "id"},
                    {data: "qin", className: 'qin'},
                    {data: "name", className: 'name'},
                    {data: "email", className: 'email'},
                    {data: "phone_num", className: 'phone_num'},  
                    {data: "role", className: 'role'},                  
                    {data: "created_at", className: 'created_at'},
                    {data: 'action', className: 'action', visible : 'false'},                 
                ],              
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                },
                {
                    visible: false,
                    targets: 1
                }],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
               // select: { style: 'multi+shift' },
                
            });
            table
        .on( 'select', function ( e, dt, type, indexes ) {
           // var rowData = table.rows( indexes ).data().toArray();
           //console.log( rowData );
            $("#btn_count").html('('+  table.rows('.selected').data().length+')')
        } )
        .on( 'deselect', function ( e, dt, type, indexes ) {
          //  $("#btn_count").html('('+indexes.count()+')')
          $("#btn_count").html('')
          if(table.rows('.selected').data().length >0){
            $("#btn_count").html('('+  table.rows('.selected').data().length+')')
          }
        } );

            $('.dataTables_length').addClass('bs-select');

            // Setup - add a text input to each footer cell
    $('#users-table tfoot th').each( function () {
        console.log($(this).text());
        var title = $(this).text();
        if(title ==  "{{ $tbl_action }}" || title ==''){
            
        } else {
            $(this).html( '<input type="text" class="form-control" placeholder="'+title+'" />' );
        }      
    } );
        });

   // var table = $('#users-table').DataTable();
    function getselectedIds(){
        
        var ids = table.rows('.selected').data();
        ids.each(()=>{
            console.log(JSON.stringify(ids.name))
        })
        
    }
    function deleteBtnAppend(count){

    }
    </script>
@endsection
