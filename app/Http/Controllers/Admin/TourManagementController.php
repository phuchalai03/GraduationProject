<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TourModel;
use Illuminate\Http\Request;

class TourManagementController extends Controller
{
    private $tours;

    public function __construct()
    {
        $this->tours = new TourModel();
    }

    public function index(){
        $tours = $this->tours->getAllTours();
        return view('admin.tours', compact('tours'));
    }
}
