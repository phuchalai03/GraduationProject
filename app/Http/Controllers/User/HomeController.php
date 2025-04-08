<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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
        return view('user.home');
    }

    public function tour(){
        return view('user.tour');
    }

    public function tour_guide(){
        return view('user.tour_guide');
    }
}
