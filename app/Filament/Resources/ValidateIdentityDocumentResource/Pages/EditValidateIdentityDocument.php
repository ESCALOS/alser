<?php

namespace App\Filament\Resources\ValidateIdentityDocumentResource\Pages;

use App\Filament\Resources\ValidateIdentityDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditValidateIdentityDocument extends EditRecord
{
    protected static string $resource = ValidateIdentityDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
