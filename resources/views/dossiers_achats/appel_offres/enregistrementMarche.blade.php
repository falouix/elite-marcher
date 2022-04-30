 @extends('layouts.app')
@section('title')
<h5>' تسجيل الصفقة </h5>
@endsection
@section('content')

    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">
 
                  
            <div class="card-header">
                <h4 style="text-align:center">طلب عروض عدد: AO001</h4>
                <div class="row">
                    <div class="col-auto">
                        المصلحة أو المؤسسة:مصلحة الإعلامية
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
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='اقتناء حواسيب وتصميم منظومات'>
                                                <label>الإطار :</label>
                                                <select class="mb-3 form-control ">
                                                            <option>مواد وخدمات</option>
                                                            <option>أشغال</option>
                                                            <option>دراسات</option>
                                                </select>
                                                <label>المشروع :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='اقتناء حواسيب وتصميم منظومات'>
                                                <label>المتعهد :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=' شركة TECHNO'>
                                                <label>تاريخ الإذن:</label>
                                                <input class="mb-3 form-control form-control-lg" type="date" placeholder='10/04/2021 '>
                                                <label>تاريخ إمضاء العقد :</label>
                                                <input class="mb-3 form-control form-control-lg" type="date" placeholder='11/04/2021'>
                                               
                                            </div> 
                                            <div class="col-md-6">
                                                 <label>تاريخ تسجيل العقد :</label>
                                                <input class="mb-3 form-control form-control-lg" type="date" placeholder='12/04/2021'>
                                                <label>وضعية الملف :</label>
                                                <select class="mb-3 form-control ">
                                                            <option>بصدد الإعداد</option>
                                                            <option>في انتظار العروض</option>
                                                            <option selected>في الفرز</option>
                                                            <option>بصدد الإنجاز</option>
                                                            <option>القبول الوقتي</option>
                                                            <option>القبول النهائي</option>
                                                            <option>ملف منتهي </option>
                                                            <option>ملغى</option>
                                                        </select>
                                                <label>تاريخ إستلام الإذن:</label>
                                                <input class="mb-3 form-control form-control-lg" type="date" placeholder='10/04/2021 '>
                                                <label>نوع الصفقة :</label>
                                                <select class="mb-3 form-control ">
                                                            <option>صفقة مرهونة </option>
                                                            <option>صفقة غير مرهونة</option>
                                                        </select>
                                                <label>تاريخ النظير الوحيد :</label>
                                                <input class="mb-3 form-control form-control-lg" type="date" placeholder=''>
                                                <label>رقم تسجيل النظير:</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                            </div>
                </div>    
										
                 <button type="button" class="btn btn-primary" title="btn btn-primary" data-toggle="tooltip">تسجيل</button>											
	    </div>
    </div>
</div>          
@endsection

