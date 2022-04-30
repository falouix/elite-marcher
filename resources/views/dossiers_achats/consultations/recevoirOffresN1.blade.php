@extends('layouts.app')
@section('title')
<h5>وصول العرض عدد 1</h5>
@endsection
@section('content')
 <!-- Column Selector table start -->
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
                 <div><!--date('Y-m-d')-->
                التاريخ :  15/05/2021
                </div>
            </div>
            
                                        <div class="col-md-12"><br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>الموضوع :</label>
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder='اقتناء حواسيب وطابعات'>
                                                    <label>الإطار :</label>
                                                    <select  class="mb-3 form-control  " >
                                                            <option>مواد وخدمات</option>
                                                            <option>أشغال</option>
                                                            <option>دراسات</option>
                                                    </select>
                                                    <label>وصول العرض :</label>
                                                    <select  class="mb-3 form-control  " >
                                                            <option>Tuneps</option>
                                                            <option>موقع المؤسسة</option>
                                                            <option>مواقع أخرى</option>
                                                        </select>
                                                    <label>تاريخ الوصول :</label>
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder='15/05/2021'>
                                                    <label>الساعة :</label>
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder='10:00'>
                                                </div> 
                                                 <div class="col-md-6">
                                                    <label>وضعية الملف :</label>
                                                    <select  class="mb-3 form-control  ">
                                                            <option>بصدد الإعداد</option>
                                                            <option selected>في انتظار العروض</option>
                                                            <option>في الفرز</option>
                                                            <option>بصدد الإنجاز</option>
                                                            <option>القبول الوقتي</option>
                                                            <option>القبول النهائي</option>
                                                            <option>ملف منتهي </option>
                                                            <option>ملغى</option>
                                                    </select>
                                                    <label>المشروع :</label>
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder='اقتناء حواسيب وطابعات'>
                                                    <label>مرجع العرض :</label>
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                    <label>عدد التسجيل بمكتب الضبط :</label>
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder='01245'>
                                                    <label>تاريخ التسجيل :</label>
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder='16/05/2021'>
                                                    <label>الملاحظات :</label>
                                                    <textarea  class="mb-3 form-control form-control-lg" type="text"></textarea>
                                                </div>
                                            </div>    
												
									    </div>
    </div>
</div>
           
@endsection

