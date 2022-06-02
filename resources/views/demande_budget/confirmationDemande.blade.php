@extends('layouts.app')
@section('title')
    <h5>المصادقة على الطلب </h5>
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-header-left" style="float: left;">
                    <a href="{{ route('confirmationBudget') }}" class="btn btn-secondary">
                        العودة
                        <i class="feather icon-corner-down-left"></i>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('besoin.createOrUpdate') }}" method="post">
                    @csrf
                    <div class="row">

                        <input type="hidden" name="id_besoin_selected" id="id_besoin_selected">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="demandeur"> الطالب </label>
                                <input style='pointer-events:none' type="text" class="form-control" id='demandeur'
                                    name="demandeur" value=''>
                            </div>
                            <div class="form-group">
                                <label for="date_besoin"> التاريخ </label>
                                <input style='pointer-events:none' type="date" class="form-control" id='date_besoin'
                                    name="date_besoin" placeholder="أدخل التاريخ" value=''>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="hidden" name="valider" value="0">
                                    <input class="form-check-input" type="checkbox" id="valider" name="valider" value="1"
                                        {{ old('valider' ? 'checked' : '') }} checked> التحقق
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="libelle"> المصلحة/الدائرة/المؤسسة </label>
                                <input style='pointer-events:none' type="text" class="form-control" id='libelle'
                                    name="libelle" value=''>
                            </div>
                            <div class="form-group">
                                <label for="annee_gestion"> السنة المالية </label>
                                <input style='pointer-events:none' type="text" class="form-control" id='annee_gestion'
                                    name="annee_gestion" value=''>
                            </div>
                            <div class="form-group" id="div_date_validation">
                                <label for="date_validation"> تاريخ التحقق </label>
                                <input style='pointer-events:none' type="" class="form-control" id='date_validation'
                                    name="date_validation" value=''>
                            </div>
                            <input type="hidden" id="services_id" name="services_id" value="">
                            <input type="hidden" id="besoinsId" name="besoinsId" value="">
                        </div>
                    </div>
                    <div id="divTable" class="dt-responsive table-responsive">
                        <table id="ligneBesoin-table" class="table table-striped table-bordered nowrap">
                            <thead>
                                <th>المادة</th>
                                <th>طبيعة الطلب</th>
                                <th>الكمية المطلوبة</th>
                                <th>الكمية المصادق عليها</th>
                                <th>الكلفة التقديرية للوحدة</th>
                                <th>الكلفة التقديرية الجملية</th>
                                <th>تعديلات</th>
                            </thead>
                        </table>
                    </div>
                        <button type="submit" class="btn btn-primary" id='saveBtn'> تسجيل </button>
                </form>
            </div>
        </div>
    @endsection
    @section('srcipt-js')
        <script>
            //get Params from URL
            $(document).ready(function() {
                const urlParams = new URLSearchParams(window.location.search);
                const besoins_valider = urlParams.get('valider');
                const besoins_id = urlParams.get('id');
                var besoinsId = besoins_id;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                //dataTable ligneBesoin
                table = $("#ligneBesoin-table").DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json'
                    },
                    //processing: true,
                    //serverSide: true,
                    serverMethod: 'post',
                    ajax: {
                        url: "{{ route('ligneBesoin.datatable') }}",
                        data: {
                            besoinsId: besoinsId
                        }
                    },
                    columns: [{
                            data: "libelle",
                            className: "libelle"
                        },
                        {
                            data: "type_demande",
                            className: "type_demande"
                        },
                        {
                            data: "qte_demande",
                            className: "qte_demande"
                        },
                        {
                            data: "qte_valide",
                            className: "qte_valide"
                        },
                        {
                            data: "cout_unite_ttc",
                            className: "cout_unite_ttc"
                        },
                        {
                            data: "cout_total_ttc",
                            className: "cout_total_ttc"
                        },
                        {
                            data: 'action',
                            className: 'action',
                            visible: 'false'
                        }
                    ],
                });
                table.column(6).visible(false);

                //show input 'date_validation' when the checkbox 'valider' is clicked
                $('#div_date_validation').hide();
                $('#valider').on('click', function() {
                    if ($(this).prop('checked')) {
                        var today = new Date();
                        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                        var dateTime = date + ' ' + time;
                        $('#date_validation').val(dateTime);
                        $('#div_date_validation').fadeIn();
                    } else {
                        $('#div_date_validation').hide();
                    }
                });

                //get data besoin to form 
                $.ajax({
                    type: "POST",
                    url: "{{ route('confirmationDemande.getBesoinSelected') }}",
                    data: {
                        id: besoinsId
                    },
                    dataType: 'json',
                    success: function(data) {
                        $("#demandeur").val(data.demandeur);
                        $("#libelle").val(data.libelle);
                        $("#annee_gestion").val(data.annee_gestion);
                        $("#date_besoin").val(data.date_besoin);
                        $('#valider').prop('checked', data.valider);
                        $('#date_validation').val(data.date_validation);
                        if (data.valider == 1) {
                            $('#div_date_validation').show();
                        }
                        $("#services_id").val(data.services_id);
                        $("#besoinsId").val(data.id);
                    }
                });
                // msg success update 'valider'
                @if (Session::has('success'))
                    var msg="{{ Session::get('success') }}";
                
                    toastr.success(msg, '', {
                    positionClass: "toast-top-left"
                    });
                @endif
            });
        </script>
    @endsection
