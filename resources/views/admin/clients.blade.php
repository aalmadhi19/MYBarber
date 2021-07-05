@extends('layouts.app')
@section('title')
{{ __('lang.clients')}} - {{ config('app.name') }}
@endsection
@section('content')
    @include('layouts.header')
    <div class="limiter" id="booking" >
        <div class="container-table100">
            <div class="wrap-table100">
				<div class="table100 ver2 m-b-110">
                    @forelse($clients as $client )
                        @if ($loop->first)
                            <div class="table100-head">
                                <table>
                                    <thead>
                                        <tr class="row100 head">
                                            <th class=" cell100 column2">{{ __('lang.action')}}</th>
                                            <th class=" cell100 column2">{{ __('lang.phone')}}</th>
                                            <th class=" cell100 column2">{{ __('lang.name')}}</th>
                                            <th class=" cell100 column1">{{ __('lang.user_id')}}</th>
                                        </tr>




                                </table>
                            </div>
                        @endif
                        <div class="table100-body js-pscroll">
                            <table>
                                <tbody>
                                    <tr class="row100 body">
                                        @if ($client->blocked)
                                        <td class=" cell100 column2"><a href="{{ route('unblock', $client->id) }}" class="btn  btn-sm  btn-outline-success"> {{ __('lang.unblock')}}
                                            <i class=" fa fa-check" aria-hidden="true"></i>
                                        </a></td>
                                        @else

                                        <td class=" cell100 column2"><a  href="{{ route('block',$client->id) }}" class="btn  btn-sm  btn-outline-danger"> {{ __('lang.block')}}

                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                        </a>
                                        </td>
                                        @endif
                                        <td class=" cell100 column2">{{ $client->phone }}</td>
                                        <td class=" cell100 column2">{{ $client->name }}</td>
                                        <td class=" cell100 column1">{{ $client->id }}</td>
                                    </tr>
                                    @empty
                                    <p class="text-center" id="empty"> {{ __('lang.no clients')}} </p>
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
