<?php

namespace App\Models;

use App\Enums\BankAccountTypeEnum;
use App\Enums\CurrencyTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected $casts = [
        'bank_account_type' => BankAccountTypeEnum::class,
        'currency_type' => CurrencyTypeEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }
}
