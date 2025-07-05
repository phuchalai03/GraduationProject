<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $primaryKey = 'invoiceId';
    public $timestamps = false;

    protected $fillable = [
        'bookingId',
        'amount',
        'dateIssued',
        'details'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'bookingId', 'bookingId');
    }
}
