<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'password',
        'email',
        'role',
        'phoneNumber',
        'address',
        'ipAddress',
        'isActive',
        'status',
        'createdDate',
        'updatedDate'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'userId', 'id');
    }

    public function history()
    {
        return $this->hasMany(History::class, 'userId', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'userId', 'id');
    }
}
