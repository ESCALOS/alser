<?php

namespace App\Models;

use App\Enums\DocumentTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ComplaintBook extends Model
{
    use HasFactory;
    use Notifiable;

    protected $guarded = ['created_at', 'updated_at'];

    public function getDocumentTypeEnumAttribute(): DocumentTypeEnum
    {
        return DocumentTypeEnum::getSelfById($this->document_type);
    }

    public function getFullnameAttribute(): string
    {
        return "{$this->name} {$this->last_name_father} {$this->last_name_mother}";
    }
}
