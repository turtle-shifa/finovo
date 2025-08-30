<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
    <div class="container-fluid">

        <a class="navbar-brand fw-semi d-flex align-items-center" href="/">
            <img src="/logo.png" alt="Logo" style="height: 40px;" class="me-2">
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fw-semibold {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold {{ request()->is('signin') ? 'active' : '' }}" href="/signin">Log In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold {{ request()->is('signup') ? 'active' : '' }}" href="/signup">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>