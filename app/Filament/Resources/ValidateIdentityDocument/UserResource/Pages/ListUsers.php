<?php

namespace App\Filament\Resources\ValidateIdentityDocument\UserResource\Pages;

use App\Filament\Resources\ValidateIdentityDocument\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
