<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LoanApplicationsExport implements FromCollection  
{
    public function collection()
    {
        return Loan::select('loan_id','name', 'email', 'phone_number', 'loan_type', 'bank_name', 'status')->get();
    }

    public function headings(): array
    {
        return ["Loan ID","Name", "Email", "Phone Number", "Loan Type", "Bank Name", "Status"];
    }
}
