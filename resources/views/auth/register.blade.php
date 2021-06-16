@extends('layouts.app')
@section('title', ' تسجيل ')
@section('content')

    <form method="POST" action="{{ route('register') }}" class="login100-form validate-form">
        @csrf
        <div class="limiter">
            <div class="container-login100" style="background-image: url('../img/background.jpg');">
                <div class="wrap-login100">
                    <form method="POST" action="{{ route('register')) }}" class="login100-form validate-form">
                        @csrf
                        <span class="login100-form-logo">
                            <img src="{{ asset('img/icon1.png') }}"
                            alt="logo" width="66" height="66">
                        </span>

                        <span class="login100-form-title p-b-34 p-t-27">
                            تسجيل
                        </span>

                        <div class="wrap-input100">
                            <input class="input100" type="text" name="name" placeholder="الاسم">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>
                        @error('name')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                        <div class="wrap-input100">
                            <input class="input100" type="phone" name="phone" placeholder="الجوال">
                            <span class="focus-input100" data-placeholder="&#xf2be;"></span>
                        </div>
                        @error('phone')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                        <div class="wrap-input100" >
                            <input class="input100" type="email" name="email" placeholder="البريد الإلكتروني">
                            <span class="focus-input100" data-placeholder="&#xf15a;"></span>
                        </div>
                        @error('email')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                        <div class="wrap-input100">
                            <input class="input100" type="password" name="password" placeholder="كلمة السر">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>
                        @error('password')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="wrap-input100">
                            <input class="input100" type="password" name="password_confirmation"
                                placeholder="تاكيد كلة السر">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                تسجـــــيل
                            </button>
                        </div>

                        <div class="text-center p-t-20">
                            <a class="txt1" href="{{ route('login') }}">
                                عندك حساب ؟
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
