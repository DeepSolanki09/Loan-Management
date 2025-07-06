<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class AdminsExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    public function collection()
    {
        return User::select('id','name', 'email', 'phone_number', 'role','profile_pic')->where('role', 'Admin')->get();
    }

    public function headings(): array
    {
        return ["ID", "Name", "Email", "Phone Number", "Role","Profile Picture"];
    }

    public function map($admin): array
    {
        return [
            $admin->id,
            $admin->name,
            $admin->email,
            $admin->phone_number,
            $admin->role,
            $admin->profile_pic ? 'Image' : 'No Image',
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $admins = User::where('role', 'Admin')->get();

        foreach ($admins as $index => $admin) {
            if ($admin->profile_pic) {
                $drawing = new Drawing();
                $drawing->setName('Profile Picture');
                $drawing->setDescription('Admin Profile Picture');
                $drawing->setPath(public_path('storage/' . $admin->profile_pic)); // Image path
                $drawing->setHeight(50); // Set image height
                $drawing->setCoordinates('F' . ($index + 2)); // 'F' column (Profile Picture) + Row Number
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }
}
