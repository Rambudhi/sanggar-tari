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
        <li class="menu-item {{ Route::currentRouteName() == 'admin::register-course' || Route::currentRouteName() == 'admin::register-course-detail' ? 'active' : '' }}">
            <a href="{{ route('admin::register-course') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-account-outline"></i>
                <div data-i18n="penggunaAktif">Pendaftaran Kursus</div>
            </a>
        </li>
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text">Transaksi</span>
        </li>
        <li class="menu-item {{ Route::currentRouteName() == 'admin::taking-rental-costume' ? 'active' : '' }}">
            <a href="{{ route('admin::taking-rental-costume') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-cart-outline"></i>
                <div data-i18n="pengambilanKostum">Pengambilan Kostum</div>
            </a>
        </li>
        <li class="menu-item {{ Route::currentRouteName() == 'admin::return-rental-costume' ? 'active' : '' }}">
            <a href="{{ route('admin::return-rental-costume') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-cart-outline"></i>
                <div data-i18n="pengembalianKostum">Pengembalian Kostum</div>
            </a>
        </li>
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text">Kelas</span>
        </li>
        <li class="menu-item {{ Route::currentRouteName() == 'admin::class-material' || Route::currentRouteName() == 'admin::class-material-detail' ? 'active' : '' }}">
            <a href="{{ route('admin::class-material') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-file-document-multiple-outline"></i>
                <div data-i18n="penggunaAktif">Materi</div>
            </a>
        </li>
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text">Master</span>
        </li>
        <li class="menu-item {{ Route::currentRouteName() == 'admin::custom-type' || Route::currentRouteName() == 'admin::custom-type-detail' ? 'active' : '' }}">
            <a href="{{ route('admin::custom-type') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-file-document-multiple-outline"></i>
                <div data-i18n="penggunaAktif">Jenis Kustom</div>
            </a>
        </li>
        <li class="menu-item {{ Route::currentRouteName() == 'admin::custom-size' ? 'active' : '' }}">
            <a href="{{ route('admin::custom-size') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-file-document-multiple-outline"></i>
                <div data-i18n="penggunaAktif">Ukuran</div>
            </a>
        </li>
    </ul>

</aside>
