@extends('layouts.app')

@section('title', ' تسجيل الدخول ')
@section('content')

    @if (session('message'))
        <div class="alert alert-danger text-center" style="width:50%;">{{ session('message') }}</div>
    @endif
    <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
        @csrf

        <div class="limiter">
            <div class="container-login100" style="background-image: url('../img/background1.jpg');">
                <div class="wrap-login100">
                    <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                        @csrf
                        <span class="login100-form-logo">
                            <img src="{{ asset('img/icon1.png') }}"
                            alt="logo" width="66" height="66">
                        </span>

                        <span class="login100-form-title p-b-34 p-t-27">
                            تسجيل الدخول
                        </span>

                        <div class="wrap-input100">
                            <input class="input100" type="phone" name="phone" placeholder="الجوال">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>
                        @error('phone')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror



                        <div class="wrap-input100" >
                            <input class="input100" type="password" name="password" placeholder="كلمة السر">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>
                        @error('password')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                دخـــــول
                            </button>
                        </div>

                        <div class="text-center p-t-190">
                            <a class="txt1" href="{{ route('register') }}">
                                انشاء حساب جديد
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
