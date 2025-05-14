<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
    use HasFactory;

    protected $table = 'tours';

    public function getHomeTour(){
        $tours = DB::table($this->table)->take(8)->get();

        foreach ($tours as $tour){
            $tour->images =  DB::table('images')
                ->where('tourId', $tour->tourId)
                ->pluck('imgURL');

            $tour->timeline =  DB::table('timeline')
                ->where('tourId', $tour->tourId)
                ->pluck('title');

            $toursModel = new Tour();
            $tour->rating = $toursModel->reviewStats($tour->tourId)->averageRating;
        }

        return $tours;
    }
}
