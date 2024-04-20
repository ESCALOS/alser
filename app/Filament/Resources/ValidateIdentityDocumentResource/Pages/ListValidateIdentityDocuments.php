<?php

namespace App\Filament\Resources\ValidateIdentityDocumentResource\Pages;

use App\Enums\IdentityDocumentStatusEnum;
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
                ->modifyQueryUsing(fn (Builder $query) => $query->where('identity_document', IdentityDocumentStatusEnum::UPLOADED))
                ->icon('heroicon-m-clock')
                ->badge(PersonalAccount::query()->where('identity_document', IdentityDocumentStatusEnum::UPLOADED)->count())
                ->badgeColor('warning'),
            'validated' => Tab::make('Validados')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('identity_document', IdentityDocumentStatusEnum::VALIDATED))
                ->icon('heroicon-m-check-circle')
                ->badgeColor('success'),
            'rejected' => Tab::make('Rechazados')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('identity_document', IdentityDocumentStatusEnum::REJECTED))
                ->icon('heroicon-m-x-circle')
                ->badgeColor('danger'),
        ];
    }
}
