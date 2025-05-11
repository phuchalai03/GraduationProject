<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BookingModel;
use Illuminate\Http\Request;

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

}
