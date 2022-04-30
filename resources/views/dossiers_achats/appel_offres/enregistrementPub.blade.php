@extends('layouts.app')
@section('title')
<h5> تسجيل الإعلان الإشهاري </h5>
@endsection
@section('content')
    <div class="col-sm-12">
        <div class="card">
       
            <div class="card-header">
                <h4 style="text-align:center"> طلب عروض عدد : AO001 </h4>
                <div class="row">
                    <div class="col-auto">
                        المصلحة أو المؤسسة: مصلحة الإعلامية 
                    </div>
                    <div class="col text-right">
                       السنةالمالية : 2021
                    </div>
                </div>
                 التاريخ : 01/03/2021
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
                                                    <label>موجه الى :</label>
                                                        <select class="mb-3 form-control ">
                                                            <option>Tuneps</option>
                                                            <option>موقع المؤسسة</option>
                                                            <option>مواقع أخرى</option>
                                                        </select>
                                                    <label>مدة الإعلان باليوم :</label>
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder='30'>
                                                    <label>تاريخ أول ظهور للإعلان :</label>
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder='03/03/2021'>
                                                    <label>مرجع الإعلان :</label>
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder='AO001232021'>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>نص الإعلان :</label>
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                    <label>وضعية الملف :</label>
                                                    <select class="mb-3 form-control ">
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
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder=' اقتناء حواسيب وتصميم منظومات '>
                                                    <label>اخر أجل لقبول العروض :</label>
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder='03/04/2021 10:00'>
                                                    <label>تاريخ فتح الظروف :</label>
                                                    <input class="mb-3 form-control form-control-lg" type="text" placeholder='03/04/2021 10:00'>
                                                </div>
                                                	

                </div>
                
                                                <div >
                                                     <button type="button" class="btn btn-primary" title="btn btn-primary" data-toggle="tooltip">تسجيل</button> 
                                                </div> 
            </div>
          
            </div>
        </div>
    </div>
           
@endsection


