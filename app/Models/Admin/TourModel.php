<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TourModel extends Model
{
    use HasFactory;

    protected $table = 'tours';

    public function getAllTours()
    {
        return DB::table($this->table)
            ->orderBy('tourId', 'DESC')
            ->get();
    }

    public function createTours($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }

    public function uploadImages($data)
    {
        return DB::table('images')->insert($data);
    }

    public function addTimeLine($data)
    {
        return DB::table('timeline')->insert($data);
    }

    public function updateTimeline($timelineId, $data)
    {
        return DB::table('timeline')
            ->where('timelineId', $timelineId)
            ->update($data);
    }

    public function deleteTimelineById($timelineId)
    {
        return DB::table('timeline')->where('timelineId', $timelineId)->delete();
    }

    public function deleteImageById($imageId)
    {
        return DB::table('images')->where('imageId', $imageId)->delete();
    }
    
    public function updateTour($tourId, $data)
    {
        $updated = DB::table($this->table)
            ->where('tourId', $tourId)
            ->update($data);

        return $updated;
    }

    public function deleteTour($tourId)
    {
        return DB::table($this->table)->where('tourId', $tourId)->delete();
    }

    public function deleteTimeline($tourId)
    {
        return DB::table('timeline')->where('tourId', $tourId)->delete();
    }

    public function deleteImage($tourId)
    {
        return DB::table('images')->where('tourId', $tourId)->delete();
    }

    public function getTour($tourId)
    {
        return DB::table($this->table)->where('tourId', $tourId)->first();
    }

    public function getImages($tourId)
    {
        return DB::table('images')->where('tourId', $tourId)->get();
    }

    public function getTimeLine($tourId)
    {
        return DB::table('timeline')->where('tourId', $tourId)->get();
    }
}
