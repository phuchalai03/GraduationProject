<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $table = 'checkouts';
    protected $primaryKey = 'checkoutId';
    public $timestamps = false;

    protected $fillable = [
        'bookingId',
        'paymentMethod',
        'paymentDate',
        'amount',
        'paymentStatus',
        'transactionId'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'bookingId', 'bookingId');
    }
}
