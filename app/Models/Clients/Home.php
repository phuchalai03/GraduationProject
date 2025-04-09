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
        $getTour = DB::table($this->table)
        ->leftJoin('images', 'tours.tourId', 'images.tourId')
        ->leftJoin('timeline', 'tours.tourId', 'timeline.tourId')
        ->get();

        return $getTour;
    }
}
