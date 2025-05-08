<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Clients\Tour;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    protected $tours;
    public function __construct()
    {
        $this->tours = new Tour();
    }

    public function index(){
        $title = 'Điểm đến';
        $tours = $this->tours->getAllTours(9);
        //dd($tours);
        return view('user.destination', compact('tours', 'title'));
    }
}
