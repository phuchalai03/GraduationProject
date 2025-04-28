<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Clients\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserProfile();
    }

    public function index(){
        $id = auth()->user()->id;
        $user = $this->user->getUser($id);
        //dd($user);
        return view('user.user_profile', compact('user'));
    }
}
