@extends('layout.master')

@section('content')
    <!-- Page Banner Start -->
    <section class="page-banner-area pt-50 pb-35 rel z-1 bgs-cover"
        style="background-image: url(assets/images/banner/banner4.png);">
        <div class="container">
            <div class="banner-inner text-white">
                <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">Liên hệ</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200"
                        data-aos-duration="1500" data-aos-offset="50">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Liên hệ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->


    <!-- Contact Info Area start -->
    <section class="contact-info-area pt-100 rel z-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="contact-info-content mb-30 rmb-55" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="section-title mb-30">
                            <h2>Trò chuyện với các chuyên gia du lịch</h2>
                        </div>
                        <p>Đội ngũ hỗ trợ tận tâm của chúng tôi luôn sẵn sàng hỗ trợ bạn giải đáp mọi thắc mắc hoặc vấn đề,
                            cung cấp
                            các giải pháp nhanh chóng và được cá nhân hóa để đáp ứng nhu cầu của bạn.</p>
                        <div class="features-team-box mt-40">
                            <h6>85+ Thành viên nhóm chuyên gia</h6>
                            <div class="feature-authors">
                                <img src="assets/images/features/feature-author1.jpg" alt="Author">
                                <img src="assets/images/features/feature-author2.jpg" alt="Author">
                                <img src="assets/images/features/feature-author3.jpg" alt="Author">
                                <img src="assets/images/features/feature-author4.jpg" alt="Author">
                                <img src="assets/images/features/feature-author5.jpg" alt="Author">
                                <img src="assets/images/features/feature-author6.jpg" alt="Author">
                                <img src="assets/images/features/feature-author7.jpg" alt="Author">
                                <span>+</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-info-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"
                                data-aos-delay="50">
                                <div class="icon"><i class="fas fa-envelope"></i></div>
                                <div class="content">
                                    <h5>Cần trợ giúp và hỗ trợ</h5>
                                    <div class="text"><i class="far fa-envelope"></i> <a
                                            href="mailto:ntwohp23@gmail.com">ntwohp23@gmail.com</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-info-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"
                                data-aos-delay="100">
                                <div class="icon"><i class="fas fa-phone"></i></div>
                                <div class="content">
                                    <h5>Cần hỗ trợ ngay</h5>
                                    <div class="text"><i class="far fa-phone"></i> <a
                                            href="callto:+372840125">+372840125</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-info-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"
                                data-aos-delay="50">
                                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="content">
                                    <h5>Chi nhánh Cầu Giấy</h5>
                                    <div class="text"><i class="fal fa-map-marker-alt"></i>Số 2 Cầu Giấy, Láng Thượng,
                                        Đống Đa, Hà Nội</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-info-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"
                                data-aos-delay="100">
                                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="content">
                                    <h5>Trụ sở chính</h5>
                                    <div class="text"><i class="fal fa-map-marker-alt"></i>36 Khúc Thừa Dụ, Dịch Vọng, Cầu
                                        Giấy, Hà Nội</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Info Area end -->


    <!-- Contact Form Area start -->
    <section class="contact-form-area py-70 rel z-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="comment-form bgc-lighter z-1 rel mb-30 rmb-55">
                        @if (session('success'))
                            <div id="message" class="alert alert-success mt-3">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div id="message" class="alert alert-danger mt-3">{{ session('error') }}</div>
                        @endif
                        @if (session('success') || session('error'))
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var formSection = document.getElementById('message');
                                    if (formSection) {
                                        formSection.scrollIntoView({
                                            behavior: 'smooth',
                                            block: 'center'
                                        });
                                    }
                                });
                            </script>
                        @endif
                        <form id="contactForm" class="contactForm" name="contactForm"
                            action="{{ route('create-contact') }}" method="post" data-aos="fade-left"
                            data-aos-duration="1500" data-aos-offset="50">
                            @csrf
                            <div class="section-title">
                                <h2>Liên hệ</h2>
                            </div>
                            <p>Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu <span
                                    style="color: red">*</span></p>
                            <div class="row mt-35">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Họ và tên <span style="color: red">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Họ và tên" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number">Số điện thoại <span style="color: red">*</span></label>
                                        <input type="text" id="phone_number" name="phone_number" class="form-control"
                                            placeholder="Số điện thoại" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Địa chỉ Email <span style="color: red">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            placeholder="Nhập email" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message">Nội dung <span style="color: red">*</span></label>
                                        <textarea name="message" id="message" class="form-control" rows="5" placeholder="Nội dung" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <button type="submit" class="theme-btn style-two">
                                            <span data-hover="Send Comments">Gửi</span>
                                            <i class="fal fa-arrow-right"></i>
                                        </button>
                                        <div id="msgSubmit" class="hidden"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-images-part" data-aos="fade-right" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="row">
                            <div class="col-12">
                                <img src="assets/images/contact/contact1.jpg" alt="Contact">
                            </div>
                            <div class="col-6">
                                <img src="assets/images/contact/contact2.jpg" alt="Contact">
                            </div>
                            <div class="col-6">
                                <img src="assets/images/contact/contact3.jpg" alt="Contact">
                            </div>
                        </div>
                        <div class="circle-logo">
                            <img src="assets/images/logos/logo3.png" alt="Logo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Form Area end -->


    <!-- Contact Map Start -->
    <div class="contact-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1916.5488372154218!2d105.79274601048144!3d21.03363689863466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1748009272625!5m2!1sen!2s"
            style="border:0; width: 100%;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- Contact Map End -->
@endsection
