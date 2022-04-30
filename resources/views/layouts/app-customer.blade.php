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

    @include('layouts.partials.menu-customer')
    @include('layouts.partials.head-bar')

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
                            <!-- Other js files or scripts -->.
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
                                        // console.log($(this).text());
                                        var title = $(this).text();
                                        if (title == "{{ $tbl_action }}" || title == '') {

                                        } else {
                                            $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
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
                            </script>
                            @if (Session::has('notification'))
                                <script>
                                    new PnotifyCustom({!! Session::get('notification') !!});
                                </script>
                            @endif


                            @include('layouts.partials.footer')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</body>

</html>
