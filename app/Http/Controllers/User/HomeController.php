<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Clients\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $homeTours;

    public function __construct()
    {
        $this->homeTours = new Home();
    }


    public function about(){
        return view('user.about');
    }

    public function contact(){
        return view('user.contact');
    }

    public function destination(){
        return view('user.destination');
    }

    public function index(){
        $tours = $this->homeTours->getHomeTour();

        dd($tours);
        return view('user.home');
    }

    public function tour(){
        return view('user.tour');
    }

    public function tour_guide(){
        return view('user.tour_guide');
    }
}
