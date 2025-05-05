<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserProfile extends Model
{
    use HasFactory;
    protected $table = 'users';

    public function getUser($id)
    {
        $users = DB::table($this->table)
            ->where('id', $id)
            ->get();
        
        return $users;
    }

    public function updateUser($id, $data)
    {
        $update = DB::table($this->table)
            ->where('id', $id)
            ->update($data);

        return $update;
    }
}
