 @extends('layouts.app')
@section('title')
<h5>  القبول النهائي </h5>
@endsection
@section('content')

    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">
 
                  
            <div class="card-header">
                <h4 style="text-align:center">طلب عروض عدد: AO001</h4>
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
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='شركة TECHNO'>
                                                <label>التاريخ المبرمج:</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='10/12/2021'>
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <label>التاريخ الفعلي :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='10/12/2021'>
                                                <label>مدة التاخير :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='0'>
                                                <label>نسبة تقدم الأشغال :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder='70%'>
                                                <label>محضر الإستلام الوقتي :</label>
                                                <button class="mb-3 form-control form-control-lg" onclick="document.getElementById('getFile').click()" >حدد المحضر  :</button>
                                                <input class="mb-3 form-control form-control-lg" type='file' id="getFile" style="display:none" >
                                                <label>وضعية الملف :</label>
                                                <select class="mb-3 form-control ">
                                                            <option>بصدد الإعداد</option>
                                                            <option>في انتظار العروض</option>
                                                            <option>في الفرز</option>
                                                            <option>بصدد الإنجاز</option>
                                                            <option selected>القبول الوقتي</option>
                                                            <option>القبول النهائي</option>
                                                            <option>ملف منتهي </option>
                                                            <option>ملغى</option>
                                                </select> 
                                            </div>
                </div>
            </div>
        </div> 
    </div>
								
											
												
												
@endsection


