<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotions';
    protected $primaryKey = 'promotionId';
    public $timestamps = false;

    protected $fillable = [
        'description',
        'discount',
        'startDate',
        'endDate',
        'quantity'
    ];
}
