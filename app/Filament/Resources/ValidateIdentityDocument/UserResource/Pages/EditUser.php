<?php

namespace App\Filament\Resources\ValidateIdentityDocument\UserResource\Pages;

use App\Filament\Resources\ValidateIdentityDocument\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
