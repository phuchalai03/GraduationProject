<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ContactModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactManagementController extends Controller
{
    protected $contact;

    public function __construct()
    {
        $this->contact = new ContactModel();
    }
    public function index()
    {
        $contacts = $this->contact->getContacts();

        return view('admin.contact', compact('contacts'));
    }

    public function replyContact(Request $request)
    {
        $contactId = $request->contactId;
        $emailReply = $request->email;
        $messageContent = $request->message;
        // Kiểm tra xem message có phải là chuỗi
        if (is_object($messageContent)) {
            $messageContent = (string) $messageContent; // Chuyển đối tượng thành chuỗi nếu cần
        }
        try {
            Mail::send('admin.reply-contact', compact('messageContent'), function ($message) use ($emailReply) {
                $message->to($emailReply)
                    ->subject('Phản hồi liên lệ của khách hàng');
            });
            // Cập nhật trạng thái
            $dataUpdate = [
                'isReply' => 'y'
            ];
            $this->contact->updateContact($contactId, $dataUpdate);

            return response()->json([
                'success' => true,
                'message' => 'Phản hồi qua email thành công.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể gửi email: ' . $e->getMessage(),
            ], 500);
        }
    }
}
