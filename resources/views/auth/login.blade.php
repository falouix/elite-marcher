@extends('layouts.app-save')

@section('content')
    <div class="card">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="card-body">

                    <img src="{{  asset('/images/product/prod-1.jpg')  }}" alt="product images" class="img-fluid mb-5">
                    <h4 class="mb-3 f-w-400">{{ __('app.login_account') }}</h4>
                    @error('email')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>

                        </span>
                    @enderror

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="feather icon-mail"></i></span>
                            </div>
                            <input type="email" placeholder="{{ __('inputs.email') }}" id="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="feather icon-lock"></i></span>
                            </div>
                            <input type="password" id="password" placeholder="{{ __('inputs.password') }}"
                                class="form-control @error('email') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                        </div>
                        <div class="form-group text-left mt-2">
                            <div class="checkbox checkbox-primary d-inline">
                                <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="">
                                <label for="checkbox-fill-a1" class="cr">{{ __('inputs.remember_me') }}</label>
                            </div>
                        </div>
                        <button class="btn btn-primary mb-4">{{ __('inputs.btn_login') }}</button>
                        <p class="mb-2 text-muted">{{ __('inputs.forgot_password') }}
                            <a href="{{ route('password.request') }}" class="f-w-400">
                                {{ __('inputs.btn_resetPwd') }}
                            </a>
                        </p>
                    </form>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block">
                <div id="carouselExampleCaptions" class="carousel slide auth-slider" data-ride="carousel">
                    <!-- <div id="carouselExampleCaptions" class="carousel carousel-fade slide auth-slider" data-ride="carousel"> -->
                    <!--
    <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="auth-prod-slidebg bg-1"></div>
                        <div class="carousel-caption d-none d-md-block">
                            <img src="{{ asset('/images/product/logo-isetks.jpg') }}" alt="product images"
                                class="img-fluid mb-5">

                    <h3 class="mb-50"> المعهد العالي للدراسات التكنولوجية بالقصرين</h3>
                    <p class="mb-5">منظومة متابعة الصفقات العمومية</p>
                </div>
            </div>
        </div>
        -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="auth-prod-slidebg bg-1"></div>
                <div class="carousel-caption d-none d-md-block">
                   {{--  <img src="{{ asset('/images/product/prod-1.jpg') }}" alt="product images" class="img-fluid mb-5"> --}}
                    <h3 class="mb-50">جامعة جندوبة</h3>
                    <p class="mb-5">منظومة متابعة الصفقات العمومية</p>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>
@endsection
