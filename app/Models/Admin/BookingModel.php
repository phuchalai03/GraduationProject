<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookingModel extends Model
{
    use HasFactory;
    protected $table = 'bookings';

    public function getBooking(){

        $list_booking = DB::table($this->table)
        ->join('tours', 'tours.tourId', '=', 'bookings.tourId')
        ->join('checkouts', 'bookings.bookingId', '=', 'checkouts.bookingId')
        ->orderByDesc('bookingDate')
        ->get();

        return $list_booking;
    }

    public function updateBooking($bookingId, $data){
        return DB::table($this->table)
        ->where('bookingId',$bookingId)
        ->update($data);
    }

    public function deleteBooking($bookingId){
        return DB::table($this->table)
        ->where('bookingId',$bookingId)
        ->delete();
    }

    public function getInvoiceBooking($bookingId){

        $invoice = DB::table($this->table)
        ->join('tours', 'tours.tourId', '=', 'bookings.tourId')
        ->join('checkouts', 'bookings.bookingId', '=', 'checkouts.bookingId')
        ->where('bookings.bookingId', $bookingId)
        ->first();

        return $invoice;
    }

    public function updateCheckout($bookingId, $data){
        return DB::table('checkouts')
        ->where('bookingId',$bookingId)
        ->update($data);
    }
}
