<?php

namespace App\Filament\Resources\ValidateIdentityDocument\UserResource\Pages;

use App\Filament\Resources\ValidateIdentityDocument\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
