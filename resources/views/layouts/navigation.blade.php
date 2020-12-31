<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="https://bulma.io">
            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item">
                Home
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    Master
                </a>

                <div class="navbar-dropdown">
                    <a class="navbar-item" href="{{ route('master.configurations.index') }}">
                        Configurations
                    </a>
                </div>
            </div>

            <a class="navbar-item">
                
            </a>

        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="button is-primary" href="#" onclick="event.preventDefault();this.closest('form').submit();"">
                            <strong>{{ __('Logout') }}</strong>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
