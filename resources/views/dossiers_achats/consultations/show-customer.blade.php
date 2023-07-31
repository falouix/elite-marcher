@php

    $breadcrumb = 'الإستشارات';
    $subreadcrumb = 'عرض تفاصيل الإستشارة';

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
        'bread_subtitle' => $subreadcrumb,
    ])
@endsection

@section('content')
    <div class="col-xl-4 col-lg-12 task-detail-right">
        <div class="card">
            <div class="card-body bg-c-blue">
                <div class="counter text-center">
                    <h4 id="timer" class="text-white m-0">
                        <i class="fas fa-gavel" style="font-size: 30px; color:white"></i>
                        إستشارة عدد : {{ $dossier->code_dossier }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>وضعية الملف</h5>

                <div class="card-header-right">
                    {!! App\Common\Utility::getSituationDossierLabel($dossier->situation_dossier) !!}
                </div>
            </div>
            <div class="card-body task-details">

                <div class="pl-0">
                    <div class="main-profile-overview">

                        <div class=" justify-content-between ">

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td style="padding: 0.3rem; border-top:white;">
                                            <h6> السنة المالية </h6>
                                        </td>
                                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                            {{ $dossier->annee_gestion }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <hr class="mg-y-20">
                            <h6>الموضوع </h6>
                            <div class="main-profile-social-list">

                                <div class="media">
                                    <p style="line-height: 27px">
                                        {{ $dossier->objet_dossier }}
                                    </p>
                                </div>
                            </div>

                        </div>

                        <hr class="mg-y-20">
                        <h6>المتعهد</h6>
                        <hr class="mg-y-20">
                        <div class=" justify-content-between ">

                            <table class="table">

                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>{{ __('labels.tbl_client_name') }} </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">

                                        {{ $client->libelle ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>
                                            المعرف :

                                        </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                        {{ $client->matricule_fiscale ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>
                                            {{ __('labels.tbl_client_phone') }} :

                                        </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                        {{ $client->tel_fax ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>
                                            {{ __('labels.tbl_email_abr') }} :
                                        </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                        {{ $client->email ?? '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 0.3rem; border-top:white;">
                                        <h6>
                                            {{ __('labels.tbl_client_adress') }} :
                                        </h6>
                                    </td>
                                    <td class="text-right" style="padding: 0.3rem; border-top:white;">
                                        {{ $client->adresse ?? '' }}
                                    </td>
                                </tr>

                            </table>
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
                        <a href="#" class="text-secondary">تفاصيل الإستشارة</a>
                        <div class="card-header-right">
                            <a href="{{ route('consultations.index') }}" class="btn btn-secondary">
                                العودة لقائمة الإستشارات
                                <i class="feather icon-corner-down-left"></i>
                            </a>

                        </div>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="contenu-tab" data-toggle="tab" href="#contenu"
                                role="tab" aria-controls="contenu" aria-selected="true"><i
                                    class="fas fa-business-time m-2"></i>محتوى الإستشارة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="cahiercharges-tab" data-toggle="tab"
                                href="#cahiercharges" role="tab" aria-controls="cahiercharges" aria-selected="false"><i
                                    class="fas fa-file-alt m-2"></i>كراس الشروط</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="docs-tab" data-toggle="tab" href="#docs"
                                role="tab" aria-controls="docs" aria-selected="false"><i
                                    class="fas fa-file-alt m-2"></i>الوثائق و الملفات</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        {{-- contenu consultation start --}}
                        <div class="tab-pane fade show active" id="contenu" role="tabpanel" aria-labelledby="contenu-tab">
                            <div class="col-md-12">

                                <table id="ligneConsultation-table" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                                class="select-checkbox not-export-col" /> </th>
                                        <th class="not-export-col"></th>
                                        <th>المادة</th>
                                        <th>الكمية </th>
                                        <th>الكلفة التقديرية للوحدة</th>
                                        <th>الكلفة التقديرية الجملية</th>

                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                                    class="select-checkbox not-export-col" /> </th>
                                            <th class="not-export-col"></th>
                                            <th>المادة</th>
                                            <th>الكمية </th>
                                            <th>الكلفة التقديرية للوحدة</th>
                                            <th>الكلفة التقديرية الجملية</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        {{-- contenu consultation end --}}
                        {{-- Cahier Charges Tab start --}}
                        <div class="tab-pane fade" id="cahiercharges" role="tabpanel"
                            aria-labelledby="cahiercharges-tab">
                            <div class="col-md-12"> <br>
                                @php
                                    $cahiers_charges = $dossier->cahiers_charges;
                                @endphp

                                <div class="form-row">
                                    <input type="number" name="cahiers_charges_id" id="cahiers_charges_id"
                                        value="0" hidden>
                                    <div class="form-group col-md-6">
                                        <label>تاريخ اعتزام نشر الإعلان :</label>
                                        <input type="date" class="form-control" id='date_pub_prevu'
                                            name="date_pub_prevu" placeholder="أدخل التاريخ"
                                            value='{{ $cahiers_charges->date_pub_prevu ?? '' }}' readonly>
                                        <label id="date_pub_prevu-error"
                                            class="error jquery-validation-error small form-text invalid-feedback"
                                            for="date_pub_prevu"></label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>ثمن اقتناء كراس الشروط :</label>
                                        <input class="form-control" type="number" min=0 max=99999999999,999
                                            id="prix_cc" name="prix_cc" value='{{ $cahiers_charges->prix_cc ?? '' }}'>
                                        <label id="date_pub_prevu-error"
                                            class="error jquery-validation-error small form-text invalid-feedback"
                                            for="date_pub_prevu"></label>
                                    </div>







                                    **





















                                    99999999999999996

                                    <div class="form-vvvvv     vgroup col-md-6">
                                        <label>طري1 cقة قبول العروض :</label>
                                        <select class="form-control" id="type_reception" name="type_reception">
                                            <option value="1"
                                                {{ $cahiers_charges != null && $cahiers_charges->type_reception == 1 ? 'selected' : '' }}>
                                                منظومة الشراءات على الخط</option>
                                            <option value="2"
                                                {{ $cahiers_charges != null && $cahiers_charges->type_reception == 2 ? 'selected' : '' }}>
                                                مكتب الضبط </option>
                                            <option value="3"
                                                {{ $cahiers_charges != null && $cahiers_charges->type_reception == 3 ? 'selected' : '' }}>
                                                البريد </option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>طريقة فتح الظروف :</label>
                                        <select class="form-control" id="type_overture_plis" name="type_overture_plis">
                                            <option value="1"
                                                {{ $cahiers_charges != null && $cahiers_charges->type_overture_plis == 1 ? 'selected' : '' }}>
                                                مالية علنية </option>
                                            <option value="2"
                                                {{ $cahiers_charges != null && $cahiers_charges->type_overture_plis == 2 ? 'selected' : '' }}>
                                                مالية وفنية علنية</option>
                                            <option value="3"
                                                {{ $cahiers_charges != null && $cahiers_charges->type_overture_plis == 3 ? 'selected' : '' }}>
                                                مالية وفنية غير علنية</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>مدة الضمان الوقتي :</label>
                                        <input type="number" class="form-control" id="duree_caution_prov"
                                            name="duree_caution_prov" min=0 max=999
                                            value="{{ $cahiers_charges->duree_caution_prov ?? '' }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>قيمة الضمان الوقتي :</label>
                                        <input type="number" class="form-control" id="caution_prov" name="caution_prov"
                                            min=1,000 max=99999999999,999
                                            value="{{ $cahiers_charges->caution_prov ?? '' }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>مدة الضمان النهائي :</label>
                                        <input type="number" class="form-control" id="duree_caution_def" min=0 max=999
                                            value="{{ $cahiers_charges->duree_caution_def ?? '' }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>نسبة الضمان النهائي :</label>
                                        <input type="number" class="form-control" id="caution_def" name="caution_def"
                                            min=1 max=99 value="{{ $cahiers_charges->caution_def ?? '' }}">
                                        <label id="caution_def-error"
                                            class="error jquery-validation-error small form-text invalid-feedback"
                                            for="caution_def"></label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>مدة الإنجاز باليوم : </label>
                                        <input class="mb-3 form-control form-control-lg" type="number"
                                            id="duree_travaux" name="duree_travaux" min=1 max=999
                                            value="{{ $cahiers_charges->duree_travaux ?? '' }}">
                                        <label id="duree_travaux-error"
                                            class="error jquery-validation-error small form-text invalid-feedback"
                                            for="duree_travaux"></label>
                                    </div>
                                </div>

                                <div class="dt-responsive table-responsive">
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="documents" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <th></th>
                                                    <th></th>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- Cahier Charges Tab end --}}
                        {{-- docs Tab start --}}
                        <div class="tab-pane fade" id="offres" role="tabpanel" aria-labelledby="offres-tab">
                            <div class="col-md-12"> <br>
                                <div class="dt-responsive table-responsive">
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="offres-table" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                                            class="select-checkbox not-export-col" /> </th>
                                                    <th class="not-export-col"></th>

                                                    <th>تاريخ الوصول</th>
                                                    <th>مرجع العرض</th>
                                                    <th>عدد التسجيل بمكتب الضبط</th>
                                                    <th>تاريخ التسجيل</th>
                                                    <th>وصول العرض عن طريق</th>
                                                    <th>عدد الأقساط</th>
                                                    <th>الثمن</th>
                                                    <th>المتعهد</th>
                                                    <th>قرار لجنة فتح الظروف</th>
                                                    <th>قرار اللجنة الفنية</th>
                                                    <th>الملاحظات</th>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- docs Tab end --}}

                    </div>

                </div>
            </div>

        </div>
    </div>
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

            //Consultation Datatable
            var table = $('#ligneConsultation-table').DataTable({
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
                    url: "{{ route('lignes-dossier.data') }}",
                    data: function(data) {
                        data.dossiers_id = "{{ $dossier->id }}";
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
                        e
                        data: "id",
                        className: "id"
                    },
                    {
                        data: "libelle",
                        className: "libelle"
                    },
                    {
                        data: "qte",
                        className: "qte"
                    },
                    {
                        data: "cout_unite_ttc",
                        className: "cout_unite_ttc"
                    },
                    {
                        data: "cout_total_ttc",
                        className: "cout_total_ttc"
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
                    SelectedRowCountBtnDelete(table)
                })
                .on('deselect', function(e, dt, type, indexes) {
                    SelectedRowCountBtnDelete(table)
                });

            $('.dataTables_length').addClass('bs-select');

            // Setup - add a text input to each footer cell

            addSearchFooterDataTable("#ligneConsultation-table")

            //Offres Datatable
            var offres_table = $('#offres-table').DataTable({
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
                    url: "{{ route('dossiers.offres.data') }}",
                    data: function(data) {
                        data.dossiers_id = "{{ $dossier->id }}";
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
                        data: "date_arrive",
                        className: "date_arrive"
                    },
                    {
                        data: "ref_offre",
                        className: "ref_offre"
                    },
                    {
                        data: "ref_bo",
                        className: "ref_bo"
                    },
                    {
                        data: 'date_enregistrement',
                        className: 'date_enregistrement',
                    },
                    {
                        data: "source_offre",
                        className: "source_offre"
                    },
                    {
                        data: "nbr_lots",
                        className: "nbr_lots"
                    },
                    {
                        data: 'prix_offre',
                        className: 'prix_offre',
                    },
                    {
                        data: 'soumissionaire_id',
                        className: 'soumissionaire_id',
                    },
                    {
                        data: 'decision_op',
                        className: 'decision_op',
                    },
                    {
                        data: 'decision_technique',
                        className: 'decision_technique',
                    },
                    {
                        data: 'observations',
                        className: 'observations',
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
            offres_table
                .on('select', function(e, dt, type, indexes) {
                    SelectedRowCountBtnDelete(table)
                })
                .on('deselect', function(e, dt, type, indexes) {
                    SelectedRowCountBtnDelete(table)
                });

            $('.dataTables_length').addClass('bs-select');

            // Setup - add a text input to each footer cell

            addSearchFooterDataTable("#offres-table")


            var table = [
                ['الشروط الإدارية', ''],
                ['الفنية', '']
            ];
            $("#documents").DataTable({
                data: dossiers.cc - docs.data,
                columns: [{

                    title: 'الوثائق المكونة لكراس الشروط'
                }],
                language: {
                    url: "{{ $lang }}"
                }

            });


            //Offres Datatable
            var offres_table = $('#documents').DataTable({
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
                    url: "{{ route('dossiers.cc-docs.data') }}",
                    data: function(data) {
                        data.idCC = "{{ $cahiers_charges->id ?? 0 }}";
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
                        data: "libelle",
                        className: "libelle"
                    },
                    {
                        data: 'action',
                        className: 'action',
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
            offres_table
                .on('select', function(e, dt, type, indexes) {
                    SelectedRowCountBtnDelete(table)
                })
                .on('deselect', function(e, dt, type, indexes) {
                    SelectedRowCountBtnDelete(table)
                });

            $('.dataTables_length').addClass('bs-select');

            // Setup - add a text input to each footer cell

            addSearchFooterDataTable("#offres-table")



        });



        $("#docs-table").DataTable({
            language: {
                url: "{{ asset('/plugins/i18n/Arabic.json') }}"
            }
        });
        $("#ordres-table").DataTable({
            language: {
                url: "{{ asset('/plugins/i18n/Arabic.json') }}"
            }
        });
    </script>
@endsection
