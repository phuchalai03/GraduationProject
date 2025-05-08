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