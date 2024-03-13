<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = ['purchase', 'sales'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}
