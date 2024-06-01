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
}
