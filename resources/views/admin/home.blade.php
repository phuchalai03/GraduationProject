@extends('layoutAdmin.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tổng số tour</p>
                                        <h4 class="card-title">{{ $summary['tourWorking'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tổng số lượt booking</p>
                                        <h4 class="card-title">{{ $summary['countBooking'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-luggage-cart"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Người dùng đăng ký</p>
                                        <h4 class="card-title">12</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="far fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tổng doanh thu</p>
                                        <h4 class="card-title">{{ number_format($summary['totalAmount'], 0, ',', '.') }} vnđ
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">Tours được đặt nhiều nhất</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive table-hover table-sales">
                                        <table class="table table-head-bg-primary mt-4">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Tên</th>
                                                    <th scope="col">Số chỗ đã đặt</th>
                                                    <th scope="col">Số chỗ trống</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($toursBooked as $item)
                                                    <tr>
                                                        <th scope="row">{{ $item->tourId }}</th>
                                                        <td>{{ $item->title }}</td>
                                                        <td>{{ $item->booked_quantity }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">Đơn đặt mới</h4>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive table-hover table-sales">
                                        <table class="table table-head-bg-primary mt-4">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Họ và tên</th>
                                                    <th scope="col">Tên tour</th>
                                                    <th scope="col">Tổng tiền</th>
                                                    <th scope="col">Trạng thái</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($newBooking as $item)
                                                    <tr>
                                                        <th scope="row">
                                                            {{-- <a href="{{ route('admin.booking-detail', ['id' => $item->bookingId]) }}">{{ $item->bookingId }}</a> --}}
                                                            {{ $item->bookingId }}
                                                        </th>
                                                        <td>{{ $item->fullName }}</td>
                                                        <td>{{ $item->tour_name }}</td>
                                                        <td>{{ number_format($item->totalPrice, 0, ',', '.') }}</td>
                                                        <td>
                                                            <span class="badge badge-warning">Chưa xác nhận</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Lịch sử giao dịch</div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Mã thanh toán</th>
                                            <th scope="col" class="text-end">Người thanh toán</th>
                                            <th scope="col" class="text-end">Mã giao dịch</th>
                                            <th scope="col" class="text-end">Ngày thanh toán</th>
                                            <th scope="col" class="text-end">Số tiền</th>
                                            <th scope="col" class="text-end">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction as $trans)
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">{{ $trans->checkoutId }}</a>
                                                </th>
                                                <td class="text-end">
                                                    {{ $trans->fullName }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $trans->transactionId }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $trans->bookingDate }}
                                                </td>
                                                <td class="text-end">
                                                    {{ number_format($trans->amount, 0, ',', '.') }} vnđ
                                                </td>
                                                <td class="text-end">
                                                    @if ($trans->paymentStatus == 'y')
                                                        <span class="badge badge-success">Đã thanh toán</span>
                                                    @else
                                                        <span class="badge badge-danger">Thất bại</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
