<ul class="nav navbar-top-links navbar-right">
    @if (Auth::guest())
        <li>
            <a href="{{ route('login') }}">
                <i class="fa fa-user fa-fw"></i> Login
            </a>
        </li>
        <li>
            <a href="{{ route('register') }}">
                <i class="fa fa-user-plus fa-fw"></i> Register
            </a>
        </li>
    @else
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                {{-- <li>
                    <a href="{{ route('profile') }}"><i class="fa fa-edit fa-fw"></i> Profile</a>
                </li> --}}
                <!-- <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li> -->
                {{-- <li class="divider"></li> --}}
                <li>
                    <a href="{{ route('home') }}" target="_blank"><i class="fa fa-globe fa-fw"></i> Ir a la Web</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-fw"></i>
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    @endif
</ul>
<!-- /.navbar-top-links -->
