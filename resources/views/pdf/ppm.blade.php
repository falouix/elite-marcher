<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0098)https://www.registre-entreprises.tn/search/HistoriqueQuittanceRcc.do?action=printExtrait&id=327051 -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport"
        content="width=device-width,height=device-height,minimum-scale=1,maximum-scale=1,user-scalable=no">

    <title>نموذج الملحق ععد1</title>
</head>

<body>
    <page size="A4">
        <div class="container">
            <div class="top-container">
                <div class="row pt-4 content-depot mb-4">
                    <div class="col-12  d-flex">



                        <div class="m-l-15px col">
                            <div class="col-12 text-right">
                                <h1>
                                    <strong>اﻟﺠﻤﻬﻮرﻳﺔ اﻟﺘﻮﻧﺴﻴﺔ
                                        <br>
                                        وزارة التعليم العالي والبحث العلمي
                                        <br>
                                        جــامعة جندوبة
                                    </strong>
                                </h1>
                            </div>

                            <div class="col-12 text-center mt-4 mb-4">
                                <h1>نموذج الملحق عدد 1 </h1>
                                <p>المخطط التقديري السنوي لإبرام الصفقات العمومية</p>
                                <p> {{ $annee_gestion }} السنة </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="row d-flex justify-content-between text-center align-items-center defaut-fiscal-container m-20-3">
                    <div class="right-top-container defaut-fiscal-left">
                        <h3 style="margin: 0;line-height: 2;">
                            .............................................................................. :إسم المسؤول
                            عن خلية الصفقات العمومية ولقبة</h3>
                    </div>

                    <div class="right-top-container defaut-fiscal-right">
                        <h3 style="margin: 0;line-height: 2;">
                            ............................................................................. :المشتري
                            العمومي </h3>
                    </div>
                </div>
                <div class="row d-flex justify-content-between text-center align-items-center defaut-fiscal-container">
                    <div class="right-top-container defaut-fiscal-row" style="margin: 0;line-height: 2;">
                        <strong> ................................ : الهاتف :................................ الفاكس
                            :................................ العنوان الإلكتروني </strong>
                    </div>
                </div>
                <div class="row table-content border-0 m-20-3">
                    <div class="text-center col-12">
                        <table width="100%" dir="rtl"
                            style="border-collapse: collapse;
                        border: 2px solid;">
                            <tbody>
                                <tr style="font-size: 1.2em;">
                                    <td rowspan="2">موضوع الصفقة</td>
                                    <td rowspan="2">آجال<br>الإنجاز</td>
                                    <td rowspan="2">طريقة<br>الإبرام</td>
                                    <td rowspan="2">الإجراءات</td>
                                    <td rowspan="2">مصدر<br>التمويل</td>
                                    <td colspan="9">التاريخ التقديري</td>

                                </tr>
                                <tr style="font-size: 1.2em;">
                                    <td>لإعداد كراسات<br>الشروط</td>
                                    <td>للإعلان<br>عن المنافسة</td>
                                    <td>لفتح<br>العروض</td>
                                    <td>لتعهد<br>لجنة الشراءات<br>بالملف</td>
                                    <td>لإحالة الملف <br>على لجنة<br>الصفقات</td>
                                    <td>لإجابة لجنة<br>الصفقات</td>
                                    <td>لنشر نتائج<br>المنافسة</td>
                                    <td>لتبليغ<br>الصفقة</td>
                                    <td>لبداية<br>الإنجاز</td>
                                </tr>

                            </tbody>
                            <tbody>

                                @foreach ($ppm as $projet)
                                    <tr>
                                        <td>{{ $projet->objet }}</td>
                                        <td>{{ $projet->duree_travaux_prvu }}</td>

                                        @switch ($projet->nature_passation)
                                            @case ('CONSULTATION')
                                                <td>استشارة عادية</td>
                                            @break

                                            @case('AOS')
                                                <td>صفقة إجراءات مبسطة</td>
                                            @break

                                            @case ('AON')
                                                <td>صفقة إجراءات عادية</td>
                                            @break

                                            @default
                                                <td>صفقة بالتفاوض المباشر</td>
                                            @break
                                        @endswitch
                                        <td></td>
                                        @switch($projet->source_finance)
                                            @case(1)
                                                <td>ميزانية الدولة</td>
                                            @break

                                            @case(2)
                                                <td>قرض</td>
                                            @break

                                            @default
                                                <td>هبة</td>
                                            @break
                                        @endswitch

                                        <td>{{ $projet->date_cc_prvu }}</td>
                                        <td>{{ $projet->date_avis_prvu }}</td>
                                        <td>{{ $projet->date_op_prvu }}</td>
                                        <td>{{ $projet->date_trsfert_ca_prvu }}</td>
                                        <td>{{ $projet->date_trsfert_cao_prvu }}</td>
                                        <td>{{ $projet->date_repca_prvu }}</td>
                                        <td>{{ $projet->date_pub_reslt_prvu }}</td>
                                        <td>{{ $projet->date_avis_soumissionaire_prvu }}</td>
                                        <td>{{ $projet->date_ordre_serv_prvu }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row d-flex justify-content-between text-center align-items-center">
                    <div class="left-top-center-container">
                        <h3>الإمضــاء <br> الإسم واللقب والصفة</h3>
                    </div>
                </div>
                <div class="row table-content  m-t-foot"></div>
                <div class="col-12 text-right p-top-foot" dir="rtl">
                    (1) باليوم
                    <br> (2) باليوم
                    <br> (3) باليوم
                    <br> (4) باليوم
                    <br> (5) باليوم
                    <br> (6) باليوم
                </div>
            </div>
        </div>

    </page>

    <style type="text/css">
        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }

        .m-t-foot {
            margin-top: 50px;
            padding-top: 10px
        }

        .p-top-foot {
            padding-top: 10px
        }

        .m-l-15px {
            margin-left: 15px
        }

        .col {
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width: 100%;
        }

        .top-container {
            height: auto;
            border-right: 0;
            border-left: 0;
            border-top: 0;
        }

        .bottom-container {
            height: auto;
        }

        .content-depot h1 {
            font-size: 18px;
        }

        .content-depot h2 {
            font-size: 16px;
            font-weight: bold;
        }

        .content-depot p {
            margin-bottom: 0;
            font-size: 16px;
            font-weight: 600;
            margin-top: 0;
        }

        .p-6 {
            padding-top: 0;
            padding-bottom: 0;
            padding-right: 10em;
            padding-left: 0em;
        }

        .dossier-number {
            padding: 10px;
            height: 50px;
            font-weight: bold;
            width: 330px;
            margin-right: 25px;
            margin-left: 25px;
            background: #e6f2fb;
            border: 1px solid #000000;
            text-align: center;
        }

        .dossier-mat {
            padding: 10px;
            height: 10px;
            width: 200px;
            margin-right: 25px;
            margin-left: 34px;
            background: #e6f2fb;
            border: 1px solid #000000;
            text-align: center;
            margin: 0 auto;
            font-weight: bold;
            line-height: 12px;
        }

        .p-6-2 {
            padding-right: 0em;
            padding-left: 0em;
        }

        .footer {
            margin-top: 20px;
        }

        .footer p {
            font-weight: 500;
            font-size: 16px;
        }

        .footer a {
            text-decoration: none;
            color: #000000;
        }

        .pt-4,
        .py-4 {
            padding-top: initial !important;
        }

        .mb-5-2,
        .my-5 {
            margin-bottom: 2rem !important;
        }

        .pt-5-2,
        .py-5 {
            padding-top: 1rem !important;
        }

        .row {
            width: 100%;
            text-align: center;
        }

        .col-12 {
            width: 100%;
        }

        .col-6 {
            width: 50%;
            float: left;
        }

        .text-center {
            text-align: center !important;
        }

        .text-left {
            text-align: left !important;
        }

        .text-right {
            text-align: right !important;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-between {
            -ms-flex-pack: justify !important;
            justify-content: space-between !important;
        }

        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }

        .col-4 {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .align-items-center {
            -ms-flex-align: center !important;
            align-items: center !important;
        }

        .container {
            /*  max-width: 1000px;*/
            margin: 0 auto;
        }

        .right-top-container {
            width: 25%;
            float: right;
            text-align: right;
        }
        .left-top-container {
            width: 25%;
            float: left;
            text-align: left;
        }

        .left-top-center-container {
            width: 25%;
            float: left;
            text-align: center;
        }

        .arabic-name {
            border: 2px solid;
            width: 104px;
            padding: 8px;
            font-size: 18px;
            text-align: center;
            float: right;
        }

        .french-name {
            border: 2px solid;
            width: 157px;
            padding: 8px;
            font-size: 15px;
            text-align: center;
            float: left;
        }

        .table-content {
            border-bottom: 2px solid;
            padding-bottom: 20px;
            z-index: 1;
        }

        .table-content table tr {
            border: 1px solid;
        }

        .table-content table td {
            border: 1px solid;
            text-align: center;
            white-space: pre;
        }

        .fl-left {
            float: left;
        }

        .links-container {
            width: 74%;
            text-align: right !important;
            float: right;
            position: relative;
            top: -85px;
            left: 2px;
        }

        .f-s-15 {
            font-size: 15px;
        }

        .clearfix {
            clear: both;
        }

        .empty-case {
            width: 460px;
            height: 90px;
        }

        .text-content {
            width: 100%;
            padding: 10px;
            height: auto;
            min-height: 110px;
            font-weight: bold;
            background: #e6f2fb;
            border: 1px solid #000000;
            text-align: right;
        }

        .border-0 {
            border: 0 !important
        }

        .h-auto {
            height: auto !important;
        }

        .f-s-22 {
            font-size: 22px;
        }

        h3 {
            display: block;
            font-size: 1em;
            margin-block-start: 1em;
            margin-block-end: 12px;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }

        .center-content {
            text-align: center;
            width: 50%;
            word-break: break-all;
        }

        .m-20 {
            margin-top: 15px !important;
            margin-bottom: 15px !important;
        }

        .m-20-2 {
            margin-top: 15px !important;
            margin-bottom: 15px !important;
        }

        .m-20-3 {
            margin-top: 15px !important;
        }

        .arabic-title {
            font-size: 33.5px;
        }

        .qr-code {
            width: auto;
            position: relative;
            top: -13px;
            left: -9px;
            background: transparent;
            z-index: -1;
        }

        .arabic-text {
            font-size: 20px;
            line-height: 14px;
            margin-left: 6px;
        }


        @media print {

            body,
            page {
                margin: 0;
                box-shadow: 0;
            }
        }

        .border-0 {
            border: 0 !important
        }

        .left-top-container.col-6,
        .right-top-container.col-6 {
            width: 49%
        }

        .align-items-start {
            align-items: start;
        }

        .rtl {
            direction: rtl;
        }

        .qr-width {
            width: 160px
        }

        .qr-width img {
            width: 100%
        }

        .defaut-fiscal-container {
            border: 1px solid black;
            width: 100% !important;
        }

        .defaut-fiscal-center {
            padding-left: 5px !important;
            padding-right: 5px !important;
            width: 70% !important;
        }

        .defaut-fiscal-row {
            padding-left: 5px !important;
            padding-right: 5px !important;
            width: 100% !important;
        }

        .defaut-fiscal-right {
            border-left: 1px solid black;
            width: 50% !important;
            padding-right: 5px;
        }

        .defaut-fiscal-left {
            border-right: 1px solid black;
            width: 50% !important;
            padding-left: 5px;
        }

        body {
            font-family: Times New Roman Georgia
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
