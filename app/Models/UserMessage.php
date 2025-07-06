<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'applied_from_account'
    ];
}
