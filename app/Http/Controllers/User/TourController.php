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

    public function tourList(){
        return view('user.tour');
    }

    public function index($id){

        $tourDetail = $this->tours->getTourDetail($id);
        //dd($tourDetail);
        return view('user.tour_detail', compact('tourDetail'));
    }

    public function tour_detail(){

    }
}
