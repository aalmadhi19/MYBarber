@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div class="limiter" id="booking">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100 ver2 m-b-110">
                    @foreach ($settings as $setting)
                        @if ($loop->first)
                            <div class="table100-head">
                                <table>
                                    <thead>
                                        <tr class="row100 head">
                                            <th class=" cell100 column2">{{ __('lang.status') }}</th>
                                            <th class=" cell100 column2">{{ __('lang.description') }}</th>
                                            <th class=" cell100 column2">{{ __('lang.name') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        @endif
                        <div class="table100-body js-pscroll">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="cell100 column2">
                                            <b
                                                style="{{ $statusText[$setting->status] == __('lang.enabled') ? 'color: #38c172;' : 'color: #e3342f;' }}">
                                                {{ $statusText[$setting->status] }}
                                            </b>
                                            <form action="{{ route('change.status', $setting->id) }}">
                                                <input type="hidden" name="status" value="{{ $setting->status }}">
                                                <br>
                                                <a href="#"> <button
                                                        class="{{ $statusText[$setting->status] == __('lang.enabled') ? 'btn btn-danger btn-sm' : 'btn btn-success btn-sm' }}"
                                                        type="submit">{{ $statusText[$setting->status] == __('lang.enabled') ? __('lang.disable') : __('lang.enable') }}</button></a>
                                            </form>
                                        </td>

                                        <td class="cell100 column2"> {{ $setting->description }}</td>
                                        <td class="cell100 column2"> {{ $setting->name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
