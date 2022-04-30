@extends('layouts.app')
@section('title')
<h5> ملحق عدد : ...   </h5>
@endsection

@section('content') 
 
<div class="col-sm-12">
    <div class="card">     
            <div class="card-header">
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
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                <label>الإطار :</label>
                                                <select class="mb-3 form-control " >
                                                            <option>مواد وخدمات</option>
                                                            <option>أشغال</option>
                                                            <option>دراسات</option>
                                                </select>
                                                <label>المتعهد :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                <label>تاريخ الملحق:</label>
                                                <input class="mb-3 form-control form-control-lg" type="date" placeholder=''>
                                                <label>قرار اللجنة :</label>
                                                 <select class="mb-3 form-control " >
                                                            <option>الموافقة </option>
                                                            <option>الإرجاء</option>
                                                            <option>عدم الموافقة</option>
                                                        </select>
                                                <label>تاريخ القرار:</label>
                                                <input class="mb-3 form-control form-control-lg" type="date" placeholder=''>
                                                <label>القرار :</label>
                                                 <button class="mb-3 form-control form-control-lg" onclick="document.getElementById('getFile').click()">حدد القرار</button>
                                                 <input type='file' id="getFile" style="display:none" >
                                            </div>
                                            <div class="col-md-6">
                                                <label>وضعية الملف :</label>
                                                <select class="mb-3 form-control ">
                                                            <option>بصدد الإعداد</option>
                                                            <option>في انتظار العروض</option>
                                                            <option>في الفرز</option>
                                                            <option>بصدد الإنجاز</option>
                                                            <option>القبول الوقتي</option>
                                                            <option>القبول النهائي</option>
                                                            <option>ملف منتهي </option>
                                                            <option>ملغى</option>
                                                        </select>
                                                <label>صنف الملحق :</label>
                                                <div>
                                                            <select id='selectFileAnnex'  class="mb-3 form-control " >
                                                                <option>تحديد صنف الملحق </option>
                                                                <option value="augrentationMontant "> زيادة في المبلغ</option>
                                                                <option value="reductionMontant ">تخفيض في المبلغ</option>
                                                                <option value="variationFinancement "> تغيير في نسبة التمويل</option>
                                                                <option value="changement ">تغيير فصل</option>
                                                                <option value="changementNCompte ">تغيير رقم الحساب</option>
                                                                <option value="changementLieuP ">تغيير موقع المشروع</option>
                                                            </select>
                                                        </div><br>
                                                         
                                                        <div class="mx-sm-3 ">
                                                            <div class="augrentationMontant class" >
                                                               <label> المبلغ الأصلي :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                               <label>  نسبة الزيادة :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                               <label>  مبلغ الصفقة النهائي :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                            </div>

                                                            <div class="reductionMontant class">
                                                               <label>  المبلغ الأصلي :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                               <label>  نسبة التخفيض :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                               <label>  مبلغ الصفقة النهائي :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                            </div>

                                                            <div class="variationFinancement class">
                                                               <label>  نسبة ميزانية الدولة :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                               <label>  نسبة التمويل الخارجي :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                            </div>

                                                            <div class="changement class">
                                                               <label>  العنوان :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                               <label>  الفصل :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                               <label>  الفقرة :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                               <label>  الفقرة الفرعية :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                            </div>

                                                            <div class="changementNCompte class">
                                                              <label>  البنك :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                              <label>  الحساب الجديد :</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                            </div>

                                                            <div class="changementLieuP class">
                                                             <label> الموقع الجديد</label><input class="mb-3 form-control form-control-lg"   placeholder=''>
                                                            </div>
                                                        </div>
                                            </div> 
                </div> 
        </div>     
	</div>											
</div>				
	    
@endsection
            
@section('srcipt-js') 
        <script >
            $(document).ready(function() {
                $("#selectFileAnnex").on('change', function() {
                    $(this).find("option:selected").each(function() {
                        var geeks = $(this).attr("value");
                        if (geeks) {
                            $(".class").not("." + geeks).hide();
                            $("." + geeks).show();
                        } else {
                            $(".class").hide();
                        }
  
                    });
                }).change();
                
            })
        </script>
    </div>
</div>
@endsection

