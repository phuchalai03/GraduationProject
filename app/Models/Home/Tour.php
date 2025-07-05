<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';
    protected $primaryKey = 'tourId';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'images',
        'quantity',
        'priceAdult',
        'priceChild',
        'duration',
        'destination',
        'availability',
        'itinerary',
        'reviews',
        'startDate',
        'endDate'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'tourId', 'tourId');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'tourId', 'tourId');
    }

    public function history()
    {
        return $this->hasMany(History::class, 'tourId', 'tourId');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'tourId', 'tourId');
    }

    public function timeline()
    {
        return $this->hasOne(Timeline::class, 'tourId', 'tourId');
    }
}
