<?php

namespace App\Models;

use App\Enums\IdentityDocumentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccount extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    public function getIdentityDocumentStatusAttribute(): IdentityDocumentStatusEnum
    {
        return IdentityDocumentStatusEnum::getSelfById($this->document_type);
    }
}
