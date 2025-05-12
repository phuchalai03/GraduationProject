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
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Thao tác
                </button>
                <ul class="dropdown-menu">
                    @if ($booking->bookingStatus == 'b')
                        <li>
                            <a class="dropdown-item confirm-booking" href="javascript:void(0)"
                                data-bookingid="{{ $booking->bookingId }}" data-urlconfirm="{{ route('admin.confirm-booking') }}">
                                <i class="fa fa-check text-success me-2"></i> Xác
                                nhận
                            </a>
                        </li>
                    @endif
                    @if ($booking->paymentStatus == 'n' && $booking->bookingStatus != 'c')
                        <li>
                            <a class="dropdown-item confirm-checkout" href="javascript:void(0)"
                                data-bookingid="{{ $booking->bookingId }}" data-urlconfirm-checkout="{{ route('admin.confirm-checkout') }}">
                                <i class="fa fa-check text-success me-2"></i> Xác
                                nhận thanh toán
                            </a>
                        </li>
                    @endif
                    @if ($booking->bookingStatus == 'y')
                        <li>
                            <a class="dropdown-item finish-booking " href="javascript:void(0)"
                                data-bookingid="{{ $booking->bookingId }}" data-urlfinish="{{ route('admin.finish-booking') }}">
                                <i class="fa fa-flag-checkered text-info me-2"></i>
                                Đã hoàn thành
                            </a>
                        </li>
                    @endif
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.booking-detail',['id' => $booking->bookingId]) }}">
                            <i class="fa fa-eye text-primary me-2"></i> Xem chi tiết
                        </a>
                    </li>
                    @if ($booking->bookingStatus == 'c')
                        <li>
                            <a class="dropdown-item delete-booking" href="javascript:void(0)"
                                data-bookingid="{{ $booking->bookingId }}" data-urldelete="{{ route('admin.delete-booking') }}">
                                <i class="fa fa-trash text-danger me-2"></i> Xóa
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </td>
    </tr>
@endforeach
