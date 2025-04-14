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

    public function index(){
        $tours = $this->homeTours->getHomeTour();

        //dd($tours);
        return view('user.home', compact('tours'));
    }
}
