<?php

namespace App\Models;

use App\Enums\IdentityDocumentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalAccount extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = ['identity_document_status' => IdentityDocumentStatusEnum::class];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
