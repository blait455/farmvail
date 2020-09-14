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
            <a class="app-menu__item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'panel.banners.index' ? 'active' : '' }}" href="{{ route('panel.banners.index') }}">
                <i class="app-menu__icon fa fa-briefcase"></i>
                <span class="app-menu__label">Banners</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'panel.categories.index' ? 'active' : '' }}"
                href="{{ route('panel.categories.index') }}">
                <i class="app-menu__icon fa fa-tags"></i>
                <span class="app-menu__label">Categories</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'panel.products.index' ? 'active' : '' }}" href="{{ route('panel.products.index') }}">
                <i class="app-menu__icon fa fa-briefcase"></i>
                <span class="app-menu__label">Products</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'panel.partners.index' ? 'active' : '' }}" href="{{ route('panel.partners.index') }}">
                <i class="app-menu__icon fa fa-briefcase"></i>
                <span class="app-menu__label">Partners</span>
            </a>
        </li>
        @can('manage-users')
            <li class="treeview">
                <a class="app-menu__item {{ Route::currentRouteName() == 'panel.users.index' ? 'active' : '' || Route::currentRouteName() == 'panel.roles.index' ? 'active' : '' }}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">User Management</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item {{ Route::currentRouteName() == 'panel.users.index' ? 'active' : '' }}" href="{{ route('panel.users.index') }}"><i class="icon fa fa-circle-o"></i>Users</a>
                    </li>
                    <li>
                        <a class="treeview-item {{ Route::currentRouteName() == 'panel.roles.index' ? 'active' : '' }}" href="{{ route('panel.roles.index') }}" target="_blank" rel="noopener noreferrer"><i class="icon fa fa-circle-o"></i>Roles</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>Permissions</a>
                    </li>
                </ul>
            </li>
        @endcan
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'panel.testimonies.index' ? 'active' : '' }}"
                href="{{ route('panel.testimonies.index') }}">
                <i class="app-menu__icon fa fa-tags"></i>
                <span class="app-menu__label">Testimonies</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'settings' ? 'active' : '' }}" href="{{ route('settings') }}">
                <i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Settings</span>
            </a>
        </li>
    </ul>
</aside>
