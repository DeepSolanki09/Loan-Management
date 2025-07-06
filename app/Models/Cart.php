<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','loan_id','loan_type','interest_rate', 'loan_tenure','bank_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
