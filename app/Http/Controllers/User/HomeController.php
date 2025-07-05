<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Clients\Home;
use App\Models\Clients\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    private $homeTours;
    private $tours;

    public function __construct()
    {
        $this->homeTours = new Home();
        $this->tours = new Tour();
    }

    public function index(){
        $tours = $this->homeTours->getHomeTour();

        $userId = auth()->user()->id;

        if ($userId) {
            
            // Gọi API Python để lấy danh sách tour được gợi ý cho từng người dùng 
            try {
                $apiUrl = 'http://127.0.0.1:5555/api/user-recommendations';
                $response = Http::get($apiUrl, [
                    'user_id' => $userId
                ]);

                if ($response->successful()) {
                    $tourIds = $response->json('recommended_tours');
                } else {
                    $tourIds = [];
                }
            } catch (\Exception $e) {
                // Xử lý lỗi khi gọi API
                $tourIds = [];
                Log::error('Lỗi khi gọi API liên quan: ' . $e->getMessage());
            }
            $toursPopular = $this->tours->toursRecommendation($tourIds);

            if (empty($tourIds)) {
                $toursPopular = $this->tours->toursPopular(8);
                
            }

        }else {
            $toursPopular = $this->tours->toursPopular(8);
        }

        //dd($tours);
        return view('user.home', compact('tours', 'toursPopular'));
    }
}
