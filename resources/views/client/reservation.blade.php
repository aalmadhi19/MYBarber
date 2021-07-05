@extends('layouts.app')
@section('title')
{{ __('lang.reservation')}} - {{ config('app.name') }}
@endsection
@section('Styles')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}">

@endsection
@section('title', 'طلب جديد ')
@section('content')
    @include('layouts.header')
    <div class="rtl">
        <div id="booking" class="section">
            <div class="section-center">
                <div class="container">

                    <div class="row">
                        <div class="" style="padding-left: 20%;">
                            <div class="booking-cta">
                                <h1>{{ __('lang.Book your appointment') }}</h1>

                                <p>

                                </p>
                            </div>
                        </div>
                        <div>
                            <div class="booking-form">
                                <form method="POST" action="{{ route('store') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">

                                    <div class="form-group">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <span class="form-label text-right">{{ __('lang.Date and Time') }}</span>

                                        <input class="form-control text-right" type="text"
                                            placeholder="{{ __('lang.Date and Time') }}" name="start_date" id="start_date"
                                            value="{{ old('start_date') }}">

                                        <input type="hidden" name="end_date" id="end_date" value="">
                                        <span
                                            class="text-danger"><strong>{{ $errors->first('start_date') }}</strong></span>
                                    </div>


                                    <div class="form-group">
                                        <i class="fa fa-scissors" aria-hidden="true"></i>
                                        <span class="form-label text-right">{{ __('lang.Shaving type') }} </span>
                                        <div class="wrapper">
                                            <input type="radio" name="type" id="option-1" value="beard">
                                            <input type="radio" name="type" id="option-2" value="hair">
                                            <input type="radio" name="type" id="option-3" value="all">
                                            <label for="option-1" class="option option-1">
                                                <div class="dot"></div>
                                                <span>{{ __('lang.beard') }}</span>
                                            </label>
                                            <label for="option-2" class="option option-2">
                                                <div class="dot"></div>
                                                <span>{{ __('lang.hair') }}</span>
                                            </label>
                                            <label for="option-3" class="option option-3">
                                                <div class="dot"></div>
                                                <span>{{ __('lang.hair and beard') }}</span>
                                            </label>
                                        </div>
                                        <span class="text-danger"><strong>{{ $errors->first('type') }}</strong></span>

                                    </div>



                                    <div class="form-btn text-center">
                                        <button class="submit-btn">{{ __('lang.book') }}</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
{{-- @include('layouts.footer') --}}
@if (App::getLocale() == 'en')
    @php
        $lang = 'en';
    @endphp
@else
    @php
        $lang = 'ar';
    @endphp
@endif

@section('script')
    <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#start_date").on('change', function() {
                $("#end_date").val($("#start_date").val());
            });

        });


        function formatDate(datestr) {
            var date = new Date(datestr);
            var minutes = date.getUTCMinutes();
            minutes = minutes < 10 ? "0" + minutes : minutes;
            var hours = date.getUTCHours();
            hours = hours < 10 ? "0" + hours : hours;
            var day = date.getDate();
            day = day > 9 ? day : "0" + day;
            var month = date.getMonth() + 1;
            month = month > 9 ? month : "0" + month;
            return month + "/" + day + "/" + date.getFullYear() + ":" + hours + ":" + minutes;
        }
        var disabletime = @json($unavailableDates);
        var lang = @json($lang);
        $("#start_date").datetimepicker({
            format: 'yy-mm-dd hh:ii',
            showMeridian: true,
            hoursDisabled: '0,1,2,3,4,5,6,7,8,9',
            language: lang,
            startDate: new Date(),
            todayHighlight: 1,
            minuteStep: 15,
            startView: 2,
            forceParse: true,
            autoclose: true,

            onRenderMinute: function(date) {
                if (disabletime.indexOf(formatDate(date)) > -1) {
                    return ['disabled'];
                }
            },
        });

    </script>
@endsection
