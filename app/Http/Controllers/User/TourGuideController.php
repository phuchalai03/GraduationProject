<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourGuideController extends Controller
{
    public function index(){
        return view('user.tour_guide');
    }
}
