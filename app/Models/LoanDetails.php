<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanDetails extends Model
{
    use HasFactory;

    protected $table = 'loan_details'; // Ensure it maps to the correct table
    protected $primaryKey = 'loan_id'; // If loan_id is the main identifier


    protected $fillable = [
        'loan_id',
        'bank_name',
        'loan_type',
        'interest_rate',
        'loan_tenure',
        'bank_logo',
    ];
}
