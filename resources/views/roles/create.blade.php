@php
    $name = "name_".$locale;  
    $breadcrumb = __('breadcrumb.bread_role');
    $sub_breadcrumb = __('breadcrumb.bread_role_create');
@endphp

@extends('layouts.app')

@section('breadcrumb')
    @include('layouts.partials.breadcrumb', [
    'bread_title'=> $breadcrumb,
    'bread_subtitle'=> $sub_breadcrumb
    ])
@endsection

@section('content')
    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $sub_breadcrumb }}</h5>
                <div class="card-header-right">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                        {{ __('inputs.btn_back_roles') }}
                        <i class="feather icon-corner-down-left"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">


                {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                <div class="row  ml-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('labels.lbl_libelle_role') }}</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('labels.lbl_libelle_role') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('labels.lbl_libelle_role_ar') }}</label>
                            <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="{{ __('labels.lbl_libelle_role_ar') }}">
                        </div>
                    </div>
                    <h4> {{ __('labels.lbl_role') }}</h4>
                        <div class="row">
                            
                           
                            @foreach ($permission as  $value => $permission_list)
                            <div class="col-md-3">
                                 <h5>{{ ($value) }}</h5>
                                 @foreach ($permission_list as $item)
                                <label>
                                    {{ Form::checkbox('permission[]', $item->id, false, ['class' => 'name']) }}
                                    {{ $item->$name }}
                                </label><br>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                 
                        <button type="submit" class="btn btn-primary" style="float: right;">
                            <i class="feather icon-circle-plus"></i>
                            {{ __('inputs.btn_create') }}
    
                        </button>
                        <a href="{{ route('roles.index') }}" class="btn btn-danger" style="float: left;">
                            <i class="feather icon-minus-circle"></i>
                            {{ __('inputs.btn_cancel') }}
                        </a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
