<?php

namespace App\Filament\Resources\OperationResource\Pages;

use App\Enums\OperationStatusEnum;
use App\Filament\Resources\OperationResource;
use App\Models\Operation;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewOperation extends ViewRecord
{
    protected static string $resource = OperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('validate')
                ->label('Validar')
                ->color('success')
                ->requiresConfirmation()
                ->action(function (Operation $operation) {
                    $operation->status = OperationStatusEnum::VALIDATED;
                    $operation->save();
                    Notification::make()
                        ->title('Operación validada')
                        ->success()
                        ->send();
                })
                ->visible(fn (Operation $operation): bool => $operation->status === OperationStatusEnum::UPLOADED),
            Action::make('reject')
                ->label('Rechazar')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function (Operation $operation) {
                    $operation->status = OperationStatusEnum::REJECTED;
                    $operation->save();
                    Notification::make()
                        ->title('Operación rechazada')
                        ->info()
                        ->send();
                })
                ->visible(fn (Operation $operation): bool => $operation->status === OperationStatusEnum::UPLOADED),
        ];
    }
}
