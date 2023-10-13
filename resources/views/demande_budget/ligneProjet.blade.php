@extends('layouts.app')
@section('title')
    <h5>ضبط الحاجيات إضافة أو تحيين</h5>
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-header-left" style="float: left;">
                    <a href="{{ route('besoin') }}" class="btn btn-secondary">
                        العودة
                        <i class="feather icon-corner-down-left"></i>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('besoin.createOrUpdate') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group ">
                                <label for="demandeur"> الطالب </label>
                                <input type="text" class="form-control" id='demandeur' name="demandeur"
                                    placeholder="أدخل الطالب" value=''>
                                @if ($errors->has('demandeur'))
                                    <span class="text-danger">{{ $errors->first('demandeur') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="date_besoin"> التاريخ </label>
                                <input type="date" class="form-control" id='date_besoin' name="date_besoin"
                                    placeholder="أدخل التاريخ" value=''>
                                @if ($errors->has('date_besoin'))
                                    <span class="text-danger">{{ $errors->first('date_besoin') }}</span>
                                @endif
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="valider" name="valider"> التحقق
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label> المصلحة/الدائرة/المؤسسة </label>
                                <select class="form-control select2" id="libelle" name="libelle">
                                    <option selected> إختر من القائمة </option>
                                    @foreach ($list as $item)
                                        <option value="{{ $item->libelle }}" class="{{ $item->id }}">
                                            {{ $item->libelle }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('libelle'))
                                    <span class="text-danger">{{ $errors->first('libelle') }}</span>
                                @endif
                            </div>

                            <input type="hidden" id="services_id" name="services_id" value="">
                            <input type="hidden" id="besoinsId" name="besoinsId" value="">

                            <div class="form-group">
                                <label for="annee_gestion"> السنة المالية </label>
                                <input type="number" class="form-control" id='annee_gestion' name="annee_gestion"
                                    placeholder="أدخل السنة المالية" value=''>
                                @if ($errors->has('annee_gestion'))
                                    <span class="text-danger">{{ $errors->first('annee_gestion') }}</span>
                                @endif
                            </div>

                            <div class="form-group" id="div_date_validation">
                                <label for="date_validation"> تاريخ التحقق </label>
                                <input style='pointer-events:none' type="" class="form-control" id='date_validation'
                                    name="date_validation" placeholder="أدخل تاريخ التحقق" value=''>
                            </div>
                        </div>
                    </div>

                    <div class="dt-responsive table-responsive">
                        <table id="ligneBesoin-table" class="table table-striped table-bordered nowrap">
                            <thead>
                                <th>المادة</th>
                                <th>طبيعة الطلب</th>
                                <th>الكمية المطلوبة</th>
                                <th>الكمية المصادق عليها</th>
                                <th>الكلفة التقديرية للوحدة(بالدينار)</th>
                                <th>الكلفة التقديرية الجملية(بالدينار)</th>
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
            $(document).ready(function() {
                // get Params from URL
                const urlParams = new URLSearchParams(window.location.search);
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

                //get msg success
                @if (Session::has('success'))
                    var msg = "{{ Session::get('success') }}";

                    toastr.success(msg, '', {
                        positionClass: "toast-top-left"
                    });
                @endif

                //get data besoin selected to update
                if (besoinsId != null) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('confirmationDemande.getBesoinSelected') }}",
                        data: {
                            id: besoinsId
                        },
                        dataType: 'json',
                        success: function(data) {
                            $("#demandeur").val(data.demandeur);
                            $("#libelle option[class=" + data.services_id + "]").prop('selected', true);
                            $("#annee_gestion").val(data.annee_gestion);
                            $("#date_besoin").val(data.date_besoin);
                        }
                    });
                    $("#besoinsId").val(besoinsId);
                    table.column(6).visible(true);
                } else {
                    table.column(6).visible(false);
                }
                // hide column of dataTable
                table.column(1).visible(false);
                table.column(3).visible(false);
                $('.form-check-label').hide();
                $('#div_date_validation').hide();

                //get services_id selected in the dropdown
                $('#saveBtn').click(function() {
                    var services_id = $("#libelle option:selected").attr("class");
                    $("#services_id").val(services_id);
                });

                // delete ligneBesoin
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
                                    url: "{{ route('ligneBesoin.destroy') }}",
                                    data: {
                                        id: id,
                                    },
                                    success: function(data) {
                                        toastr.success('تم الحذف بنجاح', '', {
                                            positionClass: "toast-top-left"
                                        });
                                        table = $("#ligneBesoin-table").DataTable().ajax
                                            .reload();
                                    }
                                });
                            }
                        });
                });
            });
        </script>
    @endsection
