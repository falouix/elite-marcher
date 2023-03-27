@php

    $breadcrumb = 'الإستشارات';
    $subreadcrumb = 'مراحل إنجاز الإستشارة';

    if ($locale == 'ar') {
        $lang = asset('/plugins/i18n/Arabic.json');
        $rtl = 'rtl';
    } else {
        $lang = '';
        $rtl = 'ltr';
    }
    $tbl_action = __('labels.tbl_action');

    $avisDossier = $dossier->avis_dossiers;
   // dd($avisDossier);
@endphp

@extends('layouts.app')
@section('head-script')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('/plugins/data-tables/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/data-tables/css/select.dataTables.min.css') }}">
    <!-- pnotify css -->
    <link rel="stylesheet" href="{{ asset('/plugins/pnotify/css/pnotify.custom.min.css') }}">
    <!-- pnotify-custom css -->
    <link rel="stylesheet" href="{{ asset('/css/pages/pnotify.css') }}">
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
@endsection

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', [
        'bread_title' => $breadcrumb,
        'bread_subtitle' => $subreadcrumb,
    ])
@endsection

@section('content')
    <div class="col-xl-4 col-lg-12 task-detail-right">
        <div class="card">
            <div class="card-body bg-c-blue">
                <div class="counter text-center">
                    <h4 id="timer" class="text-white m-0">
                        <i class="fas fa-gavel" style="font-size: 30px; color:white"></i>
                        إستشارة عدد : {{ $dossier->code_dossier }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>وضعية الملف</h5>

                <div class="card-header-right">
                    {!! App\Common\Utility::getSituationDossierLabel($dossier->situation_dossier) !!}
                </div>
            </div>
            <div class="card-body task-details">

                @component('components.dossier_details', ['dossier' => $dossier])
                @endcomponent
            </div>
        </div>


    </div>
    <div class="col-xl-8 col-lg-12">

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-border-c-blue">
                    <div class="card-header">
                        <a href="#" class="text-secondary">مراحل إنجاز الإستشارة</a>
                        <div class="card-header-right">
                            <a href="{{ route('consultations.index') }}" class="btn btn-secondary">
                                العودة لقائمة الإستشارات
                                <i class="feather icon-corner-down-left"></i>
                            </a>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <button type="button" id="btnPartial_CC" class="btn btn-primary-gradient btn-block"
                                        onclick='return showHideSteps("#card-cc");'>
                                        <i class="fe fe-users tx-20 pl-2"></i>
                                        كراس الشروط
                                    </button>
                                </div>

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <button type="button" id="btnPartial_pubAvis" class="btn btn-danger-gradient btn-block"
                                        onclick='return showHideSteps("#card-pubAvis");'>
                                        <i class="fas fa-gavel tx-20 pl-2" aria-hidden="true"></i>
                                        الإعلان الإشهاري
                                    </button>
                                </div>

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <button type="button" id="btnPartial_receptionOffre"
                                        class="btn btn-warning-gradient btn-block"
                                        onclick='return showHideSteps("#card-receptionOffres");'>
                                        <i class="fas fa-gavel tx-20 pl-2" aria-hidden="true"></i>
                                        وصول العروض
                                    </button>
                                </div>

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <button type="button" id="btnPartial_comOuverturePlis"
                                        class="btn btn-success-gradient btn-block"
                                        onclick='return showHideSteps("#card-cc");'>
                                        <i class="far fa-clock tx-20 pl-2" aria-hidden="true"></i>
                                        جلسات فتح الظروف
                                    </button>
                                </div>


                                <div class="col-sm-6 col-md-3 mb-2">
                                    <button type="button" id="btnPartial_comOuvertureTech"
                                        class="btn btn-secondary-gradient btn-block"
                                        onclick='return showHideSteps("#card-cc");'>
                                        <i class="fe fe-dollar-sign tx-20 pl-2"></i>
                                        جلسات الفرز
                                    </button>
                                </div>

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <button type="button" id="btnPartial_engagement"
                                        class="btn btn-success-gradient btn-block"
                                        onclick='return showHideSteps("#card-cc");'>
                                        <i class="fe fe-dollar-sign tx-20 pl-2"></i>
                                        اسناد الصفقة
                                    </button>
                                </div>

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <button type="button" id="btnPartial_enregistrementOffre"
                                        class="btn btn-info-gradient btn-block" onclick='return showHideSteps("#card-cc");'>
                                        <i class="fas fa-sort-amount-up-alt tx-20 pl-2" aria-hidden="true"></i>
                                        تسجيل الصفقة
                                    </button>
                                </div>

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <button type="button" id="btnPartial_ordreService"
                                        class="btn btn-dark-gradient btn-block" onclick='return showHideSteps("#card-cc");'>
                                        <i class="fas fa-sort-amount-up-alt tx-20 pl-2" aria-hidden="true"></i>
                                        إذن بداية الأشغال
                                    </button>
                                </div>

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <button type="button" id="btnPartial_receptionProvisoire"
                                        class="btn btn-danger-gradient btn-block"
                                        onclick='return showHideSteps("#card-cc");'>
                                        <i class="fas fa-sort-amount-up-alt tx-20 pl-2" aria-hidden="true"></i>
                                        القبول الوقتي
                                    </button>
                                </div>

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <button type="button"
                                        id="btnPartial_receptionDefinitif"class="btn btn-warning-gradient btn-block"
                                        onclick='return showHideSteps("#card-cc");'>
                                        <i class="fas fa-sort-amount-up-alt tx-20 pl-2" aria-hidden="true"></i>
                                        القبول النهائي
                                    </button>
                                </div>

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <button type="button" id="btnPartial_clotureDossier"
                                        class="btn btn-secondary-gradient btn-block"
                                        onclick='return showHideSteps("#card-cc");'>
                                        <i class="fas fa-cogs tx-20 pl-2" aria-hidden="true"></i>
                                        التسوية النهائية
                                    </button>
                                </div>

                                <div class="col-sm-6 col-md-3 mb-2">
                                    <button type="button" id="btnPartial_annulationOffre"
                                        class="btn btn-danger-gradient btn-block"
                                        onclick='return showHideSteps("#card-cc");'>
                                        <i class="fas fa-cogs tx-20 pl-2" aria-hidden="true"></i>
                                        الغاء الصفقة
                                    </button>
                                </div>



                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- Cahier charges Card Start --}}
        <div class="row" id="card-cc" name="card" style="display: none;">
            <div class="col-md-12 col-sm-12">
                <div class="card card-border-c-blue">
                    <div class="card-header">
                        <a href="#" class="text-secondary">كراس الشروط</a>
                        <div class="card-header-right">
                            <button type="button" class="btn btn-success" id="btn_add_cc">
                                تسجيل البيانات
                                <i class="feather icon-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                {{--  Cahier des charges  form start --}}
                                <div class="col-md-12">
                                    @php
                                        $cahiers_charges = $dossier->cahiers_charges;
                                    @endphp
                                    <div class="form-row">
                                        <input type="number" name="cahiers_charges_id" id="cahiers_charges_id"
                                            value="{{ $cahiers_charges->id ?? '' }}" hidden>
                                        <div class="form-group col-md-6">
                                            <label>تاريخ اعتزام نشر الإعلان :</label>
                                            <input type="date" class="form-control" id='date_pub_prevu'
                                                name="date_pub_prevu" placeholder="أدخل التاريخ"
                                                value='{{ $cahiers_charges->date_pub_prevu ?? '' }}' required>
                                            <label id="date_pub_prevu-error"
                                                class="error jquery-validation-error small form-text invalid-feedback"
                                                for="date_pub_prevu"></label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>ثمن اقتناء كراس الشروط :</label>
                                            <input class="form-control" type="number" min=0 max=99999999999,999
                                                id="prix_cc" name="prix_cc"
                                                value='{{ $cahiers_charges->prix_cc ?? '' }}'>
                                            <label id="date_pub_prevu-error"
                                                class="error jquery-validation-error small form-text invalid-feedback"
                                                for="date_pub_prevu"></label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>طريقة قبول العروض :</label>
                                            <select class="form-control" id="type_reception" name="type_reception">
                                                <option value="1"
                                                    {{ $cahiers_charges != null && $cahiers_charges->type_reception == 1 ? 'selected' : '' }}>
                                                    منظومة الشراءات على الخط</option>
                                                <option value="2"
                                                    {{ $cahiers_charges != null && $cahiers_charges->type_reception == 2 ? 'selected' : '' }}>
                                                    مكتب الضبط </option>
                                                <option value="3"
                                                    {{ $cahiers_charges != null && $cahiers_charges->type_reception == 3 ? 'selected' : '' }}>
                                                    البريد </option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>طريقة فتح الظروف :</label>
                                            <select class="form-control" id="type_overture_plis"
                                                name="type_overture_plis">
                                                <option value="1"
                                                    {{ $cahiers_charges != null && $cahiers_charges->type_overture_plis == 1 ? 'selected' : '' }}>
                                                    مالية علنية </option>
                                                <option value="2"
                                                    {{ $cahiers_charges != null && $cahiers_charges->type_overture_plis == 2 ? 'selected' : '' }}>
                                                    مالية وفنية علنية</option>
                                                <option value="3"
                                                    {{ $cahiers_charges != null && $cahiers_charges->type_overture_plis == 3 ? 'selected' : '' }}>
                                                    مالية وفنية غير علنية</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>مدة الضمان الوقتي :</label>
                                            <input type="number" class="form-control" id="duree_caution_prov"
                                                name="duree_caution_prov" min=0 max=999
                                                value="{{ $cahiers_charges->duree_caution_prov ?? '' }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>قيمة الضمان الوقتي :</label>
                                            <input type="number" class="form-control" id="caution_prov"
                                                name="caution_prov" min=1,000 max=99999999999,999
                                                value="{{ $cahiers_charges->caution_prov ?? '' }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>مدة الضمان النهائي :</label>
                                            <input type="number" class="form-control" id="duree_caution_def" min=0
                                                max=999 value="{{ $cahiers_charges->duree_caution_def ?? '' }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>نسبة الضمان النهائي :</label>
                                            <input type="number" class="form-control" id="caution_def"
                                                name="caution_def" min=1 max=99
                                                value="{{ $cahiers_charges->caution_def ?? '' }}">
                                            <label id="caution_def-error"
                                                class="error jquery-validation-error small form-text invalid-feedback"
                                                for="caution_def"></label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>مدة الإنجاز باليوم : </label>
                                            <input class="mb-3 form-control form-control-lg" type="number"
                                                id="duree_travaux" name="duree_travaux" min=1 max=999
                                                value="{{ $cahiers_charges->duree_travaux ?? '' }}">
                                            <label id="duree_travaux-error"
                                                class="error jquery-validation-error small form-text invalid-feedback"
                                                for="duree_travaux"></label>
                                        </div>
                                    </div>
                                    <div class="m-t-30">
                                        <h5>الوثائق المكونة لكراس الشروط</h5>
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label for="exampleInputEmail1"> {{ __('labels.tbl_file_libelle') }}
                                                </label>
                                                <input type="text" class="form-control" name="file_name"
                                                    id="file_name" placeholder="{{ __('labels.tbl_file_libelle') }}"
                                                    value="">
                                                <label id="file_name-error"
                                                    class="error jquery-validation-error small form-text invalid-feedback"
                                                    for="file_name"></label>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="exampleInputEmail1">{{ __('labels.tbl_file_file') }}</label>
                                                <input type="file" id="file" name="file"
                                                    class="form-control form-control-file" id="file">
                                                <label id="file-error"
                                                    class="error jquery-validation-error small form-text invalid-feedback"
                                                    for="file"></label>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="submit" id="btn_add_file">
                                                <span class="spinner-border spinner-border-sm" role="status"
                                                    hidden></span>
                                                {{ __('inputs.btn_create') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="dt-responsive table-responsive">
                                        <table id="table-docs-cc" class="table table-striped table-bordered nowrap"
                                            style="width: 100%">
                                            <thead>
                                                <th style="width: 30px"><input type="checkbox" class="select-checkbox" />
                                                </th>
                                                <th>id</th>
                                                <th>{{ __('labels.tbl_file_libelle') }}</th>
                                                <th>{{ $tbl_action }}</th>
                                                <th>{{ __('labels.tbl_created_at') }}</th>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th style="width: 30px"><input type="checkbox"
                                                            class="select-checkbox" />
                                                    </th>
                                                    <th>id</th>
                                                    <th>{{ __('labels.tbl_file_libelle') }}</th>
                                                    <th>{{ $tbl_action }}</th>
                                                    <th>{{ __('labels.tbl_created_at') }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                                {{--  Cahier des charges form end --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- Cahier charges Card End --}}
        {{-- Publication Avis Card Start --}}
        <div class="row" id="card-pubAvis" name="card" style="display: none;">
            <div class="col-md-12 col-sm-12">
                <div class="card card-border-c-blue">
                    <div class="card-header">
                        <a href="#" class="text-secondary"> الإعلان الإشهاري</a>
                        <div class="card-header-right">
                            <button type="button" class="btn btn-success" id="btn_add_pubAvis">
                                تسجيل البيانات
                                <i class="feather icon-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                {{--  Publication Avis  form start --}}
                                <input type="number" name="avisPubId" id="avisPubId" value="{{$avisDossier->id ?? '0'}}" hidden>
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>مرجع الإعلان</label>
                                            <input type="text" class="form-control" id='ref_avis' name="ref_avis"
                                                placeholder="...المرجع" value="{{$avisDossier->ref_avis ?? ''}}" required>
                                                <label id="ref_avis-error"
                                                class="error jquery-validation-error small form-text invalid-feedback"
                                                for="ref_avis"></label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>موجه إلى </label>
                                            <select class="form-control" id="destination" name="destination">
                                                <option value="1" @if($avisDossier->destination == '1') selected="selected" @endif>منظومة الشراءات على الخط</option>
                                                <option value="2" @if($avisDossier->destination == '2') selected="selected" @endif>موقع المؤسسة</option>
                                                <option value="3" @if($avisDossier->destination == '3') selected="selected" @endif>مواقع أخرى</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>نص الإعلان</label>
                                            <textarea class="form-control" id="texte_avis" name="texte_avis" placeholder="نص الإعلان...">{{$avisDossier->texte_avis}}</textarea>
                                            <label id="texte_avis-error"
                                            class="error jquery-validation-error small form-text invalid-feedback"
                                            for="texte_avis"></label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>تاريخ أول ظهور للإعلان </label>
                                            <input type="datetime-local" class="form-control" id='date_debut_avis'
                                                name="date_debut_avis" placeholder="أدخل التاريخ" value="{{$avisDossier->date_debut_avis ?? ''}}" required>
                                                <label id="date_debut_avis-error"
                                                class="error jquery-validation-error small form-text invalid-feedback"
                                                for="date_debut_avis"></label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>مدة الإعلان باليوم</label>
                                            <input type="number" class="form-control" id="duree_avis" name="duree_avis"
                                                min=0 max=99  value="{{$avisDossier->duree_avis ?? '0'}}" >
                                                <label id="duree_avis-error"
                                                class="error jquery-validation-error small form-text invalid-feedback"
                                                for="duree_avis"></label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>آخر أجل لقبول العروض </label>
                                            <input type="datetime-local" class="form-control" id='date_validite'
                                                name="date_validite" placeholder="أدخل التاريخ"  value="{{$avisDossier->date_validite ?? ''}}" required>
                                                <label id="date_validite-error"
                                                class="error jquery-validation-error small form-text invalid-feedback"
                                                for="date_validite"></label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>تاريخ فتح الظروف </label>
                                               <input type="datetime-local" class="form-control" id='date_ouverture_plis'
                                                name="date_ouverture_plis" placeholder="أدخل التاريخ"  value="{{$avisDossier->date_ouverture_plis ?? ''}}" required>
                                                <label id="date_ouverture_plis-error"
                                                class="error jquery-validation-error small form-text invalid-feedback"
                                                for="date_ouverture_plis"></label>
                                        </div>
                                    </div>
                                    {{-- AvisPub form end --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- Publication Avis Card End --}}
        </div>
        {{-- Reception Offres Card Start --}}
        <div class="row" id="card-receptionOffres" name="card" style="display: none;">
            <div class="col-md-12 col-sm-12">
                <div class="card card-border-c-blue">
                    <div class="card-header">
                        <a href="#" class="text-secondary">وصول العروض</a>
                        <div class="card-header-right">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                {{--  Cahier des charges  form start --}}
                                <form id="form-id">
                                    <div class="col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>تاريخ وصول العرض</label>
                                                <input type="datetime-local" class="form-control" id='date_arrive'
                                                    name="date_arrive" placeholder="أدخل التاريخ" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>طريقة وصول العرض</label>
                                                <select class="form-control" id="source_offre" name="source_offre">
                                                    <option value="1">منظومة الشراءات على الخط</option>
                                                    <option value="2">مكتب الضبط</option>
                                                    <option value="3">البريد</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>مرجع العرض</label>
                                                <input type="text" class="form-control" name="ref_offre"
                                                    id="ref_offre" placeholder="مرجع العرض">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>عدد التسجيل بمكتب الضبط</label>
                                                <input type="text" class="form-control" name="ref_bo" id="ref_bo"
                                                    placeholder="عدد التسجيل">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>الملاحظات</label>
                                                <input type="text" class="form-control" id="observation"
                                                    name="observation">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <a href="javascript:void(0);" class="btn btn-rounded btn-info" id='add-offre'
                                                for-table='#table-offres'>
                                                <i class="feather icon-plus"></i>
                                                <span class="spinner-border spinner-border-sm" role="status"
                                                    hidden></span>
                                                <span id="btn_add_poa_title">إضافة إلى الجدول</span>

                                            </a>
                                        </div>
                                        <div class="dt-responsive table-responsive">
                                            <table id="table-offres" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                                            class="select-checkbox not-export-col" /> </th>
                                                    <th class="not-export-col"> </th>
                                                    <th>تاريخ وصول العرض</th>
                                                    <th>المرجع</th>
                                                    <th>عدد التسجيل بمكتب الضبط</th>
                                                    <th>تاريخ التسجيل</th>
                                                    <th class="not-export-col">{{ $tbl_action }}</th>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th class="not-export-col" style="width: 30px"><input
                                                                type="checkbox" class="select-checkbox not-export-col" />
                                                        </th>
                                                        <th class="not-export-col"> </th>
                                                        <th>تاريخ وصول العرض</th>
                                                        <th>المرجع</th>
                                                        <th>عدد التسجيل بمكتب الضبط</th>
                                                        <th>تاريخ التسجيل</th>
                                                        <th class="not-export-col">{{ $tbl_action }}</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                                {{--  Cahier des charges form end --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Reception Offres Card End --}}
    </div>
@endsection
@section('srcipt-js')
    <!-- datatable Js -->
    <script src="{{ asset('/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/dataTables.select.min.js') }}"></script>
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- pnotify Js -->
    <script src="{{ asset('/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
    <!-- sweet alert Js -->
    <script src="{{ asset('/plugins/sweetalert/js/sweetalert.min.js') }}"></script>

    <!-- jquery-validation Js -->
    <script src="{{ asset('/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <!-- form-select-custom Js -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#table-offres").DataTable({
                language: {
                    url: "{{ $lang }}"
                }
            });
            $("#ordres-table").DataTable({
                language: {
                    url: "{{ $lang }}"
                }
            });
            var table = $('#table-docs-cc').DataTable({
                initComplete: function() {
                    // Apply the search
                    this.api().columns().every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    });
                },
                processing: true,
                serverSide: true,
                serverMethod: 'POST',
                ajax: {
                    url: "{{ route('files.datatable') }}",
                    data: {
                        id: {{ $dossier->id }},
                        param: 'cc_docs'
                    }
                },
                language: {
                    url: "{{ $lang }}"
                },
                columns: [{
                        data: "select",
                        className: "select-checkbox"
                    },
                    {
                        data: "id",
                        className: "id"
                    },
                    {
                        data: "libelle",
                        className: 'libelle'
                    },
                    {
                        data: 'action',
                        className: 'action',
                        visible: 'false'
                    },
                    {
                        data: "created_at",
                        className: 'created_at'
                    },

                ],
                responsive: true,

                columnDefs: [{
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    },
                    {
                        visible: false,
                        targets: 1
                    }
                ],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                // select: { style: 'multi+shift' },

            });
            table
                .on('select', function(e, dt, type, indexes) {
                    // var rowData = table.rows( indexes ).data().toArray();
                    //console.log( rowData );
                    SelectedRowCountBtnDelete(table)
                })
                .on('deselect', function(e, dt, type, indexes) {
                    SelectedRowCountBtnDelete(table)
                });

            $('.dataTables_length').addClass('bs-select');

            // Create new file_documents
            $('#btn_add_file').click((e) => {
                e.preventDefault();
                $('#btn_add_file').attr('disabled', 'disabled');
                $('.spinner-border').removeAttr('hidden');
                $('#file_name').removeClass('is-invalid')
                $('#file').removeClass('is-invalid')
                let cahiers_charges_id = $('#cahiers_charges_id').val();
                if (cahiers_charges_id == 0 || cahiers_charges_id == "" || cahiers_charges_id == null ||
                    cahiers_charges_id == undefined) {
                    swal("{{ __('labels.swal_warning_title') }}",
                        'الرجاء تسجيل بيانات كراس الشروط قبل إضافة الملف أو الوثيقة',
                        "warning");
                    $('#btn_add_file').removeAttr('disabled');
                    $('.spinner-border').attr('hidden', 'hidden');
                    return false;
                }
                let path = "cc_docs";
                let file_name = $("input[name=file_name]").val();
                let file = document.getElementById("file").files[0];
                var formData = new FormData();
                formData.append('cahiers_charges_id', cahiers_charges_id)
                formData.append('path', path)
                formData.append('file', file)
                formData.append('file_name', file_name)
                formData.append('libelle', file_name)
                $.ajax({
                    url: "{{ route('file.upload.post') }}",
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        $('#file_name').val('')
                        $('#file').val('')
                        //refreshSessions()
                        PnotifyCustom(response)
                        $('#btn_add_file').removeAttr('disabled');
                        $('.spinner-border').attr('hidden', 'hidden');
                        $('#table-docs-cc').DataTable().ajax.reload();


                    },
                    error: function(response) {
                        console.log(JSON.stringify(response))
                        $('#btn_add_file').removeAttr('disabled');
                        $('.spinner-border').attr('hidden', 'hidden');
                        $('#file_name-error').html('')
                        $('#file-error').html('')
                        // alert(JSON.stringify(response.responseJSON.message))
                        if (response.responseJSON.message.file_name != null) {
                            $('#file_name').addClass('is-invalid')
                            $('#file_name-error').text(response.responseJSON.message.file_name);
                        }
                        if (response.responseJSON.message.file != null) {
                            $('#file').addClass('is-invalid')
                            $('#file-error').text(response.responseJSON.message.file);
                        }


                    }
                }); // ajax end

            })
        });
        // show or hide div step
        function showHideSteps(divName) {
            $('[name="card"]').hide();
            $(divName).show();
        }




        // Create cc
        $('#btn_add_cc').click(() => {
            var $url = "{{ route('consultation.cc') }}"
            var $type = "POST";

            $.ajax({
                url: $url,
                type: $type,
                data: {
                    dossiers_achats_id: {{ $dossier->id }},
                    date_pub_prevu: $('#date_pub_prevu').val(),
                    prix_cc: $('#prix_cc').val(),
                    type_reception: $('#type_reception').val(),
                    type_overture_plis: $('#type_overture_plis').val(),
                    duree_travaux: $('#duree_travaux').val(),
                    caution_prov: $('#caution_prov').val(),
                    duree_caution_prov: $('#duree_caution_prov').val(),
                    caution_def: $('#caution_def').val(),
                    duree_caution_def: $('#duree_caution_def').val(),
                },
                success: function(response) {
                    $('#date_pub_prevu').removeClass('is-invalid')
                    $('#duree_travaux').removeClass('is-invalid')
                    $('#cahiers_charges_id').val(response.data.id)
                    PnotifyCustom(response)
                },
                error: function(errors) {

                    if (errors.responseJSON.message.date_pub_prevu != null) {
                        $('#date_pub_prevu').addClass('is-invalid')
                        $('#date_pub_prevu-error').text(errors.responseJSON.message.date_pub_prevu);
                    }

                    if (errors.responseJSON.message.duree_travaux != null) {
                        $('#duree_travaux').addClass('is-invalid')
                        $('#duree_travaux-error').text(errors.responseJSON.message.duree_travaux);
                    }
                    if (errors.responseJSON.message.caution_def != null) {
                        $('#caution_def').addClass('is-invalid')
                        $('#caution_def-error').text(errors.responseJSON.message.caution_def);
                    }
                }
            }); // ajax end

        })
        // Create Avis Pub
        $('#btn_add_pubAvis').click(() => {
            var $url = "{{ route('consultation.avisPub') }}"
            var $type = "POST";

            $.ajax({
                url: $url,
                type: $type,
                data: {
                    dossiers_achats_id: {{ $dossier->id }},
                    ref_avis: $('#ref_avis').val(),
                    texte_avis: $('#texte_avis').val(),
                    destination: $('#destination').val(),
                    duree_avis: $('#duree_avis').val(),
                    date_debut_avis: $('#date_debut_avis').val(),
                    date_validite: $('#date_validite').val(),
                    date_ouverture_plis: $('#date_ouverture_plis').val(),
                },
                success: function(response) {
                    $('#ref_avis').removeClass('is-invalid')
                    $('#date_debut_avis').removeClass('is-invalid')
                    $('#date_validite').removeClass('is-invalid')
                    $('#duree_avis').removeClass('is-invalid')
                    $('#date_ouverture_plis').removeClass('is-invalid')

                    PnotifyCustom(response)
                },
                error: function(errors) {

                    $('#ref_avis').removeClass('is-invalid')
                    $('#date_debut_avis').removeClass('is-invalid')
                    $('#date_validite').removeClass('is-invalid')
                    $('#duree_avis').removeClass('is-invalid')
                    $('#date_ouverture_plis').removeClass('is-invalid')

                    if (errors.responseJSON.message.ref_avis != null) {
                        $('#ref_avis').addClass('is-invalid')
                        $('#ref_avis-error').text(errors.responseJSON.message.ref_avis);
                    }

                    if (errors.responseJSON.message.date_debut_avis != null) {
                        $('#date_debut_avis').addClass('is-invalid')
                        $('#date_debut_avis-error').text(errors.responseJSON.message.date_debut_avis);
                    }
                    if (errors.responseJSON.message.date_validite != null) {
                        $('#date_validite').addClass('is-invalid')
                        $('#date_validite-error').text(errors.responseJSON.message.date_validite);
                    }
                    if (errors.responseJSON.message.duree_avis != null) {
                        $('#duree_avis').addClass('is-invalid')
                        $('#duree_avis-error').text(errors.responseJSON.message.duree_avis);
                    }
                    if (errors.responseJSON.message.date_ouverture_plis != null) {
                        $('#date_ouverture_plis').addClass('is-invalid')
                        $('#date_ouverture_plis-error').text(errors.responseJSON.message.date_ouverture_plis);
                    }
                }
            }); // ajax end

        })
        //Create Offres
        $('#add-offre').click(() => {
            //$('#libelle').removeClass('is-invalid')
            $('.spinner-border').removeAttr('hidden');
            var articleId = $('#articles_id').val()
            if (articleId === null || articleId == 'NULL' || articleId === undefined) {
                swal("{{ __('labels.swal_warning_title') }}", 'الرجاء تحديد المادة',
                    "warning");
                return false;
            }

            var formData = new FormData();
            formData.append('dossiers_id', "{{ $dossier->id }}")
            formData.append('mode', "editProjet")
            formData.append('annee_gestion', $("#annee_gestion").val())
            formData.append('type_demande', $("#type_demande").val())
            formData.append('nature_demandes_id', $("#natures_demande").val())
            formData.append('articles_id', articleId)
            formData.append('description', $("input[name=description]").val())
            formData.append('file_name', $("input[name=file_name]").val())
            formData.append('qte_demande', $("input[name=qte_demande]").val())
            formData.append('cout_unite_ttc', $("input[name=cout_total_ttc]").val())
            formData.append('cout_unite_ttc', $("input[name=cout_unite_ttc]").val())

            formData.append('file', document.getElementById("file").files[0])
            //alert(file)
            var $type = 'POST'
            var $url = "{{ route('lignes_besoin.storeExeption') }}"

            $.ajax({
                url: $url,
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    console.log(response)
                    $('.spinner-border').attr('hidden', 'hidden');
                    $('#table-cp').DataTable().ajax.reload();
                    $('#cp_form')[0].reset()
                    //$("#cp_form").get(0).reset()
                    $('#add').html("إضافة إلى الجدول")
                    PnotifyCustom(response)


                },
                error: function(response) {
                    $('.spinner-border').attr('hidden', 'hidden');
                    console.log(JSON.stringify(response.responseJSON));
                    $('.spinner-border').attr('hidden', 'hidden');
                    //  $('#file_name-error').html('')
                    $('#libelle-error').html('')
                    $('#file-error').html('')
                    // alert(JSON.stringify(response.responseJSON.message))
                    if (response.responseJSON.message.libelle != null) {
                        $('#libelle').addClass('is-invalid')
                        $('#libelle-error').text(response.responseJSON.message.poa_title);
                    }

                }
            }); // ajax end
        })
        // Delete CC files
        function deleteFile(id) {
            swal({
                    title: "{{ __('labels.swal_delete_title') }}",
                    text: "{{ __('labels.swal_delete_text') }}",
                    icon: "warning",
                    buttons: ["{{ __('labels.swal_cancel_btn') }}", "{{ __('labels.swal_confirm_btn') }}"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            type: 'DELETE',
                            dataType: 'JSON',
                            data: {
                                id: id,
                                param: 'cc_docs'
                            },
                            url: "{{ route('files.delete') }}",
                            success: function(response) {
                                //console.log(response)
                                //alert(JSON.stringify(response))
                                // refresh data or remove only tr
                                $('#table-docs-cc').DataTable().ajax.reload();
                                PnotifyCustom(response)


                            }
                        }); // ajax end

                    }
                });
        }
    </script>
@endsection
