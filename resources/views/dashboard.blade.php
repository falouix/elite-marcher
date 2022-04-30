@extends('layouts.app')

@section('content')

    <!-- [ sample-page ] start -->


    <div class="col-md-12">
        <div class="row">
            <!-- [ shadows ] start -->
            <div class="col-md-12">
                <div class="shadow-lg p-3 mb-5 bg-white rounded" style="text-align:center;">
                    <span style="color:black; font-weight:bold; font-size:24px;">Welcome to the Lawyer Program</span>
                </div>
            </div>
            <!-- [ shadows ] end -->
        </div>

        <div class="row">
            <div class="col-md-6">
                <!-- [ cards ] start -->

                <!-- [ row 1 ] end -->
                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="card ticket-card">
                            <div class="card-body">
                                <p class="m-b-25 bg-c-green lbl-card"><i class="fas fa-users m-r-5"></i> عدد العملاء</p>
                                <div class="text-center">
                                    <h2 class="m-b-0 d-inline-block text-c-green">307</h2>
                                    <p class="m-b-0 d-inline-block">عميل</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card ticket-card">
                            <div class="card-body">
                                <p class="m-b-25 bg-c-red lbl-card"><i class="fas fa-folder-open m-r-5"></i> عدد القضايا
                                    النشطة</p>
                                <div class="text-center">
                                    <h2 class="m-b-0 d-inline-block text-c-red">128</h2>
                                    <p class="m-b-0 d-inline-block">قضية</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card ticket-card">
                            <div class="card-body">
                                <p class="m-b-25 bg-c-blue lbl-card"><i class="fas fa-file-archive m-r-5"></i> عدد الجلسات
                                </p>
                                <div class="text-center">
                                    <h2 class="m-b-0 d-inline-block text-c-blue">134</h2>
                                    <p class="m-b-0 d-inline-block">جلسة</p>                                    
                                </div>
                            </div>
                        </div>
                    </div>

                 

                    <div class="col-md-4">
                        <div class="card  bg-success">
                            <div class="card-body">
                                <div class="counter-status d-flex md-mb-0">
                                    <div class="counter-icon text-success">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div class="mr-auto text-center">
                                        <h5 class="tx-14 tx-white-8 mb-3"> إجمالي العقود</h5>
                                        <h2 class="counter mb-0 text-white"
                                            style="font-family: Arial, sans-serif; font-size: 24px">
                                            2,000.000
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-info">
                            <div class="card-body">
                                <div class="counter-status d-flex md-mb-0">
                                    <div class="counter-icon text-success">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div class="mr-auto text-center">
                                        <h5 class="tx-14 tx-white-8 mb-3"> إجمالي المدفوع </h5>
                                        <h2 class="counter mb-0 text-white"
                                            style="font-family: Arial, sans-serif; font-size: 24px">
                                            400.000
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card  bg-danger">
                            <div class="card-body">
                                <div class="counter-status d-flex md-mb-0">
                                    <div class="counter-icon text-success">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div class="mr-auto text-center">
                                        <h5 class="tx-14 tx-white-8 mb-3"> اجمالي المتبقي</h5>
                                        <h2 class="counter mb-0 text-white"
                                            style="font-family: Arial, sans-serif; font-size: 24px">
                                            1,600.000
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="card  bg-secondary">
                            <div class="card-body">
                                <div class="counter-status d-flex md-mb-0">
                                    <div class="counter-icon text-success">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div class="mr-auto text-center">
                                        <h5 class="tx-14 tx-white-8 mb-3"> اجمالي المصروفات </h5>
                                        <h2 class="counter mb-0 text-white"
                                            style="font-family: Arial, sans-serif; font-size: 24px">
                                            200.000
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card  bg-warning">
                            <div class="card-body">
                                <div class="counter-status d-flex md-mb-0">
                                    <div class="counter-icon text-success">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div class="mr-auto text-center">
                                        <h5 class="tx-14 tx-white-8 mb-3"> المبالغ المتبقية بعد المصروفات </h5>
                                        <h2 class="counter mb-0 text-white"
                                            style="font-family: Arial, sans-serif; font-size: 24px">
                                            200.000
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
                <!-- [ row 2 ] end -->

                <!-- [ Quick links ] start -->
                <!-- [ row 3 ] start -->
                <div class="row">




                    <div class="col-md-12">
                        <h5 class="font-weight-bold pb-3"> روابط سريعة : </h5>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <a href="#" class="btn btn-primary btn-block">
                            <i class="fe fe-users tx-20 pl-2"></i>
                            العملاء
                        </a>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <a href="#" class="btn btn-danger btn-block">
                            <i class="fas fa-gavel tx-20 pl-2"></i>
                            القضايا
                        </a>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <a href="#" class="btn btn-warning btn-block">
                            <i class="fas fa-gavel tx-20 pl-2"></i>
                            قضية جديدة
                        </a>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <a href="#" class="btn btn-success btn-block">
                            <i class="far fa-clock tx-20 pl-2"></i>
                            الجلسات
                        </a>
                    </div>


                    <div class="col-sm-6 col-md-3 mb-2">
                        <a href="#" class="btn btn-secondary btn-block">
                            <i class="fe fe-dollar-sign tx-20 pl-2"></i>
                            المدفوعـــات
                        </a>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <a href="#" class="btn btn-success btn-block">
                            <i class="fe fe-dollar-sign tx-20 pl-2"></i>
                            المصروفــات
                        </a>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <a href="#" class="btn btn-info btn-block">
                            <i class="fas fa-sort-amount-up-alt tx-20 pl-2"></i>
                            تقارير العملاء
                        </a>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <a href="#" class="btn btn-dark btn-block">
                            <i class="fas fa-sort-amount-up-alt tx-20 pl-2"></i>
                            تقارير القضايا
                        </a>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <a href="#" class="btn btn-danger btn-block">
                            <i class="fas fa-sort-amount-up-alt tx-20 pl-2"></i>
                            تقارير الجلسات
                        </a>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <a href="#" class="btn btn-warning btn-block">
                            <i class="fas fa-sort-amount-up-alt tx-20 pl-2"></i>
                            تقارير المدفوعات
                        </a>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <a href="#" class="btn btn-secondary btn-block">
                            <i class="fas fa-cogs tx-20 pl-2"></i>
                            إعدادات النظام
                        </a>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <a href="#" class="btn btn-danger btn-block">
                            <i class="fas fa-cogs tx-20 pl-2"></i>
                            المستخدمين
                        </a>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <a href="#" class="btn btn-primary btn-block">
                            <i class="fas fa-user-tag tx-20 pl-2"></i>
                            الصلاحيات
                        </a>
                    </div>


                </div>
                <!-- [ row 4 ] end -->
                <!-- [ Quick links ] end -->

            </div>

            <!-- [ cards ] end -->

            <div class="col-md-6">
                <div class="card fullcalendar-card">
                    <div class="card-header">
                        <h5>Full Calendar</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div id='calendar' class='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>



    <!-- [ sample-page ] end -->
