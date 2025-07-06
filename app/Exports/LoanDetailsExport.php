<?php

namespace App\Exports;

use App\Models\LoanDetails;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class LoanDetailsExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    public function collection()
    {
        return LoanDetails::select('loan_id','bank_name', 'loan_type', 'interest_rate', 'loan_tenure',"bank_logo")->get();
    }

    public function headings(): array
    {
        return ["Loan ID","Bank Name", "Loan Type", "Interest Rate", "Loan Tenure","Bank Logo"];
    }

    public function map($loandetail): array
    {
        return [
            $loandetail->loan_id,
            $loandetail->bank_name,
            $loandetail->loan_type,
            $loandetail->interest_rate,
            $loandetail->loan_tenure,
            $loandetail->bank_logo ? 'Image' : 'No Image',
        ];
    }   
    
    public function drawings()
    {
        $drawings = [];
        $loandetails = LoanDetails::all();

        foreach ($loandetails as $index => $loandetail) {
            if ($loandetail->bank_logo) {
                $drawing = new Drawing();
                $drawing->setName('Bank Logo');
                $drawing->setDescription('Bank Logo');
                $drawing->setPath(public_path('storage/' . $loandetail->bank_logo)); // Image path
                $drawing->setHeight(50); // Set image height
                $drawing->setCoordinates('F' . ($index + 2)); // 'F' column (Profile Picture) + Row Number
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }
}
