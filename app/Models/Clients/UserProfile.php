<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserProfile extends Model
{
    use HasFactory;
    protected $table = 'users';

    public function getUser($id)
    {
        $users = DB::table($this->table)
            ->where('id', $id)
            ->get();
        
        return $users;
    }

    public function updateUser($id, $data)
    {
        $update = DB::table($this->table)
            ->where('id', $id)
            ->update($data);

        return $update;
    }

    public function getMyTours($id)
    {
        $myTours =  DB::table('bookings')
        ->join('tours', 'bookings.tourId', '=', 'tours.tourId')
        ->join('checkouts', 'bookings.bookingId', '=', 'checkouts.bookingId')
        ->where('bookings.userId', $id)
        ->orderByDesc('bookings.bookingDate')
        // ->take(3)
        ->get();

        foreach ($myTours as $tour) {
            // Lấy rating từ tbl_reviews cho mỗi tour
            $tour->rating = DB::table('reviews')
                ->where('tourId', $tour->tourId)
                ->where('userId', $id)
                ->value('rating'); // Dùng value() để lấy giá trị rating
        }
        foreach ($myTours as $tour) {
            // Lấy danh sách hình ảnh thuộc về tour
            $tour->images = DB::table('images')
                ->where('tourId', $tour->tourId)
                ->pluck('imgURL');
        }

        return $myTours;
    }
}
