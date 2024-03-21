<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ComplaintBook extends Model
{
    use HasFactory;
    use Notifiable;

    protected $guarded = ['created_at', 'updated_at'];
}
