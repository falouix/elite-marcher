@php
 if($settings->hidden_days){$hiddenday = $settings->hidden_days;} else {$hiddenday ="4,5";}
    if($settings->calendar_min_time){$minTime = $settings->calendar_min_time;} else {$minTime = '08:00:00';}
    if($settings->calendar_min_time){$maxTime = $settings->calendar_max_time;} else {$maxTime = '18:30:00';}
    if($settings->calendar_default_view){$defaultView = $settings->calendar_default_view;} else {$defaultView ='month';}
$breadcrumb = __('breadcrumb.bread_appointement');
if ($locale == 'ar') {
    $rtl = 'rtl';
} else {
    $rtl = 'ltr';
}
@endphp
@extends('layouts.app')
@section('head-script')
    <!-- fullcalendar css  -->
    <link rel="stylesheet" href="{{ asset('/plugins/fullcalendar/css/fullcalendar.min.css') }}">
    <!-- pnotify css -->
    <link rel="stylesheet" href="{{ asset('/plugins/pnotify/css/pnotify.custom.min.css') }}">
    <!-- pnotify-custom css -->
    <link rel="stylesheet" href="{{ asset('/css/pages/pnotify.css') }}">
    <!--Dropdown css & js-->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/mini-color/css/jquery.minicolors.css') }}">
@endsection
@section('breadcrumb')
    @include('layouts.partials.breadcrumb', [
    'bread_title'=> $breadcrumb,
    'bread_subtitle'=> $breadcrumb
    ])
@endsection

