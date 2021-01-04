<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item py-0" href="{{ url('/') }}">
            <img src="{{ asset('images/banner.png') }}" style="height: 3.2rem;">
        </a>
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="main-navbar">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <div id="main-navbar" class="navbar-menu">
        <div class="navbar-start">
            @guest
            @else
                @hasanyrole('SUPER_ADMIN')
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Admin
                    </a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="{{ route('admin.permissions.index') }}">Permissions</a>
                        <a class="navbar-item" href="{{ route('admin.roles.index') }}">Roles</a>
                        <a class="navbar-item" href="{{ route('admin.users.index') }}">Users</a>
                    </div>
                </div>
                @endhasrole
                @hasanyrole('SUPER_ADMIN|ADMIN')
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Master
                    </a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="{{ route('master.configurations.index') }}">Configurations</a>
                        <a class="navbar-item" href="{{ route('master.categories.index') }}">Categories</a>
                        <a class="navbar-item" href="{{ route('master.countries.index') }}">Countries</a>
                        <a class="navbar-item" href="{{ route('master.diamondshapes.index') }}">Diamond Shapes</a>
                    </div>
                </div>
                @endhasanyrole
                @hasrole('BILL_MANAGER')
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Purchase
                    </a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="{{ route('purchase.bills.index') }}">Bills</a>
                    </div>
                </div>
                @endhasrole
                {{--
                <div class="navbar-item has-dropdown is-hoverable is-mega">
                    <a class="navbar-link">
                        Reports
                    </a>
                    <div class="navbar-dropdown">
                        <div class="container is-fluid">
                            <div class="columns">
                                <div class="column is-3">
                                    <h1 class="title is-6 is-mega-menu-title">Header</h1>
                                    <a class="navbar-item" href="">
                                        <div class="navbar-content">
                                            <p>
                                                <small class="has-text-info">Subtitle</small>
                                            </p>
                                            <p>Title</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                --}}
            @endguest
        </div>
        <div class="navbar-end">
            @guest
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-primary" href="{{ route('login') }}">
                            <strong>{{ __('Login') }}</strong>
                        </a>
                        @if (Route::has('register'))
                            <a class="button is-light" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        @endif
                    </div>
                </div>
            @else
                <div class="navbar-item">
                    {{ Auth::user()->name }}
                </div>
                <div class="navbar-item">
                    <a class="button is-success" href="{{ route('users.password') }}">
                        <span class="icon">
                            <i class="fas fa-unlock-alt"></i>
                        </span>
                        <span class="has-text-weight-bold">
                            Change Password
                        </span>
                    </a>
                </div>
                <div class="navbar-item">
                    <a class="button is-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                        <span class="has-text-weight-bold">
                            {{ __('Logout') }}
                        </span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endguest
        </div>
    </div>
</nav>
<script>
    $(document).ready(function() {
        // Check for click events on the navbar burger icon
        $(".navbar-burger").click(function() {
            // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
            $(".navbar-burger").toggleClass("is-active");
            $(".navbar-menu").toggleClass("is-active");
        });
    });

</script>
