@php
$name = 'name_' . $locale;
$breadcrumb = __('breadcrumb.bread_role');
$sub_breadcrumb = __('breadcrumb.bread_role_edit');
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


                {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
                <div class="row  ml-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">{{ __('labels.lbl_libelle_role') }}</label>
                            @php
                                $placeholdername = __('labels.lbl_libelle_role');
                            @endphp
                            {!! Form::text('name', null, ['placeholder' => '' . $placeholdername . '', 'class' => 'form-control']) !!}

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label"><input type="checkbox" id="checkAll">
                                {{ __('labels.checkAll') }}</label>
                        </div>

                    </div>

                    <h4> {{ __('labels.lbl_role') }}</h4>

                    <div class="row">


                        @foreach ($permission as $value => $permission_list)
                            <div class="col-md-3">
                                <h5>{{ $value }}</h5>
                                @foreach ($permission_list as $item)
                                    <label>
                                        {{ Form::checkbox('permission[]', $item->id, in_array($item->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                        {{ $item->$name }}
                                    </label><br>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary" style="float: right;">
                        <i class="feather icon-edit-2"></i>
                        {{ __('inputs.btn_edit') }}

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
@section('srcipt-js')
    <script>
        $(document).ready(function() {
            $("#checkAll").click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
    </script>
@endsection
