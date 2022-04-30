@extends('layouts.app')
@section('title')
    <h5> إعدادات التنبيهات </h5>
@endsection
@section('content')
    <div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('reglages.createOrUpdate') }}" method="post">
                    @csrf
                    <input type="hidden" id="parametreAvertissement" name="parametreAvertissement">
                    <div class="row">
                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <input name="notif_validation_besoins" type="hidden" value="0">
                                <input id="notif_validation_besoins" name="notif_validation_besoins" type="checkbox"
                                    value="1" {{ old('notif_validation_besoins' ? 'checked' : '') }}>
                                <label>تفعيل تنبيه عند المصادقة على الحاجيات</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <input name="notif_pa" type="hidden" value="0">
                                <input id="notif_pa" name="notif_pa" type="checkbox" value="1"
                                    {{ old('notif_pa' ? 'checked' : '') }}>
                                <label>تفعيل تنبيه لإعداد ملف شراء</label>
                            </div>
                        </div>
                        <div class="col-sm-7 ">
                            <div class="form-group">
                                <input id="notif_duree_pa" name="notif_duree_pa" type="number"
                                    class="form-control form-control-sm" placeholder="تنبيه لإعداد ملف شراء قبل ">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <input name="notif_publication_achat" type="hidden" value="0">
                                <input id="notif_publication_achat" name="notif_publication_achat" type="checkbox" value="1"
                                    {{ old('notif_publication_achat' ? 'checked' : '') }}>
                                <label>تفعيل تنبيه لنشر الإعلان عن صفقة </label>
                            </div>
                        </div>
                        <div class="col-sm-7 ">
                            <div class="form-group">
                                <input id="notif_duree_publication" name="notif_duree_publication" type="number"
                                    class="form-control form-control-sm" placeholder="تنبيه لنشر الإعلان عن صفقة قبل ">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <input name="notif_session_op" type="hidden" value="0">
                                <input id="notif_session_op" name="notif_session_op" type="checkbox" value="1"
                                    {{ old('notif_session_op' ? 'checked' : '') }}>
                                <label>تفعيل تنبيه لجلسة فتح الظروف</label>
                            </div>
                        </div>
                        <div class="col-sm-7 ">
                            <div class="form-group">
                                <input id="notif_duree_session_op" name="notif_duree_session_op" type="number"
                                    class="form-control form-control-sm" placeholder="تنبيه لجلسة فتح الظروف قبل ">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <input name="notif_date_caution_final" type="hidden" value="0">
                                <input id="notif_date_caution_final" name="notif_date_caution_final" type="checkbox"
                                    value="1" {{ old('notif_delais_rp' ? 'checked' : '') }}>
                                <label>تنبيه بتاريخ تقديم الضمان النهائي </label>
                            </div>
                        </div>
                        <div class="col-sm-7 ">
                            <div class="form-group">
                                <input id="notif_duree_caution_final" name="notif_duree_caution_final" type="number"
                                    class="form-control form-control-sm"
                                    placeholder="تنبيه بتاريخ تقديم الضمان النهائي قبل">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <input name="notif_delais_rp" type="hidden" value="0">
                                <input id="notif_delais_rp" name="notif_delais_rp" type="checkbox" value="1"
                                    {{ old('notif_delais_rp' ? 'checked' : '') }}>
                                <label>تفعيل تنبيه بحلول آجال الإستلام الوقتي</label>
                            </div>
                        </div>
                        <div class="col-sm-7 ">
                            <div class="form-group">
                                <input id="notif_duree_rp" name="notif_duree_rp" type="number"
                                    class="form-control form-control-sm"
                                    placeholder="تنبيه بحلول آجال الإستلام الوقتي قبل ">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id='saveBtn'> تسجيل </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('srcipt-js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#saveBtn').click(function() {
                $('#viewName').val('parametreAvertissement');
            });
            //get data etablissement
            $.ajax({
                type: "get",
                url: "{{ route('reglages.getEtablissement') }}",
                dataType: 'json',
                success: function(data) {
                    if (data.id != undefined) {
                        $('#notif_duree_pa').val(parseInt(data.notif_duree_pa));
                        $('#notif_duree_publication').val(parseInt(data.notif_duree_publication));
                        $('#notif_duree_session_op').val(parseInt(data.notif_duree_session_op));
                        $('#notif_duree_caution_final').val(parseInt(data.notif_duree_caution_final));
                        $('#notif_duree_rp').val(parseInt(data.notif_duree_rp));
                        $('#notif_duree_rd').val(parseInt(data.notif_duree_rd));
                        $('#notif_validation_besoins').prop('checked', parseInt(data
                            .notif_validation_besoins));
                        $('#notif_pa').prop('checked', parseInt(data.notif_pa));
                        $('#notif_publication_achat').prop('checked', parseInt(data
                            .notif_publication_achat));
                        $('#notif_session_op').prop('checked', parseInt(data.notif_session_op));
                        $('#notif_date_caution_final').prop('checked', parseInt(data
                            .notif_date_caution_final));
                        $('#notif_delais_rp').prop('checked', parseInt(data.notif_delais_rp));
                        $('#notif_delais_rd').prop('checked', parseInt(data.notif_delais_rd));
                    }
                }
            });
            //msg success create or update
            @if (Session::has('success'))
                var msg="{{ Session::get('success') }}";
            
                toastr.success(msg, '', {
                positionClass: "toast-top-left"
                });
            @endif
        })
    </script>
@endsection
