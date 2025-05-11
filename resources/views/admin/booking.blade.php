@extends('layoutAdmin.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Danh sách booking</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Booking</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Tour
                                            </th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Tên
                                                khách hàng</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">
                                                Email</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">SĐT
                                            </th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Địa
                                                chỉ</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Ngày
                                                đặt</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Người lớn
                                                </th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Trẻ em
                                                </th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Tổng
                                                tiền</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">
                                                Trạng thái booking</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">
                                                Thanh toán</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">
                                                Trạng thái</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list_booking as $booking)
                                            <tr>
                                                <td style="padding: 7px">{{ $booking->title }}</td>
                                                <td style="padding: 7px">{{ $booking->fullName }}</td>
                                                <td style="padding: 7px">{{ $booking->email }}</td>
                                                <td style="padding: 7px">{{ $booking->phoneNumber }}</td>
                                                <td style="padding: 7px">{{ $booking->address }}
                                                </td>
                                                <td style="padding: 7px">
                                                    {{ date('d-m-Y', strtotime($booking->bookingDate)) }}
                                                </td>
                                                <td style="padding: 7px">{{ $booking->numAdults }}</td>
                                                <td style="padding: 7px">{{ $booking->numChildren }}</td>
                                                <td style="padding: 7px">
                                                    {{ number_format($booking->totalPrice, 0, ',', '.') }}</td>
                                                <td style="padding: 7px">
                                                    @if ($booking->bookingStatus == 'c')
                                                        <span class="badge badge-danger">Đã hủy</span>
                                                    @elseif ($booking->bookingStatus == 'b')
                                                        <span class="badge badge-warning">Chưa xác nhận</span>
                                                    @elseif ($booking->bookingStatus == 'y')
                                                        <span class="badge badge-primary">Đã xác nhận</span>
                                                    @elseif ($booking->bookingStatus == 'f')
                                                        <span class="badge badge-success">Đã hoàn thành</span>
                                                    @endif
                                                </td>
                                                <td style="padding: 7px">
                                                    @if ($booking->paymentMethod == 'momo-payment')
                                                        <span>Momo</span>
                                                    @elseif ($booking->paymentMethod == 'paypal-payment')
                                                        <span>Paypal</span>
                                                    @else
                                                        <span>Tại văn phòng</span>
                                                    @endif
                                                </td>
                                                <td style="padding: 7px">
                                                    @if ($booking->paymentStatus == 'n')
                                                        <span class="badge badge-danger">Chưa thanh toán</span>
                                                    @else
                                                        <span class="badge badge-success">Đã thanh toán</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span>Action</span>
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
