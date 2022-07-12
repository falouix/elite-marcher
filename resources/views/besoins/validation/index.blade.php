@php

$breadcrumb = __('breadcrumb.bread_besoins_list');
$subbreadcrumb = 'المصادقة على الحاجيات';
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
        'bread_title' => $breadcrumb,
        'bread_subtitle' => $subbreadcrumb,
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
                <h5>{{ __('cards.besoins_list') }}</h5>
                <div class="card-header-right">

                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1">
                        <label> السنة المالية</label>
                        <input type="text" class="form-control" id="annee_gestion" maxlength="4" id="pin"
                            pattern="\d{4}" value="{{ strftime('%Y') }}" required />
                    </div>

                    @if (\Auth::user()->user_type == 'admin')
                        <div class="col-md-3">

                            <label for="exampleFormControlSelect1">المؤسسة/المصلحة</label>

                            <select class="js-example-basic-multiple-limit col-sm-12" multiple="multiple" id="services_id"
                                name="services_id">
                                @foreach ($services as $item)
                                    <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="col-md-3">
                            <label for="exampleFormControlSelect1">المؤسسة/المصلحة</label>
                            <select class="col-sm-12" id="services_id" name="services_id" readonly>
                                @foreach ($services as $item)
                                    <option value="{{ $item->id }}" selected>{{ $item->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="col-md-3">
                        <button class="btn btn-primary-gradient " id="btn_search_besoins" type="submit"
                            style="margin-top: 32px">
                            {{ __('inputs.btn_search') }}
                        </button>
                    </div>
                </div>

                <div class="dt-responsive table-responsive">
                    <table id="besoins-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                    class="select-checkbox not-export-col" /> </th>
                            <th class="not-export-col">id</th>
                            <th>التاريخ</th>
                            <th>المؤسسة/المصلحة</th>
                            <th>السنة المالية</th>
                            <th>المصادقة النهائية</th>
                            <th class="not-export-col">{{ $tbl_action }}</th>
                        </thead>

                        <tfoot>
                            <tr>
                                <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                        class="select-checkbox not-export-col" /> </th>
                                <th class="not-export-col">id</th>
                                <th>التاريخ</th>
                                <th>المؤسسة/المصلحة</th>
                                <th>السنة المالية</th>
                                <th>المصادقة النهائية</th>
                                <th class="not-export-col">{{ $tbl_action }}</th>
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
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- pnotify Js -->
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
    <!-- form-select-custom Js -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/pdfmake.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/vfs_fonts.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var table = $('#besoins-table').DataTable({
                dom: 'frltipB',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "{{ __('labels.all') }}"]
                ],
                buttons: [{
                        text: '{{ __('inputs.btn_copy') }}',
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: '{{ __('inputs.btn_excel') }}',
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: '{{ __('inputs.btn_pdf') }}',
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: '{{ __('inputs.btn_print') }}',
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                ],
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
                // serverSide: true,
                serverMethod: 'POST',
                ajax: {
                    url: "{{ route('besoin.datatable') }}",
                    data: function(data) {
                        if ($("#services_id").val()[0] === undefined) {
                            data.services_id = 'all';

                        } else {
                            data.services_id = $("#services_id").val()[0]
                        }
                        data.annee_gestion = $('#annee_gestion').val();
                        data.status = false;
                        data.mode = "validation";
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
                        data: "date_besoin",
                        className: "date_besoin"
                    },
                    {
                        data: "service",
                        className: "service"
                    },
                    {
                        data: "annee_gestion",
                        className: "annee_gestion"
                    },
                    {
                        data: "valide",
                        className: "valide"
                    },
                    {
                        data: 'action',
                        className: 'action',
                        visible: 'false'
                    }
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

            addSearchFooterDataTable("#besoins-table")
            $("#services_id").select2({
                dir: "{{ $rtl }}",
                maximumSelectionLength: 1,
                placeholder: "{{ __('labels.choose') }} ",

            });
        });

        // Search button click event (reload dtatable)
        $('#btn_search_besoins').on('click', (e) => {
            e.preventDefault();
            /*
            var start_date = Date.parse($('#start_date').val());
            var end_date = Date.parse($('#end_date').val());

            if (start_date > end_date) {
                var swal_title = "{{ __('labels.swal_error_title') }}"
                swal_text = "{{ __('labels.swal_error_event_star_end_date') }}"
                swal({
                    icon: 'error',
                    title: swal_title,
                    text: swal_text,
                })
                return false;
            }

            if ((isNaN(start_date) || isNaN(end_date)) == true) {
                var swal_title = "{{ __('labels.swal_error_title') }}"
                swal_text = "{{ __('labels.swal_error_event_star_end_date') }}"
                swal({
                    icon: 'error',
                    title: swal_title,
                    text: swal_text,
                })
                return false;
            }
            */
            $('#besoins-table').DataTable().ajax.reload();

        })

        function validerBesoin(id) {
            var url = "{{ route('besoins-validation.valider', ':id') }}";
            url = url.replace(':id', id);
            swal({
                    title: "المصادقة النهائية على الحاجيات",
                    text: "عند المصادقة النهائية, لايمكن تحيين أو حذف المعلومات",
                    icon: "warning",
                    buttons: ["{{ __('labels.swal_cancel_btn') }}", "نعم, تأكيد المصادقة"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal({
                                title: "أنت بصدد المصادقة النهائية على الحاجيات",
                                text: "هل تريد فعلا المصادقة؟",
                                icon: "warning",
                                buttons: ["{{ __('labels.swal_cancel_btn') }}", "نعم,أريد تأكيد المصادقة"],
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    $.ajax({
                                        type: 'PUT',
                                        dataType: 'JSON',
                                        url: url,
                                        success: function(response) {
                                            console.log(response)
                                            //alert(JSON.stringify(response))
                                            // refresh data or remove only tr
                                            //deleteSingleRowDataTable("#besoins-table")
                                            $('#besoins-table').DataTable().ajax.reload();
                                            PnotifyCustom(response)
                                        }
                                    }); // ajax end
                                }
                            });
                    }
                });
        }
    </script>
@endsection