@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="limiter" id="booking">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100 ver2 m-b-110">
                    @forelse($reservations as $reservation )
                        @if ($loop->first)
                            <div class="table100-head">
                                <table>
                                    <thead>
                                        <tr class="row100 head">
                                            @if ($reservation->status==null)
                                            <th class=" cell100 column2">{{ __('lang.cancel')}}</th>
                                            @endif
                                            <th class=" cell100 column2">{{ __('lang.appointment_status') }}</th>
                                            <th class=" cell100 column2">{{ __('lang.time')}}</th>
                                            <th class=" cell100 column2">{{ __('lang.date')}}</th>
                                            <th class=" cell100 column1">{{ __('lang.id')}}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        @endif
                        <div class="table100-body js-pscroll">
                            <table>
                                <tbody>
                                    <tr class="row100 body">
                                        @if ($reservation->status==null)
                                        <td class="cell100 column2"><a class="btn btn-outline-danger"
                                            onclick="return confirm('هل انت متاكد من الغاء الموعد ؟')"
                                            href="{{ route('destroy', $reservation->id) }}">{{ __('lang.cancel')}}<i
                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                         </td>
                                        @endif
                                        <td class="cell100 column2">{{ $status[$reservation->status] }}</td>
                                        <td class=" cell100 column2">
                                            {{ date(' A h:i', strtotime($reservation->start_date)) }}</td>
                                        <td class=" cell100 column2">
                                            {{ date('Y-m-d', strtotime($reservation->start_date)) }}</td>
                                        <td class=" cell100 column1">{{ $reservation->id }}</td>
                                    </tr>
                                @empty
                                    <p class="text-center" id="empty">{{ __('lang.you do not have any appointment')}} </p>
                                </tbody>
                            </table>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="links">
        {{ $reservations->links() }}
        <div class="text-center" style="padding-bottom: 2%;">
            @if ($canBook)
                <a href="{{ route('create') }}" class=" text-center btn btn-primary  btn-lg">{{ __('lang.new appointment')}}</a>
            @endif
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
