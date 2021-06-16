@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="limiter" id="booking" >
        <div class="container-table100">
            <div class="wrap-table100">
				<div class="table100 ver2 m-b-110">
                    @forelse($reservations as $reservation )
                        @if ($loop->first)
                            <div class="table100-head">
                                <table>
                                    <thead>
                                        <tr class="row100 head">
                                            <th class=" cell100 column3">حظر العميل</th>
                                            <th class=" cell100 column3">الغاء الحجز</th>
                                            <th class=" cell100 column3">نوع الحلاقة</th>
                                            <th class=" cell100 column3">الاسم</th>
                                            <th class=" cell100 column3">حالة الحجز</th>
                                            <th class=" cell100 column3">الوقت</th>
                                            <th class=" cell100 column3">التاريخ</th>
                                            <th class=" cell100 column1">رقم الحجز</th>
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
                                            <a href="{{ route('block',$reservation->user_id) }}" class="btn btn-outline-danger">حظر العميل
                                                <i class="fa fa-ban" aria-hidden="true"></i></a>
                                        </td>
                                        <td class=" cell100 column3"> <a class="btn btn-outline-danger"
                                            onclick="return confirm('هل انت متاكد من الغاء الموعد ؟')"
                                            href="{{ route('cancel',$reservation->id) }}">الغاء الموعد <i
                                                class="fa fa-trash" aria-hidden="true"></i></a> </td>
                                        <td class=" cell100 column3">{{ $reservation->type }}</td>
                                        <td class=" cell100 column3">{{ $reservation->name }}</td>
                                        <td class="cell100 column3">{{ $status[$reservation->status] }}</td>
                                        <td class=" cell100 column3">
                                            {{ date(' A h:i', strtotime($reservation->start_date)) }}
                                        </td>
                                        <td class=" cell100 column3">
                                            {{ date('Y-m-d', strtotime($reservation->start_date)) }}
                                        </td>
                                        <td class=" cell100 column1">{{ $reservation->id }}</td>
                                    </tr>
                                    @empty
                                    <p class="text-center" id="empty"> لا يوجد مواعيد </p>
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
