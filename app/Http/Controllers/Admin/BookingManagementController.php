<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BookingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingManagementController extends Controller
{
    private $booking;

    public function __construct()
    {
        $this->booking = new BookingModel();
    }
    public function index()
    {
        $list_booking = $this->booking->getBooking();
        //$list_booking = $this->updateHideBooking($list_booking);

        // dd($list_booking);

        return view('admin.booking', compact('list_booking'));
    }

    public function confirmBooking(Request $request)
    {
        $bookingId = $request->bookingId;
        $dataConfirm = [
            'bookingStatus' => 'y'
        ];

        $result = $this->booking->updateBooking($bookingId, $dataConfirm);

        if ($result) {
            $list_booking = $this->booking->getBooking();
            //$list_booking = $this->updateHideBooking($list_booking);
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái thành công.',
                'data' => view('admin.list-booking', compact('list_booking'))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cập nhật thất bại.'
            ], 500);
        }
    }

    public function confirmCheckout(Request $request)
    {
        $bookingId = $request->bookingId;
        $dataConfirm = [
            'paymentStatus' => 'y'
        ];

        $result = $this->booking->updateCheckout($bookingId, $dataConfirm);

        if ($result) {
            $list_booking = $this->booking->getBooking();
            //$list_booking = $this->updateHideBooking($list_booking);
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái thành công.',
                'data' => view('admin.list-booking', compact('list_booking'))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cập nhật thất bại.'
            ], 500);
        }
    }

    public function finishBooking(Request $request)
    {
        $bookingId = $request->bookingId;

        $dataConfirm = [
            'bookingStatus' => 'f'
        ];

        $result = $this->booking->updateBooking($bookingId, $dataConfirm);

        if ($result) {
            $list_booking = $this->booking->getBooking();
            //$list_booking = $this->updateHideBooking($list_booking);
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái thành công.',
                'data' => view('admin.list-booking', compact('list_booking'))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cập nhật thất bại.'
            ], 500);
        }
    }

    public function deleteBooking(Request $request)
    {
        $bookingId = $request->bookingId;
        $result = $this->booking->deleteBooking($bookingId);

        if ($result) {
            $list_booking = $this->booking->getBooking();
            return response()->json([
                'success' => true,
                'message' => 'Xóa tour thành công.',
                'data' => view('admin.list-booking', compact('list_booking'))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Xóa thất bại thất bại.'
            ], 500);
        }
    }

    public function showDetail($bookingId)
    {

        $invoice_booking = $this->booking->getInvoiceBooking($bookingId);
        // dd($invoice_booking);
        // $hide = 'hide';
        if ($invoice_booking->transactionId == null) {
            $invoice_booking->transactionId = 'Thanh toán tại công ty Travela';
        }
        // if ($invoice_booking->paymentStatus === 'n') {
        //     $hide = '';
        // }
        return view('admin.booking-detail', compact('invoice_booking'));
    }

    public function sendPdf(Request $request)
    {
        $bookingId = $request->input('bookingId');
        $email = $request->input('email');
        $title = 'Hóa đơn';
        $invoice_booking = $this->booking->getInvoiceBooking($bookingId);

        if ($invoice_booking->transactionId == null) {
            $invoice_booking->transactionId = 'Thanh toán tại công ty Travela';
        }

        try {
            Mail::send('admin.invoice', compact('invoice_booking'), function ($message) use ($invoice_booking) {
                $message->to($invoice_booking->email)
                    ->subject('Hóa đơn đặt tour của khách hàng' . $invoice_booking->fullName);
            });

            return response()->json([
                'success' => true,
                'message' => 'Hóa đơn đã được gửi qua email thành công.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể gửi email: ' . $e->getMessage(),
            ], 500);
        }

    }
}
