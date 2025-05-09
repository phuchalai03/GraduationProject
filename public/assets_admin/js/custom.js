$(document).ready(function () {
    // Xử lý cập nhật thông tin admin
    $('#formProfileAdmin').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this); 

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false, 
            success: function (response) {
                if (response.success) {
                    $('#fullName').val(response.data.fullName);
                    $('#email').val(response.data.email);
                    $('#address').val(response.data.address);

                    alert('Cập nhật thông tin thành công!');
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Có lỗi xảy ra:', error);
                alert('Đã xảy ra lỗi trong quá trình cập nhật!');
            },
        });
    });
});

$(document).ready(function () {
    $("#avatar").on("change", function (event) {
        const file = event.target.files[0];

        if (file) {
            // Hiển thị ảnh vừa chọn trước khi gửi lên server
            const reader = new FileReader();
            reader.onload = function (e) {
                $("#avatarPreview").attr("src", e.target.result);
                $(".img-account-profile").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);

            // Lấy CSRF token và URL từ các input ẩn
            const __token = $(this).closest(".form-group").find("input.__token").val();
            const url_avatar = $(this).closest(".form-group").find("input.label_avatar").val();

            // Tạo FormData để gửi file qua AJAX
            const formData = new FormData();
            formData.append("avatar", file);

            // Gửi AJAX đến server
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
                    alert(error);
                },
            });
        }
    });
});