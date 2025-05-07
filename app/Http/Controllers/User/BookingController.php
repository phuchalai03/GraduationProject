<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Clients\Booking;
use App\Models\Clients\Checkout;
use App\Models\Clients\Tour;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class BookingController extends Controller
{
    private $tour;
    private $booking;
    private $checkout;

    public function __construct()
    {
        $this->tour = new Tour();
        $this->booking = new Booking();
        $this->checkout = new Checkout();
    }

    public function index($id)
    {
        $tour = $this->tour->getTourDetail($id);
        return view('user.booking', compact('tour'));
    }

    public function createBooking(Request $req)
    {
        $address = $req->input('address');
        $email = $req->input('email');
        $fullName = $req->input('fullName');
        $numAdults = $req->input('numAdults');
        $numChildren = $req->input('numChildren');
        $paymentMethod = $req->input('payment_hidden');
        $tel = $req->input('tel');
        $totalPrice = $req->input('totalPrice');
        $tourId = $req->input('tourId');
        $userId = auth()->user()->id;
        /**
         * Xử lý booking và checkout
         */
        $dataBooking = [
            'tourId' => $tourId,
            'userId' => $userId,
            'address' => $address,
            'fullName' => $fullName,
            'email' => $email,
            'numAdults' => $numAdults,
            'numChildren' => $numChildren,
            'phoneNumber' => $tel,
            'totalPrice' => $totalPrice
        ];

        $bookingId = $this->booking->createBooking($dataBooking);

        $dataCheckout = [
            'bookingId' => $bookingId,
            'paymentMethod' => $paymentMethod,
            'amount' => $totalPrice,
            'paymentStatus' => ($paymentMethod === 'paypal-payment' || $paymentMethod === 'momo-payment') ? 'y' : 'n',
        ];

        if ($paymentMethod === 'paypal-payment') {
            $dataCheckout['transactionId'] = $req->transactionIdPaypal;
        } elseif ($paymentMethod === 'momo-payment') {
            $dataCheckout['transactionId'] = $req->transactionIdMomo;
        }
        $checkoutId = $this->checkout->createCheckout($dataCheckout);

        if (empty($bookingId) && !$checkoutId) {
            alert('Có vấn đề khi đặt tour!');
            return redirect()->back();
        }

        /**
         * Update quantity mới cho tour đó, trừ số lượng
         */
        $tour = $this->tour->getTourDetail($tourId);
        $dataUpdate = [
            'quantity' => $tour[0]->quantity - ($numAdults + $numChildren)
        ];

        $updateQuantity = $this->tour->updateTours($tourId, $dataUpdate);

        /******************************* */

        alert('Đặt tour thành công!');
        return redirect()->route('tour-booked', [
            'bookingId' => $bookingId,
            'checkoutId' => $checkoutId,
        ]);

    }
}
