@extends('layouts.app')
@section('title')
<h5>  'التسوية النهائية</h5>
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
            
            <div class="col-md-12"><br>
                <div class="row">
                                            <div class="col-md-6">
                                                <label>الموضوع :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                 <label>الإطار :</label>
                                                <select class="mb-3 form-control " >
                                                            <option>مواد وخدمات</option>
                                                            <option>أشغال</option>
                                                            <option>دراسات</option>
                                                </select>
                                                 <label>المتعهد :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                 <label>تاريخ التسوية النهائية :</label>
                                                <input class="mb-3 form-control form-control-lg" type="date" >
                                                 <label>مبلغ الصفقة الأصلي:</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                 <label>مبلغ الصفقة النهائي :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                 <label>الفارق:</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                 <label>مبلغ الخصم للضمان:</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                            </div>
                                            <div class="col-md-6">
                                                
                                                 <label>مدة الضمان:</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                <label>وضعية الملف :</label>
                                                <select class="mb-3 form-control " >
                                                            <option>بصدد الإعداد</option>
                                                            <option>في انتظار العروض</option>
                                                            <option>في الفرز</option>
                                                            <option>بصدد الإنجاز</option>
                                                            <option>القبول الوقتي</option>
                                                            <option>القبول النهائي</option>
                                                            <option>ملف منتهي </option>
                                                            <option>ملغى</option>
                                                </select>
                                                 <label>مدة الإنجاز المبرمجة :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                 <label>مدة الإنجاز الفعلية :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                 <label>مدة توقف الأشغال :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                <div class="mb-3 ">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline1">تقدم في مدة الإنجاز</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
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


