<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';

    public function getAllTours(){

        $allTours = DB::table($this->table)->get();
        foreach ($allTours as $tour){
            $tour->images =  DB::table('images')
                ->where('tourId', $tour->tourId)
                ->pluck('imgURL');
        }
        return $allTours;
    }

    public function getTourDetail($id){
        $getTourDetail = DB::table($this->table)
        ->where('tourId', $id)
        ->get();

        foreach ($getTourDetail as $tour){
            $tour->images =  DB::table('images')
                ->where('tourId', $tour->tourId)
                ->limit(2)
                ->pluck('imgURL');

            $tour->timeline =  DB::table('timeline')
                ->where('tourId', $tour->tourId)
                ->pluck('title');
        }

        return $getTourDetail;
    }

    public function getDomain(){
        return DB::table($this->table)
            ->select('domain', DB::raw('count(*) as count'))
            ->whereIn('domain', ['b', 't', 'n'])
            ->groupBy('domain')
            ->get();
    }

    public function filterTours($filters =[], )
    {
        $getTours = DB::table($this->table);

        if (!empty($filters)){
            foreach ($filters as $filter) {
                if (count($filter) === 4) {
                    $getTours = $getTours->where($filter[0], $filter[1], $filter[2], $filter[3]);
                }
            }
            $getTours = $getTours->where($filters);
        }
        $tours = $getTours->get();

        foreach ($tours as $tour){
            $tour->images =  DB::table('images')
                ->where('tourId', $tour->tourId)
                ->pluck('imgURL');
        }
        return $tours;
    }
}
