@php

    $breadcrumb = __('breadcrumb.bread_services_list');
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
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
@endsection

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', [
        'bread_title' => 'إعدادات ',
        'bread_subtitle' => 'إعدادات المدد',
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
                <h5>إعدادات المدد</h5>
                <div class="card-header-right">
                    @can('besoins-list')
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="date-cc_prvu">طبيعة الملف </label>
                        <select class="form-control">
                            <option>إستشارة</option>
                            <option>طلب عرض</option>
                        </select>
                        @if ($errors->has('date_cc_prvu'))
                            <span class="text-danger">{{ $errors->first('date_cc_prvu') }}</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <h4>المدة التقديرية(باليوم) ل :</h4>
                    <div class="row">
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="date-cc_prvu"> إعداد كراس الشروط </label>
                                <input type="number" value="{{ $periodes[0]->periode_cc_prvu }}" class="form-control"
                                    id='periode_cc_prvu' name="periode_cc_prvu" placeholder="أدخل المدة">
                                @if ($errors->has('date_cc_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_cc_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="date-date_avis_prvu">الإعلان عن المنافسة </label>
                                <input type="number" value="{{ $periodes[0]->periode_avis_prvu }}" class="form-control"
                                    id='periode_avis_prvu' name="periode_avis_prvu" placeholder="أدخل المدة">
                                @if ($errors->has('date_avis_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_avis_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="date-periode_op_prvu"> فتح العروض </label>
                                <input type="number" value="{{ $periodes[0]->periode_op_prvu }}" class="form-control"
                                    id='periode_op_prvu' name="periode_op_prvu" placeholder="أدخل المدة">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="date-date_op_prvu">تعهد لجنة الشراءات بالملف</label>
                                <input type="number" value="{{ $periodes[0]->periode_trsfert_ca_prvu }}"
                                    class="form-control" id='periode_trsfert_ca_prvu' name="periode_trsfert_ca_prvu"
                                    placeholder="أدخل المدة">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="date-date_op_prvu">إحالة الملف على لجنة الصفقات</label>
                                <input type="number" value="{{ $periodes[0]->periode_trsfert_cao_prvu }}"
                                    class="form-control" id='periode_trsfert_cao_prvu' name="periode_trsfert_cao_prvu"
                                    placeholder="أدخل المدة">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> إجابة لجنة الصفقات </label>
                                <input type="number" value="{{ $periodes[0]->periode_repca_prvu }}" class="form-control"
                                    id='periode_repca_prvu' name="periode_repca_prvu" placeholder="أدخل المدة">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> نشر نتائج المنافسة </label>
                                <input type="number" value="{{ $periodes[0]->periode_pub_reslt_prvu }}"
                                    class="form-control" id='periode_pub_reslt_prvu' name="periode_pub_reslt_prvu"
                                    placeholder="أدخل المدة">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> لتبليغ الصفقة</label>
                                <input type="number" value="{{ $periodes[0]->periode_avis_soumissionaire_prvu }}"
                                    class="form-control" id='periode_avis_soumissionaire_prvu'
                                    name="periode_avis_soumissionaire_prvu" placeholder="أدخل المدة">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label for="date-date_op_prvu"> لبداية الإنجاز </label>
                                <input type="number" value="{{ $periodes[0]->periode_ordre_serv_prvu }}"
                                    class="form-control" id='periode_ordre_serv_prvu' name="periode_ordre_serv_prvu"
                                    placeholder="أدخل المدة">
                                @if ($errors->has('date_op_prvu'))
                                    <span class="text-danger">{{ $errors->first('date_op_prvu') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="mt-12">
                <button type="button" id="btn_create" class="btn btn-primary" style="float: right;">
                    <i class="feather icon-client-plus"></i>
                    حفض
                </button>
                <a href="{{ route('besoins.index') }}" class="btn btn-danger" style="float: left;">
                    <i class="feather icon-minus-circle"></i>
                    {{ __('inputs.btn_cancel') }}
                </a>
            </div>
        </div>
    </div>
    <!-- Column Selector table end -->
    <!-- Modal Create or edit status -->
    <div class="modal fade show" id="add_service" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
        style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"> {{ __('modals.service_modal') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_id">
                        <input type="text" name="service_id" id="service_id" value="0" hidden>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="lbl_libelle"> {{ __('labels.tbl_libelle') }} </label>
                                <input type="text" class="form-control" id='libelle' name="libelle"
                                    placeholder="{{ __('labels.tbl_libelle') }}" required>
                                <label id="libelle-error"
                                    class="error jquery-validation-error small form-text invalid-feedback"
                                    for="libelle"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="lbl_contact"> {{ __('labels.tbl_contact') }} </label>
                                <input type="text" class="form-control" id='contact' name="contact"
                                    placeholder="{{ __('labels.tbl_contact') }}" required>
                                <label id="contact-error"
                                    class="error jquery-validation-error small form-text invalid-feedback"
                                    for="contact"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="lbl_responsable"> {{ __('labels.tbl_responsable') }} </label>
                                <input type="text" class="form-control" id='responsable' name="responsable"
                                    placeholder="{{ __('labels.tbl_responsable') }}" required>
                                <label id="responsable-error"
                                    class="error jquery-validation-error small form-text invalid-feedback"
                                    for="responsable"></label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('inputs.btn_close') }}</button>
                    <button class="btn btn-primary" id='btn_add_service'> {{ __('inputs.btn_create') }}
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Create or edit status end-->
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


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                $('#btn_create').on('click', function() {
                    var data = {
                        'periode_cc_prvu': $('#periode_cc_prvu').val(),
                        'periode_avis_prvu': $('#periode_avis_prvu').val(),
                        'periode_op_prvu': $('#periode_op_prvu').val(),
                        'periode_trsfert_ca_prvu': $('#periode_trsfert_ca_prvu').val(),
                        'periode_trsfert_cao_prvu': $('#periode_trsfert_cao_prvu').val(),
                        'periode_repca_prvu': $('#periode_repca_prvu').val(),
                        'periode_pub_reslt_prvu': $('#periode_pub_reslt_prvu').val(),
                        'periode_avis_soumissionaire_prvu': $('#periode_avis_soumissionaire_prvu')
                            .val(),
                        'periode_ordre_serv_prvu': $('#periode_ordre_serv_prvu').val(),
                    }
                })
            });
        });




        function editService(id) {
            $("#service_id").val(id)
            $url = "{{ route('services.edit', ['service' => ':id']) }}"
            $url = $url.replace(':id', id);
            // alert($url)
            $.ajax({
                url: $url,
                type: 'GET',
                success: function(response) {
                    var btn_title = "{{ __('inputs.btn_edit') }}"
                    $("#btn_add_service").html(btn_title)
                    var modal_title = "تحيين دائرة/مصلحة أو مؤسسة"
                    $("#modal-title").html(modal_title)

                    $("input[name=libelle]").val(response.libelle);
                    $("input[name=contact]").val(response.contact);
                    $("#responsable").val(response.responsable);
                    $('#add_service').modal('show');
                },
                error: function(response) {
                    alert(response.responseJSON.message)
                }
            }); // ajax end
        }

        function deleteFromDataTableBtn(id) {
            //  let id = $('#tbl_btn_delete').attr('data-id');

            var url = "{{ route('services.destroy', ['service' => ':id']) }}";
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
                                deleteSingleRowDataTable("#service-table")
                                PnotifyCustom(response)
                            },
                            error: function(jqXHR, exception) {
                                var msg = '';
                                if (jqXHR.status === 0) {
                                    msg = 'Not connect.\n Verify Network.';
                                } else if (jqXHR.status == 404) {
                                    msg = 'Requested page not found. [404]';
                                } else if (jqXHR.status == 500) {
                                    msg = 'Internal Server Error [500].';
                                } else if (exception === 'parsererror') {
                                    msg = 'Requested JSON parse failed.';
                                } else if (exception === 'timeout') {
                                    msg = 'Time out error.';
                                } else if (exception === 'abort') {
                                    msg = 'Ajax request aborted.';
                                } else {
                                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                                }
                                alert(msg);
                            },
                        }); // ajax end

                    }
                });
        }
    </script>
@endsection
