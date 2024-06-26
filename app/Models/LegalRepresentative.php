<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalRepresentative extends Model
{
    use HasFactory;

    public function identityDocuments()
    {
        return $this->morphMany(IdentityDocument::class, 'imageable');
    }
}