@section('content')
    <div class="card fullcalendar-card">
        <div class="card-header">
            <h5>{{ __('labels.appointement') }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div id='calendar' class='calendar'></div>
            </div>
        </div>
    </div>

    <!--******************************************* Event Modal Start **************************************-->
    <div class="modal fade show" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-modal="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel"> {{ __('inputs.btn_create_event') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--form-->
                    <form id='form_id'>
                        <input type="number" id="event_id" value="0" hidden>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>{{ __('labels.tbl_event_title') }}</label>
                                <input type="text" class="form-control" id="input-title" name="input-title">

                            </div>
                            <div class="form-group col-md-12">
                                <label for="input-description"
                                    class="col-form-label">{{ __('labels.tbl_event_description') }}</label>
                                <textarea class="form-control" id="input-description"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('labels.tbl_event_start_at') }}</label>
                                <input class="form-control" id="input-start" name="input-start" placeholder="dd-MM-dd HH:mm:ss"
                                    size="16" type="datetime-local">
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{ __('labels.tbl_event_end_at') }}</label>
                                <input class="form-control" type="datetime-local" placeholder="dd-MM-dd HH:mm:ss"
                                    size="16" id="input-end" name="end" placeholder="End date & time">
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{ __('labels.tbl_event_color') }}</label>
                                <input type="text" class="form-control color" name="color" id="input-color"
                                    data-control="hue" value="#7425d4">
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{ __('labels.tbl_event_textColor') }}</label>
                                <input type="text" name="textColor" id="input-textColor" class="form-control color"
                                    data-control="hue" value="#f7f7f7">
                            </div>
                            <!--*************************************start code dropdown add ******************************-->
                            <div class="form-group col-md-12">

                                <select class="form-control select2" id="user_id" name="user_id">
                                </select>
                            </div>
                            <!--**************************************end code dropdown*******************************-->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn_add_event"
                        class="btn btn-primary">{{ __('inputs.btn_create') }}</button>
                    <button type="button" id="btn_delete_event"
                        class="btn btn-danger">{{ __('inputs.btn_delete') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--******************************************* Event Modal End **************************************-->

@endsection


@section('srcipt-js')

    <!--model js-->
    <!--Dropdown js-->
    <!-- Full calendar js -->
    <script src="{{ asset('/plugins/fullcalendar/js/lib/moment.min.js') }}"></script>
    <script src="{{ asset('/plugins/fullcalendar/js/lib/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/plugins/fullcalendar/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('/plugins/fullcalendar/js/locale/locales-all.js') }}"></script>
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- Full calendar js end-->
    <!-- form-select-custom Js -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- minicolors Js -->
    <script src="{{ asset('/plugins/mini-color/js/jquery.minicolors.min.js') }}"></script>
    <!-- jquery-validation Js -->
    <script src="{{ asset('/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <!-- pnotify Js -->
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>


    <script type="text/javascript">
        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        var dateTime = date + ' ' + time;

        var user_id;
        // Full calendar
        $(document).ready(function() {
             // [ Initialize validation ]
             $('#form_id').validate({
                ignore: '.ignore',
                focusInvalid: false,
                rules: {
                    'input-title': {
                        required: true,
                    },
                    'input-start': {
                        required: true,
                    },
                    'user_id': {
                        required: true,
                    }
                },

                // Errors //

                errorPlacement: function errorPlacement(error, element) {
                    var $parent = $(element).parents('.form-group');

                    // Do not duplicate errors
                    if ($parent.find('.jquery-validation-error').length) {
                        return;
                    }

                    $parent.append(
                        error.addClass(
                            'jquery-validation-error small form-text invalid-feedback')
                    );
                },
                highlight: function(element) {
                    var $el = $(element);
                    var $parent = $el.parents('.form-group');

                    $el.addClass('is-invalid');

                    // Select2 and Tagsinput
                    if ($el.hasClass('select2-hidden-accessible') || $el.attr(
                            'data-role') === 'tagsinput') {
                        $el.parent().addClass('is-invalid');
                    }
                },
                unhighlight: function(element) {
                    $(element).parents('.form-group').find('.is-invalid').removeClass(
                        'is-invalid');
                }
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //**************************** MiniColors Background & Text Color Initialize ***********
            $('.color').each(function() {
                $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    defaultValue: $(this).attr('data-defaultValue') || '',
                    format: $(this).attr('data-format') || 'hex',
                    keywords: $(this).attr('data-keywords') || '',
                    inline: $(this).attr('data-inline') === 'true',
                    letterCase: $(this).attr('data-letterCase') || 'lowercase',
                    opacity: $(this).attr('data-opacity'),
                    position: $(this).attr('data-position') || 'bottom',
                    swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split(
                        '|') : [],
                    change: function(value, opacity) {
                        if (!value) return;
                        if (opacity) value += ', ' + opacity;
                        if (typeof console === 'object') {}
                    },
                    theme: 'bootstrap'
                });
            });
            //**************************** ajax dropdown *******************************************
            // Initialize Customer select2
            $("#user_id").select2({
                dir: "{{ $rtl }}",
                placeholder: "{{ __('labels.choose') }} ",
                dropdownParent: $("#eventModal"),
                ajax: {
                    url: "{{ route('users.AllByTypeListToSelect') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            search: params.term, // search term
                            type: 'all'
                        };
                    },
                },
                processResults: function(response) {
                    // alert(JSON.stringify(response))
                    return {
                        results: response
                    };
                },
                cache: true

            });
             /*****************************fullCalendar**************************/
            $('#calendar').fullCalendar({
                selectable: true,
                selectHelper: true,
                eventLimit: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listMonth'

                },
                locale: "{{ $locale }}",
                defaultView: '{{ $defaultView }}',
                minTime:'{{ $minTime }}', maxTime:'{{ $maxTime }}',
                hiddenDays: [ {{ $hiddenday }} ], // hide Mondays, Wednesdays, and Fridays

                dayMaxEvents: true, // allow "more" link when too many events
                events: "{{ route('listEvent') }}",
                // ************************************* select date start-end add e *******************************
                select: function(start, end, allDay) {
                    //******** show modal **************

                    //******** show start & end event **************
                    var start = $.fullCalendar.formatDate(start, 'Y/MM/DD HH:mm:ss');

                    var end = $.fullCalendar.formatDate(end, 'Y/MM/DD HH:mm:ss');
                    start = new Date(start);
                    //console.log(new Date(now.getTime()-now.getTimezoneOffset()*60000).toISOString().substring(0,19));
                    start = new Date(start.getTime() - start.getTimezoneOffset() * 60000).toISOString()
                        .substring(0, 19);
                    $('#input-start').val(start);
                    $('#input-end').val(end);
                    $("#btn_delete_event").toggle(false);
                    $('#eventModal').modal('show');
                },
                editable: true,
                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var description = event.description;
                    var color = event.color;
                    var textColor = event.textColor;
                    var id = event.id;
                    var users = event.user_id

                    if (Date.parse(dateTime) <= Date.parse(start)) {
                        $.ajax({
                            url: "{{ route('calendar.verif-users') }}",
                            method: "POST",
                            data: {
                                start: start,
                                end: end,
                                users: users
                            },
                            success: function(data) {
                                if (data === false) {
                                    //******update event******
                                    $.ajax({
                                        url: "{{ route('calendar.action') }}",
                                        type: "POST",
                                        data: {
                                            title: title,
                                            description: description,
                                            start: start,
                                            end: end,
                                            color: color,
                                            textColor: textColor,
                                            id: id,
                                            users: users,
                                            type: 'update'
                                        },
                                        success: function(response) {
                                            $('#calendar').fullCalendar(
                                                'refetchEvents')
                                            alert("Event Updated Successfully");
                                        }
                                    })
                                } else {
                                    alert(
                                        'error: there is a user (s) has another event in this date'
                                    );
                                }
                            }
                        });
                    } else {
                        alert('impossible to add an event in a previous date');
                    }
                },
                eventClick: function(event, delta, element) {
                    //******** show modal update **************

                    $('#input-title').val(event.title);
                    $('#input-description').val(event.description);
                    if (event.start) {
                        $('#input-start').val(event.start.toISOString());
                    }
                    if (event.end) {
                        $('#input-end').val(event.end.toISOString());
                    }
                    $('#input-color').val(event.color);
                    $('#input-color').minicolors('settings', {
                        swatches: [event.color]
                    });
                    $('#input-textColor').val(event.textColor);
                    $('#input-textColor').minicolors('settings', {
                        swatches: [event.textColor]
                    });
                    $('#event_id').val(event.id);
                    console.log(event.start.toISOString())

                    btn_title = "{{ __('inputs.btn_edit') }}"
                    $("#btn_add_event").html(btn_title)
                    $("#btn_delete_event").show()
                    $('#eventModal').modal('show');
                    //**********                  **************
                }
            });



        });
 /*****************************start function onclick  add event**************************/

        $('#btn_add_event').click(function() {

            let id = $('#event_id').val();
            var title = $('#input-title').val();
            var description = $('#input-description').val();
            var start = $('#input-start').val();
            var end = $('#input-end').val();
            var color = $('#input-color').val();
            var textColor = $('#input-textColor').val();
            var user_id = $('#user_id').val();
            let $type = 'add';

            var btn_title = "{{ __('inputs.btn_create') }}"
            if (id != 0) {
                btn_title = "{{ __('inputs.btn_edit') }}"
                $("#btn_add_event").html(btn_title)
                $("#btn_delete_event").toggle(false);
                $type = 'update';

            }

            if ($("#form_id").valid()) {

                /*
                user_id = $('#user_id').serialize();// return tt elements framework dans une chaine
                var ch=user_id[11];
                for(let i=24;i<user_id.length;i+=13){ch=ch.concat(',').concat(user_id[i]);}
                */
                var start_date = Date.parse(start)
                var end_date = Date.parse(end)
                var swal_title = "{{ __('labels.swal_error_title') }}"
                var swal_text = "";
                if (isNaN(start_date) || start_date > end_date) {
                    swal_text = "{{ __('labels.swal_error_event_star_end_date') }}"
                    swal({
                        icon: 'error',
                        title: swal_title,
                        text: swal_text,
                    })
                    return false;
                }
                if (color === textColor) {
                    swal_text = "{{ __('labels.swal_error_colors') }}"
                    swal({
                        icon: 'error',
                        title: swal_title,
                        text: swal_text,
                    })
                    return false;
                }
                $.ajax({
                    url: "{{ route('calendar.verif-users') }}",
                    method: "POST",
                    data: {
                        start: start,
                        end: end,
                        users: user_id //ch
                    },
                    success: function(data) {

                            //******add event******
                            $.ajax({
                                url: "{{ route('calendar.action') }}",
                                type: "POST",
                                data: {
                                    id: id,
                                    title: title,
                                    // description:description,
                                    start: start,
                                    end: end,
                                    color: color,
                                    textColor: textColor,
                                    users: user_id,
                                    //user_id:2,
                                    type: $type
                                },
                                success: function(data) {
                                    $('#calendar').fullCalendar(
                                        'refetchEvents');
                                    $('#eventModal').modal(
                                    'toggle');
                                    //alert("Event Created Successfully");
                                    document.getElementById(
                                            "form_id")
                                        .reset();
                                        PnotifyCustom(data)
                                    // $('#user_id').multiselect('refresh');
                                },
                                error: function(response) {
                                    console.log(JSON.stringify(
                                        response))
                                }
                            })

                    },
                    error: function(response) {
                        console.log(JSON.stringify(response))
                    }
                });
            }
        });
         /*****************************end function onclick  add event**************************/

            // *******************************start function click button delete *******************************
            $('#btn_delete_event').click(function() {
                swal({
                    title: "{{ __('labels.swal_delete_title') }}",
                    text: "{{ __('labels.swal_delete_text') }}",
                    icon: "warning",
                    buttons: ["{{ __('labels.swal_cancel_btn') }}", "{{ __('labels.swal_confirm_btn') }}"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                    var id = $('#event_id').val();
                    $.ajax({
                        url: "{{ route('calendar.action') }}",
                        type: "POST",
                        data: {
                            id: id,
                            type: "delete"
                        },
                        success: function(response) {
                            $('#calendar').fullCalendar('refetchEvents');
                            $('#eventModal').modal(
                                    'toggle');
                                    PnotifyCustom(response)
                            //alert("Event Deleted Successfully");
                        }
                    })
                }
                })

            });
            // *************************************end function onclick button delete *******************************

            $('#eventModal').on('hidden.bs.modal', function () {
                $('#form_id')[0].reset()
              })
    </script>

@endsection
