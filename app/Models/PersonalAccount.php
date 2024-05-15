<?php

namespace App\Models;

use App\Enums\DocumentTypeEnum;
use App\Enums\IdentityDocumentStatusEnum;
use App\Enums\PdfPEPStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalAccount extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'document_type' => DocumentTypeEnum::class,
        'identity_document_status' => IdentityDocumentStatusEnum::class,
        'pdf_PEP_status' => PdfPEPStatusEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isIdentityDocumentRequired(): bool
    {
        return $this->identity_document_status === IdentityDocumentStatusEnum::PENDING || $this->identity_document_status === IdentityDocumentStatusEnum::REJECTED;
    }

    public function isPdfPEPRequired(): bool
    {
        return $this->pdf_PEP_status === PdfPEPStatusEnum::PENDING || $this->pdf_PEP_status === PdfPEPStatusEnum::REJECTED;
    }
}
