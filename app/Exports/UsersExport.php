<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    public function collection()
    {
        return User::select('id','name', 'email', 'phone_number', 'role','profile_pic')->where('role', 'User')->get();
    }

    public function headings(): array
    {
        return ["ID","Name", "Email", "Phone Number", "Role","Profile Picture"];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->phone_number,
            $user->role,
            $user->profile_pic ? 'Image' : 'No Image',
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $users = User::where('role', 'User')->get();

        foreach ($users as $index => $user) {
            if ($user->profile_pic) {
                $drawing = new Drawing();
                $drawing->setName('Profile Picture');
                $drawing->setDescription('User Profile Picture');
                $drawing->setPath(public_path('storage/' . $user->profile_pic)); // Image path
                $drawing->setHeight(50); // Set image height
                $drawing->setCoordinates('F' . ($index + 2)); // 'F' column (Profile Picture) + Row Number
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }
}
