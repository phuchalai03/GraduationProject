<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class ContactController extends Controller
{
    public function index(){
        return view('user.contact');
    }

    public function createContact(Request $req){
        $name = $req->name;
        $phone = $req->phone_number;
        $email = $req->email;
        $message = $req->message;

        $dataContact = [
            'fullName'    => $name,
            'phoneNumber' => $phone,
            'email'       => $email,
            'message'     => $message
        ];

        $createContact = DB::table('contact')->insert($dataContact); 

        if($createContact){
            alert('Gửi thành công. Chúng tôi sẽ sớm liên hệ tới bạn!');
        }else{
            alert('Có lỗi xảy ra. Xin vui lòng thử lại');
        }
        return redirect()->back();

    }
}
