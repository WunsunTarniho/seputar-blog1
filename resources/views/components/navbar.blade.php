<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">Seputar Blog</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="/" class="active">Home</a></li>
                <li class="dropdown"><a href="#" onclick="event.preventDefault()"><span>Categories</span> <i
                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        @foreach ($categories as $category)
                            <li><a href="#{{ Str::lower($category->name) }}-category">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
                @if (!Auth::check())
                    <li class="d-lg-none d-flex justify-content-start align-items-center gap-2">
                        <a href="/login">Login</a>
                        <span>|</span>
                        <a href="/register">Register</a>
                    </li>
                @else
                    <li class="d-flex justify-content-between align-items-center d-lg-none">
                        <a class="nav-link" href='#' data-bs-toggle="offcanvas"
                            data-bs-target="#notificationRight" aria-controls="notificationRight">
                            Notification
                        </a>
                        <span class="notification-read badge text-bg-danger me-4">{{ $notificationRead }}</span>
                    </li>
                    <li class="d-lg-none d-block">
                        <a href="/logout">Logout</a>
                    </li>
                @endif
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div class="d-lg-flex align-items-center gap-4 d-none">
            @if (!Auth::check())
                <a class="btn px-3 btn-secondary" href="/login">Login</a>
                <a class="btn px-3 btn-outline-secondary" href="/register">Register</a>
            @else
                <a class="nav-link position-relative" href='#' data-bs-toggle="offcanvas"
                    data-bs-target="#notificationRight" aria-controls="notificationRight">
                    <i class="bi bi-envelope fs-3"></i>
                    <span class="notification-read badge text-bg-danger position-absolute"
                        style="right: -15px; bottom: 0px;">{{ $notificationRead }}</span>
                </a>
                <a class="btn btn-secondary" href="/logout">Logout</a>
            @endif
        </div>
    </div>
</header>
