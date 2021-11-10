========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ url('/index') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li {{ Request::segment(1) == 'roles' ? 'class=mm-active': '' }}>
                    <a href="{{ route('roles') }}" class="waves-effect {{ Request::segment(1) == 'roles' ? 'active': '' }}"
                        {{Request::segment(1) == 'roles' ? 'aria-expanded=false' : ''}}>
                        <i class="bx bxs-user-detail"></i>
                        <span>Roles</span>
                    </a>
                </li>
                <li {{ Request::segment(1) == 'modules' ? 'class=mm-active': '' }}>
                    <a href="{{ route('modules') }}" class="waves-effect {{ Request::segment(1) == 'modules' ? 'active': '' }}"
                        {{Request::segment(1) == 'modules' ? 'aria-expanded=false' : ''}}>
                        <i class="bx bxs-user-detail"></i>
                        <span>Modules</span>
                    </a>
                </li>

                <li {{ Request::segment(1) == 'users' ? 'class=mm-active': '' }}>
                    <a href="{{ route('users') }}" class="waves-effect {{ Request::segment(1) == 'users' ? 'active': '' }}"
                        {{Request::segment(1) == 'users' ? 'aria-expanded=false' : ''}}>
                        <i class="bx bxs-user-detail"></i>
                        <span>Users</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
========== Left Sidebar End ========== -->