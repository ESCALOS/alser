<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_department_id',
        'bank_id',
        'bank_account_type',
        'currency_type',
        'account_number',
        'name',
        'is_onwer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
