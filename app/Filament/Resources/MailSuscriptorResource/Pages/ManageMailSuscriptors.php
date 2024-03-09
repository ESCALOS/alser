<?php

namespace App\Filament\Resources\MailSuscriptorResource\Pages;

use App\Filament\Resources\MailSuscriptorResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMailSuscriptors extends ManageRecords
{
    protected static string $resource = MailSuscriptorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
