<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $admin;

    public function __construct()
    {
        $this->admin = new AdminModel();
    }

    public function index()
    {
        $admin = $this->admin->getAdmin();
        //dd($admin);
        return view('admin.profile-admin', compact('admin'));
    }

    public function updateAdmin(Request $request)
    {
        $fullName = $request->fullName;
        $password = $request->password;
        $email = $request->email;
        $address = $request->address;

        $admin = $this->admin->getAdmin();
        $oldPass = $admin->password;

        if ($password != $oldPass) {
            $password = bcrypt($password);
        }
        
        $dataUpdate = [
            'fullName' => $fullName,
            'password' => $password,
            'email' => $email,
            'address' => $address
        ];
        $update = $this->admin->updateAdmin($dataUpdate);
        $newinfo = $this->admin->getAdmin();
        
        //dd($newinfo);
        if ($update) {
            return response()->json(
                [
                    'success' => true,
                    'data' => $newinfo
                ]
            );
        } else {
            return response()->json(['success' => false, 'message' => 'Không có thông tin nào thay đổi!']);
        }
    }

    public function updateAvatar(Request $req)
    {
        $avatar = $req->file('avatar');
        $filename = 'avt_admin.jpg';
        unlink(public_path('storage/images/avatars/avt_admin.jpg'));

        // Di chuyển ảnh vào thư mục public/admin/assets/images/user-profile/
        $update = $avatar->move(public_path('storage/images/avatars/'), $filename);
        if (!$update) {
            return response()->json(['error' => true, 'message' => 'Có vấn đề khi cập nhật ảnh!']);
        }
        return response()->json(['success' => true, 'message' => 'Cập nhật ảnh thành công!']);
    }
}
