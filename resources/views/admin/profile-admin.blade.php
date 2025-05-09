@extends('layoutAdmin.master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Thông tin Admin</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <div class="card-body">
                        <div class="row">
                            <!-- Avatar -->
                            <div class="col-md-4">
                                <div class="form-group text-center">
                                    <label for="avatar">Ảnh đại diện</label>
                                    <div class="mb-3">
                                        <img id="avatarPreview" src="{{ asset('storage/images/avatars/avt_admin.jpg') }}" alt="Admin Avatar"
                                            class="rounded-circle img-account-profile" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <input type="file" id="avatar" name="avatar" accept="image/*" style="display: none;">
                                    <input type="hidden" class="__token" value="{{ csrf_token() }}">
                                    <input type="hidden" class="label_avatar" value="{{ route('admin.update-avatar') }}">
                                    <label for="avatar" class="btn btn-success" style="align-items: center; text-align: center; width: 78%; margin: 10px 24px;">
                                        <i class="fa fa-edit m-right-xs"></i> Tải ảnh lên
                                    </label>
                                </div>
                            </div>

                            <!-- Admin Information -->
                            <div class="col-md-8">
                                <form action="{{ route('admin.update-admin') }}" method="POST" id="formProfileAdmin">
                                    @csrf
                                    <div class="form-group">
                                        <label for="fullName">Họ và tên</label>
                                        <input type="text" class="form-control" id="fullName" name="fullName" value="{{ $admin->fullName }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mật khẩu</label>
                                        <input type="password" class="form-control" id="password" name="password" value="{{ $admin->password }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Địa chỉ</label>
                                        <textarea class="form-control" id="address" name="address" rows="3">{{ $admin->address }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
