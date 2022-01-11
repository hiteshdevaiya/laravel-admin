========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li {{ Request::segment(1) == 'dashboard' ? 'class=mm-active': '' }}>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect {{ Request::segment(1) == 'dashboard' ? 'active': '' }}"
                        {{Request::segment(1) == 'dashboard' ? 'aria-expanded=false' : ''}}>
                        <i class="bx bxs-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li {{ Request::segment(1) == 'roles' ? 'class=mm-active': '' }}>
                    <a href="{{ route('roles') }}" class="waves-effect {{ Request::segment(1) == 'roles' ? 'active': '' }}"
                        {{Request::segment(1) == 'roles' ? 'aria-expanded=false' : ''}}>
                        <i class="bx bx-user-voice"></i>
                        <span>Roles</span>
                    </a>
                </li>
                <li {{ Request::segment(1) == 'modules' ? 'class=mm-active': '' }}>
                    <a href="{{ route('modules') }}" class="waves-effect {{ Request::segment(1) == 'modules' ? 'active': '' }}"
                        {{Request::segment(1) == 'modules' ? 'aria-expanded=false' : ''}}>
                        <i class="bx bxs-grid"></i>
                        <span>Modules</span>
                    </a>
                </li>

                <li {{ Request::segment(1) == 'users' ? 'class=mm-active': '' }}>
                    <a href="{{ route('users') }}" class="waves-effect {{ Request::segment(1) == 'users' ? 'active': '' }}"
                        {{Request::segment(1) == 'users' ? 'aria-expanded=false' : ''}}>
                        <i class="bx bx-user-plus"></i>
                        <span>Users</span>
                    </a>
                </li>

                <li {{ Request::segment(1) == 'settings' ? 'class=mm-active': '' }}>
                    <a href="{{ route('settings') }}" class="waves-effect {{ Request::segment(1) == 'settings' ? 'active': '' }}"
                        {{Request::segment(1) == 'settings' ? 'aria-expanded=false' : ''}}>
                        <i class="bx bxs-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
========== Left Sidebar End ========== -->