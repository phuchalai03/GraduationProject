@extends('layout.master_home')

@section('content')
    <!--Form Back Drop-->
    <div class="form-back-drop"></div>

    <!-- Hidden Sidebar -->
    <section class="hidden-bar">
        <div class="inner-box text-center">
            <div class="cross-icon"><span class="fa fa-times"></span></div>
            <div class="title">
                <h4>Get Appointment</h4>
            </div>

            <!--Appointment Form-->
            <div class="appointment-form">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
        </div>
    </section>
    <!--End Hidden Sidebar -->

    <!-- Destinations Area start -->
    <section class="destinations-area bgc-black pt-100 pb-70 rel z-1">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-white text-center counter-text-wrap mb-70" data-aos="fade-up"
                        data-aos-duration="1500" data-aos-offset="50">
                        <h2>Khám phá các điểm đến tuyệt vời với Travelday</h2>
                        <p>Một trang web với <span class="count-text plus" data-speed="1000" data-stop="2300">0</span> trải
                            nghiệm đáng nhớ từ người dùng!</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($toursPopular as $tour)
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <div class="destination-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                <div class="ratting"><i class="fas fa-star"></i> {{ number_format($tour->rating, 1) }}</div>
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{ asset('storage/images/' . ($tour->images[0] ?? 'images/default.jpg')) }}"
                                    alt="Destination" style="width: 100%; height: 280px; object-fit: cover;">
                            </div>
                            <div class="content">
                                <span class="location">
                                    <i class="fal fa-map-marker-alt"></i> {{ $tour->destination ?? 'Unknown Location' }}
                                </span>
                                <h5>
                                    <a href="{{ route('tour_detail', ['id' => $tour->tourId]) }}"
                                        style="display:inline-block; max-width:100%; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                        {{ $tour->title ?? 'Tour Title' }}
                                    </a>
                                </h5>
                                <span class="time"> {{ $tour->duration }} </span>
                            </div>
                            <div class="destination-footer" style="display: block;">
                                <span class="price">
                                    <span>{{ number_format($tour->priceAdult, 0, ',', '.') }}</span>VND / Người
                                </span>
                                <a href="{{ route('tour_detail', ['id' => $tour->tourId]) }}" class="read-more">Book Now <i
                                        class="fal fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Destinations Area end -->


    <!-- About Us Area start -->
    <section class="about-us-area py-100 rpb-90 rel z-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="about-us-content rmb-55" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                        <div class="section-title mb-25">
                            <h2>Du lịch với sự tự tin Lý do hàng đầu để chọn công ty chúng tôi</h2>
                        </div>
                        <p>Chúng tôi sẽ nỗ lực hết mình để biến giấc mơ du lịch của bạn thành hiện thực, những viên ngọc ẩn
                            và những điểm tham quan không thể bỏ qua
                        </p>
                        <div class="divider counter-text-wrap mt-45 mb-55"><span>Chúng tôi có <span><span
                                        class="count-text plus" data-speed="3000" data-stop="25">0</span> năm</span> kinh
                                nghiệm</span></div>
                        <div class="row">
                            <div class="col-6">
                                <div class="counter-item counter-text-wrap">
                                    <span class="count-text k-plus" data-speed="3000" data-stop="3">0</span>
                                    <span class="counter-title">Địa điểm phổ biến</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="counter-item counter-text-wrap">
                                    <span class="count-text m-plus" data-speed="3000" data-stop="9">0</span>
                                    <span class="counter-title">Khách hàng hài lòng</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('destination.index') }}" class="theme-btn mt-10 style-two">
                            <span data-hover="Explore Destinations">Khám phá các điểm đến</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                    <div class="about-us-image">
                        <div class="shape"><img src="assets/images/about/shape1.png" alt="Shape"></div>
                        <div class="shape"><img src="assets/images/about/shape2.png" alt="Shape"></div>
                        <div class="shape"><img src="assets/images/about/shape3.png" alt="Shape"></div>
                        <div class="shape"><img src="assets/images/about/shape4.png" alt="Shape"></div>
                        <div class="shape"><img src="assets/images/about/shape5.png" alt="Shape"></div>
                        <div class="shape"><img src="assets/images/about/shape6.png" alt="Shape"></div>
                        <div class="shape"><img src="assets/images/about/shape7.png" alt="Shape"></div>
                        <img src="assets/images/about/about.png" alt="About">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Area end -->


    <!-- Popular Destinations Area start -->
    <section class="popular-destinations-area rel z-1">
        <div class="container-fluid">
            <div class="popular-destinations-wrap br-20 bgc-lighter pt-100 pb-70">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center counter-text-wrap mb-70" data-aos="fade-up"
                            data-aos-duration="1500" data-aos-offset="50">
                            <h2>Khám phá các điểm đến thú vị</h2>
                            <p>Trên trang web với hơn <span class="count-text plus" data-speed="300"
                                    data-stop="3450">0</span> trải nghiệm</p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        @php $count = 0; @endphp
                        @foreach ($tours as $tour)
                            @if ($count == 2 || $count == 3)
                                <!-- Cột thứ 3 và thứ 4 sẽ là col-md-6 -->
                                <div class="col-md-6 item ">
                                @else
                                    <!-- Các cột còn lại sẽ là col-xl-3 col-md-6 -->
                                    <div class="col-xl-3 col-md-6 item ">
                            @endif

                            <div class="destination-item style-two" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image" style="max-height: 250px">
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="{{ asset('storage/images/' . $tour->images->first()) }}" alt="Destination"
                                        style="width: 100%; height: 230px; object-fit: cover;">
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

                    </div> <!-- Đóng div col-md-6 hoặc col-xl-3 col-md-6 -->

                    @php $count++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Popular Destinations Area end -->


    <!-- Features Area start -->
    <section class="features-area pt-100 pb-45 rel z-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <div class="features-content-part mb-55" data-aos="fade-left" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="section-title mb-60">
                            <h2>Trải nghiệm du lịch tuyệt đỉnh mang đến sự khác biệt cho công ty chúng tôi</h2>
                        </div>
                        <div class="features-customer-box">
                            <div class="image">
                                <img src="assets/images/features/features-box.jpg" alt="Features">
                            </div>
                            <div class="content">
                                <div class="feature-authors mb-15">
                                    <img src="assets/images/features/feature-author1.jpg" alt="Author">
                                    <img src="assets/images/features/feature-author2.jpg" alt="Author">
                                    <img src="assets/images/features/feature-author3.jpg" alt="Author">
                                    <span>4k+</span>
                                </div>
                                <h6>850K+ Khách hàng hài lòng</h6>
                                <div class="divider style-two counter-text-wrap my-25"><span><span class="count-text plus"
                                            data-speed="3000" data-stop="5">0</span>
                                        Năm</span></div>
                                <p>Chúng tôi tự hào cung cấp các hành trình được cá nhân hóa</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                    <div class="row pb-25">
                        <div class="col-md-6">
                            <div class="feature-item">
                                <div class="icon"><i class="flaticon-tent"></i></div>
                                <div class="content">
                                    <h5><a href="{{ route('tour.index') }}">Chinh Phục Cảnh Quan Việt Nam</a></h5>
                                    <p>Khám phá những cảnh đẹp hùng vĩ và tuyệt vời của đất nước Việt Nam.</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="icon"><i class="flaticon-tent"></i></div>
                                <div class="content">
                                    <h5><a href="{{ route('tour.index') }}">Trải Nghiệm Đặc Sắc Việt Nam</a></h5>
                                    <p>Trải nghiệm những hoạt động và lễ hội đặc trưng của văn hóa Việt.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-item mt-20">
                                <div class="icon"><i class="flaticon-tent"></i></div>
                                <div class="content">
                                    <h5><a href="{{ route('tour.index') }}">Khám Phá Di Sản Việt Nam</a></h5>
                                    <p>Khám phá các di sản thế giới và những kỳ quan thiên nhiên nổi tiếng.</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="icon"><i class="flaticon-tent"></i></div>
                                <div class="content">
                                    <h5><a href="{{ route('tour.index') }}">Vẻ Đẹp Thiên Nhiên Việt </a></h5>
                                    <p>Chinh phục vẻ đẹp tự nhiên hoang sơ và kỳ vĩ của Việt Nam.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features Area end -->

    <!-- CTA Area start -->
    <section class="cta-area pt-100 rel z-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-duration="1500" data-aos-offset="50">
                    <div class="cta-item"
                        style="background-image: url( {{ asset('storage/images/home/home1.png') }});">
                        <span class="category">Khám Phá Vẻ Đẹp Văn Hóa Việt</span>
                        <h2>Tìm hiểu những giá trị văn hóa độc đáo của các vùng miền Việt Nam.</h2>
                        <a href="{{ route('tour.index') }}" class="theme-btn style-two bgc-secondary">
                            <span data-hover="Khám phá">Khám phá</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="50" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="cta-item"
                        style="background-image: url( {{ asset('storage/images/home/home2.png') }});">
                        <span class="category">Bãi biển Sea</span>
                        <h2>Bãi trong xanh dạt dào ở Việt Nam</h2>
                        <a href="{{ route('tour.index') }}" class="theme-btn style-two">
                            <span data-hover="Khám phá">Khám phá</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="100" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="cta-item"
                        style="background-image: url( {{ asset('storage/images/home/home3.png') }});">
                        <span class="category">Thác nước</span>
                        <h2>Thác nước lớn nhất Việt Nam</h2>
                        <a href="{{ route('tour.index') }}" class="theme-btn style-two bgc-secondary">
                            <span data-hover="Khám phá">Khám phá</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CTA Area end -->
@endsection
