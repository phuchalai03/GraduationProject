@extends('layoutAdmin.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Chi tiết tour</h3>
                </div>
            </div>
            <div class="row">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fa fa-file-invoice-dollar text-primary me-2"></i> Hóa đơn đặt tour du
                            lịch</h4>
                        <span class="badge bg-info">Mã hóa đơn #{{ $invoice_booking->checkoutId }}</span>
                    </div>
                    <div class="card-body" id="print-area">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="fw-bold">Khách hàng</h5>
                                <ul class="list-unstyled mb-0">
                                    <li><strong>{{ $invoice_booking->fullName }}</strong></li>
                                    <li>{{ $invoice_booking->address }}</li>
                                    <li>Điện thoại: {{ $invoice_booking->phoneNumber }}</li>
                                    <li>Email: {{ $invoice_booking->email }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <h5 class="fw-bold">Công ty Travel</h5>
                                <ul class="list-unstyled mb-0">
                                    <li>Số 3 Cầu Giấy</li>
                                    <li>Đống Đa, Hà Nội</li>
                                    <li>Điện thoại: 0321540251</li>
                                    <li>Email: ntwohp23@gmail.com</li>
                                </ul>
                                <div class="mt-2">
                                    <span class="badge bg-secondary">Ngày:
                                        {{ date('d-m-Y', strtotime($invoice_booking->bookingDate)) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Loại</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Điểm đến</th>
                                        <th>Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Người lớn</td>
                                        <td>{{ $invoice_booking->numAdults }}</td>
                                        <td>{{ number_format($invoice_booking->priceAdult, 0, ',', '.') }} vnđ</td>
                                        <td>{{ $invoice_booking->destination }}</td>
                                        <td>{{ number_format($invoice_booking->priceAdult * $invoice_booking->numAdults, 0, ',', '.') }}
                                            vnđ</td>
                                    </tr>
                                    <tr>
                                        <td>Trẻ em</td>
                                        <td>{{ $invoice_booking->numChildren }}</td>
                                        <td>{{ number_format($invoice_booking->priceChild, 0, ',', '.') }} vnđ</td>
                                        <td>{{ $invoice_booking->destination }}</td>
                                        <td>{{ number_format($invoice_booking->priceChild * $invoice_booking->numChildren, 0, ',', '.') }}
                                            vnđ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Phương thức thanh toán:</h6>
                                @if ($invoice_booking->paymentMethod == 'momo-payment')
                                    <img src="{{ asset('storage/images/icons/logo-momo.jpg') }}" alt="Momo"
                                        style="height:32px;">
                                @elseif ($invoice_booking->paymentMethod == 'paypal-payment')
                                    <img src="{{ asset('storage/images/icons/cong-thanh-toan-paypal.jpg') }}"
                                        alt="Paypal" style="height:32px;">
                                @else
                                    <img src="{{ asset('storage/images/icons/thanh-toan.png') }}" alt="Văn phòng"
                                        style="height:32px;">
                                    <span class="badge bg-info">Thanh toán tại văn phòng</span>
                                @endif
                                <div class="text-muted mt-2">
                                    Vui lòng hoàn tất thanh toán theo hướng dẫn hoặc liên hệ với chúng tôi nếu cần hỗ trợ.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Thông tin hóa đơn</h6>
                                <ul class="list-unstyled mb-0">
                                    <li><b>Mã giao dịch:</b> {{ $invoice_booking->transactionId }}</li>
                                    <li><b>Ngày thanh toán:</b> {{ $invoice_booking->paymentDate }}</li>
                                    <li><b>Tài khoản:</b> {{ $invoice_booking->userId }}</li>
                                </ul>
                                <div class="table-responsive mt-2">
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Tổng tiền:</th>
                                                <td>{{ number_format($invoice_booking->totalPrice, 0, ',', '.') }} vnđ</td>
                                            </tr>
                                            <tr>
                                                <th>Thuế (0%)</th>
                                                <td>0 vnđ</td>
                                            </tr>
                                            <tr>
                                                <th>Giảm giá</th>
                                                <td>0 vnđ</td>
                                            </tr>
                                            <tr>
                                                <th>Thành tiền:</th>
                                                <td>{{ number_format($invoice_booking->amount, 0, ',', '.') }} vnđ</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-2">
                                    <span class="badge bg-warning">Phải trả trước
                                        {{ date('d-m-Y', strtotime($invoice_booking->startDate)) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <button class="btn btn-outline-secondary" onclick="window.print();">
                                    <i class="fa fa-print"></i> In hóa đơn
                                </button>
                                <button id="send-pdf-btn" data-bookingid="{{ $invoice_booking->bookingId }}"
                                    data-email="{{ $invoice_booking->email }}" data-urlsendmail=""
                                    class="btn btn-primary ms-2">
                                    <i class="fa fa-paper-plane"></i> Gửi hóa đơn cho khách hàng
                                </button>
                            </div>
                            <div>
                                @if ($invoice_booking->paymentStatus == 'y')
                                    <span class="badge bg-success">Đã thanh toán</span>
                                @else
                                    <span class="badge bg-primary">Chưa thanh toán</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
