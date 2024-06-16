<?php

namespace App\Models;

use App\Enums\OperationStatusEnum;
use App\Enums\TransactionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Operation extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'transaction_type' => TransactionTypeEnum::class,
        'status' => OperationStatusEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function originBank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'origin_bank');
    }

    public function destinationBank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'destination_bank');
    }

    public function numbers(): HasMany
    {
        return $this->hasMany(OperationNumber::class);
    }

    public function isUploaded(): bool
    {
        return $this->status === OperationStatusEnum::UPLOADED;
    }

    public function isPurchase(): bool
    {
        return $this->transaction_type === TransactionTypeEnum::PURCHASE;
    }

    public function isSale(): bool
    {
        return $this->transaction_type === TransactionTypeEnum::SALE;
    }
}
