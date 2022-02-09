<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'credit_card_number',
        'expiration_date',
        'cvv_code',
        'credit_card_name',
        'atm_card_number',
        'bank_name',
        'atm_card_name',
    ];
}
