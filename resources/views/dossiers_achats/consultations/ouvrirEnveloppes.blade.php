@extends('layouts.app')
@section('title')
<h5>فتح الظروف </h5>
@endsection
@section('content')
<!-- Column Selector table start -->
<div class="col-sm-12">
    <div class="card">
 
                  
            <div class="card-header">
                <h4 style="text-align:center">استشارة عدد: C01/2021</h4>
                <div class="row">
                    <div class="col-auto">
                        المصلحة أو المؤسسة: المعهد العالي للدراسات التكنولوجية بجندوبة
                    </div>
                    <div class="col text-right">
                       السنةالمالية : 2021
                    </div>
                </div>
            </div>

        <div class="col-md-12">	<br>
                <div class="row">
                                            <div class="col-md-6">
                                                <label>الموضوع :</label>
                                                <input class="mb-3 form-control " type="text" placeholder=''>
                                                <label>الإطار :</label>
                                                <select class="mb-3 form-control ">
                                                    <option>مواد وخدمات</option>
                                                    <option>أشغال</option>
                                                    <option>دراسات</option>
                                                </select>
                                                <label>جلسة :</label>
                                                <select class="mb-3 form-control ">
                                                            <option>فنية</option>
                                                            <option>مالية</option>
                                                            <option>فنية ومالية</option>
                                                </select>
                                                 <label>جلسة عدد:</label>
                                                <input class="mb-3 form-control " type="text" placeholder=''>
                                               
                                            </div>  
                                             <div class="col-md-6">
                                                <label>وضعية الملف :</label>
                                                <select class="mb-3 form-control  ">
                                                    <option>بصدد الإعداد</option>
                                                    <option>في انتظار العروض</option>
                                                    <option>في الفرز</option>
                                                    <option>بصدد الإنجاز</option>
                                                    <option>القبول الوقتي</option>
                                                    <option>القبول النهائي</option>
                                                    <option>ملف منتهي </option>
                                                    <option>ملغى</option>
                                                </select>
                                                 <label>التاريخ:</label>
                                                <input class="mb-3 form-control " type="text" placeholder=''>
                                                <label>توصيات اللجنة:</label>
                                                <input class="mb-3 form-control " type="text" placeholder=''>
                                                <label>الحضور:</label>
                                                <input class="mb-3 form-control " type="text" placeholder=''>
                                            </div> 
                </div> 
        </div>   
		 <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="table" class="table table-striped table-bordered nowrap">
                                               <thead>
                                                    <th></th>
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
@endsection
@section('srcipt-js')
    <script>
        $(document).ready(function() {
            
            var table=[
                ['','','','','','','','']
                ];
            $("#table").DataTable({
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
                       
                       title:'مبلق العرض'
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
										
            