@endsection





@section('srcipt-js')
    <!-- am chart js -->
    <script src="{{ asset('/plugins/chart-am4/js/core.js') }}"></script>
    <script src="{{ asset('/plugins/chart-am4/js/charts.js') }}"></script>
    <script src="{{ asset('/plugins/chart-am4/js/animated.js') }}"></script>
    <script src="{{ asset('/plugins/chart-am4/js/maps.js') }}"></script>
    <script src="{{ asset('/plugins/chart-am4/js/worldLow.js') }}"></script>
    <script src="{{ asset('/plugins/chart-am4/js/continentsLow.js') }}"></script>

    <!-- dashboard-custom js -->
    <script src="{{ asset('/js/pages/dashboard-analytics.js') }}"></script>

    <!-- Full calendar js -->
    <script src="{{ asset('/plugins/fullcalendar/js/lib/moment.min.js') }}"></script>
    <script src="{{ asset('/plugins/fullcalendar/js/lib/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/plugins/fullcalendar/js/fullcalendar.min.js') }}"></script>
    <!-- Full calendar js end-->



    <script type="text/javascript">
        // Full calendar
        $(window).on('load', function() {
            $('#external-events .fc-event').each(function() {
                $(this).data('event', {
                    title: $.trim($(this).text()),
                    stick: true
                });
                $(this).draggable({
                    zIndex: 999,
                    revert: true,
                    revertDuration: 0
                });
            });
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: '2018-08-12',
                editable: true,
                droppable: true,
                events: [{
                    title: 'All Day Event',
                    start: '2018-08-01',
                    borderColor: '#04a9f5',
                    backgroundColor: '#04a9f5',
                    textColor: '#fff'
                }, {
                    title: 'Long Event',
                    start: '2018-08-07',
                    end: '2018-08-10',
                    borderColor: '#f44236',
                    backgroundColor: '#f44236',
                    textColor: '#fff'
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2018-08-09T16:00:00',
                    borderColor: '#f4c22b',
                    backgroundColor: '#f4c22b',
                    textColor: '#fff'
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2018-08-16T16:00:00',
                    borderColor: '#3ebfea',
                    backgroundColor: '#3ebfea',
                    textColor: '#fff'
                }, {
                    title: 'Conference',
                    start: '2018-08-11',
                    end: '2018-08-13',
                    borderColor: '#1de9b6',
                    backgroundColor: '#1de9b6',
                    textColor: '#fff'
                }, {
                    title: 'Meeting',
                    start: '2018-08-12T10:30:00',
                    end: '2018-08-12T12:30:00'
                }, {
                    title: 'Lunch',
                    start: '2018-08-12T12:00:00',
                    borderColor: '#f44236',
                    backgroundColor: '#f44236',
                    textColor: '#fff'
                }, {
                    title: 'Happy Hour',
                    start: '2018-08-12T17:30:00',
                    borderColor: '#a389d4',
                    backgroundColor: '#a389d4',
                    textColor: '#fff'
                }, {
                    title: 'Birthday Party',
                    start: '2018-08-13T07:00:00'
                }, {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2018-08-28',
                    borderColor: '#a389d4',
                    backgroundColor: '#a389d4',
                    textColor: '#fff'
                }],
                drop: function() {
                    if ($('#drop-remove').is(':checked')) {
                        $(this).remove();
                    }
                }
            });
        });
    </script>


    <!-- cards css -->
    <style>
        .order-card {
            color: #fff;
        }

        .bg-c-blue {
            background: linear(45deg, #4099ff, #73b4ff);
        }

        .bg-c-green {
            background: linear(45deg, #2ed8b6, #59e0c5);
        }

        .bg-c-yellow {
            background: linear(45deg, #FFB64D, #ffcb80);
        }

        .bg-c-pink {
            background: linear(45deg, #FF5370, #ff869a);
        }


        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .card .card-block {
            padding: 25px;
        }

        .order-card i {
            font-size: 26px;
        }

        .f-left {
            float: left;
        }

        .f-right {
            float: right;
            font-size: 20px;
        }

    </style>
    <!-- / cards css -->

@endsection
