<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function getAllUsers()
    {
        return DB::table($this->table)
            ->where('role', 'user')
            ->get();
    }

    public function deleteUser($id)
    {
        return DB::table($this->table)
            ->where('id', $id)
            ->delete();
    }
}
