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
                                        <img src="{{ asset('storage/images/' . $admin->avatar) }}" alt="Admin Avatar"
                                            class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <input type="file" class="form-control" id="avatar" name="avatar">
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
                                        <input type="password" class="form-control" id="password" name="password" value="{{ $admin->password }}" required>
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
