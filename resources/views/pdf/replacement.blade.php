<!DOCTYPE html>
<html lang="ar"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>
            {{ __('labels.replacementDoc') }}
        </title>
        <link rel="stylesheet" href="{{ asset('/css/styles_contract.css') }}">
    </head>

    <body dir="rtl">
        <header>
            <img src="{{ url($settings->cp_page_header) }}" width="793" height="125" alt="" style="border-radius:10px;">

            <address contenteditable="">الطابق {{ $floor }}<div>القاعة&nbsp; {{ $hall }}</div><div>الساعة {{ $session_hour }}</div></address>
        </header>


        <main>
            <h2 style="
    text-align: center;
    text-decoration: underline;
    font-weight: bolder;
"><b style="font-size: 26px;">سنــــد إنــــابة</b></h2><div><b style="font-size: 24px;"><br></b></div>
<p dir="rtl" style="line-height: 1.7999999999999998;text-align: right;margin-top: 0pt;margin-bottom: 0pt;background-color: transparent;">
    <span style="background-color: transparent;color: rgb(0, 0, 0);/* font-family: Arial; */font-size: 14pt;font-style: normal;font-weight: 400;white-space: pre-wrap;">        الزميل الأستاذ/ {{ $lawyer_replcament }} المحترم</span></p>
<p dir="rtl" style="line-height: 1.7999999999999998;text-align: right;margin-top: 0pt;margin-bottom: 0pt;background-color: transparent;"><span style="background-color: transparent;color: rgb(0, 0, 0);/* font-family: Arial; */font-size: 14pt;font-style: normal;font-weight: 400;white-space: pre-wrap;">        الرجاء التكرم بالحضور نيابة عني المحامي/ {{ $lawyer_1 }}</span></p>
<p dir="rtl" style="line-height: 1.7999999999999998; text-align: right; margin-top: 0pt; margin-bottom: 0pt;"><span style="background-color: transparent;color: rgb(0, 0, 0);/* font-family: Arial; */font-size: 14pt;font-style: normal;font-weight: 400;white-space: pre-wrap;">                                      (في الدعوى رقم {{ $case_num }} لسنة {{ $case_year }})</span></p>
<p dir="rtl" style="line-height: 1.7999999999999998; text-align: right; margin-top: 0pt; margin-bottom: 0pt;"><span style="background-color: transparent;color: rgb(0, 0, 0);/* font-family: Arial; */font-size: 14pt;font-style: normal;white-space: pre-wrap;">        المنظورة بجلسة يوم /{{ $session_day }}</span>
    <span style="background-color: transparent;color: rgb(0, 0, 0);/* font-family: Arial; */font-size: 14pt;font-style: normal;white-space: pre-wrap;">                                                        الموافق : {{ $session_date }}</span></p>
    <p dir="rtl" style="line-height: 1.7999999999999998; text-align: right; margin-top: 0pt; margin-bottom: 0pt;"><span style="background-color: transparent;color: rgb(0, 0, 0);/* font-family: Arial; */font-size: 14pt;font-style: normal;white-space: pre-wrap;">        أمام المحكمة / {{ $court_name }}                                                    الدائرة : {{ $circle_name }}</span></p>
    <p dir="rtl" style="line-height: 1.7999999999999998; text-align: right; margin-top: 0pt; margin-bottom: 0pt;"><span style="background-color: transparent; color: rgb(0, 0, 0); font-family: Arial; font-size: 14pt; font-style: normal; white-space: pre-wrap;"> </span></p>
    <p dir="rtl" style="line-height: 1.7999999999999998; text-align: right; margin-top: 0pt; margin-bottom: 0pt;"><span style="background-color: transparent;color: rgb(0, 0, 0);/* font-family: Arial; */font-size: 14pt;font-style: normal;white-space: pre-wrap;">        بصفتي وكيلا عن / {{ $client_name }}                                           بصفتة : {{ $client_type }}</span></p>
    <p dir="rtl" style="line-height: 1.7999999999999998; text-align: right; margin-top: 0pt; margin-bottom: 0pt;"><span style="background-color: transparent;color: rgb(0, 0, 0);/* font-family: Arial; */font-size: 14pt;font-style: normal;white-space: pre-wrap;">        ضد / {{ $party_name }}                                                            بصفتة : {{ $party_type }}</span></p>
    <p dir="rtl" style="line-height: 1.7999999999999998; text-align: right; margin-top: 0pt; margin-bottom: 0pt;"><br></p>
    <p dir="rtl" style="line-height: 1.7999999999999998;margin-top: 0pt;margin-bottom: 0pt;text-align: center;text-decoration: underline;"><font face="Arial"><span style="font-size: 18.6667px;/* white-space: pre-wrap; */font-weight: 500;">                                                  وإبــــــــداء الطلبات الآتية</span></font></p>
    <p dir="rtl" style="line-height: 1.7999999999999998; text-align: right; margin-top: 0pt; margin-bottom: 0pt;"><font face="Arial"><span style="font-size: 18.6667px; white-space: pre-wrap;">      </span></font></p><p dir="rtl" style="line-height: 1.7999999999999998; text-align: right; margin-top: 0pt; margin-bottom: 0pt;"><span style="background-color: transparent;color: rgb(0, 0, 0);/* font-family: Arial; */font-size: 14pt;font-style: normal;white-space: pre-wrap;">{{ $replacement_description }}  </span></p>
    <p><br></p>
    <p dir="rtl" style="line-height: 1.7999999999999998;text-align: right;margin-top: 0pt;margin-bottom: 0pt;text-decoration: underline;"><span style="background-color: transparent;color: rgb(0, 0, 0);/* font-family: Arial; */font-size: 12pt;font-style: normal;font-weight: 500;white-space: pre-wrap;">ولكم منا وافر الإحترام و التقدير,,,</span></p>
    <p><br></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p><br></p><h2>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;المحامي</h2><p><br></p><p><br></p><p><br></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p><br></p>
    <p><font face="Arial"><span style="font-size: 18.6667px; white-space: pre;">&nbsp;                                                  </span></font></p>
            <p></p>
        </main>
<script>
    window.onload = function() {
       window.print();
    };
</script>

</body>

</html>
