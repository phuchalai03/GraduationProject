<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';

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
}
