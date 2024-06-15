<?php

namespace App\Filament\Resources\OperationResource\Pages;

use App\Enums\OperationStatusEnum;
use App\Filament\Resources\OperationResource;
use App\Models\Operation;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListOperations extends ListRecords
{
    protected static string $resource = OperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'uploaded' => Tab::make('Pendientes')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OperationStatusEnum::UPLOADED))
                ->icon('heroicon-m-clock')
                ->badge(Operation::query()->where('status', OperationStatusEnum::UPLOADED)->count())
                ->badgeColor('warning'),
            'validated' => Tab::make('Validadas')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OperationStatusEnum::VALIDATED)->latest())
                ->icon('heroicon-m-check-circle')
                ->badgeColor('success'),
            'rejected' => Tab::make('Rechazadas')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OperationStatusEnum::REJECTED)->latest())
                ->icon('heroicon-m-x-circle')
                ->badgeColor('danger'),
        ];
    }
}
