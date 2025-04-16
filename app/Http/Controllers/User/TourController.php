<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Clients\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    private $tours;

    public function __construct()
    {
        $this->tours = new Tour();
    }

    public function index(){
        $tours = $this->tours->getAllTours();
        return view('user.tour', compact('tours'));
    }

    public function tour_detail($id){
        $tourDetail = $this->tours->getTourDetail($id);
        return view('user.tour_detail', compact('tourDetail'));
    }
}
