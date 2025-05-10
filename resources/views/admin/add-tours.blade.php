@extends('layoutAdmin.master')

@section('content')
<div class="container-fluid py-4">
    <div class="page-inner">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Thêm tour mới</h3>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thông tin tour</h4>
                <p class="card-category">Điền đầy đủ thông tin để tạo tour du lịch mới</p>
            </div>
            <div class="card-body">
                <div id="wizard" class="wizard-container">
                    <ul class="nav nav-pills nav-primary">
                        <li class="nav-item"><a class="nav-link active" href="#step-1" data-toggle="tab">1. Thông tin</a></li>
                        <li class="nav-item"><a class="nav-link" href="#step-2" data-toggle="tab">2. Hình ảnh</a></li>
                        <li class="nav-item"><a class="nav-link" href="#step-3" data-toggle="tab">3. Lộ trình</a></li>
                    </ul>

                    <div class="tab-content mt-4">
                        <!-- Step 1 -->
                        <div class="tab-pane active" id="step-1">
                            <form id="form-step1" method="POST" action="{{ route('admin.add-tours') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Tên Tour <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="name" placeholder="Nhập tên tour" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Điểm đến <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="destination" placeholder="Điểm đến" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Khu vực <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="domain" required>
                                            <option value="">-- Chọn khu vực --</option>
                                            <option value="b">Miền Bắc</option>
                                            <option value="t">Miền Trung</option>
                                            <option value="n">Miền Nam</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Số lượng <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" name="number" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Giá người lớn <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" name="price_adult" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Giá trẻ em <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" name="price_child" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Ngày khởi hành <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control datetimepicker" name="start_date" id="start_date" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Ngày kết thúc <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control datetimepicker" name="end_date" id="end_date" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Mô tả <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" name="description" rows="5" required></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Step 2 -->
                        <div class="tab-pane" id="step-2">
                            <form action="{{ route('admin.add-images-tours') }}" class="dropzone" id="myDropzone" enctype="multipart/form-data">
                                @csrf
                                <div class="dz-message">
                                    Kéo thả hoặc click để chọn hình ảnh tour.
                                </div>
                            </form>
                        </div>

                        <!-- Step 3 -->
                        <div action="{{ route('admin.add-timeline') }}" class="tab-pane" id="step-3">
                            <form id="timeline-form" method="POST">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="tourId" class="hiddenTourId">
                                <!-- Khu vực timeline sẽ được thêm tự động bởi JavaScript -->
                            </form>
                            <!-- Nút "Thêm ngày" sẽ được thêm tự động bởi JavaScript -->
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="button" class="btn btn-primary" id="save-tour">Lưu Tour</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
