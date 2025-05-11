<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('assets_admin/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                    class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                {{-- active --}}
                <li class="nav-item"> 
                    <a href="{{ route('admin.home') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.admin') }}">
                        <i class="fas fa-layer-group"></i>
                        <p>Quản lý Admin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users') }}">
                        <i class="fas fa-layer-group"></i>
                        <p>Quản lý người dùng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.booking') }}">
                        <i class="fas fa-layer-group"></i>
                        <p>Quản lý booking</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Liên hệ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#submenu">
                        <i class="fas fa-bars"></i>
                        <p>Quản lý tour</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.page-add-tours') }}">
                                    <span class="sub-item">Thêm tour</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.tours') }}">
                                    <span class="sub-item">Danh sách tour</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>