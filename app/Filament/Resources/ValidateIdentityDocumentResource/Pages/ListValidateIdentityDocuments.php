<?php

namespace App\Filament\Resources\ValidateIdentityDocumentResource\Pages;

use App\Filament\Resources\ValidateIdentityDocumentResource;
use App\Models\PersonalAccount;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListValidateIdentityDocuments extends ListRecords
{
    protected static string $resource = ValidateIdentityDocumentResource::class;

    public function getTabs(): array
    {
        return [
            'uploaded' => Tab::make('Pendientes')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('identity_document', 2))
                ->icon('heroicon-m-clock')
                ->badge(PersonalAccount::query()->where('identity_document', 2)->count())
                ->badgeColor('warning'),
            'validated' => Tab::make('Validados')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('identity_document', 3))
                ->icon('heroicon-m-check')
                ->badgeColor('success'),
            'rejected' => Tab::make('Rechazados')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('identity_document', 4))
                ->icon('heroicon-m-x-circle')
                ->badgeColor('danger'),
        ];
    }
}
