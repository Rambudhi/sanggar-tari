<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo me-1">
                <span style="color:var(--bs-primary);">
                    <img src="{{ asset('assets/img/purnama.png') }}" alt="" width="60" height="60">               
                </span>
            </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
    </div>
    
    <div class="menu-inner-shadow"></div>
    
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ Route::currentRouteName() == 'admin::dashboard' ? 'active' : '' }}">
            <a href="{{ route('admin::dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        <!-- User -->
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text">User</span>
        </li>
        <li class="menu-item {{ Route::currentRouteName() == 'admin::user-active' ? 'active' : '' }}">
            <a href="{{ route('admin::user-active') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-account-outline"></i>
                <div data-i18n="penggunaAktif">Pengguna Aktif</div>
            </a>
        </li>
    </ul>

</aside>