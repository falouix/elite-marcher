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

                <div class="shadow-lg p-3 mb-2 bg-white rounded" style="text-align:center;">
                    <span style="color:black; font-weight:bold; font-size:24px;">{{ __('app.welcome') }}{{ __('app.app_name') }}</span>

                </div>
                @if($besoins_actif)
                <div class="shadow-lg p-3 mb-1 bg-white rounded" style="text-align:center;">
                    <span style="color:rgb(231, 29, 29); font-weight:bold; font-size:20px;">بلاغ حول ظبط الحاجيات</span>
                </br>
                    <span style="color:rgb(27, 25, 25); font-weight:bold; font-size:18px;"> تم تحديد آجال ضبط الحاجيات لسنة {{ strftime("%Y") }} بداية من {{ $paramBesoin->date_debut }} إلى غاية {{ $paramBesoin->date_fin }}</span>
                </div>
                @endif
            </div>
            <!-- [ shadows ] end -->
        </div>
        <div class="row">

        </div>
    </div>

@endsection

@section('srcipt-js')
@endsection
