<?php

namespace App\Models;

use App\Enums\OperationStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'status' => OperationStatusEnum::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function originBank()
    {
        return $this->belongsTo(Bank::class, 'origin_bank');
    }

    public function destinationBank()
    {
        return $this->belongsTo(Bank::class, 'destination_bank');
    }
}
