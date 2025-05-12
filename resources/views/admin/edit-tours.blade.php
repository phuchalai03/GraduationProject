{{-- filepath: resources/views/admin/edit-tours.blade.php --}}
@extends('layoutAdmin.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="page-inner">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold">Chỉnh sửa thông tin tour</h3>
            </div>
            <form action="{{ route('admin.edit-tour') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Thông tin cơ bản --}}

                <div class="card mb-4">
                    <div class="card-header fw-bold">Thông tin tour</div>
                    <div class="card-body">
                        <input type="hidden" name="tourId" value="{{ $getTour->tourId }}">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Tên tour <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="title" value="{{ $getTour->title }}"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Khu vực <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="domain" required>
                                    <option value="">-- Chọn khu vực --</option>
                                    <option value="b" {{ $getTour->domain == 'b' ? 'selected' : '' }}>Miền Bắc</option>
                                    <option value="t" {{ $getTour->domain == 't' ? 'selected' : '' }}>Miền Trung
                                    </option>
                                    <option value="n" {{ $getTour->domain == 'n' ? 'selected' : '' }}>Miền Nam</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Mô tả</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="description" rows="3">{{ $getTour->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Số lượng</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="quantity" value="{{ $getTour->quantity }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Giá người lớn</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="priceAdult"
                                    value="{{ $getTour->priceAdult }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Giá trẻ em</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="priceChild"
                                    value="{{ $getTour->priceChild }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Điểm đến</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="destination"
                                    value="{{ $getTour->destination }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Ngày khởi hành <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control datetimepicker" name="startDate"
                                    value="{{ \Carbon\Carbon::parse($getTour->startDate)->format('d-m-Y') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Ngày kết thúc <span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control datetimepicker" name="endDate"
                                    value="{{ \Carbon\Carbon::parse($getTour->endDate)->format('d-m-Y') }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Ảnh của tour --}}
                <div class="card mb-4">
                    <div class="card-header fw-bold">Ảnh tour</div>
                    <div class="card-body">
                        <div id="images-container" class="row mb-3">
                            @foreach ($getImages as $img)
                                <div class="col-md-3 mb-3 image-item" data-image-id="{{ $img->imageId }}">
                                    <img src="{{ asset('storage/images/' . $img->imgURL) }}" class="img-fluid rounded"
                                        alt="Ảnh tour">
                                    <div class="mt-2 text-center">
                                        <button type="button" class="btn btn-danger btn-sm btn-remove-image"
                                            data-image-id="{{ $img->imageId }}">Xóa</button>
                                        <input type="hidden" name="old_images[]" value="{{ $img->imageId }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-primary" id="btn-add-image">Thêm ảnh mới</button>
                                <input type="file" id="input-add-image" name="images[]" accept="image/*"
                                    style="display:none;" multiple>
                            </div>
                        </div>
                        <div id="preview-new-images" class="row mt-2"></div>
                        <div id="deleted-images"></div>
                    </div>
                </div>

                {{-- Timeline --}}
                <div class="card mb-4">
                    <div class="card-header fw-bold">Lộ trình tour</div>
                    <div class="card-body">
                        <div id="timeline-container"></div>
                        <button type="button" class="btn btn-info" id="add-timeline-day-edit">+ Thêm ngày</button>
                    </div>
                </div>

                <div class="text-center mb-4">
                    <button type="submit" class="btn btn-success px-5">Cập nhật tour</button>
                    <a href="{{ route('admin.tours') }}" class="btn btn-secondary px-5">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
