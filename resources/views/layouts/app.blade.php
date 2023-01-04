 <!DOCTYPE html>
<html>
<head>
    @include('layouts.partials.head')
    @yield('head-script')
</head>
@php
$tbl_action = __('labels.tbl_action');
@endphp

<body>

    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    @include('layouts.partials.menu')
    @include('layouts.partials.head-bar')
    {{-- @--include('layouts.partials.chat') --}}


    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ breadcrumb ] start -->
                            @yield('breadcrumb')
                            <!-- [ breadcrumb ] end -->
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!-- [ sample-page ] start -->
                                @yield('content')
                                <!-- [ sample-page ] end -->
                            </div>
                            <!-- [ Main Content ] end -->
                            <!-- Warning Section start -->
                            <!-- Older IE warning message -->
                            <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="{{ asset('/images/browser/chrome.png') }}" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="{{ asset('/images/browser/firefox.png') }}" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="{{ asset('/images/browser/opera.png') }}" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="{{ asset('/images/browser/safari.png') }}" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="{{ asset('/images/browser/ie.png') }}" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
                            <!-- Warning Section Ends -->
                            <!-- Required Js -->
                            <script src="{{ asset('/js/vendor-all.min.js') }}"></script>
                            <script src="{{ asset('/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
                            <script src="{{ asset('/js/pcoded.min.js') }}"></script>
                            <script src="{{ asset('/js/menu-setting.min.js') }}"></script>


                            {{-- Single delete modal --}}
                            @yield('srcipt-js')
                            <script>
                                // Add selected row count to Mulitiple Delete Btn
                                function SelectedRowCountBtnDelete(table) {
                                    if (table.rows('.selected').data().length > 0) {
                                        $("#btn_count").html('(' + table.rows('.selected').data().length + ')')
                                    } else {
                                        $("#btn_count").html('')
                                    }
                                }
                                // Setup - add a text input to each footer cell
                                function addSearchFooterDataTable(tableId) {
                                    $('' + tableId + ' tfoot th').each(function() {
                                        console.log($(this).text());
                                        var title = $(this).text();
                                        switch (title) {
                                            case "{{ $tbl_action }}":
                                                // code block
                                                break;
                                            case '':
                                                // code block
                                                break;
                                            case 'id':
                                                // code block
                                                break;
                                            case " ":
                                                // code block
                                                break;
                                            default:

                                                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
                                                // code block
                                        }

                                    });
                                }

                                function deleteSingleRowDataTable(tableId) {
                                    var table = $(tableId).DataTable();
                                    var row = $(this).parents('tr');

                                    if ($(row).hasClass('child')) {
                                        table.row($(row).prev('tr')).remove().draw();
                                    } else {
                                        table
                                            .row($(this).parents('tr'))
                                            .remove()
                                            .draw();
                                    }
                                }
                                // Top left/right
                                function PnotifyCustom(response) {

                                    var position = "stack-top-right";
                                    var stack_top_left = {
                                        "dir1": "down",
                                        "dir2": "right",
                                        "push": "top"
                                    };

                                    if (response.rtl == true) {
                                        stack_top_left = {
                                            "dir1": "down",
                                            "dir2": "left",
                                            "push": "top"
                                        };
                                        position = "stack-top-left"
                                    }

                                    var opts = {
                                        title: response.title,
                                        text: response.message,
                                        addclass: position + " bg-primary",
                                        stack: stack_top_left,
                                        delay: 3000,

                                    };
                                    switch (response.type) {
                                        case 'error':
                                            opts.addclass = position + " bg-danger";
                                            opts.type = "error";
                                            break;

                                        case 'info':
                                            opts.addclass = position + " bg-info";
                                            opts.type = "info";
                                            break;

                                        case 'success':
                                            opts.addclass = position + " bg-success";
                                            opts.type = "success";
                                            break;
                                    }
                                    new PNotify(opts);
                                }

                                function multipleDeleteG(locale, tableId, ids, url) {

                                    if (ids.length <= 0) {
                                        swal("{{ __('labels.swal_warning_title') }}", "{{ __('labels.swal_delete_users_warning_text') }}",
                                            "warning");
                                        return;
                                    } else {
                                        swal({
                                                title: "{{ __('labels.swal_delete_title') }}",
                                                text: "{{ __('labels.swal_delete_text') }}",
                                                icon: "warning",
                                                buttons: ["{{ __('labels.swal_cancel_btn') }}", "{{ __('labels.swal_confirm_btn') }}"],
                                                dangerMode: true,
                                            })
                                            .then((willDelete) => {
                                                if (willDelete) {

                                                    if (locale == 'ar') {
                                                        var stack_top_left = {
                                                            "dir1": "down",
                                                            "dir2": "right",
                                                            "push": "top"
                                                        };
                                                        var PnClass = "stack-top-left bg-primary";
                                                    } else {
                                                        var stack_top_left = {
                                                            "dir1": "down",
                                                            "dir2": "left",
                                                            "push": "top"
                                                        };
                                                        var PnClass = "bg-primary";
                                                    }
                                                    // Progress loader
                                                    var cur_value = 1,
                                                        valuePB = 1,
                                                        progress;
                                                    var idsArr = [];
                                                    // Make a loader.
                                                    var loader = new PNotify({
                                                        title: "{{ __('labels.pnotify_title') }}",
                                                        text: '<div class="progress progress-striped active" style="margin:0">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                <span class="sr-only">0%</span>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>',
                                                        addclass: PnClass,
                                                        stack: stack_top_left,
                                                        icon: 'icon-spinner4 spinner',

                                                        hide: false,
                                                        buttons: {
                                                            closer: false,
                                                            sticker: false
                                                        },
                                                        history: {
                                                            history: false
                                                        },
                                                        before_open: function(PNotify) {
                                                            progress = PNotify.get().find("div.progress-bar");
                                                            progress.width(cur_value + "%").attr("aria-valuenow", cur_value).find(
                                                                "span").html(
                                                                cur_value + "%");
                                                            // Pretend to do something.
                                                            ids.each((el) => {
                                                                console.log('ids : ' + el.id)
                                                                idsArr.push(el.id);
                                                            })
                                                            //idsArr.join(",")
                                                            //console.log("id arr : " +idsArr)
                                                            $.ajax({
                                                                type: 'DELETE',
                                                                dataType: 'JSON',
                                                                url: url,
                                                                data: {
                                                                    ids: idsArr,
                                                                },
                                                                success: function(response) {

                                                                    // refresh data or remove only tr
                                                                    deleteSingleRowDataTable(tableId)
                                                                    $("#btn_count").html('')
                                                                    //console.log('id : '+ el.id, cur_value, ids.length)
                                                                    PnotifyCustom(response)
                                                                },
                                                                error: function(error) {
                                                                    alert(JSON.stringify(error))
                                                                }
                                                            });
                                                            var timer = setInterval(function() {
                                                                if (valuePB >= 100) {

                                                                    // Remove the interval.
                                                                    window.clearInterval(timer);
                                                                    loader.remove();
                                                                    return;
                                                                }
                                                                valuePB = ((cur_value + 1) / ids.length) * 100;
                                                                cur_value += 1;
                                                                progress.width(Math.round(valuePB) + "%").attr(
                                                                        "aria-valuenow", Math.round(
                                                                            valuePB))
                                                                    .find("span")
                                                                    .html(Math.round(valuePB) + "%");
                                                            }, 65);


                                                        }
                                                    });

                                                    return;

                                                }
                                            });
                                    }


                                }

                                function customnotify(title, desc, url) {

                                    if (Notification.permission !== "granted") {
                                        Notification.requestPermission();
                                    } else {
                                        var notification = new Notification(title, {
                                            icon: '',
                                            body: desc,
                                        });

                                        /* Remove the notification from Notification Center when clicked.*/
                                        notification.onclick = function() {
                                            window.open(url);
                                        };

                                        /* Callback function when the notification is closed. */
                                        notification.onclose = function() {
                                            console.log('Notification closed');
                                        };

                                    }
                                }

                                function showNotifG() {
                                    var afficheNotifDesktop = 'True'
                                    var afficheNotifValidationDesktop = 'True'
                                    var afficheNotifActionsDesktop = 'True'
                                    var nbNotifModel = 10
                                    var nbNotifValidationModel = 2
                                    var nbNotifActionsModel = 6
                                    if (afficheNotifDesktop == 'True') {
                                        showInernalNotif("info", 'إشعارات تذكير ', "لديك " + nbNotifModel + " إشعارات تذكير ", "", false)
                                        customnotify('إشعار', "لديك " + nbNotifModel + " إشعارات تذكير ", '');
                                    }
                                    if (afficheNotifValidationDesktop == 'True') {
                                        showInernalNotif("success", " إشعارات تذكير لتثبيت المعلومات ", "لديك " + nbNotifValidationModel +
                                            "إشعارات تذكير لتثبيت المعلومات ",
                                            "", true)
                                        customnotify('إشعار', "لديك " + nbNotifValidationModel + " إشعارات تذكير لتثبيت المعلومات ",
                                            '');
                                    }
                                    if (afficheNotifActionsDesktop == 'True') {
                                        showInernalNotif("error", "إشعارات تذكير لتثبيت المعلومات ",
                                            "لديك " + nbNotifActionsModel + " مهام يجب إنجازها ", "", false)
                                        customnotify('إشعار', "لديك " + nbNotifActionsModel + " مهام يجب إنجازها ", '');
                                    }
                                }

                                function showInernalNotif(type, title, desc, url, hide) {

                                    show_stack_bottom_right(type, title, desc, url, hide);
                                }
                                // Stacks
                                // ------------------------------

                                // Define directions
                                var stack_top_left = {
                                    "dir1": "down",
                                    "dir2": "right",
                                    "push": "top"
                                };
                                var stack_bottom_left = {
                                    "dir1": "right",
                                    "dir2": "up",
                                    "push": "top"
                                };
                                var stack_bottom_right = {
                                    "dir1": "up",
                                    "dir2": "right",
                                    "firstpos1": 25,
                                    "firstpos2": 25
                                };
                                var stack_custom_left = {
                                    "dir1": "right",
                                    "dir2": "down"
                                };
                                var stack_custom_right = {
                                    "dir1": "left",
                                    "dir2": "up",
                                    "push": "top"
                                };
                                var stack_custom_top = {
                                    "dir1": "down",
                                    "dir2": "right",
                                    "push": "top",
                                    "spacing1": 1
                                };
                                var stack_custom_bottom = {
                                    "dir1": "up",
                                    "dir2": "left",
                                    "spacing1": 1
                                };
                                // Custom bottom position
                                function show_stack_custom_bottom(type, title, desc, url, $hide) {
                                    type = "info"
                                    var opts = {
                                        title: "Over here",
                                        text: "Check me out. I'm in a different stack.",
                                        width: "50%",
                                        cornerclass: "no-border-radius",
                                        addclass: "stack-custom-bottom bg-primary",
                                        stack: stack_custom_bottom,
                                        hide: $hide
                                    };
                                    switch (type) {
                                        case 'error':
                                            opts.title = "Oh No";
                                            opts.text = "Watch out for that water tower!";
                                            opts.addclass = "stack-custom-bottom bg-danger";
                                            opts.type = "error";
                                            break;

                                        case 'info':
                                            opts.title = "Breaking News";
                                            opts.text = "Have you met Ted?";
                                            opts.addclass = "stack-custom-bottom bg-info";
                                            opts.type = "info";
                                            break;

                                        case 'success':
                                            opts.title = "Good News Everyone";
                                            opts.text = "I've invented a device that bites shiny metal asses.";
                                            opts.addclass = "stack-custom-bottom bg-success";
                                            opts.type = "success";
                                            break;
                                    }
                                    new PNotify(opts);
                                }
                                // Bottom right
                                function show_stack_bottom_right(type, title, desc, url, hide) {
                                    console.log(hide)
                                    var opts = {
                                        title: title,
                                        text: desc,
                                        addclass: "stack-bottom-left bg-primary",
                                        stack: stack_bottom_right,
                                        hide: hide
                                    };
                                    switch (type) {
                                        case 'error':

                                            opts.addclass = "stack-bottom-left bg-danger";
                                            opts.type = "error";
                                            break;

                                        case 'info':

                                            opts.addclass = "stack-bottom-left bg-info";
                                            opts.type = "info";
                                            break;

                                        case 'success':

                                            opts.addclass = "stack-bottom-left bg-success";
                                            opts.type = "success";
                                            break;
                                    }
                                    new PNotify(opts);
                                }

                            </script>
                            @if (Session::has('notification'))
                                <script>
                                    new PnotifyCustom({!! Session::get('notification') !!});
                                </script>
                            @endif




                            {{-- @include('layouts.partials.footer') --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</body>

</html>
