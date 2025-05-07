<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Checkout extends Model
{
    use HasFactory;
    protected $table = 'checkouts';

    public function createCheckout($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }
}
