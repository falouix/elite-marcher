@extends('layouts.app')
@section('title')
    <h5> المصالح/الدوائر/المؤسسات </h5>
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5></h5>
                <div class="card-header-left" style="float: left;">
                    <button type="button" id="createBtn" class="btn btn-info feather icon-plus-circle">إضافة</button>
                </div>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="Services-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th>المصلحة/الدائرة/ المؤسسة</th>
                            <th>جهة الإتصال</th>
                            <th>المسؤول</th>
                            <th>تعديلات</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal create or update service -->
    <div class="modal fade show" id="serviceModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
        style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-header"> تحيين </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id='serviceForm' name='serviceForm'>

                        <input type="hidden" name="id_service_selected" id="id_service_selected">
                        <div class="form-group">
                            <label for="libelle"> المصلحة/الدائرة/ المؤسسة </label>
                            <input type="text" class="form-control" id='libelle' name="libelle"
                                placeholder="أدخل المصلحة/الدائرة/ المؤسسة" value=''>
                            <span class="text-danger error-text libelle_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="contact"> جهة الإتصال</label>
                            <input type="text" class="form-control" id='contact' name="contact"
                                placeholder="أدخل جهة الإتصال" value=''>
                            <span class="text-danger error-text contact_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="responsable"> المسؤول </label>
                            <input type="text" class="form-control" id='responsable' name="responsable"
                                placeholder="أدخل المسؤول" value=''>
                            <span class="text-danger error-text responsable_err"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> إغلاق</button>
                            <button type="submit" class="btn btn-primary" id='saveBtn'> إضافة </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal create or update service end-->
@endsection

@section('srcipt-js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //dataTable service
            var table = $("#Services-table").DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json'
                },
                //processing: true,
                //serverSide: true,
                serverMethod: 'get',
                ajax: {
                    url: "{{ route('service.datatable') }}"
                },
                columns: [{
                        data: "libelle",
                        className: "libelle"
                    },
                    {
                        data: "contact",
                        className: "contact"
                    },
                    {
                        data: "responsable",
                        className: "responsable"
                    },
                    {
                        data: 'action',
                        className: 'action',
                        visible: 'false'
                    }
                ],
            });

            $('#createBtn').click(function() {
                $('.error-text').text('');
                $('#serviceModel').modal('show');
                $('#saveBtn').html("إضافة");
                $('#id_service_selected').val('');
                $('#serviceForm').trigger("reset");
                $('#modal-header').html("إضافة");
            });
            //display data service in form of 'serviceModel'
            $('body').on('click', '.btnServiceEdit', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('serviceDataTable.edit') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('.error-text').text('');
                        $('#saveBtn').html("إضافة");
                        $('#serviceModel').modal('show');
                        $('#id_service_selected').val(data.id);
                        $('#modal-header').html("تحيين");
                        $('#libelle').val(data.libelle);
                        $('#contact').val(data.contact);
                        $('#responsable').val(data.responsable);
                    }
                });
            });
            // create or update service
            //$('#serviceForm').serialize(),
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('إرسال..');
                var id = $('#id_service_selected').val();
                var libelle = $('#libelle').val();
                var contact = $('#contact').val();
                var responsable = $('#responsable').val();
                $.ajax({
                    data: {
                        id: id,
                        libelle: libelle,
                        contact: contact,
                        responsable: responsable
                    },
                    url: "{{ route('service.createOrUpdate') }}",
                    type: "POST",
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data.error)
                        if ($.isEmptyObject(data.error)) {
                            $('#serviceForm').trigger("reset");
                            $('#id_service_selected').val('');
                            $("#serviceModel").modal('hide');
                            table = $("#Services-table").DataTable().ajax.reload();
                            toastr.success('تمت الإضافة بنجاح', '', {
                                positionClass: "toast-top-left"
                            });
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            });

            function printErrorMsg(msg) {
                $.each(msg, function(key, value) {
                    $('#saveBtn').html("إضافة");
                    console.log(key);
                    $('.' + key + '_err').text(value);
                });
            }
            //delete service
            $('body').on('click', '.btnServiceDelete', function() {
                var id = $(this).data("id");
                swal({
                        title: "هل تريد فعلا حذف هذا التسجيل ؟",
                        text: "بمجرد الحذف, لا يمكن إستعادة هذا التسجيل",
                        icon: "warning",
                        buttons: ["إلقاء ", "تأكيد الحذف  "],
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "post",
                                dataType: 'JSON',
                                url: "{{ route('serviceDataTable.destroy') }}",
                                data: {
                                    id: id,
                                },
                                success: function(data) {
                                    toastr.success('تم الحذف بنجاح', '', {
                                        positionClass: "toast-top-left"
                                    });
                                    table = $("#Services-table").DataTable().ajax.reload();
                                }
                            });
                        }
                    });
            });
        });
    </script>
@endsection
