@extends('layouts.app')
@section('page_title')
    {{ __('app.home_page') }}
@endsection

@section('head-script')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('/plugins/data-tables/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/data-tables/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/notification/css/notification.min.css') }}">
    <!-- pnotify css -->
    <link rel="stylesheet" href="{{ asset('/plugins/pnotify/css/pnotify.custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/pages/pnotify.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/animation/css/animate.min.css') }}">
@endsection
@section('content')
    <!-- [ sample-page ] start -->
    <div class="col-md-12">
        <div class="row">
            <!-- [ shadows ] start -->
            <div class="col-md-12">
                @if ($besoins_actif)
                    <div class="shadow-lg p-3 mb-1 bg-white rounded" style="text-align:center;">
                        <span style="color:rgb(231, 29, 29); font-weight:bold; font-size:20px;">بلاغ حول ضبط الحاجيات</span>
                        </br>
                        <span style="color:rgb(27, 25, 25); font-weight:bold; font-size:18px;"> تم تحديد آجال ضبط الحاجيات
                            لسنة {{ strftime('%Y') }} بداية من {{ $paramBesoin->date_debut }} إلى
                            غاية {{ $paramBesoin->date_fin }}</span>
                    </div>
                @endif
            </div>
            <!-- [ shadows ] end -->
        </div>
        @can('dashboard-list')
            <div class="row mt-3">
                <!-- [ cards ] start -->

                <!-- [ Statistics ] Start-->
                <!-- [ Calendar ] Start-->
                @can('dossiers-list')
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>ملفات الشراءات</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">طبيعة الطلب</label>
                                            <select class="form-control" id="type_demande">
                                                <option value="all">الكل</option>
                                                <option value="1">مواد وخدمات</option>
                                                <option value="2">أشغال</option>
                                                <option value="3">دراسات</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">وضعية الملف</label>
                                            <select class="form-control" id="situation_dossier" name="situation_dossier">
                                                <option value="all">الكل</option>
                                                <option value="1">بصدد الإعداد</option>
                                                <option value="2">في انتظار العروض</option>
                                                <option value="3">في الفرز</option>
                                                <option value="4">بصدد الإنجاز</option>
                                                <option value="5">القبول الوقتي</option>
                                                <option value="6">القبول النهائي</option>
                                                <option value="7">ملف منتهي </option>
                                                <option value="8">ملغى</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <button class="btn btn-primary-gradient " id="btn_search_projets" type="submit"
                                            style="margin-top: 32px">
                                            {{ __('inputs.btn_search') }}
                                        </button>
                                    </div>
                                </div>

                                <div class="dt-responsive table-responsive">

                                    <table id="table-cp" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                                    class="select-checkbox not-export-col" /> </th>
                                            <th class="not-export-col"> </th>
                                            <th>ملف عدد</th>
                                            <th>وضعية الملف</th>
                                            <th>الموضوع</th>
                                            <th>الإطار</th>
                                            <th>مشروع عدد</th>
                                            <th>جهة التمويل</th>
                                            <th>طريقة التمويل</th>
                                            <th>طبيعة الأسعار</th>
                                            <th>الكلفة التقديرية</th>
                                            <th>تاريخ الختم</th>
                                            <th class="not-export-col">قرار</th>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                                        class="select-checkbox not-export-col" /> </th>
                                                <th class="not-export-col"> </th>
                                                <th>ملف عدد</th>
                                                <th>وضعية الملف</th>
                                                <th>الموضوع</th>
                                                <th>الإطار</th>
                                                <th>مشروع عدد</th>
                                                <th>جهة التمويل</th>
                                                <th>طريقة التمويل</th>
                                                <th>طبيعة الأسعار</th>
                                                <th>الكلفة التقديرية</th>
                                                <th>تاريخ الختم</th>
                                                <th class="not-export-col">قرار</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan

                <!-- [ cards ] end -->
                <div class="col-md-6">

                    <div class="row">
                        @can('statistic-list')
                            <!-- [ clients_count ] start -->
                            <div class="col-md-4">
                                <div class="card ticket-card">
                                    <div class="card-body">
                                        <p class="m-b-25 bg-c-green lbl-card"><i class="fas fa-folder-open m-r-5"></i>
                                            ملفات بصدد الإنجاز</p>
                                        <div class="text-center">
                                            <h2 class="m-b-0 d-inline-block text-c-green">{{ $count_dossiersEncours }}</h2>
                                            <p class="m-b-0 d-inline-block"> ملف</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ clients_count ] end -->
                            <!-- [ session_count ] start -->
                            <div class="col-md-4">
                                <div class="card ticket-card">
                                    <div class="card-body">
                                        <p class="m-b-25 bg-c-blue lbl-card"><i class="fas fa-file-archive m-r-5"></i>
                                            الملفات المنجزة
                                        </p>
                                        <div class="text-center">
                                            <h2 class="m-b-0 d-inline-block text-c-blue">{{ $count_dossiersFini }}</h2>
                                            <p class="m-b-0 d-inline-block"> ملف</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ session_count ] end -->
                            <!-- [ cases_count ] start -->
                            <div class="col-md-4">
                                <div class="card ticket-card">
                                    <div class="card-body">
                                        <p class="m-b-25 bg-c-red lbl-card"><i class="fas fa-folder-minus m-r-5"></i>
                                            الملفات الملغاة
                                        </p>
                                        <div class="text-center">
                                            <h2 class="m-b-0 d-inline-block text-c-red">{{ $count_dossiersAnnuler }}</h2>
                                            <p class="m-b-0 d-inline-block">ملف</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ cases_count ] end -->
                            <!-- [ total_payment_expenses ] end -->
                            <!-- [ statistics_payement_incomes ] start -->
                            <div class="col-xl-12 col-md-12">
                                <div class="card table-card">
                                    <div class="card-header borderless">
                                        <h5>ملفات الشراءات حسب الوضعية ونوع الطلب</h5>
                                    </div>
                                    <div class="card-body px-0 py-0">
                                        <div class="table-responsive">
                                            <div class="revenue-scroll ps ps--active-y" style="height:415px;position:relative;">
                                                <table class="table table-hover mb-0">
                                                    <th>وضعية الملف</th>
                                                    <th>العدد</th>
                                                    <tbody>
                                                        <tr>
                                                            <td><i class="fas fa-caret-left text-c-green f-20">الإستشارات</i></td>
                                                            <td> </td>
                                                        </tr>
                                                        @foreach ($count_dossiersGroupedConsultation as $item)
                                                            <tr>
                                                                <td>
                                                                    {!! App\Common\Utility::getSituationDossierLabel($item->situation_dossier) !!}
                                                                </td>
                                                                <td>
                                                                    <h6 class="text-c-green">{{ $item->totalBySituation }}</h6>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td><i class="text-c-green f-20">طلبات العروض</i></td>
                                                            <td> </td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="fas fa-caret-left text-c-green f-20">إجراءات مبسطة</i>
                                                            </td>
                                                            <td> </td>
                                                        </tr>
                                                        @foreach ($count_dossiersGroupedAos as $item)
                                                            <tr>
                                                                <td>
                                                                    {!! App\Common\Utility::getSituationDossierLabel($item->situation_dossier) !!}
                                                                </td>
                                                                <td>
                                                                    <h6 class="text-c-green">{{ $item->totalBySituation }}</h6>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td><i class="fas fa-caret-left text-c-green f-24">إجراءات عادية</i>
                                                            </td>
                                                            <td> </td>
                                                        </tr>
                                                        @foreach ($count_dossiersGroupedAon as $item)
                                                            <tr>
                                                                <td>
                                                                    {!! App\Common\Utility::getSituationDossierLabel($item->situation_dossier) !!}
                                                                </td>
                                                                <td>
                                                                    <h6 class="text-c-green">{{ $item->totalBySituation }}</h6>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td><i class="fas fa-caret-left text-c-green f-24">التفاوض المباشر</i>
                                                            </td>
                                                            <td> </td>
                                                        </tr>
                                                        @foreach ($count_dossiersGroupedGreGre as $item)
                                                            <tr>
                                                                <td>
                                                                    {!! App\Common\Utility::getSituationDossierLabel($item->situation_dossier) !!}
                                                                </td>
                                                                <td>
                                                                    <h6 class="text-c-green">{{ $item->totalBySituation }}</h6>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                <div class="ps__rail-x" style="left: 0px; bottom: -450px;">
                                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                </div>
                                                <div class="ps__rail-y" style="top: 450px; height: 415px; right: 0px;">
                                                    <div class="ps__thumb-y" tabindex="0" style="top: 216px; height: 199px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endcan

                    </div>
                    <!-- [ row 2 ] end -->
                </div>
            </div>
            <div class="row">
                <!-- [ statistics_incomes ] end -->
                @if (\Auth::user()->can('dossiers-list') || \Auth::user()->can('statistic-list'))
                    @component('components.notifs_home', ['col' => '12'])
                    @endcomponent
                @endif
            </div>
        @endcan


    </div>
