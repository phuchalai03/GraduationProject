@extends('layout.master')

@section('content')
    <!-- Page Banner Start -->
    <section class="page-banner-area pt-50 pb-35 rel z-1 bgs-cover"
        style="background-image: url(assets/images/banner/banner.jpg);">
        <div class="container">
            <div class="banner-inner text-white mb-50">
                <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">Địa điểm
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200"
                        data-aos-duration="1500" data-aos-offset="50">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Địa điểm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <div class="container container-1400">
        <div class="search-filter-inner" data-aos="zoom-out-down" data-aos-duration="1500" data-aos-offset="50">
            <div class="filter-item clearfix">
                <div class="icon"><i class="fal fa-map-marker-alt"></i></div>
                <span class="title">Destinations</span>
                <select name="city" id="city">
                    <option value="value1">City or Region</option>
                    <option value="value2">City</option>
                    <option value="value2">Region</option>
                </select>
            </div>
            <div class="filter-item clearfix">
                <div class="icon"><i class="fal fa-flag"></i></div>
                <span class="title">All Activity</span>
                <select name="activity" id="activity">
                    <option value="value1">Choose Activity</option>
                    <option value="value2">Daily</option>
                    <option value="value2">Monthly</option>
                </select>
            </div>
            <div class="filter-item clearfix">
                <div class="icon"><i class="fal fa-calendar-alt"></i></div>
                <span class="title">Departure Date</span>
                <select name="date" id="date">
                    <option value="value1">Date from</option>
                    <option value="value2">10</option>
                    <option value="value2">20</option>
                </select>
            </div>
            <div class="filter-item clearfix">
                <div class="icon"><i class="fal fa-users"></i></div>
                <span class="title">Guests</span>
                <select name="cuests" id="cuests">
                    <option value="value1">0</option>
                    <option value="value2">1</option>
                    <option value="value2">2</option>
                </select>
            </div>
            <div class="search-button">
                <button class="theme-btn">
                    <span data-hover="Search">Search</span>
                    <i class="far fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->


    <!-- Popular Destinations Area start -->
    <section class="popular-destinations-area pt-100 pb-90 rel z-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-center counter-text-wrap mb-40" data-aos="fade-up"
                        data-aos-duration="1500" data-aos-offset="50">
                        <h2>Khám phá các điểm đến phổ biến</h2>
                        <p>Website <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> trải nghiệm
                            phổ
                            biến nhất mà bạn sẽ nhớ</p>
                        <ul class="destinations-nav mt-30">
                            <li data-filter="*" class="active">Tất cả</li>
                            <li data-filter=".domain-b">Miền Bắc</li>
                            <li data-filter=".domain-t">Miền Trung</li>
                            <li data-filter=".domain-n">Miền Nam</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row gap-10 destinations-active justify-content-center">
                    @php $count = 0; @endphp
                    @foreach ($tours as $tour)
                        @if ($count % 3 == 2)
                            <div class="col-md-6 item domain-{{ $tour->domain }}">
                            @else
                                <div class="col-xl-3 col-md-6 item domain-{{ $tour->domain }}">
                        @endif
                        <div class="destination-item style-two" data-aos-duration="1500" data-aos-offset="50">
                            <div class="image" style="max-height: 250px">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{ asset('storage/images/' . $tour->images->first()) }}" alt="Destination"
                                    style="width: 100%; height: 250px; object-fit: cover; object-position: center; display: block;">
                            </div>
                            <div class="content">
                                <h6 class="tour-title"><a
                                        href="{{ route('tour_detail', ['id' => $tour->tourId]) }}">{{ $tour->title }}</a>
                                </h6>
                                <span class="time">{{ $tour->duration }}</span>
                                <a href="{{ route('tour_detail', ['id' => $tour->tourId]) }}" class="more"><i
                                        class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                </div>
                @php $count++; @endphp
                @endforeach

            </div>
        </div>
        </div>
    </section>
    <!-- Popular Destinations Area end -->

    <!-- Hot Deals Area start -->
    {{-- <section class="hot-deals-area pt-70 pb-50 rel z-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-center counter-text-wrap mb-50" data-aos="fade-up"
                        data-aos-duration="1500" data-aos-offset="50">
                        <h2>Discover Hot Deals</h2>
                        <p>One site <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> most
                            popular experience you’ll remember</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="image">
                            <span class="badge">10% Off</span>
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="assets/images/destinations/hot-deal1.jpg" alt="Hot Deal">
                        </div>
                        <div class="content">
                            <span class="location"><i class="fal fa-map-marker-alt"></i> City of Venice, Italy</span>
                            <h5><a href="tour-details.html">Venice Grand Canal, Metropolitan Summer in Venice</a></h5>
                        </div>
                        <div class="destination-footer">
                            <span class="price"><span>$58.00</span>/person</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <a href="destination-details.html" class="theme-btn style-three">
                            <span data-hover="Explore">Explore</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="image">
                            <span class="badge">10% Off</span>
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="assets/images/destinations/hot-deal2.jpg" alt="Hot Deal">
                        </div>
                        <div class="content">
                            <span class="location"><i class="fal fa-map-marker-alt"></i> Kyoto, Japan</span>
                            <h5><a href="tour-details.html">Japan, Kyoto, travel, and people in Kyoto, Japan by Sorasak</a>
                            </h5>
                        </div>
                        <div class="destination-footer">
                            <span class="price"><span>$58.00</span>/person</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <a href="destination-details.html" class="theme-btn style-three">
                            <span data-hover="Explore">Explore</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="image">
                            <span class="badge">10% Off</span>
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <img src="assets/images/destinations/hot-deal3.jpg" alt="Hot Deal">
                        </div>
                        <div class="content">
                            <span class="location"><i class="fal fa-map-marker-alt"></i> Tamnougalt, Morocco</span>
                            <h5><a href="tour-details.html">Camels on desert under blue sky Morocco, Sahara.</a></h5>
                        </div>
                        <div class="destination-footer">
                            <span class="price"><span>$58.00</span>/person</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <a href="destination-details.html" class="theme-btn style-three">
                            <span data-hover="Explore">Explore</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Hot Deals Area end -->


    <!-- Newsletter Area start -->
    <section class="newsletter-three bgc-primary py-100 rel z-1"
        style="background-image: url(assets/images/newsletter/newsletter-bg-lines.png);">
        <div class="container container-1500">
            <div class="row">
                <div class="col-lg-6">
                    <div class="newsletter-content-part text-white rmb-55" data-aos="zoom-in-right"
                        data-aos-duration="1500" data-aos-offset="50">
                        <div class="section-title counter-text-wrap mb-45">
                            <h2>Subscribe Our Newsletter to Get more offer & Tips</h2>
                            <p>One site <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> most
                                popular experience you’ll remember</p>
                        </div>
                        <form class="newsletter-form mb-15" action="#">
                            <input id="news-email" type="email" placeholder="Email Address" required>
                            <button type="submit" class="theme-btn bgc-secondary style-two">
                                <span data-hover="Subscribe">Subscribe</span>
                                <i class="fal fa-arrow-right"></i>
                            </button>
                        </form>
                        <p>No credit card requirement. No commitments</p>
                    </div>
                    <div class="newsletter-bg-image" data-aos="zoom-in-up" data-aos-delay="100" data-aos-duration="1500"
                        data-aos-offset="50">
                        <img src="assets/images/newsletter/newsletter-bg-image.png" alt="Newsletter">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="newsletter-image-part bgs-cover"
                        style="background-image: url(assets/images/newsletter/newsletter-two-right.jpg);"
                        data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter Area end -->
@endsection
