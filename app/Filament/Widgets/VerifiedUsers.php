<?php

namespace App\Filament\Widgets;

use App\Enums\IdentityDocumentStatusEnum;
use App\Enums\OperationStatusEnum;
use App\Models\Operation;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VerifiedUsers extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Usuarios Validados', User::where('identity_document_status', IdentityDocumentStatusEnum::VALIDATED)->count())
                ->description('Total de usuarios activos')
                ->descriptionIcon('heroicon-o-check-circle')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Operaciones pendientes', Operation::where('status', OperationStatusEnum::UPLOADED)->count())
                ->description('Operaciones pendientes a validar')
                ->descriptionIcon('heroicon-o-exclamation-circle')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('warning'),
            Stat::make('Usuarios pendientes', User::where('identity_document_status', IdentityDocumentStatusEnum::UPLOADED)->count())
                ->description('Usuarios pendientes en validar')
                ->descriptionIcon('heroicon-o-x-circle')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger'),
        ];
    }
}
