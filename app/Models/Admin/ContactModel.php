<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContactModel extends Model
{
    use HasFactory;

    protected $table = 'contact';

    public function getContacts()
    {
        return DB::table($this->table)
            ->where('isReply', 'n')
            ->orderBy('contactId', 'desc')
            ->get();
    }

    public function updateContact($contactId, $data)
    {
        return DB::table($this->table)
            ->where('contactId', $contactId)
            ->update($data);
    }

    public function countContactsUnread()
    {
        $contacts = DB::table($this->table)
            ->where('isReply', 'n')
            ->orderBy('contactId', 'desc')
            ->get();

        $countUnread = $contacts->count();

        return [
            'countUnread' => $countUnread,
            'contacts' => $contacts
        ];
    }
}
