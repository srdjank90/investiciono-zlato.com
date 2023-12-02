<header class="lp-header-wrapper">
    <div class="lp-header-left">
        <button class="navbar-toggler collapsed shadow bg-white d-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <span class="shop-name"><i class="bi bi-shop"></i> MinuteSHOP</span>
    </div>
    <div class="lp-header-right">
        <div class="dropdown">
            <button class="btn dropdown-toggle btn-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-bs-expanded="false"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }} </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> {{ __('Profile')}}</a></li>
                <li><a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="bi bi-door-open"></i> {{ __('Sign out') }}</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</header>
