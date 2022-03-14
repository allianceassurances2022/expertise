<!-- Top Bar Start -->
<div class="topbar">

    <div class="topbar-left	d-none d-lg-block">
        <div class="text-center">

            <a href="{{ route('dashboard') }}" class="logo"><img
                    src="{{ asset('assets/images/logo.png') }}" height="20" alt="logo"></a>
        </div>
    </div>

    <nav class="navbar-custom">

        <ul class="list-inline float-right mb-0">
            <li class="list-inline-item " style="color: white !important;">
                {{ auth()->user()->username }}
            </li>
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('assets/images/users/coronavirus.svg') }}" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                    <a class="dropdown-item" href="{{ route('utilisateur.profil') }}"><i
                            class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                    <a class="dropdown-item" href="javascript:void(0)"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect" id="menu-button">
                    <i class="ion-navicon"></i>
                </button>
            </li>
        </ul>

        <div class="clearfix"></div>

    </nav>

</div>
<!-- Top Bar End -->
