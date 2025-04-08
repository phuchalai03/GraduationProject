<header class="main-header header-one white-menu menu-absolute">
    <!--Header-Upper-->
    <div class="header-upper py-30 rpy-0">
        <div class="container-fluid clearfix">

            <div class="header-inner rel d-flex align-items-center">
                <div class="logo-outer">
                    <div class="logo"><a href="index.html"><img src="assets/images/logos/logo.png" alt="Logo" title="Logo"></a></div>
                </div>

                <div class="nav-outer mx-lg-auto ps-xxl-5 clearfix">
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-lg">
                        <div class="navbar-header">
                           <div class="mobile-logo">
                               <a href="index.html">
                                    <img src="assets/images/logos/logo.png" alt="Logo" title="Logo">
                               </a>
                           </div>
                           
                            <!-- Toggle Button -->
                            <button type="button" class="navbar-toggle" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                                <li><a href="{{ route('home.index') }}">Home</a></li>
                                <li><a href="{{ route('about.index') }}">About</a></li>
                                <li class="dropdown"><a href="#">Tours</a>
                                    <ul>
                                        <li><a href="{{ route('tour.index') }}">Tour</a></li>
                                        <li><a href="{{ route('tour_guide.index') }}">Tour Guide</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('destination.index') }}">Destinations</a></li>
                                <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
                            </ul>
                        </div>

                    </nav>
                    <!-- Main Menu End-->
                </div>
                
                <!-- Nav Search -->
                <div class="nav-search">
                    <button class="far fa-search"></button>
                    <form action="#" class="hide">
                        <input type="text" placeholder="Search" class="searchbox" required="">
                        <button type="submit" class="searchbutton far fa-search"></button>
                    </form>
                </div>
                
                <!-- Menu Button -->
                <div class="menu-btns py-10">
                    <a href="contact.html" class="theme-btn style-two bgc-secondary">
                        <span data-hover="Book Now">Book Now</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                    <!-- menu sidbar -->
                    <div class="menu-sidebar">
                        <button class="bg-transparent">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Header Upper-->
</header>