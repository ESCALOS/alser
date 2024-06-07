<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Enums\IdentityDocumentStatusEnum;
use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }

    public function getTabs(): array
    {
        return [
            'uploaded' => Tab::make('Pendientes')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('identity_document_status', IdentityDocumentStatusEnum::UPLOADED))
                ->icon('heroicon-m-clock')
                ->badge(User::query()->where('identity_document_status', IdentityDocumentStatusEnum::UPLOADED)->count())
                ->badgeColor('warning'),
            'validated' => Tab::make('Validados')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('identity_document_status', IdentityDocumentStatusEnum::VALIDATED))
                ->icon('heroicon-m-check-circle')
                ->badgeColor('success'),
            'rejected' => Tab::make('Rechazados')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('identity_document_status', IdentityDocumentStatusEnum::REJECTED))
                ->icon('heroicon-m-x-circle')
                ->badgeColor('danger'),
        ];
    }
}
