<?php

namespace App\Filament\Resources\ComplaintBookResource\Pages;

use App\Filament\Resources\ComplaintBookResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewComplaintBook extends ViewRecord
{
    protected static string $resource = ComplaintBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
