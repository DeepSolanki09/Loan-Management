<?php

namespace App\Exports;

use App\Models\UserMessage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserMessagesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return UserMessage::select('id','name', 'email', 'subject', 'message')->get();
    }

    public function headings(): array
    {
        return ["ID", "Name", "Email", "Subject", "Message"];
    }
}
