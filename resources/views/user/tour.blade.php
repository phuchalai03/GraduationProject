@extends('layout.master')

@section('content')
    <!-- Hidden Sidebar -->
    <section class="hidden-bar">
        <div class="inner-box text-center">
            <div class="cross-icon"><span class="fa fa-times"></span></div>
            <div class="title">
                <h4>Get Appointment</h4>
            </div>

            <!--Appointment Form-->
            <div class="appointment-form">
                <form method="post" action="https://webtendtheme.net/html/2024/ravelo/contact.html">
                    <div class="form-group">
                        <input type="text" name="text" value="" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" value="" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Message" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="theme-btn style-two">
                            <span data-hover="Submit now">Submit now</span>
                            <i class="fal fa-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!--Social Icons-->
            <div class="social-style-one">
                <a href="contact.html"><i class="fab fa-twitter"></i></a>
                <a href="contact.html"><i class="fab fa-facebook-f"></i></a>
                <a href="contact.html"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-pinterest-p"></i></a>
            </div>
        </div>
    </section>
    <!--End Hidden Sidebar -->


    <!-- Page Banner Start -->
    <section class="page-banner-area pt-50 pb-35 rel z-1 bgs-cover"
        style="background-image: url(assets/images/banner/banner.jpg);">
        <div class="container">
            <div class="banner-inner text-white mb-50">
                <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">Tour Grid
                    View</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200"
                        data-aos-duration="1500" data-aos-offset="50">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Tour Grid</li>
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


    <!-- Tour Grid Area start -->
    <section class="tour-grid-page py-100 rel z-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-10 rmb-75">
                    <div class="shop-sidebar">
                        <div class="widget widget-filter" data-aos="fade-up" data-aos-delay="50"
                            data-aos-duration="1500" data-aos-offset="50">
                            <h6 class="widget-title">Filter by Price</h6>
                            <div class="price-filter-wrap">
                                <div class="price-filter-wrap">
                                    <div class="price">
                                        <span>Price: </span>
                                        <input type="number" id="min_price" placeholder="Min price"
                                            style="width: 80px; color:#f6931f;">
                                        <span> - </span>
                                        <input type="number" id="max_price" placeholder="Max price"
                                            style="width: 80px; color:#f6931f;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget widget-activity" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <h6 class="widget-title">Điểm đến</h6>
                            <ul class="radio-filter">
                                <li>
                                    <input class="form-check-input" type="radio" name="domain" id="id_mien_bac"
                                        value="b">
                                    <label for="activity1">Miền Bắc <span> {{ $domain_count['mien_bac'] }} </span></label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="domain" id="id_mien_trung"
                                        value="t">
                                    <label for="activity2">Miền Trung <span> {{ $domain_count['mien_trung'] }}
                                        </span></label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="domain" id="id_mien_nam"
                                        value="n">
                                    <label for="activity3">Miền Nam <span> {{ $domain_count['mien_nam'] }} </span></label>
                                </li>
                            </ul>
                        </div>

                        <div class="widget widget-reviews" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <h6 class="widget-title">By Reviews</h6>
                            <ul class="radio-filter">
                                <li>
                                    <input class="form-check-input" type="radio" name="star" id="5star"
                                        value="5">
                                    <label for="5star">
                                        <span class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="star" id="4star"
                                        value="4">
                                    <label for="4star">
                                        <span class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt white"></i>
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="star" id="3star"
                                        value="3">
                                    <label for="3star">
                                        <span class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star white"></i>
                                            <i class="fas fa-star-half-alt white"></i>
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="star" id="2star"
                                        value="2">
                                    <label for="2star">
                                        <span class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star white"></i>
                                            <i class="fas fa-star white"></i>
                                            <i class="fas fa-star-half-alt white"></i>
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="star" id="1star"
                                        value="1">
                                    <label for="1star">
                                        <span class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star white"></i>
                                            <i class="fas fa-star white"></i>
                                            <i class="fas fa-star white"></i>
                                            <i class="fas fa-star-half-alt white"></i>
                                        </span>
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <div class="widget widget-duration" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <h6 class="widget-title">Duration</h6>
                            <ul class="radio-filter">
                                <li>
                                    <input class="form-check-input" type="radio" name="duration" id="duration1"
                                        value="2n1d">
                                    <label for="duration1">2 ngày 1 đêm</label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="duration" id="duration2"
                                        value="3n2d">
                                    <label for="duration2">3 ngày 2 đêm</label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="radio" name="duration" id="duration3"
                                        value="3n">
                                    <label for="duration3">3 ngày</label>
                                </li>
                            </ul>
                        </div>

                        {{-- <div class="widget widget-tour" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <h6 class="widget-title">Popular Tours</h6>
                            <div class="destination-item tour-grid style-three bgc-lighter">
                                <div class="image">
                                    <span class="badge">10% Off</span>
                                    <img src="assets/images/widgets/tour1.jpg" alt="Tour">
                                </div>
                                <div class="content">
                                    <div class="destination-header">
                                        <span class="location"><i class="fal fa-map-marker-alt"></i> Bali,
                                            Indonesia</span>
                                        <div class="ratting">
                                            <i class="fas fa-star"></i>
                                            <span>(4.8)</span>
                                        </div>
                                    </div>
                                    <h6><a href="tour-details.html">Relinking Beach, Bali, Indonesia</a></h6>
                                </div>
                            </div>
                            <div class="destination-item tour-grid style-three bgc-lighter">
                                <div class="image">
                                    <img src="assets/images/widgets/tour1.jpg" alt="Tour">
                                </div>
                                <div class="content">
                                    <div class="destination-header">
                                        <span class="location"><i class="fal fa-map-marker-alt"></i> Bali,
                                            Indonesia</span>
                                        <div class="ratting">
                                            <i class="fas fa-star"></i>
                                            <span>(4.8)</span>
                                        </div>
                                    </div>
                                    <h6><a href="tour-details.html">Relinking Beach, Bali, Indonesia</a></h6>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    {{-- <div class="widget widget-cta mt-30" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="content text-white">
                            <span class="h6">Explore The World</span>
                            <h3>Best Tourist Place</h3>
                            <a href="tour-list.html" class="theme-btn style-two bgc-secondary">
                                <span data-hover="Explore Now">Explore Now</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="image">
                            <img src="assets/images/widgets/cta-widget.png" alt="CTA">
                        </div>
                        <div class="cta-shape"><img src="assets/images/widgets/cta-shape2.png" alt="Shape"></div>
                    </div> --}}
                </div>

                {{-- Main --}}
                <div class="col-lg-9">
                    <div class="shop-shorter rel z-3 mb-20">
                        <ul class="grid-list mb-15 me-2">
                            <li><a href="#"><i class="fal fa-border-all"></i></a></li>
                            <li><a href="#"><i class="far fa-list"></i></a></li>
                        </ul>
                        <div class="sort-text mb-15 me-4 me-xl-auto">
                            34 Tours found
                        </div>
                        <div class="sort-text mb-15 me-4">
                            Sort By
                        </div>
                        <select>
                            <option value="default" selected="">Short By</option>
                            <option value="new">Newness</option>
                            <option value="old">Oldest</option>
                            <option value="hight-to-low">High To Low</option>
                            <option value="low-to-high">Low To High</option>
                        </select>
                    </div>

                    <div class="tour-grid-wrap">
                        <div class="row" id="tours-container">
                            @foreach ($tours as $tour)
                                <div class="col-xl-4 col-md-6">
                                    <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up"
                                        data-aos-duration="1500" data-aos-offset="50">
                                        <div class="image">
                                            {{-- <span class="badge bgc-pink">Featured</span> --}}
                                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                            <img src="{{ asset('storage/images/' . ($tour->images[0] ?? 'images/default.jpg')) }}"
                                                alt="Tour List"
                                                style="width: 100%; height: 250px; object-fit: cover; object-position: center; border-radius: 10px;">
                                        </div>
                                        <div class="content">
                                            <div class="destination-header">
                                                <span class="location"><i class="fal fa-map-marker-alt"></i>
                                                    {{ $tour->destination }}</span>
                                                <div class="ratting">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>
                                            <h6><a href="{{ route('tour_detail', ['id' => $tour->tourId]) }}">
                                                    {{ $tour->title }} </a></h6>
                                            <ul class="blog-meta">
                                                <li><i class="far fa-clock"></i> {{ $tour->description }}</li>
                                                <li><i class="far fa-user"></i> {{ $tour->quantity }} guest</li>
                                            </ul>
                                            <div class="destination-footer">
                                                <span
                                                    class="price"><span>{{ number_format($tour->priceAdult, 0, ',', '.') }}</span>/Người</span>
                                                <a href="{{ route('tour_detail', ['id' => $tour->tourId]) }}"
                                                    class="theme-btn style-two style-three">
                                                    <i class="fal fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-lg-12">
                                <ul class="pagination justify-content-center pt-15 flex-wrap" data-aos="fade-up"
                                    data-aos-duration="1500" data-aos-offset="50">
                                    <li class="page-item disabled">
                                        <span class="page-link"><i class="far fa-chevron-left"></i></span>
                                    </li>
                                    <li class="page-item active">
                                        <span class="page-link">
                                            1
                                            <span class="sr-only">(current)</span>
                                        </span>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="far fa-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Tour Grid Area end -->


    <!-- Newsletter Area start -->
    <section class="newsletter-three bgc-primary py-100 rel z-1"
        style="background-image: url({{ asset('assets/images/newsletter/newsletter-bg-lines.png') }});">
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
                        <img src="{{ asset('assets/images/newsletter/newsletter-bg-image.png') }}" alt="Newsletter">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="newsletter-image-part bgs-cover"
                        style="background-image: url({{ asset('assets/images/newsletter/newsletter-two-right.jpg') }});"
                        data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter Area end -->
@endsection
