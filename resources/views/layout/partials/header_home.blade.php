<header class="main-header header-one white-menu menu-absolute">
    <!--Header-Upper-->
    <div class="header-upper py-30 rpy-0">
        <div class="container-fluid clearfix">

            <div class="header-inner rel d-flex align-items-center">
                <div class="logo-outer">
                    <div class="logo"><a href="{{ route('home.index') }}"><img src="assets/images/logos/logo.png" alt="Logo"
                                title="Logo"></a></div>
                </div>

                <div class="nav-outer mx-lg-auto ps-xxl-5 clearfix">
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-lg">
                        <div class="navbar-header">
                            <div class="mobile-logo">
                                <a href="{{ route('home.index') }}">
                                    <img src="assets/images/logos/logo.png" alt="Logo" title="Logo">
                                </a>
                            </div>

                            <!-- Toggle Button -->
                            <button type="button" class="navbar-toggle" data-bs-toggle="collapse"
                                data-bs-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                                <li><a href="{{ route('home.index') }}">Trang chủ</a></li>
                                <li><a href="{{ route('about.index') }}">About</a></li>
                                <li class="dropdown"><a href="#">Tours</a>
                                    <ul>
                                        <li><a href="{{ route('tour.index') }}">Tour</a></li>
                                        <li><a href="{{ route('tour_guide.index') }}">Hướng dẫn viên du lịch</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('destination.index') }}">Điểm đến</a></li>
                                <li><a href="{{ route('contact.index') }}">Liên hệ</a></li>
                            </ul>
                        </div>

                    </nav>
                    <!-- Main Menu End-->
                </div>

                <!-- Nav Search -->
                <div class="nav-search">
                    <button class="far fa-search"></button>
                    <form action="{{ route('search-text') }}" class="hide" method="GET">
                        <input type="text" name="keyword" placeholder="Search" class="searchbox" required>
                        <button type="submit" class="searchbutton far fa-search"></button>
                    </form>
                </div>

                <!-- Menu Button -->
                <div class="menu-btns py-10">
                    <a href="contact.html" class="theme-btn style-two bgc-secondary">
                        <span data-hover="Book Now">Đặt ngay</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                    <!-- menu sidbar -->
                    <div class="menu-sidebar">
                        <button class="bg-transparent">
                            <li class="drop-down">
                                <img src="{{ auth()->user()->avatar ? asset('storage/images/avatars/' . auth()->user()->avatar) : asset('assets/images/default-avatar.png') }}"
                                    alt="User Avatar" class="rounded-circle"
                                    style="width: 45px; height: 45px; object-fit: cover;">
                                <ul class="dropdown-menu" id="dropdownMenu">
                                    <li><a href="{{ route('user-profile') }}">Thông tin người dùng</a></li>
                                    <li><a href="{{ route('my-tours') }}">Tour đã đặt</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Header Upper-->
</header>
