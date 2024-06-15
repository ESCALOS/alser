<?php

namespace App\Models;

use App\Enums\AccountTypeEnum;
use App\Enums\DocumentTypeEnum;
use App\Enums\IdentityDocumentStatusEnum;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'account_type',
        'document_type',
        'document_number',
        'name',
        'email',
        'password',
        'is_admin',
        'celphone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'document_type' => DocumentTypeEnum::class,
        'identity_document_status' => IdentityDocumentStatusEnum::class,
        'account_type' => AccountTypeEnum::class,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function personalAccount(): HasOne
    {
        return $this->hasOne(PersonalAccount::class);
    }

    public function legalRepresentative(): HasOne
    {
        return $this->hasOne(LegalRepresentative::class);
    }

    public function shareHolders(): HasMany
    {
        return $this->hasMany(ShareHolder::class);
    }

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class);
    }

    public function isPersonalAccount(): bool
    {
        return $this->account_type === AccountTypeEnum::PERSONAL;
    }

    public function getFullnameAttribute(): string
    {
        $lastname = '';
        if ($this->isPersonalAccount()) {
            $lastname = "{$this->personalAccount->first_lastname} {$this->personalAccount->second_lastname}";
        }

        return "{$this->name} {$lastname}";
    }

    public function getPepAttribute(): bool
    {
        if ($this->isPersonalAccount()) {
            return $this->personalAccount->is_PEP;
        } else {
            return $this->legalRepresentative->is_PEP;
        }
    }

    public function getWifePepAttribute(): bool
    {
        if ($this->isPersonalAccount()) {
            return $this->personalAccount->wife_is_PEP;
        } else {
            return $this->legalRepresentative->wife_is_PEP;
        }
    }

    public function getRelativePepAttribute(): bool
    {
        if ($this->isPersonalAccount()) {
            return $this->personalAccount->relative_is_PEP;
        } else {
            return $this->legalRepresentative->relative_is_PEP;
        }
    }

    public function isBusinessAccount(): bool
    {
        return $this->account_type === AccountTypeEnum::BUSINESS;
    }

    public function isIdentityDocumentRequired(): bool
    {
        return $this->identity_document_status === IdentityDocumentStatusEnum::PENDING || $this->identity_document_status === IdentityDocumentStatusEnum::REJECTED;
    }

    public function isDataValidated(): bool
    {
        return $this->identity_document_status === IdentityDocumentStatusEnum::VALIDATED;
    }

    public function isDataUploaded(): bool
    {
        return $this->identity_document_status === IdentityDocumentStatusEnum::UPLOADED;
    }

    public function isDataPending(): bool
    {
        return $this->identity_document_status === IdentityDocumentStatusEnum::PENDING;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // return str_ends_with($this->email, '@alsercambio.com') && $this->hasVerifiedEmail();
        return $this->is_admin;
    }
}
