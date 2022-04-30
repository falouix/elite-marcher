@extends('layouts.app')
@section('page_title')
 {{__('app.home_page')}}
@endsection

@section('head-script')
<!-- fullcalendar css -->
<link rel="stylesheet" href="{{ asset('/plugins/fullcalendar/css/fullcalendar.min.css')}}">
@endsection
@section('content')

    <!-- [ sample-page ] start -->
    <div class="col-md-12">
        <div class="row">
            <!-- [ shadows ] start -->
            <div class="col-md-12">
                <div class="shadow-lg p-3 mb-5 bg-white rounded" style="text-align:center;">
                    <span style="color:black; font-weight:bold; font-size:24px;">{{ __('app.welcome') }}{{ __('app.app_name') }}</span>
                </div>
            </div>
            <!-- [ shadows ] end -->
        </div>
        <div class="row">

        </div>
    </div>

@endsection

@section('srcipt-js')
@endsection