@endsection

@section('srcipt-js')
    <!-- datatable Js -->
    <script src="{{ asset('/plugins/notification/js/bootstrap-growl.min.js') }}"></script>
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/pdfmake.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/vfs_fonts.js') }}"></script>
    <!-- Vue JS AXIOS -->
    <script src="{{ asset('/js/vue.js') }}"></script>
    <script src="{{ asset('/js/axios.min.js') }}"></script>
    <script src="{{ asset('/js/vue-axios.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            window.axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#annee_gestion').val($('#g_annee_gestion').val())
            var table = $('#table-cp').DataTable({
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
                scrollY: true,
                scrollX: true,
                scrollCollapse: true,
                //paging: false,
                fixedColumns: {
                    leftColumns: 0,
                    rightColumns: 1
                },
                initComplete: function() {
                    // Apply the search
                    this.api().columns().every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear',
                            function() {
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
                    url: "{{ route('dossiers.data') }}",
                    data: function(data) {
                        data.annee_gestion = $('#g_annee_gestion').val()

                        data.situation_dossier = $('#situation_dossier').val()
                        data.type_demande = $('#type_demande').val()
                        data.type_dossier = 'all'
                    },
                },
                deferRender: true,
                language: {
                    url: "{{ asset('/plugins/i18n/Arabic.json') }}"
                },
                columns: [{
                        data: "select",
                        className: "select-checkbox"
                    },
                    {
                        data: "id",
                        className: "id",
                    },
                    {
                        data: "code_dossier",
                        className: "code_dossier"
                    },
                    {
                        data: "situationDA",
                        className: "situationDA"
                    },
                    {
                        data: "objet_dossier",
                        className: "objet_dossier"
                    },
                    {
                        data: "type_demandeL",
                        className: "type_demandeL"
                    },
                    {
                        data: "code_projet",
                        className: "code_projet"
                    },
                    {
                        data: "organisme_financier",
                        className: "organisme_financier"
                    },
                    {
                        data: "source_financeL",
                        className: "source_financeL"
                    },
                    {
                        data: "nature_financeL",
                        className: "nature_financeL"
                    },
                    {
                        data: "total_ttc",
                        className: "total_ttc"
                    },
                    {
                        data: "date_cloture",
                        className: "date_cloture"
                    },
                    {
                        data: 'dashboard_action',
                        className: 'action',
                        visible: 'false'
                    }
                ],
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
            addSearchFooterDataTable("#table-cp")
            document.addEventListener('DOMContentLoaded', function() {
                if (Notification.permission !== "granted") {
                    Notification.requestPermission();
                }
            });

            /*[ incomeing-scroll ] start
                var px = new PerfectScrollbar('.incomeing-scroll', {
                    wheelSpeed: .5,
                    swipeEasing: 0,
                    wheelPropagation: 1,
                    minScrollbarLength: 40,
                });


                $.ajax({
                    url: "{{ route('notifs.desktop') }}",
                    type: 'POST',
                    success: function(response) {
                       // alert(response.notifsRappelCount)
                        showNotifG(response.notifsRappelCount, response.notifsValidationCount, response.notifsMessageCount)
                    },
                    error: function(errors) {
                    }
                }); // ajax end
    */


        });
        // Search button click event (reload dtatable)
        $('#btn_search_projets').on('click', (e) => {
            e.preventDefault();
            // var annee_gestion = $('#annee_gestion').val();
            $('#table-cp').DataTable().ajax.reload();
        })
    </script>
@endsection
