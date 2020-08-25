<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div>
            <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ Auth::user()->email }}</p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item active" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        @can('manage-users')
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">User Management</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="{{ route('panel.users.index') }}"><i class="icon fa fa-circle-o"></i>Users</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('panel.roles.index') }}" target="_blank" rel="noopener noreferrer"><i class="icon fa fa-circle-o"></i>Roles</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Permissions</a>
                    </li>
                </ul>
            </li>
        @endcan
        <li>
            <a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Settings</span>
            </a>
        </li>
    </ul>
</aside>
