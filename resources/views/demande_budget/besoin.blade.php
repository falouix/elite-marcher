@extends('layouts.app')
@section('title')
    <h5>ضبط الحاجيات</h5>
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5></h5>
                <div class="card-header-left" style="float: left;">
                    <a href="{{ route('ligneBesoin') }}"><button type="button"
                            class="btn btn-info feather icon-plus-circle">إضافة</button></a>
                </div>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="besoin-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <th>التاريخ</th>
                            <th>الطالب</th>
                            <th>المصلحة/الدائرة/المؤسسة</th>
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
            // dataTable besoin
            table = $("#besoin-table").DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json'
                },
                //processing: true,
                //serverSide: true,
                serverMethod: 'get',
                ajax: {
                    url: "{{ route('besoin.datatable') }}",
                    data: {
                        nameView: "besoin"
                    }
                },
                columns: [{
                        data: "date_besoin",
                        className: "date_besoin"
                    },
                    {
                        data: "demandeur",
                        className: "demandeur"
                    },
                    {
                        data: "libelle",
                        className: "libelle"
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
