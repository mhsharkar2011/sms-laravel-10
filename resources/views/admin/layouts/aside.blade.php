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
            <div class="info">
                <a href="{{ route('admins.show', Auth::user()->id) }}" class="d-block">{{ Auth::user()->name }}</a>
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
                            Admins
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('classes') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Class
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admins.subjects') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Subjects
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('assign_subjects') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Assign Subjects
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admins/students') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Students
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('parents') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Parents
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
                    <a href="{{ url('subjects') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Subjects
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('students') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Students
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('parents') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
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
                    <a href="{{ url('students/teachers') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Teachers
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
                    <a href="{{ url('exams') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Exams
                        </p>
                    </a>
                </li>
                @endif
            
                <li class="nav-item">
                    <a href="{{ url('destroy') }}" class="nav-link">
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
