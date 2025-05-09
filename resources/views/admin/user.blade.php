@extends('layoutAdmin.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Danh sách người dùng</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($users as $user)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Ảnh đại diện và nút hành động -->
                                            <div class="col-md-4 text-center">
                                                <!-- Ảnh đại diện -->
                                                <img src="{{ asset('storage/images/avatars/' . $user->avatar) }}"
                                                    alt="Avatar" class="rounded-circle mb-3"
                                                    style="width: 100%; object-fit: cover;">

                                                <!-- Nút hành động -->
                                                <div class="d-flex flex-column">
                                                    <form action="{{ route('admin.delete-user') }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm w-100">Xóa</button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Thông tin người dùng -->
                                            <div class="col-md-8">
                                                <p class="card-text">
                                                        <div class="text-truncate" style="max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                            <strong>Tên:</strong> {{ $user->fullName ?? 'Unnamed' }}
                                                        </div>
                                                        <div class="text-truncate" style="max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                            <strong>Email:</strong> {{ $user->email ?? 'Không có' }}
                                                        </div>
                                                        <div>
                                                            <strong>Address:</strong> {{ $user->address ?? 'Không có' }}
                                                        </div>
                                                        <div>
                                                            <strong>Phone:</strong> {{ $user->phone ?? 'Không có' }}
                                                        </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
