<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminModel extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function getAdmin(){
        return DB::table($this->table)->where('role', 'admin')->first();
    }

    public function updateAdmin($data){
        return DB::table($this->table)
        ->where('role', 'admin')
        ->update($data);
    }
}
