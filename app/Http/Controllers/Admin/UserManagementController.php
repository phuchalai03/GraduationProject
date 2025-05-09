<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\UserModel;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function index()
    {
        $users = $this->users->getAllUsers();

        foreach ($users as $user) {
            if (!$user->fullName) {
                $user->fullName = "Unnamed";
            }
            if (!$user->avatar) {
                $user->avatar = 'unnamed.png';
            }
        }
        return view('admin.user', compact('users'));
    }

    public function deleteUser(Request $request)
    {
        $id = $request->id;
        $delete = $this->users->deleteUser($id);
        if ($delete) {
            return redirect()->route('admin.users')->with('success', 'Xóa người dùng thành công!');
        } else {
            return redirect()->route('admin.users')->with('error', 'Xóa người dùng thất bại!');
        }
    }
}
