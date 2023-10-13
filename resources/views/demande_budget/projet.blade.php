@extends('layouts.app')
@section('title')
    <h5>مشاريع الشراءات </h5>
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5></h5>
                <div class="card-header-left" style="float: left;">
                    <a href="{{ route('ligneProjet') }}"><button type="button"
                            class="btn btn-info feather icon-plus-circle">إضافة</button></a>
                </div>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="projet-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th>مشروع عدد</th>
                            <th>التاريخ</th>
                            <th>المصلحة/الدائرة/المؤسسة</th>
                            <th>تاريخ اعتزام التنفيذ</th>
                            <th>الموضوع</th>
                            <th>طبيعة الطلب</th>
                            <th>طريقة الإبرام</th>
                            <th>الكلفة التقديرية الجملية(بالدينار) للمشروع</th>
                            <th>السنة المالية</th>
                            <th>تعديلات</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('srcipt-js')
    <script>
        var table;
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            table = $("#projet-table").DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json'
                },
                //processing: true,
                //serverSide: true,
                serverMethod: 'GET',
                ajax: {
                    url: "{{ route('projet.datatable') }}"
                },
                columns: [{
                        data: "code_pa",
                        className: "code_pa"
                    },
                    {
                        data: "date_projet",
                        className: "date_projet"
                    },
                    {
                        data: "libelle",
                        className: "libelle"
                    },
                    {
                        data: "date_action_prevu",
                        className: "date_action_prevu"
                    },
                    {
                        data: "objet",
                        className: "objet"
                    },
                    {
                        data: "type_demande",
                        className: "type_demande"
                    },
                    {
                        data: "nature_passation",
                        className: "nature_passation"
                    },
                    {
                        data: "cout_total_pro",
                        className: "cout_total_pro"
                    },
                    {
                        data: "annee_gestion",
                        className: "annee_gestion"
                    },
                    {
                        data: 'action',
                        className: 'action',
                        visible: 'false'
                    }
                ],
            });

            //delete besoin
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
                                url: "{{ route('besoinDataTable.destroy') }}",
                                data: {
                                    id: id,
                                },
                                success: function(data) {
                                    table = $("#besoin-table").DataTable().ajax.reload();
                                    toastr.success('تم الحذف بنجاح', '', {
                                        positionClass: "toast-top-left"
                                    });
                                }
                            });
                        }
                    });
            });

        });
    </script>
@endsection
