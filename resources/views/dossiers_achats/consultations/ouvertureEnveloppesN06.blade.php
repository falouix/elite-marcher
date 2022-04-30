@extends('layouts.app')
@section('title')
<h5>جلسة فتح الظروف عدد 2021/06</h5>
@endsection
@section('content')
<div class="col-sm-12">
    <div class="card">
 
                  
            <div class="card-header">
                <h4 style="text-align:center">استشارة عدد: CO01</h4>
                <div class="row">
                    <div class="col-auto">
                        المصلحة أو المؤسسة: المعهد العالي للدراسات التكنولوجية بجندوبة
                    </div>
                    <div class="col text-right">
                       السنةالمالية : 2021
                    </div>
                </div>
            </div>
                                    <div class="col-md-12"><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>الموضوع :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='اقتناء حواسيب وطابعات'>
                                                <label>الإطار :</label>
                                                <select class="mb-3 form-control  " >
                                                            <option>مواد وخدمات</option>
                                                            <option>أشغال</option>
                                                            <option>دراسات</option>
                                                </select>
                                                <label>المشروع :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='اقتناء حواسيب وطابعات'>
                                                <label>جلسة :</label>
                                                <select class="mb-3 form-control  " >
                                                            <option>فنية</option>
                                                            <option>مالية</option>
                                                            <option selected>فنية ومالية</option>
                                                </select>
                                                 
                                            </div> 
                                            <div class="col-md-6">
                                            <label>التاريخ:</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='15/05/2021'>
                                                <label>توصيات اللجنة:</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                <label>وضعية الملف :</label>
                                                 <select class="mb-3 form-control  ">
                                                            <option>بصدد الإعداد</option>
                                                            <option>في انتظار العروض</option>
                                                            <option selected>في الفرز</option>
                                                            <option>بصدد الإنجاز</option>
                                                            <option>القبول الوقتي</option>
                                                            <option>القبول النهائي</option>
                                                            <option>ملف منتهي </option>
                                                            <option>ملغى</option>
                                                 </select>
                                                <label>الحضور :</label>
                                                <select class="mb-3 form-control  ">
                                                            <option> فلان فلاني</option>
                                                            <option> زيد الزيادي </option>
                                                            <option >  زيد الزيادي</option>
                                                </select>
                                            </div> 
                                        </div>  
                                    </div>	 
												
            <div class="card-body">
                                <div class="dt-responsive table-responsive">
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="recommandations-table" class="table table-striped table-bordered nowrap">
                                               <thead>
                                                    <th style="width: 30px">  </th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>          
            </div> 
        </div>
    </div>
</div>
@endsection
@section('srcipt-js')
    <script>
        $(document).ready(function() {
           
            var table=[
                ['15/05/2021',"10:00",'', "شركة TECHNO",'', "6500", "موافقة",''],
                ['17/05/2021',"09:00",'', "SIBE",'', "7000", "موافقة",''],
                ['18/05/2021',"08:00",'', "H2i",'',"8500","موافقة",'']
                ];
            $("#recommandations-table").DataTable({
                data:table,
                columns: [{
                        
                       title:'تاريخ وصول العرض'
                    },
                    {
                        title:'الساعة'
                    },
                    {
                        title:'المرجع'
                    },
                    {
                        title:'المتعهد'
                    },
                    {
                        title:'عدد الاقساط'
                    },
                    {
                        title:'مبلغ العرض'
                    },
                    {
                        title:'قرار اللجنة'
                    },
                    {
                        title:'الملاحظات'
                    }
                ]
                
            });
        });
    </script>
@endsection

