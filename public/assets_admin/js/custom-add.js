$(document).ready(function () {
    // Khởi tạo biến để theo dõi bước hiện tại
    let currentStep = 1;
    const totalSteps = 3;

    // Khởi tạo DateTimePicker cho các trường ngày
    $('.datetimepicker').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'vi',
        icons: {
            time: 'fa fa-clock',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-check',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        }
    });

    // Xử lý khi click vào các tab
    $('.nav-pills a').on('click', function (e) {
        e.preventDefault();

        // Lấy step từ href (ví dụ: #step-1 -> 1)
        const targetStep = parseInt($(this).attr('href').split('-')[1]);

        // Validate form trước khi chuyển step
        if (targetStep > currentStep) {
            // Chỉ validate khi đi từ step thấp lên step cao
            if (!validateCurrentStep(currentStep)) {
                return false;
            }
        }

        // Cập nhật step hiện tại
        currentStep = targetStep;

        // Xóa class active từ tất cả các tab và tab content
        $('.nav-pills a').removeClass('active');
        $('.tab-pane').removeClass('active');

        // Thêm class active cho tab và tab content được chọn
        $(this).addClass('active');
        $($(this).attr('href')).addClass('active');
    });
    // Khởi tạo Dropzone cho upload hình ảnh
    Dropzone.autoDiscover = false;
    if (Dropzone.instances.length > 0) {
        Dropzone.instances.forEach(instance => instance.destroy()); // Hủy tất cả các instance trước đó
    }
    if (typeof Dropzone !== 'undefined' && $('#myDropzone').length) {
        try {
            let myDropzone = new Dropzone("#myDropzone", {
                url: "/add-images-tours",
                paramName: "image",
                autoProcessQueue: false,
                parallelUploads: 10,
                maxFiles: 10,
                acceptedFiles: "image/*",
                addRemoveLinks: true,
                dictRemoveFile: "Xóa",
                dictCancelUpload: "Hủy",
                dictDefaultMessage: "Kéo thả hoặc click để chọn hình ảnh tour"
            });
        } catch (e) {
            console.error('Dropzone init error:', e);
        }
    }

    // Nút lưu tour
    $('.btn-primary').on('click', function () {
        saveAllData();
    });

    // Hàm validate form cho từng step
    function validateCurrentStep(step) {
        switch (step) {
            case 1:
                // Validate form step 1
                const form = document.getElementById('form-step1');
                if (!form.checkValidity()) {
                    // Kích hoạt validation của trình duyệt
                    form.reportValidity();
                    return false;
                }
                return true;

            case 2:
                // Validate step 2 (kiểm tra đã có hình ảnh nào được upload chưa)
                const dropzone = Dropzone.forElement("#myDropzone");
                if (dropzone && dropzone.files.length === 0) {
                    alert("Vui lòng thêm ít nhất một hình ảnh cho tour!");
                    return false;
                }
                return true;

            case 3:
                // Validate step 3 (kiểm tra các trường lộ trình)
                let isValid = true;
                const timelineDays = $('.timeline-day');
                if (timelineDays.length === 0) {
                    alert("Vui lòng thêm ít nhất một ngày cho lộ trình!");
                    return false;
                }
                timelineDays.each(function () {
                    const title = $(this).find('input[name^="title-"]').val();
                    const description = $(this).find('textarea[name^="description-"]').val();

                    if (!title || !description) {
                        alert("Vui lòng điền đầy đủ thông tin cho tất cả các ngày trong lộ trình!");
                        isValid = false;
                        return false; // Thoát khỏi vòng lặp
                    }
                });
                return isValid;

            default:
                return true;
        }
    }

    // Hàm lưu toàn bộ dữ liệu tour
    function saveAllData() {
        // Validate tất cả các step trước khi lưu
        for (let i = 1; i <= totalSteps; i++) {
            if (!validateCurrentStep(i)) {
                // Chuyển đến step không hợp lệ
                $('.nav-pills a[href="#step-' + i + '"]').tab('show');
                return false;
            }
        }

        // Lưu dữ liệu từ form step 1
        const formData = new FormData(document.getElementById('form-step1'));

        // Gửi Ajax để lưu thông tin cơ bản của tour
        $.ajax({
            url: '/add-tours',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    // Lưu ID của tour mới được tạo
                    $('.hiddenTourId').val(response.tourId);

                    // Upload hình ảnh
                    const dropzone = Dropzone.forElement("#myDropzone");
                    if (dropzone) {
                        // Thêm tour ID vào mỗi file trước khi upload
                        dropzone.on("sending", function (file, xhr, formData) {
                            formData.append("tourId", response.tourId);
                        });

                        // Bắt đầu upload các file
                        dropzone.processQueue();
                    }

                    // Lưu thông tin lộ trình
                    saveTimelineData(response.tourId);

                    // Hiển thị thông báo thành công
                    alert("Tour đã được tạo thành công!");

                    // Chuyển hướng về trang danh sách tour
                    window.location.href = '/add-tours';
                } else {
                    alert("Có lỗi xảy ra: " + response.message);
                }
            },
            error: function (error) {
                console.error("Lỗi khi lưu tour:", error);
                alert("Có lỗi xảy ra khi lưu tour. Vui lòng thử lại sau!");
            }
        });
    }

    // Hàm lưu thông tin lộ trình
    function saveTimelineData(tourId) {
        // Tạo form data để lưu timeline
        const formData = new FormData();

        // Thêm tour ID vào formData
        formData.append('tourId', tourId);

        // Thu thập tất cả các thông tin timeline
        $('.timeline-day').each(function (index) {
            const title = $(this).find('input[name^="title-"]').val();
            const description = $(this).find('textarea[name^="description-"]').val();

            formData.append(`title-${index}`, title);
            formData.append(`description-${index}`, description);
        });

        // Log dữ liệu để debug
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        // Gửi Ajax request
        $.ajax({
            url: '/add-timeline',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function (response) {
                console.log("Phản hồi từ server:", response);
                if (response.success) {
                    console.log("Lưu lộ trình thành công!");
                } else {
                    console.error("Lỗi lưu lộ trình:", response.message);
                }
            },
            error: function (error) {
                console.error("Lỗi khi lưu lộ trình:", error);
            }
        });
    }

    // Thêm các trường cho lộ trình tour
    let dayCount = 1;

    // Thêm nút để thêm ngày mới
    $('#step-3').append('<div class="mt-3 mb-3"><button type="button" class="btn btn-sm btn-info" id="add-timeline-day">+ Thêm ngày</button></div>');

    // Thêm ngày đầu tiên cho lộ trình
    addTimelineDay();

    // Xử lý khi click thêm ngày mới
    $("#add-timeline-day").on("click", function () {
        console.log("Add day button clicked");
        addTimelineDay();
    });

    // Xử lý khi click xóa ngày
    $(document).on('click', '.remove-day', function () {
        $(this).closest('.timeline-day').remove();
        // Cập nhật lại số thứ tự các ngày
        $('.timeline-day').each(function (index) {
            $(this).find('.day-title').text('Ngày ' + (index + 1));
            $(this).find('input, textarea').each(function () {
                const name = $(this).attr('name');
                if (name) {
                    const newName = name.replace(/\[\d+\]/, '[' + index + ']');
                    $(this).attr('name', newName);
                }
            });
        });
        dayCount = $('.timeline-day').length + 1;
    });

    // Hàm thêm ngày mới cho lộ trình
    function addTimelineDay() {
        const dayHtml = `
            <div class="timeline-day card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="day-title mb-0">Ngày ${dayCount}</h5>
                    <button type="button" class="btn btn-sm btn-danger remove-day">Xóa</button>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tiêu đề</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title-${dayCount - 1}" placeholder="Tiêu đề cho ngày ${dayCount}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description-${dayCount - 1}" rows="3" placeholder="Mô tả chi tiết cho ngày ${dayCount}" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Thêm HTML vào trước nút thêm ngày
        $('#add-timeline-day').before(dayHtml);
        dayCount++;
    }


    //Cập nhật timeline
    $(document).ready(function () {
        let timelineIndex = window.timelineData.length || 0;

        // Hàm render lại toàn bộ timeline
        function renderTimeline() {
            const container = $('#timeline-container');
            container.empty();
            window.timelineData.forEach(function (timeline, idx) {
                container.append(`
                <div class="timeline-day mb-4 border rounded p-3" data-index="${idx}">
                    <input type="hidden" name="timeline[${idx}][timelineId]" value="${timeline.timelineId || ''}">
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label">Tiêu đề ngày ${idx + 1}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="timeline[${idx}][title]" value="${timeline.title || ''}" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="timeline[${idx}][description]" rows="3" required>${timeline.description || ''}</textarea>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-remove-timeline">Xóa ngày</button>
                </div>
            `);
            });
        }

        // Render lần đầu
        renderTimeline();

        // Thêm ngày mới
        $('#add-timeline-day-edit').on('click', function () {
            window.timelineData.push({ title: '', description: '' });
            renderTimeline();
        });

        // Xóa ngày
        $('#timeline-container').on('click', '.btn-remove-timeline', function () {
            const idx = $(this).closest('.timeline-day').data('index');
            window.timelineData.splice(idx, 1);
            renderTimeline();
        });
    });
    
});