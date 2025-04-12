<nav class="sidebar">
    <div class="sidebar-profile">
        <img src="{{ asset('renne.jpg') }}" alt="User Avatar" class="profile-img" />
        <div class="profile-info">
            <span class="profile-name">Tan Jun Eng</span>
            <span class="profile-status">Online</span>
        </div>
    </div>

    <ul class="sidebar-menu">
        <li class="menu-item {{ Request::is('/') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <span class="icon">
                    <i class="fas fa-home"></i>
                </span>
                <span class="menu-label">Home</span>

            </a>
        </li>
        <li class="menu-item {{ Request::is('students*') ? 'active' : '' }}">
            <a href="{{ route('students.index') }}">
                <span class="icon">
                    <i class="fas fa-user-graduate"></i>
                </span>
                <span class="menu-label">Students</span>
            </a>
        </li>
        <li class="menu-item {{ Request::is('courses*') ? 'active' : '' }}">
            <a href="{{ route('courses.index') }}">
                <span class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </span>
                <span class="menu-label">Courses</span>
            </a>
        </li>
        <li class="menu-item {{ Request::is('enrollments*') ? 'active' : '' }}">
            <a href="{{ route('enrollments.index') }}">
                <span class="icon">
                    <i class="fas fa-book-open"></i>
                </span>
                <span class="menu-label">Enrollment</span>
            </a>
        </li>
        <form action="{{ route('logout') }}" method="post" class="logout-form">
            @csrf
            <button type="submit" class="logout-button">
                <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                <span>Logout</span>
            </button>
        </form>

    </ul>
</nav>
