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
                $('#tours-container').html(res);
                $('#tours-container .destination-item').addClass('aos-animate');
            }
        });
    }

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
                    toastr.error("Có lỗi xảy ra. Vui lòng thử lại sau.");
                },
            });
        }
    });

});
