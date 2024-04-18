<?php

namespace App\Models;

use App\Enums\IdentityDocumentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalRepresentative extends Model
{
    use HasFactory;

    public function getIdentityDocumentStatusAttribute(): IdentityDocumentStatusEnum
    {
        return IdentityDocumentStatusEnum::getSelfById($this->document_type);
    }
}
