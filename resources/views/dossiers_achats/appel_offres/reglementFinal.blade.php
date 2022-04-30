@extends('layouts.app')
@section('title')
<h5> التسوية النهائية</h5>
@endsection
@section('content')
    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">
 
                  
            <div class="card-header">
                <h4 style="text-align:center">طلب عروض عدد: AO001</h4>
                <div class="row">
                    <div class="col-auto">
                        المصلحة أو المؤسسة: مصلحة الإعلامية
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
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='اقتناء حواسيب وتصميم منظومات'>
                                                 <label>الإطار :</label>
                                                <select class="mb-3 form-control " >
                                                            <option>مواد وخدمات</option>
                                                            <option>أشغال</option>
                                                            <option>دراسات</option>
                                                </select>
                                                <label>المشروع :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='اقتناء حواسيب وتصميم منظومات'>
                                                 <label>المتعهد :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='المتعهد  TECHNO'>
                                                 <label>تاريخ التسوية النهائية :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='20/12/2021'  >
                                                 <label>مبلغ الصفقة الأصلي:</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='145000'>
                                                 <label>مبلغ الصفقة النهائي :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='131500'>
                                                 <label>الفارق:</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='14500'>
                                                 <label>مبلغ الخصم للضمان:</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='14500'>
                                            </div>
                                            <div class="col-md-6">
                                                
                                                 <label>مدة الضمان باليوم :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='364'>
                                                <label>وضعية الملف :</label>
                                                <select class="mb-3 form-control " >
                                                            <option>بصدد الإعداد</option>
                                                            <option>في انتظار العروض</option>
                                                            <option>في الفرز</option>
                                                            <option>بصدد الإنجاز</option>
                                                            <option selected>القبول الوقتي</option>
                                                            <option>القبول النهائي</option>
                                                            <option>ملف منتهي </option>
                                                            <option>ملغى</option>
                                                </select>
                                                 <label>مدة الإنجاز المبرمجة :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='220'>
                                                 <label>مدة الإنجاز الفعلية :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='260'>
                                                 <label>مدة توقف الأشغال :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='40'>
                                                <div class="mb-3 ">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline1">تقدم في مدة الإنجاز</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" checked>
                                                        <label class="custom-control-label" for="customRadioInline2">تـاخر في مدة الإنجاز</label>
                                                    </div>
                                                </div>
                                                 <label>مبلغ الخطية :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                 <label>نسبة الخطية:</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                            </div>
                </div>    
			</div>								
		</div>
    </div>				
            
@endsection

 
