<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';

    public function getAllTours($perPage = 9){

        $allTours = DB::table($this->table)->paginate($perPage);
        foreach ($allTours as $tour){
            $tour->images =  DB::table('images')
                ->where('tourId', $tour->tourId)
                ->pluck('imgURL');
            $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
        }
        return $allTours;
    }

    public function getTourDetail($id){
        $getTourDetail = DB::table($this->table)
        ->where('tourId', $id)
        ->first();

        if ($getTourDetail) {
            // Lấy danh sách hình ảnh thuộc về tour
            $getTourDetail->images = DB::table('images')
                ->where('tourId', $getTourDetail->tourId)
                ->limit(5)
                ->pluck('imgURL');

            // Lấy danh sách timeline thuộc về tour
            $getTourDetail->timeline = DB::table('timeline')
                ->where('tourId', $getTourDetail->tourId)
                ->get();
        }

        return $getTourDetail;
    }

    public function getDomain(){
        return DB::table($this->table)
            ->select('domain', DB::raw('count(*) as count'))
            ->whereIn('domain', ['b', 't', 'n'])
            ->groupBy('domain')
            ->get();
    }

    public function filterTours($filters =[], $sorting = [], $perPage = null)
    {
        //Chưa xử lý lọc theo đánh giá
        $getTours = DB::table($this->table);

        if (!empty($filters)){
            $getTours = $getTours->where($filters);
        }
        if (!empty($sorting) && isset($sorting[0][0]) && isset($sorting[0][1])){
            $getTours = $getTours->orderBy($sorting[0][0], $sorting[0][1]);
        }

        $tours = $getTours->paginate($perPage);

        foreach ($tours as $tour){
            $tour->images =  DB::table('images')
                ->where('tourId', $tour->tourId)
                ->pluck('imgURL');
            $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
        }
        return $tours;
    }

    public function updateTours($id, $data)
    {
        return DB::table($this->table)
            ->where('tourId', $id)
            ->update($data);
    }

    public function tourBooked($bookingId, $checkoutId)
    {
        $booked = DB::table($this->table)
            ->join('bookings', 'tours.tourId', '=', 'bookings.tourId')
            ->join('checkouts', 'bookings.bookingId', '=', 'checkouts.bookingId')
            ->where('bookings.bookingId', '=', $bookingId)
            ->where('checkouts.checkoutId', '=', $checkoutId)
            ->first();

        return $booked;
    }

     //Tạo đánh giá về tours
     public function createReviews($data)
     {
         return DB::table('reviews')->insert($data);
     }
 
     //Lấy danh sách nội dung reviews 
     public function getReviews($id)
     {
         $getReviews = DB::table('reviews')
             ->join('users', 'users.id', '=', 'reviews.userId')
             ->where('tourId', $id)
             ->orderBy('reviews.created_at', 'desc')
             ->take(3)
             ->get();
 
         return $getReviews;
     }
 
     //Lấy số lượng đánh giá và số sao trung bình của tour
     public function reviewStats($id)
     {
         $reviewStats = DB::table('reviews')
             ->where('tourId', $id)
             ->selectRaw('AVG(rating) as averageRating, COUNT(*) as reviewCount')
             ->first();
 
         return $reviewStats;
     }
 
     //Kiểm tra xem người dùng đã đánh giá tour này hay chưa?
 
     public function checkReviewExist($tourId, $userId)
     {
         return DB::table('reviews')
             ->where('tourId', $tourId)
             ->where('userId', $userId)
             ->exists(); // Trả về true nếu bản ghi tồn tại, false nếu không tồn tại
     }
 
     //Search tours
     public function searchTours($data)
     {
         $tours = DB::table($this->table);
 
 
         // Thêm điều kiện cho destination với LIKE
         if (!empty($data['destination'])) {
             $tours->where('destination', 'LIKE', '%' . $data['destination'] . '%');
         }
 
         // Thêm điều kiện cho startDate và endDate nếu cần so sánh
         if (!empty($data['startDate'])) {
             $tours->whereDate('startDate', '>=', $data['startDate']);
         }
         if (!empty($data['endDate'])) {
             $tours->whereDate('endDate', '<=', $data['endDate']);
         }
 
         // Thêm điều kiện tìm kiếm với LIKE cho title, time và description
         if (!empty($data['keyword'])) {
             $tours->where(function ($query) use ($data) {
                 $query->where('title', 'LIKE', '%' . $data['keyword'] . '%')
                     ->orWhere('description', 'LIKE', '%' . $data['keyword'] . '%')
                     ->orWhere('time', 'LIKE', '%' . $data['keyword'] . '%')
                     ->orWhere('destination', 'LIKE', '%' . $data['keyword'] . '%');
             });
         }
 
         //$tours = $tours->where('availability', 1);
         $tours = $tours->limit(12)->get();
 
         foreach ($tours as $tour) {
             // Lấy danh sách hình ảnh thuộc về tour
             $tour->images = DB::table('images')
                 ->where('tourId', $tour->tourId)
                 ->pluck('imgURL');
             // Lấy số lượng đánh giá và số sao trung bình của tour
             $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
         }
         return $tours;
     }
 
     //Get tours recommendation
     public function toursRecommendation($ids)
     {
 
         if (empty($ids)) {
             // Return an empty collection to avoid executing the query with an empty `FIELD` clause
             return collect();
         }
 
         $toursRecom = DB::table($this->table)
             ->where('availability', '1')
             ->whereIn('tourId', $ids)
             ->orderByRaw("FIELD(tourId, " . implode(',', array_map('intval', $ids)) . ")") // Chuyển tất cả các giá trị sang kiểu int và giữ thứ tự
             ->get();
         foreach ($toursRecom as $tour) {
             // Lấy danh sách hình ảnh thuộc về tour
             $tour->images = DB::table('images')
                 ->where('tourId', $tour->tourId)
                 ->pluck('imgURL');
             // Lấy số lượng đánh giá và số sao trung bình của tour
             $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
         }
 
         return $toursRecom;
     }
 
     //Get tour có số lượng booking và hoàn thành nhiều nhất để gợi ý
     public function toursPopular($quantity)
     {
         $toursPopular = DB::table('bookings')
             ->select(
                 'tours.tourId',
                 'tours.title',
                 'tours.description',
                 'tours.priceAdult',
                 'tours.priceChild',
                 'tours.duration',
                 'tours.destination',
                 'tours.quantity',
                 DB::raw('COUNT(bookings.tourId) as totalBookings')
             )
             ->join('tours', 'bookings.tourId', '=', 'tours.tourId')
             ->where('bookings.bookingStatus', 'f') // Chỉ lấy các booking đã hoàn thành
             ->groupBy(
                 'tours.tourId',
                 'tours.title',
                 'tours.description',
                 'tours.priceAdult',
                 'tours.priceChild',
                 'tours.duration',
                 'tours.destination',
                 'tours.quantity'
             )
             ->orderBy('totalBookings', 'DESC')
             ->take($quantity)
             ->get();
 
 
         foreach ($toursPopular as $tour) {
             // Lấy danh sách hình ảnh thuộc về tour
             $tour->images = DB::table('images')
                 ->where('tourId', $tour->tourId)
                 ->pluck('imgURL');
             // Lấy số lượng đánh giá và số sao trung bình của tour
             $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
         }
         return $toursPopular;
     }
 
     //Get id search tours
     public function toursSearch($ids)
     {
 
         if (empty($ids)) {
             // Return an empty collection to avoid executing the query with an empty `FIELD` clause
             return collect();
         }
 
         $tourSearch = DB::table($this->table)
             ->where('availability', '1')
             ->whereIn('tourId', $ids)
             ->orderByRaw("FIELD(tourId, " . implode(',', array_map('intval', $ids)) . ")") // Chuyển tất cả các giá trị sang kiểu int và giữ thứ tự
             ->get();
         foreach ($tourSearch as $tour) {
             // Lấy danh sách hình ảnh thuộc về tour
             $tour->images = DB::table('images')
                 ->where('tourId', $tour->tourId)
                 ->pluck('imgURL');
             // Lấy số lượng đánh giá và số sao trung bình của tour
             $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
         }
 
         return $tourSearch;
     }
}
