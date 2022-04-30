@extends('layouts.app')
@section('title')
<h5>تسجيل كراس الشروط</h5>
@endsection
@section('content')
<!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 style="text-align:center"> طلب عروض عدد : AO001</h4>
                <div class="row">
                    <div class="col-auto">
                        المصلحة أو المؤسسة: مصلحة الإعلامية
                    </div>
                    <div class="col text-right">
                       السنةالمالية : 2021
                    </div>
                </div>
                التاريخ : 01/02/2021
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
                                                <label>لجنة الصفقات  :</label>
                                                <select class="mb-3 form-control  ">
                                                    <option>محلية</option>
                                                    <option selected>جهوية</option>
                                                    <option>وطنية</option>
                                                </select>
                                                <label>طريقة قبول العروض  :</label>
                                                <select class="mb-3 form-control  ">
                                                    <option>منظومة الشراءات على الخط</option>
                                                    <option>مكتب الضبط</option>
                                                    <option>البريد</option>
                                                </select>
                                                <label>طريقة فتح الظروف   :</label>
                                                <select class="mb-3 form-control  ">
                                                    <option>مالية علنية</option>
                                                    <option> مالية وفنية علنية</option>
                                                    <option selected>مالية وفنية غير علنية</option>
                                                </select>
                                                <label>المشروع :</label>
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
                                                <label>تاريخ اعتزام نشر الإعلان :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='01/03/2021'>
                                                
                                                <label>ثمن اقتناء كراس الشروط :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                <div>
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">ضمان وقتي</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                        <label class="custom-control-label" for="customCheck2">ضمان نهائي</label>
                                                    </div>
                                                </div>
                                            <form>
                                                <div  class="form-inline">
                                                    <div class="mx-sm-3 mb-3  " >
                                                        <label  >مدة الضمان الوقتي :</label>
                                                        <input type="text" class="form-control" id="inputPassword2b" placeholder="">
                                                    </div>
                                                    <div class=" mx-sm-3 mb-3" >
                                                        <label  >المبلغ :</label>
                                                        <input type="text" class="form-control" id="inputPassword2b" placeholder="">
                                                    </div> 
                                                </div>
                                                <div  class="form-inline">    
                                                    <div class="mx-sm-3 mb-3  " >
                                                        <label  >مدة الضمان النهائي :</label>
                                                        <input type="text" class="form-control" id="inputPassword2b" placeholder="">
                                                    </div>
                                                    <div class=" mx-sm-3 mb-3" >
                                                        <label  >المبلغ :</label>
                                                        <input type="text" class="form-control" id="inputPassword2b" placeholder="">
                                                    </div> 
                                                </div>                            
                                            </form>
                                            <label>مدة الإنجازباليوم : </label>
                                            <input class="mb-3 form-control form-control-lg" type="text" placeholder='160'>
                                        </div>    
               									
            </div>


             <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="documents" class="table table-striped table-bordered nowrap">
                                               <thead>
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
                ['الشروط الإدارية'],['الفنية']
                ];
            $("#documents").DataTable({
                data:table,
                columns: [{
                       
                       title:'الوثائق المكونة لكراس الشروط'
                    }
                ],
                language: {
                    url:'//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json'
                }
                
            });
        });
    </script>
@endsection
