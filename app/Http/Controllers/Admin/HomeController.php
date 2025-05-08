<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DashboardModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $dashboard;

    public function __construct()
    {
        $this->dashboard = new DashboardModel();
    }

    public function index(){
        $summary = $this->dashboard->getSummary();
        $valueTour = $this->dashboard->getValueDomain();
        $dataDomain = [
            'values' => [
                $valueTour['b'] ?? 0,
                $valueTour['t'] ?? 0,
                $valueTour['n'] ?? 0,
            ]
        ];

        $paymentStatus = $this->dashboard->getValuePayment();

        $toursBooked = $this->dashboard->getMostTourBooked();
        $newBooking = $this->dashboard->getNewBooking();
        $revenue = $this->dashboard->getRevenuePerMonth();
        $transaction = $this->dashboard->getHistoryTransaction();
        // dd($revenue);
        //dd($summary);
        //dd($transaction);
        return view('admin.home', compact('summary', 'dataDomain', 'paymentStatus','toursBooked','newBooking','revenue','transaction'));
    }
}
