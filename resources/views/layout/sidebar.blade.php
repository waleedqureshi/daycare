<nav class="sidebar">
    <div class="sidebar-header">
        <a target="_blank" href="https://paradisedaycare.co.uk/" class="sidebar-brand">
            <!-- PurchaseOrder<span>MS</span> -->
            <center>
            <img src="{{ asset('assets/images/daycare_logo.png') }}" style="width:150px;">
            </center>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ active_class(['/']) }}">
                <a href="{{ url('/') }}" class="nav-link">
                    <i class="link-icon" data-feather="airplay"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            @canany(['View Role', 'View User'])
                <li class="nav-item nav-category">User Management</li>
                @canany(['View Role'])
                    <li class="nav-item {{ active_class(['role/*']) }}">
                        <a href="{{ url('role/view') }}" class="nav-link">
                            <i class="link-icon" data-feather="sliders"></i>
                            <span class="link-title">Roles</span>
                        </a>
                    </li>
                @endcanany


                @canany(['View User'])
                    <li class="nav-item {{ active_class(['user/*']) }}">
                        <a href="{{ url('user/view') }}" class="nav-link">
                            <i class="link-icon" data-feather="users"></i>
                            <span class="link-title">Users</span>
                        </a>
                    </li>
                @endcanany
            @endcanany

            @canany(['View Register', 'View Teacher', 'View Room'])
                <li class="nav-item nav-category">Daycare Management</li>
                @canany(['View Register'])
                    <li class="nav-item {{ active_class(['register/*']) }}">
                        <a href="{{ url('register/view') }}" class="nav-link">
                            <i class="link-icon" data-feather="book-open"></i>
                            <span class="link-title">Child Register</span>
                        </a>
                    </li>
                @endcanany


                @canany(['View Teacher'])
                    <li class="nav-item {{ active_class(['teacher/*']) }}">
                        <a href="{{ url('teacher/view') }}" class="nav-link">
                            <i class="link-icon" data-feather="user"></i>
                            <span class="link-title">Teachers</span>
                        </a>
                    </li>
                @endcanany

                @canany(['View Room'])
                    <li class="nav-item {{ active_class(['room/*']) }}">
                        <a href="{{ url('room/view') }}" class="nav-link">
                            <i class="link-icon" data-feather="codesandbox"></i>
                            <span class="link-title">Rooms</span>
                        </a>
                    </li>
                @endcanany
            @endcanany

            @canany(['View Session'])
                <li class="nav-item nav-category">Session Management</li>
                @canany(['View Session'])
                    <li class="nav-item {{ active_class(['session/*']) }} {{ active_class(['slot/*']) }}">
                        <a href="{{ url('session/view') }}" class="nav-link">
                            <i class="link-icon mdi mdi-calendar-clock"></i>
                            <span class="link-title">Sessions</span>
                        </a>
                    </li>
                @endcanany
            @endcanany
        </ul>
    </div>
</nav>
