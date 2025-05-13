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
    $(document).ready(function () {
        // Xử lý sự kiện click nút xóa
        $(document).on('click', '.btn-delete', function () {
            const tourId = $(this).data('id');
            const token = $(this).siblings('input[name="_token"]').val();

            if (confirm('Bạn có chắc chắn muốn xóa tour này?')) {
                $.ajax({
                    url: '/delete-tour',
                    type: 'POST',
                    data: {
                        tourId: tourId,
                        _token: token
                    },
                    success: function (response) {
                        if (response.success) {
                            // Xóa dòng trong bảng
                            // $(`button[data-id="${tourId}"]`).closest('tr').remove();
                            alert('Xóa tour thành công!');
                            window.location.reload();
                        } else {
                            alert('Xóa tour thất bại!');
                        }
                    },
                    error: function (xhr) {
                        alert('Có lỗi xảy ra khi xóa tour!');
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
    $(document).on('click', '.btn-edit', function () {
        const url = $(this).data('url');
        const tourId = $(this).data('tour-id');
        // Ví dụ: chuyển hướng kèm tourId dạng query string
        window.location.href = url + '?tourId=' + tourId;
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

    $("#basic-datatables").DataTable({});

    $("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function () {
            this.api()
                .columns()
                .every(function () {
                    var column = this;
                    var select = $(
                        '<select class="form-select"><option value=""></option></select>'
                    )
                        .appendTo($(column.footer()).empty())
                        .on("change", function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });

    // Add Row
    $("#add-row").DataTable({
        pageLength: 5,
    });


    $('#btn-add-image').on('click', function () {
        $('#input-add-image').click();
    });

    // Khi chọn ảnh mới
    $('#input-add-image').on('change', function (e) {
        const files = e.target.files;
        const previewContainer = $('#preview-new-images');
        previewContainer.empty(); // Xóa preview cũ nếu cần

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = function (e) {
                const html = `
                    <div class="col-md-3 mb-3 new-image-item">
                        <img src="${e.target.result}" class="img-fluid rounded" alt="Ảnh mới">
                        <div class="mt-2 text-center">
                            <button type="button" class="btn btn-danger btn-sm btn-remove-new-image">Xóa</button>
                        </div>
                    </div>
                `;
                previewContainer.append(html);
            };
            reader.readAsDataURL(file);
        }
    });

    // Xóa ảnh mới (chỉ xóa preview, không xóa file khỏi input do giới hạn HTML, khi submit sẽ chỉ gửi lại các file còn lại)
    $('#preview-new-images').on('click', '.btn-remove-new-image', function () {
        $(this).closest('.new-image-item').remove();
        // Nếu muốn xóa file khỏi input, cần tạo lại input file và gán lại các file còn lại (nâng cao)
    });

    // Xóa ảnh cũ
    $('#images-container').on('click', '.btn-remove-image', function () {
        var imageId = $(this).data('image-id');
        $('#deleted-images').append('<input type="hidden" name="delete_images[]" value="' + imageId + '">');
        $(this).closest('.image-item').remove();
    });

    $(document).on("click", ".confirm-booking", function (e) {
        e.preventDefault();

        const bookingId = $(this).data("bookingid");
        const urlConfirm = $(this).data("urlconfirm");

        $.ajax({
            url: urlConfirm,
            method: "POST",
            data: {
                bookingId: bookingId,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    $("#tbody-booking").html(response.data);
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function (error) {
                alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
            },
        });
    });

    $(document).on("click", ".confirm-booking", function (e) {
        e.preventDefault();

        const bookingId = $(this).data("bookingid");
        const urlConfirm = $(this).data("urlconfirm");

        $.ajax({
            url: urlConfirm,
            method: "POST",
            data: {
                bookingId: bookingId,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    $("#tbody-booking").html(response.data);
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function (error) {
                alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
            },
        });
    });

    $(document).on("click", ".confirm-checkout", function (e) {
        e.preventDefault();

        const bookingId = $(this).data("bookingid");
        const urlConfirm = $(this).data("urlconfirm-checkout");

        $.ajax({
            url: urlConfirm,
            method: "POST",
            data: {
                bookingId: bookingId,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    $("#tbody-booking").html(response.data);
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function (error) {
                alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
            },
        });
    });

    $(document).on("click", ".finish-booking", function (e) {
        e.preventDefault();

        const bookingId = $(this).data("bookingid");
        const urlFinish = $(this).data("urlfinish");

        $.ajax({
            url: urlFinish,
            method: "POST",
            data: {
                bookingId: bookingId,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    $("#tbody-booking").html(response.data);
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function (error) {
                alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
            },
        });
    });

    $(document).on("click", ".delete-booking", function (e) {
        e.preventDefault();

        const bookingId = $(this).data("bookingid");
        const urlDelete = $(this).data("urldelete");

        $.ajax({
            url: urlDelete,
            method: "POST",
            data: {
                bookingId: bookingId,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    $("#tbody-booking").html(response.data);
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function (error) {
                alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
            },
        });
    });
    $(document).ready(function () {
        $('.contact-item').on('click', function () {
            var fullName = $(this).data("name");
            var email = $(this).data("email");
            var message = $(this).data("message");
            var contactId = $(this).data("contactid");
            $('#contact-detail-card').show();
            $('#contact-name').text(fullName);
            $('#contact-email').text('<' + email + '>');
            $('#contact-id').text('ID: ' + contactId);
            $('#contact-message').text(message);
            $(".send-reply-contact").attr("data-email", email);
            $(".send-reply-contact").attr("data-contactid", contactId);
        });
    });
    $('.btn-group').on('click', '#compose', function () {
        $('#compose-contact').show();
    });

    // Đóng form phản hồi
    $('#compose-contact').on('click', '.compose-close', function () {
        $('#compose-contact').hide();
    });

    $(document).on("click", ".send-reply-contact", function (e) {
        e.preventDefault();

        // Lấy thông tin từ nút gửi
        var email = $(this).attr("data-email");
        var contactId = $(this).attr("data-contactid");
        var editorContent = $('#editor-contact').text();

        var urlReply = $(this).data("url");

        if (!email) {
            alert("Không có địa chỉ email để gửi.");
            return;
        }

        // Gửi AJAX request
        $.ajax({
            url: urlReply,
            type: "POST",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // CSRF Token
            },
            data: {
                contactId: contactId,
                email: email,
                message: editorContent,
            },
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    // Xóa element contact-item sau khi phản hồi thành công
                    $(
                        ".contact-item[data-contactid='" + contactId + "']"
                    ).remove();
                    $(".mail_view").hide();
                    $("#editor-contact").empty(); // Dọn sạch nội dung div nếu cần
                    $(".compose").slideToggle();

                    $(this)
                        .removeAttr("data-email")
                        .removeAttr("data-contactid");
                }
            },
            error: function (xhr) {
                alert("Đã xảy ra lỗi khi gửi email. Vui lòng thử lại.");
            },
        });
    });
});