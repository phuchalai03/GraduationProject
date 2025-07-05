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

    public function index()
    {
        $id = auth()->user()->id;
        $user = $this->user->getUser($id);
        //dd($user);
        return view('user.user_profile', compact('user'));
    }

    public function update(Request $request)
    {
        $fullName = $request->fullName;
        $address = $request->address;
        $email = $request->email;
        $phone = $request->phone;

        $dataUpdate = [
            'fullName' => $fullName,
            'address' => $address,
            'email' => $email,
            'phoneNumber' => $phone,
        ];

        $update = $this->user->updateUser(auth()->user()->id, $dataUpdate);
        if (!$update) {
            return response()->json([
                'fail' => false,
                'message' => 'Cập nhật thất bại',
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công',
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = $this->user->getUser(auth()->user()->id);
        if (!password_verify($request->oldPass, $user[0]->password)) {
            return response()->json([
                'fail' => false,
                'message' => 'Mật khẩu cũ không đúng',
            ]);
        }
        $newPass = bcrypt($request->newPass);
        $dataPass = [
            'password' => $newPass,
        ];
        $update = $this->user->updateUser(auth()->user()->id, $dataPass);
        if (!$update) {
            return response()->json([
                'fail' => false,
                'message' => 'Cập nhật thất bại',
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công',
        ]);
    }

    public function changeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $file = $request->file('avatar');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $user = $this->user->getUser(auth()->user()->id);
        if ($user[0]->avatar) {
            $oldAvatarPath = public_path('storage/images/avatars/' . $user[0]->avatar);
            if (file_exists($oldAvatarPath)) {
                unlink($oldAvatarPath);
            }
        }

        $file->move(public_path('storage/images/avatars/'), $fileName);
        $dataAvatar = [
            'avatar' => $fileName,
        ];

        $update = $this->user->updateUser(auth()->user()->id, $dataAvatar);
        if (!$update) {
            return response()->json([
                'fail' => false,
                'message' => 'Cập nhật thất bại',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công',
        ]);
    }
}
