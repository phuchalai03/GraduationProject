@extends('layout.master')

@section('content')
    <!-- Page Banner Start -->
    <section class="page-banner-two rel z-1">
        <div class="container-fluid">
            <hr class="mt-0">
            <div class="container">
                <div class="banner-inner pt-15 pb-25">
                    <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                        {{ $tourDetail->destination }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200"
                            data-aos-duration="1500" data-aos-offset="50">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->


    <!-- Tour Gallery start -->
    <div class="tour-gallery">
        <div class="container-fluid">
            <div class="row gap-10 justify-content-center rel">
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="{{ asset('storage/images/' . ($tourDetail->images[0] ?? 'thanhhoa1.jpg')) }}"
                            alt="Destination" style="width:100%; height:200px; object-fit:cover; border-radius:10px;">
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('storage/images/' . ($tourDetail->images[1] ?? 'thanhhoa1.jpg')) }}"
                            alt="Destination" style="width:100%; height:200px; object-fit:cover; border-radius:10px;">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="{{ asset('storage/images/' . ($tourDetail->images[2] ?? 'thanhhoa1.jpg')) }}"
                            alt="Destination" style="width:100%; height:410px; object-fit:cover; border-radius:10px;">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="{{ asset('storage/images/' . ($tourDetail->images[3] ?? 'thanhhoa1.jpg')) }}"
                            alt="Destination" style="width:100%; height:200px; object-fit:cover; border-radius:10px;">
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('storage/images/' . ($tourDetail->images[4] ?? 'thanhhoa1.jpg')) }}"
                            alt="Destination" style="width:100%; height:200px; object-fit:cover; border-radius:10px;">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="gallery-more-btn">
                        <a href="contact.html" class="theme-btn style-two bgc-secondary">
                            <span data-hover="See All Photos">Xem tất cả</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tour Gallery End -->


    <!-- Tour Header Area start -->
    <section class="tour-header-area pt-70 rel z-1">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-lg-7">
                    <div class="tour-header-content mb-15" data-aos="fade-left" data-aos-duration="1500"
                        data-aos-offset="50">
                        <span class="location d-inline-block mb-10"><i class="fal fa-map-marker-alt"></i>
                            {{ $tourDetail->destination }}</span>
                        <div class="section-title pb-5">
                            <h2>{{ $tourDetail->title }}</h2>
                        </div>
                        <div class="ratting">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($avgStar && $i < $avgStar)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 text-lg-end" data-aos="fade-right" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="tour-header-social mb-10">
                        <a href="#"><i class="far fa-share-alt"></i>Share tours</a>
                        <a href="#"><i class="fas fa-heart bgc-secondary"></i>Wish list</a>
                    </div>
                </div>
            </div>
            <hr class="mt-50 mb-70">
        </div>
    </section>
    <!-- Tour Header Area end -->


    <!-- Tour Details Area start -->
    <section class="tour-details-page pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="tour-details-content">
                        <h3>Khám phá tour</h3>
                        <p>{!! $tourDetail->description !!}</p>
                        
                    </div>

                    <h3>Lịch trình</h3>
                    <div class="accordion-two mt-25 mb-60" id="faq-accordion-two">
                        @php
                            $day = 1;
                        @endphp
                        @foreach ($tourDetail->timeline as $timeline)
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo{{ $timeline->timelineId }}">
                                        Ngày {{ $day++ }}
                                    </button>
                                </h5>
                                <div id="collapseTwo{{ $timeline->timelineId }}" class="accordion-collapse collapse"
                                    data-bs-parent="#faq-accordion-two">
                                    <div class="accordion-body">
                                        <p>{!! $timeline->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <h3>Bản đồ</h3>
                    <div class="tour-map mt-30 mb-50">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54655.39647930672!2d108.20356591256284!3d16.05052611161243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219c792252a13%3A0x1df0cb4b86727e06!2zxJDDoCBO4bq1bmcsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1747729058421!5m2!1svi!2s"
                         width="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                    <h3>Đánh giá của khách hàng</h3>
                    <div id="partials_reviews">
                        @include('user.reviews')
                    </div>


                    <h3 class="{{ $checkDisplay }}">Thêm Đánh giá</h3>
                    <form id="comment-form" class="comment-form bgc-lighter z-1 rel mt-30 {{ $checkDisplay }}"
                        name="review-form" action="{{ route('reviews') }}" method="POST" data-aos="fade-up"
                        data-aos-duration="1500" data-aos-offset="50">
                        @csrf
                        <div class="comment-review-wrap">
                            <div class="comment-ratting-item">
                                <span class="title">Đánh giá</span>
                                <div class="ratting" id="rating-stars">
                                    <i class="far fa-star" data-value="1"></i>
                                    <i class="far fa-star" data-value="2"></i>
                                    <i class="far fa-star" data-value="3"></i>
                                    <i class="far fa-star" data-value="4"></i>
                                    <i class="far fa-star" data-value="5"></i>
                                </div>
                            </div>

                        </div>
                        <hr class="mt-30 mb-40">
                        <h5>Để lại phản hồi</h5>
                        <div class="row gap-20 mt-20">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Nội dung</label>
                                    <textarea name="message" id="message" class="form-control" rows="5" required=""></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <button type="submit" class="theme-btn bgc-secondary style-two" id="submit-reviews"
                                        data-url-checkBooking="{{ route('checkBooking') }}"
                                        data-tourId-reviews="{{ $tourDetail->tourId }}">
                                        <span data-hover="Gửi đánh giá">Gửi đánh giá</span>
                                        <i class="fal fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-lg-4 col-md-8 col-sm-10 rmt-75">
                    <div class="blog-sidebar tour-sidebar">

                        <div class="widget widget-booking" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <h5 class="widget-title">Tour Booking</h5>
                            <form action="{{ route('booking', ['id' => $tourDetail->tourId]) }}" method="POST">
                                @csrf
                                <div class="date mb-25">
                                    <b>Ngày bắt đầu</b>
                                    <input type="text" value="{{ date('d-m-Y', strtotime($tourDetail->startDate)) }}"
                                        name="startdate" disabled>
                                </div>
                                <div class="date mb-25">
                                    <b>Ngày kết thúc</b>
                                    <input type="text" value="{{ date('d-m-Y', strtotime($tourDetail->endDate)) }}"
                                        name="enddate" disabled>
                                </div>
                                <hr>
                                <div class="time py-5">
                                    <b>Thời Gian :</b> {{ $tourDetail->duration }}
                                </div>
                                <hr class="mb-25">
                                <h6>Vé:</h6>
                                <ul class="tickets clearfix">
                                    <li>
                                        Trẻ em<span
                                            class="price">{{ number_format($tourDetail->priceChild, 0, ',', '.') }}VND</span>
                                    </li>
                                    <li>
                                        Người lớn<span
                                            class="price">{{ number_format($tourDetail->priceAdult, 0, ',', '.') }}VND</span>
                                    </li>
                                    <hr>
                                    <button type="submit" class="theme-btn style-two w-100 mt-15 mb-5">
                                        <span data-hover="Book Now">Đặt ngay</span>
                                        <i class="fal fa-arrow-right"></i>
                                    </button>
                                    <div class="text-center">
                                        <a href="{{ route('contact.index') }}">Cần trợ giúp?</a>
                                    </div>
                            </form>
                        </div>

                        <div class="widget widget-contact" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <h5 class="widget-title">Cần trợ giúp?</h5>
                            <ul class="list-style-one">
                                <li><i class="far fa-envelope"></i> <a
                                        href="emilto:ntwohp23@gmail.com">ntwohp23@gmail.com</a></li>
                                <li><i class="far fa-phone-volume"></i> <a href="callto:+000(123)45688">+000 (123) 456
                                        88</a></li>
                            </ul>
                        </div>

                        @if (!empty($tourRecommendations))
                            <div class="widget widget-tour" data-aos="fade-up" data-aos-duration="1500"
                                data-aos-offset="50">
                                <h6 class="widget-title">Tours tương tự</h6>
                                @foreach ($tourRecommendations as $tour)
                                    <div class="destination-item tour-grid style-three bgc-lighter">
                                        <div class="image">
                                            {{-- <span class="badge">10% Off</span> --}}
                                            <img src="{{ asset('storage/images/' . $tour->images[0]) }}"
                                                alt="Tour" style="max-height: 137px">
                                        </div>
                                        <div class="content">
                                            <div class="destination-header">
                                                <span class="location"><i class="fal fa-map-marker-alt"></i>
                                                    {{ $tour->destination }}</span>
                                                <div class="ratting">
                                                    <i class="fas fa-star"></i>
                                                    <span>({{ $tour->rating }})</span>
                                                </div>
                                            </div>
                                            <h6><a
                                                    href="{{ route('tour-detail', ['id' => $tour->tourId]) }}">{{ $tour->title }}</a>
                                            </h6>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Tour Details Area end -->
@endsection
