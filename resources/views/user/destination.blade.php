@extends('layout.master')

@section('content')
    <!-- Page Banner Start -->
    <section class="page-banner-area pt-50 pb-35 rel z-1 bgs-cover"
        style="background-image: url(assets/images/banner/banner3.png);">
        <div class="container">
            <div class="banner-inner text-white mb-50">
                <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">Địa điểm
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200"
                        data-aos-duration="1500" data-aos-offset="50">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Địa điểm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
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

    <!-- Newsletter Area start -->
    <section class="newsletter-three bgc-primary py-100 rel z-1"
        style="background-image: url(assets/images/newsletter/newsletter-bg-lines.png);">
        <div class="container container-1500">
            <div class="row">
                <div class="col-lg-6">
                    <div class="newsletter-content-part text-white rmb-55" data-aos="zoom-in-right"
                        data-aos-duration="1500" data-aos-offset="50">
                        <div class="section-title counter-text-wrap mb-45">
                            <h2>Đăng ký nhận bản tin của chúng tôi để nhận thêm ưu đãi và mẹo hữu ích</h2>
                            <p>Trang web <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> trải nghiệm
                                phổ biến nhất mà bạn sẽ nhớ</p>
                        </div>
                        <form class="newsletter-form mb-15" action="#">
                            <input id="news-email" type="email" placeholder="Địa chỉ Email" required>
                            <button type="submit" class="theme-btn bgc-secondary style-two">
                                <span data-hover="Subscribe">Đăng ký</span>
                                <i class="fal fa-arrow-right"></i>
                            </button>
                        </form>
                        <p>Không yêu cầu thẻ tín dụng. Không cam kết</p>
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
