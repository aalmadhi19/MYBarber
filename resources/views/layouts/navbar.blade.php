<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">


                @if (Auth::user()->isAdmin())
                    <li class="nav-item active">
                        <a class="{{ Route::is('dashboard') ? 'nav-link_02 active' : 'nav-link ' }}"
                            href="{{ route('dashboard') }}" role="tabpanel">المواعيد</a>
                    </li>
                    <li class="nav-item active">
                        <a class="{{ Route::is('clients') ? 'nav-link_02 active' : 'nav-link ' }}"
                            href="{{ route('clients') }}" role="tabpanel">العملاء</a>
                    </li>
                    {{-- <li class="nav-item active">
                        <a class="{{ Route::is('blocklist') ? 'nav-link_02 active' : 'nav-link ' }}"
                            href="{{ route('blocklist') }}" role="tabpanel">قائمة المحظورين</a>
                    </li> --}}
                @else
                    <li class="nav-item active">
                        <a class="nav-link_02" href="{{ route('home') }}">الرئيسية</a>
                    </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            {{ __('تسجيل الخروج') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- end -- navbar -->
