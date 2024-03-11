<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ url('public/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('public/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- Admin Dashboard --}}
                @if (Auth::user()->user_type == 1)
                <li class="nav-item">
                    <a href="{{ url('admin/admin-dashboard') }}" class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admins') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Admin
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admins/profile') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                {{-- Teacher Dashboard --}}
                @elseif (Auth::user()->user_type == 2)
                <li class="nav-item">
                    <a href="{{ url('teacher/teacher-dashboard') }}" class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('subject/subject-list') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Subject
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('student/student-list') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Student
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('parent/parent-list') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Parents
                        </p>
                    </a>
                </li>
                {{-- Student Dashboard --}}
                @elseif (Auth::user()->user_type == 3)
                <li class="nav-item">
                    <a href="{{ url('student/student-dashboard') }}" class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('subject/subject-list') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Subject
                        </p>
                    </a>
                </li>
                {{-- Parent Dashboard --}}
                @elseif (Auth::user()->user_type == 4)
                <li class="nav-item">
                    <a href="{{ url('parent/parent-dashboard') }}" class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('exam/exam-list') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Exam
                        </p>
                    </a>
                </li>
                @endif
            
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
