@extends('layouts.app')
@section('title')
    {{ __('lang.appointments') }} - {{ config('app.name') }}
@endsection
@section('content')
    @include('layouts.header')
    <div class="limiter" id="booking">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100 ver2 m-b-110">
                    @forelse($reservations as $reservation)
                        @if ($loop->first)
                            <div class="table100-head">
                                <table>
                                    <thead>
                                        <tr class="row100 head">
                                            <th class=" cell100 column3">{{ __('lang.block') }}</th>
                                            <th class=" cell100 column3">{{ __('lang.action') }}</th>
                                            <th class=" cell100 column3">{{ __('lang.Shaving type') }}</th>
                                            <th class=" cell100 column3">{{ __('lang.name') }}</th>
                                            <th class=" cell100 column3">{{ __('lang.appointment_status') }}</th>
                                            <th class=" cell100 column3">{{ __('lang.time') }}</th>
                                            <th class=" cell100 column3">{{ __('lang.date') }}</th>
                                            <th class=" cell100 column1">{{ __('lang.id') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        @endif
                        <div class="table100-body js-pscroll">
                            <table>
                                <tbody>
                                    <tr class="row100 body">
                                        <td class="cell100 column3">
                                            <a href="{{ route('block', $reservation->user_id) }}"
                                                class="btn btn-sm btn-outline-danger"> {{ __('lang.block') }}
                                                <i class="fa fa-ban" aria-hidden="true"></i></a>
                                        </td>
                                        @if ($reservation->status == 0)
                                            <td class=" cell100 column3"> <a class="btn  btn-sm  btn-outline-success"
                                                    href="{{ route('confirm', $reservation->id) }}">
                                                    {{ __('lang.confirm') }} <i class="fa fa-check"
                                                        aria-hidden="true"></i></a> </td>
                                        @else
                                            <td class=" cell100 column3"> <a class="btn  btn-sm  btn-outline-danger"
                                                    onclick="return confirm({{ __('lang.are you sure?') }} )"
                                                    href="{{ route('cancel', $reservation->id) }}">
                                                    {{ __('lang.cancel') }} <i class="fa fa-trash"
                                                        aria-hidden="true"></i></a> </td>
                                        @endif
                                        <td class=" cell100 column3">{{ __('lang.' . $reservation->type) }}</td>
                                        <td class=" cell100 column3">{{ $reservation->name }}</td>
                                        <td class="cell100 column3">{{ $reservation->status_text }}</td>
                                        <td class=" cell100 column3">
                                            {{ date(' A h:i', strtotime($reservation->start_date)) }}
                                        </td>
                                        <td class=" cell100 column3">
                                            {{ date('Y-m-d', strtotime($reservation->start_date)) }}
                                        </td>
                                        <td class=" cell100 column1">{{ $reservation->id }}</td>
                                    </tr>
                                @empty
                                    <p class="text-center" id="empty"> {{ __('lang.no appointments') }} </p>
                                </tbody>
                            </table>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.js-pscroll').each(function() {
            var ps = new PerfectScrollbar(this);

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
@endsection
