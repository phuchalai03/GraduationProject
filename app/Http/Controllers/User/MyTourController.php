<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Clients\Tour;
use App\Models\Clients\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MyTourController extends Controller
{
    protected $tours;
    protected $user;

    public function __construct()
    {
        $this->tours = new Tour();
        $this->user = new UserProfile();
    }
    
    public function index()
    {
        $title = 'Tours đã đặt';
        $userId = auth()->user()->id;
        
        $myTours = $this->user->getMyTours($userId);
        //$userId = $this->getUserId();
        // if ($userId) {
        //     // Gọi API Python để lấy danh sách tour được gợi ý cho từng người dùng 
        //     try {
        //         $apiUrl = 'http://127.0.0.1:5555/api/user-recommendations';
        //         $response = Http::get($apiUrl, [
        //             'user_id' => $userId
        //         ]);

        //         if ($response->successful()) {
        //             $tourIds = $response->json('recommended_tours');
        //             $tourIds = array_slice($tourIds, 0, 2);
        //         } else {
        //             $tourIds = [];
        //         }
        //     } catch (\Exception $e) {
        //         // Xử lý lỗi khi gọi API
        //         $tourIds = [];
        //         Log::error('Lỗi khi gọi API liên quan: ' . $e->getMessage());
        //     }

        //     $toursPopular = $this->tours->toursRecommendation($tourIds);
        //     // dd($toursPopular);
        // }else {
        //     $toursPopular = $this->tours->toursPopular(6);
        // }
        $toursPopular = $this->tours->toursPopular(6);
        return view('user.my-tours', compact('title', 'myTours','toursPopular'));
    }
}
