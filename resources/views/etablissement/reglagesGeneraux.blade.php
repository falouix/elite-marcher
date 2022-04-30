@extends('layouts.app')
@section('title')
    <h5>إعدادات عامة</h5>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('reglages.createOrUpdate') }}" method="post">
                        @csrf

                        <input type="hidden" id="viewName" name="viewName">
                        <div class="mb-2">
                            <label for="matricule_fiscale" class="form-label">رقم التسجيل
                            </label>
                            <input type="number" class="form-control" id="matricule_fiscale" name="matricule_fiscale"
                                placeholder=" أدخل رقم التسجيل">
                            @if ($errors->has('matricule_fiscale'))
                                <span class="text-danger">{{ $errors->first('matricule_fiscale') }}</span>
                            @endif
                        </div>

                        <div class="mb-2">
                            <label for="libelle" class="form-label">اسم المؤسسة</label>
                            <input type="text" class="form-control" id="libelle" name="libelle" value="جامعة  جندوبة"
                                placeholder="أدخل اسم المؤسسة ">
                            @if ($errors->has('libelle'))
                                <span class="text-danger">{{ $errors->first('libelle') }}</span>
                            @endif
                        </div>

                        <div class="mb-2">
                            <label for="email" class="form-label"> البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="أدخل البريد الإلكتروني ">
                                 @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="mb-2">
                            <label for="adresse" class="form-label">العنوان </label>
                            <input type="text" class="form-control" id="adresse" name="adresse"
                                placeholder="أدخل العنوان ">
                                 @if ($errors->has('adresse'))
                                <span class="text-danger">{{ $errors->first('adresse') }}</span>
                            @endif
                        </div>

                        <div class="mb-2">
                            <label for="responsable" class="form-label">رئيس المؤسسة</label>
                            <input type="text" class="form-control" id="responsable" name="responsable"
                                placeholder="أدخل إسم رئيس المؤسسة ">
                                 @if ($errors->has('responsable'))
                                <span class="text-danger">{{ $errors->first('responsable') }}</span>
                            @endif
                        </div>

                        <div class="mb-2">
                            <label for="entete" class="form-label">رأس الصفحة</label>
                            <textarea type="text" class="form-control" id="entete" name="entete" placeholder="أدخل رأس الصفحة  "></textarea>
                             @if ($errors->has('entete'))
                                <span class="text-danger">{{ $errors->first('entete') }}</span>
                            @endif
                        </div>

                        <div class="mb-2">
                            <label for="code_pa" class="form-label">ترقيم مشاريع الشراءات
                            </label>
                            <input type="text" value="PA0001" class="form-control" id="code_pa" name="code_pa"
                                placeholder="أدخل ترقيم مشاريع الشراءات ">
                            @if ($errors->has('code_pa'))
                                <span class="text-danger">{{ $errors->first('code_pa') }}</span>
                            @endif
                        </div>

                        <div class="mb-2">
                            <label for="code_consult" class="form-label">ترقيم الإستشارات </label>
                            <input type="text" value="CO0001" class="form-control" id="code_consult" name="code_consult"
                                placeholder="أدخل ترقيم الإستشارات ">
                            @if ($errors->has('code_consult'))
                                <span class="text-danger">{{ $errors->first('code_consult') }}</span>
                            @endif
                        </div>

                        <div class="mb-2">
                            <label for="code_ao" class="form-label">ترقيم طلبات العروض
                            </label>
                            <input type="text" value="PA0001" class="form-control" id="code_ao" name="code_ao"
                                placeholder="أدخل ترقيم طلبات العروض ">
                            @if ($errors->has('code_ao'))
                                <span class="text-danger">{{ $errors->first('code_ao') }}</span>
                            @endif
                        </div>

                        <div class="form-check">
                            <input type="hidden" name="ajouter_annee" value="0">
                            <input class="form-check-input" type="checkbox" id="ajouter_annee" name="ajouter_annee"
                                value="1" {{ old('ajouter_annee' ? 'checked' : '') }} checked>

                            <label class="form-check-label" for="ajouter_annee">
                                الترقيم يضاف اليه السنة المالية
                            </label>
                        </div>

                        <div class="form-check">
                            <input type="hidden" name="reset_code" value="0">
                            <input class="form-check-input" type="checkbox" id="reset_code" name="reset_code" value="1"
                                {{ old('reset_code' ? 'checked' : '') }} checked>
                            <label class="form-check-label" for="reset_code">
                                الترقيم يعاد الى الواحد في كل سنة مالية
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary " id="saveBtn">تسجيل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('srcipt-js')
    <script>
        CKEDITOR.replace('entete');

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#saveBtn').click(function() {
                $('#viewName').val('reglagesGeneraux');
            });

            //get data etablissement
            $.ajax({
                type: "get",
                url: "{{ route('reglages.getEtablissement') }}",
                dataType: 'json', 
                success: function(data) {
                    CKEDITOR.replace('entete');
                    
                    if (data.id != undefined) {

                        $('#matricule_fiscale').val(data.matricule_fiscale);
                        $('#libelle').val(data.libelle);
                        $('#email').val(data.email);
                        $('#adresse').val(data.adresse);
                        $('#responsable').val(data.responsable);
                        $('#entete').val(data.entete);
                        $('#code_pa').val(data.code_pa);
                        $('#code_consult').val(data.code_consult);
                        $('#code_ao').val(data.code_ao);
                        $('#ajouter_annee').prop('checked', parseInt(data.ajouter_annee));
                        $('#reset_code').prop('checked', parseInt(data.reset_code));
                    }
                }
            });
            //msg success create or update data etablissement
            @if (Session::has('success'))
                var msg="{{ Session::get('success') }}";
            
                toastr.success(msg, '', {
                positionClass: "toast-top-left"
                });
            @endif
        })
    </script>
@endsection
