<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ url('public/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">English - School</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <x-avatar :avatar="Auth::user()->avatar" width="48" height="48" class="rounded-circle" />
            @if (Auth::user()->user_type == 1)
                <div class="info">
                    <a href="{{ route('admins.profile.show', Auth::user()->id) }}"
                        class="d-block">{{ Auth::user()->full_name }}</a>
                </div>
            @elseif (Auth::user()->user_type == 2)
                <div class="info">
                    <a href="{{ route('teachers.profile.show', Auth::user()->id) }}"
                        class="d-block">{{ Auth::user()->full_name }}</a>
                </div>
            @elseif (Auth::user()->user_type == 3)
                <div class="info">
                    <a href="{{ route('students.profile.show', Auth::user()->id) }}"
                        class="d-block">{{ Auth::user()->full_name }}</a>
                </div>
            @elseif (Auth::user()->user_type == 4)
                <div class="info">
                    <a href="{{ route('parents.profile', Auth::user()->id) }}"
                        class="d-block">{{ Auth::user()->full_name }}</a>
                </div>
            @endif
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- Admin Dashboard --}}
                @if (Auth::user()->user_type == 1)
                    <li class="nav-item">
                        <a href="{{ route('admins.dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'admin-dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admins.index') }}"
                            class="nav-link @if (Request::segment(2) == 'list') active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Admins
                            </p>
                        </a>
                    </li>
                    <li class="nav-item menu">
                        <a href="" class="nav-link @if (Request::segment(1) == '*') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Teacher
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admins.teachers.index') }}"
                                    class="nav-link @if (Request::segment(2) == 'teachers') active @endif">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        All Teachers
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admins.assign_class_teachers.index') }}"
                                    class="nav-link @if (Request::segment(2) == 'assign_class_teachers') active @endif">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Assign Class
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Student --}}
                    <li class="nav-item">   
                    <li class="nav-item menu">
                        <a href="" class="nav-link @if (Request::segment(1) == '*') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Student
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admins.students.index') }}"
                                    class="nav-link @if (Request::segment(2) == 'students') active @endif">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        All Students
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admins.assign_class_students.index') }}"
                                    class="nav-link @if (Request::segment(2) == 'assign_class_students') active @endif">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Assign Class
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admins.parents.index') }}"
                            class="nav-link @if (Request::segment(2) == 'parents') active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Parents
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admins/classes') }}"
                            class="nav-link @if (Request::segment(1) == 'classes') active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Class
                            </p>
                        </a>
                    </li>
                    {{-- Attendance Menu --}}
                    <li class="nav-item menu">
                        <a href="" class="nav-link @if (Request::segment(1) == '*') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Attendance
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admins.attendance.index') }}"
                                    class="nav-link @if (Request::segment(3) == Auth::user()->id) active @endif">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Student Attendance
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admins.attendance.index') }}"
                                    class="nav-link @if (Request::segment(1) == 'change_password') active @endif">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Teacher Attendance
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admins.subjects.index') }}"
                            class="nav-link @if (Request::segment(2) == 'subjects') active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Subjects
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admins.assign_subjects.index') }}"
                            class="nav-link @if (Request::segment(2) == 'assign_subjects') active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Assign Subjects
                            </p>
                        </a>
                    </li>

                    {{-- Teacher Dashboard --}}
                @elseif (Auth::user()->user_type == 2)
                    <li class="nav-item">
                        <a href="{{ route('teachers.dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('subjects') }}"
                            class="nav-link @if (Request::segment(2) == 'list') active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Subjects
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('students') }}"
                            class="nav-link @if (Request::segment(2) == 'list') active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Students
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('parents') }}"
                            class="nav-link @if (Request::segment(2) == 'list') active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Parents
                            </p>
                        </a>
                    </li>
                    {{-- Student Dashboard --}}
                @elseif (Auth::user()->user_type == 3)
                    <li class="nav-item">
                        <a href="{{ route('students.dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('students.teachers') }}"
                            class="nav-link @if (Request::segment(2) == 'list') active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Teachers
                            </p>
                        </a>
                    </li>
                    {{-- Parent Dashboard --}}
                @elseif (Auth::user()->user_type == 4)
                    <li class="nav-item">
                        <a href="{{ url('parents/parent-dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('students') }}"
                            class="nav-link @if (Request::segment(2) == 'list') active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                My Student
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('exams') }}"
                            class="nav-link @if (Request::segment(2) == 'list') active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Exams
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item menu">
                    <a href="" class="nav-link @if (Request::segment(1) == '*') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admins.profile.edit', Auth::user()->id) }}"
                                class="nav-link @if (Request::segment(3) == Auth::user()->id) active @endif">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Profile Update
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('change_password') }}"
                                class="nav-link @if (Request::segment(1) == 'change_password') active @endif">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Change Password
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
