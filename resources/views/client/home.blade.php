@extends('layouts.app')
@section('title')
    {{ __('lang.home') }} - {{ config('app.name') }}
@endsection
@section('content')
    @include('layouts.header')

    <div class="limiter" id="booking">
        <div class="container-table100">
            <div class="title text-center">
                {{ __('lang.home') }}
            </div>
            <div class="wrap-table100">
                <div class="table100 ver2">
                    @forelse($reservations as $reservation )
                        @if ($loop->first)
                            <div class="table100-head">
                                <table>
                                    <thead>
                                        <tr class="row100 head">
                                            <th class=" cell100 column2">{{ __('lang.action') }}</th>
                                            <th class=" cell100 column2">{{ __('lang.appointment_status') }}</th>
                                            <th class=" cell100 column2">{{ __('lang.time') }}</th>
                                            <th class=" cell100 column2">{{ __('lang.date') }}</th>
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
                                        <td class="cell100 column2">
                                            @if ($reservation->status == null || $reservation->status == 1)
                                                @if ($canCancel)
                                                    <a class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('{{ __('lang.are you sure?') }}')"
                                                        href="{{ route('destroy', $reservation->id) }}">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                        {{ __('lang.cancel') }}</a>
                                                @endif
                                            @endif
                                        </td>

                                        <td class="cell100 column2">{{ $status[$reservation->status] }}</td>
                                        <td class=" cell100 column2">
                                            {{ date(' A h:i', strtotime($reservation->start_date)) }}</td>
                                        <td class=" cell100 column2">
                                            {{ date('Y-m-d', strtotime($reservation->start_date)) }}</td>
                                        <td class=" cell100 column1">{{ $reservation->id }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @empty
                        <tbody>
                            <p class="text-center" id="empty">{{ __('lang.you do not have any appointment') }}
                            </p>
                            <div class="text-center" style="padding-bottom: 2%;">
                                @if ($canBook)
                                    <a href="{{ route('create') }}"
                                        class=" text-center btn btn-primary  btn-lg">{{ __('lang.new appointment') }}</a>
                                @endif
                            </div>
                        </tbody>
                        </table>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="text-center" style="padding-bottom: 10%;">
            @if ($canBook)
                <a href="{{ route('create') }}"
                    class=" text-center btn btn-primary  btn-lg">{{ __('lang.new appointment') }}</a>
            @endif
        </div>

    </div>


@endsection
