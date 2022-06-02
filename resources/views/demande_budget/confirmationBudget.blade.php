@extends('layouts.app')
@section('title')
    <h5> المصادقة على الحاجيات</h5>
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="card">
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
            //table besoin
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
                        nameView: "confirmationBudget"
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
        });
    </script>
@endsection
