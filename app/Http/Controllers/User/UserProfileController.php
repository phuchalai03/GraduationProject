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

    public function update(Request $request)
    {
        // $id = auth()->user()->id;
        // $data = $request->all();
        // $this->user->updateUser($id, $data);
        // return redirect()->route('user-profile')->with('success', 'Cập nhật thành công');
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
        //dd($update);
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công',
        ]);
    }

    public function changePassword(Request $request)
    {
        //$oldPass = bycrypt($request->oldPass);
        //$newPass = md5($request->newPass);

        $user = $this->user->getUser(auth()->user()->id);
        //dd($user[0]->password, $oldPass);
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
}
