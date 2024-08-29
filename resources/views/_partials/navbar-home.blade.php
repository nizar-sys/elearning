<!-- resources/views/_partials/navbar-home.blade.php -->

<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home<br></a></li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Abouts</a></li>
        <li><a href="{{ route('course') }}" class="{{ request()->routeIs('course') ? 'active' : '' }}">Courses</a></li>
        <li><a href="{{ route('tutor') }}" class="{{ request()->routeIs('tutor') ? 'active' : '' }}">Tutors</a></li>
        <li><a href="{{ route('article') }}" class="{{ request()->routeIs('article') ? 'active' : '' }}">Articles</a>
        </li>
        <li><a href="{{ route('video') }}" class="{{ request()->routeIs('video') ? 'active' : '' }}">Videos</a></li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>
