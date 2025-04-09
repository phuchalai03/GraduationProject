<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;

    protected $table = 'timeline';
    protected $primaryKey = 'timelineId';
    public $timestamps = false;

    protected $fillable = [
        'tourId',
        'title',
        'description'
    ];

    public function tour(){
        return $this->belongsTo(Tour::class, 'tourId', 'tourId');
    }
}
