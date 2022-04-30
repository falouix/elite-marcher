@extends('layouts.app')
@section('title')
<h5>  القبول الوقتي </h5>
@endsection
@section('content')

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
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                <label>الإطار :</label>
                                                <select class="mb-3 form-control " >
                                                            <option>مواد وخدمات</option>
                                                            <option>أشغال</option>
                                                            <option>دراسات</option>
                                                </select>
                                                <label>المتعهد :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                <label>التاريخ المبرمج:</label>
                                                <input class="mb-3 form-control form-control-lg" type="date" placeholder=' '>
                                                <label>التاريخ الفعلي :</label>
                                                <input class="mb-3 form-control form-control-lg" type="date" placeholder=' '>
                                            </div>
                                            <div class="col-md-6">
                                                
                                                <label>مدة التاخير :</label>
                                                <input class="mb-3 form-control form-control-lg" type="date" placeholder=''>
                                                <label>نسبة تقدم الأشغال :</label>
                                                <input class="mb-3 form-control form-control-lg" type="text" placeholder=''>
                                                <label>محضر الإستلام الوقتي :</label>
                                                <button class="mb-3 form-control form-control-lg" onclick="document.getElementById('getFile').click()" >حدد المحضر  :</button>
                                                <input class="mb-3 form-control form-control-lg" type='file' id="getFile" style="display:none" >
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
                                            </div>
                </div>
            </div>
        </div> 
    </div>
								
											
												
												
@endsection


