<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;
    protected $table = 'loans'; // Ensure it maps to the correct table
    protected $primaryKey = 'loan_id'; 

    protected $fillable = [
        'loan_id',
        'name',
        'email',
        'phone_number',
        'loan_type',
        'bank_name',
        'applied_from_account',
        'status'
    ];

}
