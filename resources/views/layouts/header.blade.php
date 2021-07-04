<div dir="ltr">

    <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>
    <header class="site-navbar" role="banner">

        <div class="container">
            <div class="row align-items-center">

                <div class="col-11 col-xl-2">
                    <h1 class="mb-0 site-logo"><a href="#" class="text-white mb-0"><img
                                src="{{ asset('img/icon1.png') }}" alt="logo" class="icon" width="133" height="90"></a></h1>
                </div>
                <div class="col-12 col-md-10 d-none d-xl-block">
                    <nav class="site-navigation position-relative text-right" role="navigation">

                        <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                            @if (Auth::user()->isAdmin())

                                @if (App::getLocale() == 'en')
                                    <li class="{{ App::getLocale() == 'ar' ? 'active1' : ' ' }}"><a
                                            href="{{ route('set.language', 'ar') }}"><span>العربية</span></a></li>
                                @else
                                    <li class="{{ App::getLocale() == 'en' ? 'active1' : ' ' }}"><a
                                            href="{{ route('set.language', 'en') }}"><span>EN</span></a></li>
                                @endif
                                <li class="{{ Route::is('dashboard') ? 'active' : ' ' }}"><a
                                        href="{{ route('dashboard') }}"><span>{{ __('lang.Appointments') }}</span></a>
                                </li>
                                <li class="{{ Route::is('clients') ? 'active' : ' ' }}"><a
                                        href="{{ route('clients') }}"><span>{{ __('lang.Clients') }}</span></a>
                                </li>
                                <li class="{{ Route::is('settings') ? 'active' : ' ' }}"><a
                                        href="{{ route('settings') }}"><span>{{ __('lang.settings') }}</span></a>
                                </li>
                            @else
                                @if (App::getLocale() == 'en')
                                    <li class="{{ App::getLocale() == 'ar' ? 'active1' : ' ' }}"><a
                                            href="{{ route('set.language', 'ar') }}"><span>العربية</span></a></li>
                                @else
                                    <li class="{{ App::getLocale() == 'en' ? 'active1' : ' ' }}"><a
                                            href="{{ route('set.language', 'en') }}"><span>EN</span></a></li>
                                @endif

                                <li class="{{ Route::is('home') ? 'active' : '' }}"><a
                                        href="{{ route('home') }}"><span>{{ __('lang.My Appointment') }}</span></a>
                                </li>

                            @endif
                            <li class="has-children name">
                                <a href="#"><span> {{ Auth::user()->name }}</span></a>
                                <ul class="dropdown arrow-top">
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                            {{ __('lang.Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a
                        href="#" class="site-menu-toggle js-menu-toggle text-white"><span
                            class="icon-menu h3"></span></a>
                </div>
            </div>

        </div>

    </header>
</div>
