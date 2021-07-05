@extends('layouts.app')
@section('title')
{{ __('lang.register')}} - {{ config('app.name') }}
@endsection
@section('content')

    <form method="POST" action="{{ route('register') }}" class="login100-form validate-form">
        @csrf
        <div class="limiter">
            <div class="container-login100" style="background-image: url('../img/background.jpg');">
                <div class="wrap-login100">
                    <form method="POST" action="{{ route('register') }}" class="login100-form validate-form">
                        @csrf
                        <span class="login100-form-logo">
                            <img src="{{ asset('img/icon1.png') }}"
                            alt="logo" width="66" height="66">
                        </span>

                        <span class="login100-form-title p-b-34 p-t-27">
                            {{ __('lang.register')}}
                        </span>

                        <div class="wrap-input100">
                            <input class="input100" type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('lang.name')}}">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>
                        @error('name')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                        <div class="wrap-input100">
                            <input class="input100" type="phone" name="phone" value="{{ old('phone') }}" placeholder="{{ __('lang.phone')}}">
                            <span class="focus-input100" data-placeholder="&#xf2be;"></span>
                        </div>
                        @error('phone')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                        <div class="wrap-input100" >
                            <input class="input100" type="email" name="email" value="{{ old('email') }}"  placeholder="{{ __('lang.email')}}">
                            <span class="focus-input100" data-placeholder="&#xf15a;"></span>
                        </div>
                        @error('email')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                        <div class="wrap-input100">
                            <input class="input100" type="password" name="password" placeholder="{{ __('lang.password')}}">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>
                        @error('password')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="wrap-input100">
                            <input class="input100" type="password" name="password_confirmation"
                                placeholder="{{ __('lang.password_con')}}">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                {{ __('lang.submit')}}
                            </button>
                        </div>

                        <div class="text-center p-t-20">
                            <a class="txt1" href="{{ route('login') }}">
                                {{ __('lang.have account')}}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
