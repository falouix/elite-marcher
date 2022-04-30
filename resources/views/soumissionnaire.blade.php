@extends('layouts.app')
@section('title')
    <h5>المتعهدين</h5>
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
                    <table id="soumissionnaireTable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th>الاسم</th>
                            <th>جهة الإتصال</th>
                            <th>العنوان</th>
                            <th>الترقيم البريدي</th>
                            <th>المدينة</th>
                            <th>الهاتف</th>
                            <th>الفاكس</th>
                            <th>العنوان الإلكتروني</th>
                            <th>المعرف الجبائي</th>
                            <th>تعديلات</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal create or update soumissionnaire -->
    <div class="modal fade show" id="soumissionnaire_model" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-modal="true" style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-header"> تحيين </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id='soumissionnaireForm' name='soumissionnaireForm'>

                        <input type="hidden" name="id_soumissionnaire_selected" id="id_soumissionnaire_selected">
                        <div class="form-group">
                            <label for="libelle">الاسم</label>
                            <input type="text" class="form-control" id='libelle' name="libelle" placeholder="أدخل الاسم"
                                value=''>
                            <span class="text-danger error-text libelle_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="">جهة الإتصال</label>
                            <input type="text" class="form-control" id='contact' name="contact"
                                placeholder=" أدخل جهة الإتصال " value=''>
                            <span class="text-danger error-text contact_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="">العنوان</label>
                            <input type="text" class="form-control" id='adresse' name="adresse" placeholder="أدخل العنوان"
                                value=''>
                            <span class="text-danger error-text adresse_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="">الترقيم البريدي</label>
                            <input type="number" class="form-control" id='code_postal' name="code_postal"
                                placeholder="أدخل الترقيم البريدي" value=''>
                            <span class="text-danger error-text code_postal_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="">المدينة</label>
                            <input type="text" class="form-control" id='ville' name="ville" placeholder=" أدخل المدينة"
                                value=''>
                            <span class="text-danger error-text ville_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="">الهاتف</label>
                            <input type="number" class="form-control" id='tel' name="tel" placeholder="أدخل الهاتف "
                                value=''>
                            <span class="text-danger error-text tel_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="">الفاكس</label>
                            <input type="number" class="form-control" id='tel_fax' name="tel_fax"
                                placeholder=" أدخل الفاكس " value=''>
                            <span class="text-danger error-text tel_fax_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="">العنوان الإلكتروني</label>
                            <input type="email" class="form-control" id='email' name="email"
                                placeholder="أدخل العنوان الإلكتروني" value=''>
                            <span class="text-danger error-text email_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="">المعرف الجبائي</label>
                            <input type="text" class="form-control" id='matricule_fiscale' name="matricule_fiscale"
                                placeholder=" أدخل المعرف الجبائي " value=''>
                            <span class="text-danger error-text  matricule_fiscale_err"></span>
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
    <!-- Modal create or update soumissionnaire end-->
@endsection

@section('srcipt-js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //dataTable soumissionnaire
            var table = $("#soumissionnaireTable").DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json'
                },
                //processing: true,
                //serverSide: true,
                serverMethod: 'get',
                ajax: {
                    url: "{{ route('soumissionnaire.datatable') }}"
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
                        data: "adresse",
                        className: "adresse"
                    },
                    {
                        data: "code_postal",
                        className: "code_postal"
                    },
                    {
                        data: "ville",
                        className: "ville"
                    },
                    {
                        data: "tel",
                        className: "tel"
                    },
                    {
                        data: "tel_fax",
                        className: "tel_fax"
                    },
                    {
                        data: "email",
                        className: "email"
                    },
                    {
                        data: "matricule_fiscale",
                        className: "matricule_fiscale"
                    },
                    {
                        data: 'action',
                        className: 'action',
                        visible: 'false'
                    }
                ]
            });

            $('#createBtn').click(function() {
                $('.error-text').text('');
                $('#soumissionnaire_model').modal('show');
                $('#saveBtn').html("إضافة");
                $('#id_soumissionnaire_selected').val('');
                $('#soumissionnaireForm').trigger("reset");
                $('#modal-header').html("إضافة");
            });
            //display data soumissionnaire in form of 'soumissionnaire_model'
            $('body').on('click', '.btnEdit', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('soumissionnaireDataTable.edit') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('.error-text').text('');
                        $('#saveBtn').html("إضافة");
                        $('#soumissionnaire_model').modal('show');
                        $('#id_soumissionnaire_selected').val(data.id);
                        $('#modal-header').html("تحيين");
                        $('#libelle').val(data.libelle);
                        $('#contact').val(data.contact);
                        $('#adresse').val(data.adresse);
                        $('#code_postal').val(data.code_postal);
                        $('#ville').val(data.ville);
                        $('#tel').val(data.tel);
                        $('#tel_fax').val(data.tel_fax);
                        $('#email').val(data.email);
                        $('#matricule_fiscale').val(data.matricule_fiscale);
                    }
                });
            });
            // create or update soumissionnaire
            // $('#soumissionnaireForm').serialize()
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('إرسال..');
                var id = $('#id_soumissionnaire_selected').val();
                var libelle = $('#libelle').val();
                var contact = $('#contact').val();
                var adresse = $('#adresse').val();
                var code_postal = $('#code_postal').val();
                var ville = $('#ville').val();
                var tel = $('#tel').val();
                var tel_fax = $('#tel_fax').val();
                var email = $('#email').val();
                var matricule_fiscale = $('#matricule_fiscale').val();
                $.ajax({
                    data: {
                        id: id,
                        libelle: libelle,
                        contact: contact,
                        adresse: adresse,
                        code_postal: code_postal,
                        ville: ville,
                        tel: tel,
                        tel_fax: tel_fax,
                        email: email,
                        matricule_fiscale: matricule_fiscale,
                    },
                    url: "{{ route('soumissionnaire.createOrUpdate') }}",
                    type: "POST",
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data.error)
                        if ($.isEmptyObject(data.error)) {
                            $('#soumissionnaireForm').trigger("reset");
                            $('#id_soumissionnaire_selected').val('');
                            $("#soumissionnaire_model").modal('hide');
                            table = $("#soumissionnaireTable").DataTable().ajax.reload();
                            toastr.success('تمت الإضافة بنجاح', '', {
                                positionClass: "toast-top-left"
                            });
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            });
            //show msg error
            function printErrorMsg(msg) {
                $.each(msg, function(key, value) {
                    $('#saveBtn').html("إضافة");
                    console.log(key);
                    $('.' + key + '_err').text(value);
                });
            }
            // delete soumissionnaire
            $('body').on('click', '.btnDelete', function() {
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
                                url: "{{ route('soumissionnaireDataTable.destroy') }}",
                                data: {
                                    id: id,
                                },
                                success: function(data) {
                                    toastr.success('تم الحذف بنجاح', '', {
                                        positionClass: "toast-top-left"
                                    });
                                    table = $("#soumissionnaireTable").DataTable().ajax
                                        .reload();
                                }
                            });
                        }
                    });
            });
        });
    </script>
@endsection
