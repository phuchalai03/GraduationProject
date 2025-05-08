$(document).ready(function() {

    var lastChecked = null;
    $('input[type="radio"]').on('click', function() {
        if (lastChecked && lastChecked === this) {
            $(this).prop('checked', false); 
            lastChecked = null;
        } else {
            lastChecked = this;
        }
        filterTours();
    });

    $('#min_price').on('change', filterTours);
    $('#max_price').on('change', filterTours);
    $('input[name="domain"]').on('change', filterTours);
    $('input[name="star"]').on('change', filterTours);
    $('input[name="duration"]').on('change', filterTours);
    $('input[type="checkbox"]').on('change', function() {
        filterTours();
    });

    $('#sorting_tours').on('change', function () {
        filterTours($(this).val()); 
    });

    function filterTours(sorting = 'default'){
        var min_price = $('#min_price').val();
        var max_price = $('#max_price').val();
        var domain = $('input[name="domain"]:checked').val();
        var star = $('input[name="star"]:checked').val();
        var duration = $('input[name="duration"]:checked').val();
        var sorting = $('#sorting_tours').val();
        formDataFilter = { 
            'min_price': min_price,
            'max_price': max_price,
            'domain': domain,
            'star': star,
            'duration': duration,
            'sorting': sorting,
        };

        $.ajax({
            url: filterToursUrl,
            method: 'GET',
            data: formDataFilter,
            success: function(res) {
                $("#tours-container").html(res);
                $('#tours-container .destination-item').addClass('aos-animate');
                $("#tours-container .pagination-tours").addClass("aos-animate");
            }
        });
    }

    $(document).on("click", ".pagination-tours a", function (e) {
        e.preventDefault();
        $("#tours-container").addClass("hidden-content");

        var url = $(this).attr("href");
        console.log(url);

        $.ajax({
            url: url,
            method: 'GET',
            data: formDataFilter,
            success: function(res) {
                $("#tours-container").html(res);
                $('#tours-container .destination-item').addClass('aos-animate');
                $("#tours-container .pagination-tours").addClass("aos-animate");
            },
            error: function (xhr, status, error) {
                console.log("Có lỗi xảy ra trong quá trình tải dữ liệu!");
            },
        });
    });

    //Update user profile
    $('.updateUser').on('submit', function(e) {
        e.preventDefault();
        var fullName = $('#inputFullName').val();
        var address = $('#inputLocation').val();
        var email = $('#inputEmailAddress').val();
        var phone = $('#inputPhone').val();

        var dataUpdate = {
            'fullName': fullName,
            'address': address,
            'email': email,
            'phone': phone,
            '_token': $('input[name="_token"]').val(),
        }
        console.log(dataUpdate);
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: dataUpdate,
            success: function(response) {
                alert(response.message);
                console.log(response.message);
            },
            error: function(xhr, status, error) {
                alert("Có lỗi xảy ra!");
            }
        });
    });

    $('#update_password_profile').click(function() {
        $("#card_change_password").toggle();
    });

    $('.change_password_profile').on('submit', function(e) {
        e.preventDefault();
        var oldPass = $('#inputOldPass').val();
        var newPass = $('#inputNewPass').val();

        var updatePass = {
            'oldPass': oldPass,
            'newPass': newPass,
            '_token': $('input[name="_token"]').val(),
        }
        console.log(updatePass);
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: updatePass,
            success: function(response) {
                alert(response.message);
                console.log(response.message);
            },
            error: function(xhr, status, error) {
                alert("Có lỗi xảy ra!");
            }
        });
    });

    //update avatar
    $("#avatar").on("change", function () {
        const file = event.target.files[0];

        if (file) {
            // Hiển thị ảnh vừa chọn trước khi gửi lên server
            const reader = new FileReader();
            reader.onload = function (e) {
                $("#avatarPreview").attr("src", e.target.result);
                $(".img-account-profile").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
            var __token = $(this)
                .closest(".card-body")
                .find("input.__token")
                .val();
            var url_avatar = $(this)
                .closest(".card-body")
                .find("input.label_avatar")
                .val();
            // Tạo FormData để gửi file qua AJAX
            const formData = new FormData();
            formData.append("avatar", file);

            console.log(url_avatar);

            // // Gửi AJAX đến server
            $.ajax({
                url: url_avatar,
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": __token,
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
                },
            });
        }
    });

    let discount = 0;
    let totalPrice = 0;

    function updateSummary() {
        const numAdults = parseInt($("#numAdults").val());
        const numChildren = parseInt($("#numChildren").val());

        const adultPrice = parseInt($("#numAdults").data("price-adults"));
        const childPrice = parseInt($("#numChildren").data("price-children"));

        const adultsTotal = numAdults * adultPrice;
        const childrenTotal = numChildren * childPrice;

        $(".quantity__adults").text(numAdults);
        $(".quantity__children").text(numChildren);
        $(".summary-item:nth-child(1) .total-price").text(
            adultPrice.toLocaleString() + " VNĐ"
        );
        $(".summary-item:nth-child(2) .total-price").text(
            childPrice.toLocaleString() + " VNĐ"
        );

        // Tính tổng giá trị
        totalPrice = adultsTotal + childrenTotal - discount;
        $(".summary-item.total-price span:last").text(
            totalPrice.toLocaleString() + " VNĐ"
        );

        $(".totalPrice").val(totalPrice);
    }

    // Sự kiện tăng/giảm số lượng người lớn và trẻ em
    $(".quantity-selector").on("click", ".quantity-btn", function () {
        const input = $(this).siblings("input");
        const min = parseInt(input.attr("min"));
        let value = parseInt(input.val());
        const quantityAvailable = parseInt(
            $(".quantityAvailable").text().match(/\d+/)[0]
        );

        const totalAdults = parseInt($("#numAdults").val());
        const totalChildren = parseInt($("#numChildren").val());

        // Kiểm tra nút tăng hay giảm
        if ($(this).text() === "+") {   
            // Kiểm tra nếu đang tăng số lượng người lớn
            if (input.attr("id") === "numAdults") {
                // Kiểm tra nếu tổng số người lớn và trẻ em không vượt quá số chỗ còn nhận
                if (totalAdults + totalChildren < quantityAvailable) {
                    value++;
                } else {
                    alert(
                        "Không thể thêm số người lớn vượt quá số chỗ còn nhận!"
                    );
                }
            }
            // Kiểm tra nếu đang tăng số lượng trẻ em
            else if (input.attr("id") === "numChildren") {
                // Kiểm tra nếu tổng số người lớn và trẻ em không vượt quá số chỗ còn nhận
                if (totalAdults + totalChildren < quantityAvailable) {
                    value++;
                } else {
                    alert(
                        "Không thể thêm số trẻ em vượt quá số chỗ còn nhận!"
                    ); // Thông báo nếu vượt quá
                }
            }
        } else if (value > min) {
            value--;
        }

        // Cập nhật số lượng vào input
        input.val(value);

        // Cập nhật lại tổng giá
        updateSummary();
    });

    // Áp dụng mã giảm giá
    $(".btn-coupon").on("click", function (e) {
        e.preventDefault();
        const couponCode = $(".order-coupon input").val();

        // Giả sử mã giảm giá là "DISCOUNT10" giảm 10%
        if (couponCode === "DISCOUNT10") {
            discount =
                0.1 *
                (parseInt($("#numAdults").val()) *
                    $("#numAdults").data("price-adults") +
                    parseInt($("#numChildren").val()) *
                        $("#numChildren").data("price-children"));
            alert("Áp dụng mã giảm giá thành công!");
        } else {
            discount = 0;
            alert("Mã giảm giá không hợp lệ!");
        }

        $(".summary-item:nth-child(3) .total-price").text(
            discount.toLocaleString() + " VNĐ"
        );
        updateSummary();
    });

    // Sự kiện khi thay đổi trạng thái checkbox
    $("#agree").on("change", function () {
        toggleButtonState();
    });

    // Hàm thay đổi trạng thái của nút
    function toggleButtonState() {
        if ($("#agree").is(":checked")) {
            $(".btn-submit-booking")
                .removeClass("inactive")
                .css("pointer-events", "auto");
        } else {
            $(".btn-submit-booking")
                .addClass("inactive")
                .css("pointer-events", "none");
        }
    }

    function validateBookingForm() {
        let isValid = true;

        // Xóa thông báo lỗi cũ
        $(".error-message").hide();

        // Kiểm tra họ và tên (không được để trống)
        const username = $("#username").val().trim();
        if (username === "") {
            $("#usernameError").text("Họ và tên không được để trống").show();
            isValid = false;
        }

        // Kiểm tra email (phải đúng định dạng email)
        const email = $("#email").val().trim();
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
        if (email === "") {
            $("#emailError").text("Email không được để trống").show();
            isValid = false;
        } else if (!emailPattern.test(email)) {
            $("#emailError").text("Email không đúng định dạng").show();
            isValid = false;
        }

        // Kiểm tra số điện thoại (phải là số và từ 10-11 ký tự)
        const tel = $("#tel").val().trim();
        const telPattern = /^[0-9]{10,11}$/;
        if (tel === "") {
            $("#telError").text("Số điện thoại không được để trống").show();
            isValid = false;
        } else if (!telPattern.test(tel)) {
            $("#telError").text("Số điện thoại phải có 10-11 chữ số").show();
            isValid = false;
        }

        // Kiểm tra địa chỉ (không được để trống)
        const address = $("#address").val().trim();
        if (address === "") {
            $("#addressError").text("Địa chỉ không được để trống").show();
            isValid = false;
        }

        const paymentMethod = $("input[name='payment']:checked").val();
        if (!paymentMethod) {
            alert("Vui lòng chọn phương thức thanh toán.");
            isValid = false;
        }
        return isValid; // Trả về kết quả kiểm tra
    }
    // Kiểm tra tính hợp lệ khi nhấn nút submit
    $(".btn-submit-booking").on("click", function (e) {
        e.preventDefault();

        // Nếu tất cả đều hợp lệ, gửi form
        if (validateBookingForm()) {
            $(".booking-container").submit();
        }
    });

    // Hàm kiểm tra giá trị lựa chọn thanh toán
    $('input[name="payment"]').change(function () {
        const paymentMethod = $(this).val();
        $("#payment_hidden").val(paymentMethod);
        const isPaymentSelected =
            paymentMethod === "paypal-payment" ||
            paymentMethod === "momo-payment";

        $(".btn-submit-booking").toggle(!isPaymentSelected); // Ẩn hoặc hiện nút xác nhận
        if (paymentMethod === "paypal-payment") {
            var totalPricePayment = totalPrice / 25000; //switch to USD
            paypal
                .Buttons({
                    createOrder: function (data, actions) {
                        return actions.order.create({
                            purchase_units: [
                                {
                                    amount: {
                                        value: totalPricePayment.toFixed(2), // Số tiền thanh toán
                                    },
                                },
                            ],
                        });
                    },
                    onApprove: function (data, actions) {
                        return actions.order.capture().then(function (details) {
                            // Hiển thị thông tin thanh toán thành công
                            console.log(
                                "Transaction completed by " +
                                    details.payer.name.given_name
                            );
                            // Tạo input hidden mới
                            var hiddenInput = $("<input>", {
                                type: "hidden", // Loại input là hidden
                                name: "transactionIdPaypal", // Tên của input
                                value: details.id, // Giá trị là transactionId
                            });

                            // Thêm input hidden vào form
                            $('input[name="payment"]:checked')
                                .closest("form")
                                .append(hiddenInput);
                            alert("Thanh toán thành công!");
                            $("#paypal-button-container").hide(); // Ẩn nút PayPal

                            // Vô hiệu hóa tất cả các radio button
                            $('input[name="payment"]').prop("disabled", true);

                            $(".btn-submit-booking").show(); // Hiện nút xác nhận
                        });
                    },
                    onError: function (err) {
                        console.error(err);
                        alert(
                            "Có lỗi xảy ra trong quá trình thanh toán."
                        );
                    },
                })
                .render("#paypal-button-container"); // Render nút PayPal vào thẻ chứa
        } else {
            // Nếu không phải là PayPal, ẩn nút chứa button PayPal
            $("#paypal-button-container").empty(); // Xóa nút PayPal nếu có
        }
        if (paymentMethod === "momo-payment") {
            $("#btn-momo-payment").show();
        } else {
            $("#btn-momo-payment").hide();
        }
    });

    // Save form data to localStorage before payment
    $("#btn-momo-payment").click(function (e) {
        e.preventDefault();
        var urlMomo = $(this).data("urlmomo");

        if (validateBookingForm()) {
            // Gather form data
            var bookingData = {
                fullName: $("#username").val(),
                email: $("#email").val(),
                tel: $("#tel").val(),
                address: $("#address").val(),
                numAdults: $("#numAdults").val(),
                numChildren: $("#numChildren").val(),
                payment: $("input[name='payment']:checked").val(),
                payment_hidden: $("#payment_hidden").val(),
            };
            console.log(bookingData);

            // Save to localStorage
            localStorage.setItem("bookingData", JSON.stringify(bookingData));

            $.ajax({
                url: urlMomo, // Route tạo yêu cầu thanh toán Momo
                method: "POST",
                data: {
                    amount: totalPrice,
                    tourId: $("input[name='tourId']").val(),
                    _token: $('input[name="_token"]').val(),
                },
                success: function (response) {
                    if (response && response.payUrl) {
                        // Mở popup thanh toán hoặc chuyển hướng người dùng đến URL thanh toán Momo
                        window.location.href = response.payUrl;
                    } else {
                        alert("Không thể tạo thanh toán Momo.");
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra khi kết nối đến Momo.");
                },
            });
        }
    });

    var savedData = localStorage.getItem("bookingData");
    if (savedData) {
        var bookingData = JSON.parse(savedData);
        console.log(bookingData);

        $("#username").val(bookingData.fullName);
        $("#email").val(bookingData.email);
        $("#tel").val(bookingData.tel);
        $("#address").val(bookingData.address);
        $("#numAdults").val(bookingData.numAdults);
        $("#numChildren").val(bookingData.numChildren);
        $("input[name='payment'][value='" + bookingData.payment + "']").prop(
            "checked",
            true
        );
        $("#payment_hidden").val(bookingData.payment_hidden);
        $("#agree").prop("checked", true);
        // Vô hiệu hóa tất cả các radio button
        $('input[name="payment"]').prop("disabled", true);

        // Clear booking data after populating the form
        localStorage.removeItem("bookingData");
    }
    // Khởi tạo tổng giá khi trang vừa tải
    updateSummary();
    toggleButtonState();


    let currentRating = 0;

    $("#rating-stars i").on("mouseover", function () {
        let rating = $(this).data("value");
        highlightStars(rating);
    });

    $("#rating-stars i").on("click", function () {
        currentRating = $(this).data("value");
        console.log("Sao đã chọn :", currentRating);
    });

    $("#rating-stars i").on("mouseout", function () {
        resetStars();
        if (currentRating > 0) {
            highlightStars(currentRating);
        }
    });

    // Hàm tô màu các sao được chọn
    function highlightStars(rating) {
        $("#rating-stars i").each(function () {
            if ($(this).data("value") <= rating) {
                $(this).removeClass("far").addClass("fas active");
            } else {
                $(this).removeClass("fas active").addClass("far");
            }
        });
    }

    // Hàm đặt lại tất cả sao về trạng thái chưa chọn
    function resetStars() {
        $("#rating-stars i").each(function () {
            $(this).removeClass("fas active").addClass("far");
        });
    }
    let urlCheckBooking = $("#submit-reviews").attr("data-url-checkBooking");
    let urlSubmitReview = $("#comment-form").attr("action");
    let tourIdReview = $("#submit-reviews").attr("data-tourId-reviews");

    $("#comment-form").on("submit", function (e) {
        e.preventDefault();

        let message = $("#message").val().trim();

        // Kiểm tra số sao và nội dung
        if (currentRating === 0) {
            toastr.warning("Vui lòng chọn số sao để đánh giá.");
            return;
        } else if (message === "") {
            toastr.warning("Vui lòng nhập nội dung phản hồi.");
            return;
        }

        $.ajax({
            url: urlCheckBooking,
            method: "POST",
            data: {
                tourId: tourIdReview,
                _token: $('input[name="_token"]').val(),
            },
            success: function (response) {
                if (response.success) {
                    formReviews = {
                        tourId: tourIdReview,
                        rating: currentRating,
                        message: message,
                        _token: $('input[name="_token"]').val(),
                    };

                    // Gửi AJAX request
                    $.ajax({
                        url: urlSubmitReview, // Lấy URL từ action của form
                        method: "POST",
                        data: formReviews,
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.message);
                                $("#partials_reviews").html(response.data);
                                $("#partials_reviews .comment-body").addClass(
                                    "aos-animate"
                                );
                                // Xử lý reset form hoặc thông báo
                                $("#message").val("");
                                $('#comment-form').hide();
                                resetStars();
                                currentRating = 0;
                            }
                        },
                        error: function (xhr, status, error) {
                            toastr.error("Đã có lỗi xảy ra. Vui lòng thử lại.");
                            console.error("Error:", error);
                        },
                    });
                } else {
                    toastr.error(
                        "Vui lòng đặt tour và trải nghiệm để có thể đánh giá!"
                    );
                }
            },
            error: function (xhr, status, error) {
                toastr.error("Đã có lỗi xảy ra. Vui lòng thử lại.");
                console.error("Error:", error);
            },
        });
    });
});
