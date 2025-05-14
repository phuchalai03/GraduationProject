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

    public function index(Request $request){
        $tours = $this->tours->getAllTours(9);
        $domain = $this->tours->getDomain();
        $domain_count = [
            'mien_bac' => optional($domain->firstWhere('domain', 'b'))->count,
            'mien_trung' => optional($domain->firstWhere('domain', 't'))->count,
            'mien_nam' => optional($domain->firstWhere('domain', 'n'))->count,
        ];
        if ($request->ajax()) {
            return response()->json([
                'tours' => view('user.filter_tour', compact('tours'))->render(),
            ]);
        }
        $toursPopular = $this->tours->toursPopular(2);
        return view('user.tour', compact('tours', 'domain_count', 'toursPopular'));
    }

    public function tour_detail($id){
        $tourDetail = $this->tours->getTourDetail($id);
        return view('user.tour_detail', compact('tourDetail'));
    }

    public function filterTours(Request $request)
    {
        $conditions = [];
        $sorting = [];
        if ($request->filled('min_price')) {
            $min_price = $request->input('min_price');
            $conditions[] = ['priceAdult', '>=', $min_price];
        }

        if ($request->filled('max_price')) {
            $max_price = $request->input('max_price');
            $conditions[] = ['priceAdult', '<=', $max_price];
        }

        if ($request->filled('domain')){
            $domain = $request->domain;
            $conditions[] = ['domain', '=', $domain];
        }

        if ($request->filled('star')){
            $star = (int) $request->star;
            $conditions[] = ['averageRating', '>=', $star];
        }

        if ($request->filled('duration')){
            $time = $request->duration;
            $duration = [
                '2n1d' => '2 ngày 1 đêm',
                '3n2d' => '3 ngày 2 đêm',
                '3n' => '3 ngày',
            ];
            $conditions[] = ['duration', '=', $duration[$time]];
        }

        if ($request->filled('sorting')){
            $sortingOption = trim($request->sorting);

            if ($sortingOption == "high-to-low") {
                $sorting[] = ['priceAdult', 'desc'];
            } elseif ($sortingOption == "low-to-high") {
                $sorting[] = ['priceAdult', 'asc'];
            }
        }

        $tours = $this->tours->filterTours($conditions, $sorting, 9);
        return view('user.filter_tour', compact('tours'));
    }
}
