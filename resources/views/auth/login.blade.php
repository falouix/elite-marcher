@extends('layouts.app-save')

@section('content')
    <div class="card">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="col-md-12">
                    <h4 class="text-center  h4-login_custom">
                        منظومة متابعة الصفقات العمومية
                    </h4>
                </div>
                <div class="card-body"
                    style="
                /* height: 100%; */
                display: flex;
                flex-direction: column;
                justify-content: center;
            ">


                    <h4 class="text-18 font-medium text-center h4_second-login_custom">{{ __('app.login_account') }}</h4>
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
                        <div class="form-group text-right mt-2">
                            <div class="checkbox checkbox-primary d-inline">
                                <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="">
                                <label for="checkbox-fill-a1" class="cr">{{ __('inputs.remember_me') }}</label>
                            </div>
                        </div>
                        <button
                            class="btn  mb-4 rounded-none text-ae2543 font-bold btn-login_custom">{{ __('inputs.btn_login') }}</button>

                    </form>
                </div>
                <p class="mb-2 text-muted text-center">{{ __('inputs.forgot_password') }}
                    <a href="{{ route('password.request') }}" class="f-w-400">
                        {{ __('inputs.btn_resetPwd') }}
                    </a>
                </p>
            </div>
            <div class="col-md-6 d-none d-md-block">
                <div id="carouselExampleCaptions" class="carousel slide auth-slider" data-ride="carousel">

                    <div class="carousel-inner"
                        style="
                    box-shadow: 0px 0px 61px #00000057;
                ">
                        <div class="carousel-item active">
                            <div class="auth-prod-slidebg bg-1"
                                style="
                            display: flex;
                            justify-content: center;
                            /*border: 2px solid #ae2543;*/
                            ">
                                <img src="{{ asset('/images/universitejendouba.jpg') }}" alt="product images"
                                    class="" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
