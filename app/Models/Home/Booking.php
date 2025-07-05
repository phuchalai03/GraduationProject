<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'bookingId';
    public $timestamps = false;

    protected $fillable = [
        'tourId',
        'userId',
        'bookingDate',
        'numAdults',
        'numChildren',
        'totalPrice',
        'bookingStatus',
        'specialRequestes'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tourId', 'tourId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function checkout()
    {
        return $this->hasOne(Checkout::class, 'bookingId', 'bookingId');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'bookingId', 'bookingId');
    }
}
