<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="{{ route('home') }}" class="{{ setSidebarActive(['home']) }}">Home<br></a></li>
        <li><a href="{{ route('about-us') }}" class="{{ setSidebarActive(['about-us']) }}">Abouts</a></li>
        <li><a href="{{ route('course') }}" class="{{ setSidebarActive(['course', 'detail-course']) }}">Courses</a></li>
        <li><a href="{{ route('tutor') }}" class="{{ setSidebarActive(['tutor']) }}">Tutors</a></li>
        <li><a href="{{ route('article') }}" class="{{ setSidebarActive(['article', 'detail-article']) }}">Articles</a>
        </li>
        <li><a href="{{ route('video') }}" class="{{ setSidebarActive(['video']) }}">Videos</a></li>
        <li>
            <a href="#" class="btn btn-transparent text-center btn-search" data-target="#searchModal"
                data-target="modal">
                <i class="bi bi-search"></i>
            </a>
        </li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>
