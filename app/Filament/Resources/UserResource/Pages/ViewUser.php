<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Enums\IdentityDocumentStatusEnum;
use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('validate')
                ->label('Validar')
                ->color('success')
                ->requiresConfirmation()
                ->action(function (User $user) {
                    $user->identity_document_status = IdentityDocumentStatusEnum::VALIDATED;
                    $user->save();
                    Notification::make()
                        ->title('Usuario validado')
                        ->success()
                        ->send();
                })
                ->visible(fn (User $user): bool => $user->identity_document_status === IdentityDocumentStatusEnum::UPLOADED),
            Action::make('reject')
                ->label('Rechazar')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function (User $user) {
                    $user->identity_document_status = IdentityDocumentStatusEnum::REJECTED;
                    $user->save();
                    Notification::make()
                        ->title('Usuario rechazado')
                        ->info()
                        ->send();
                })
                ->visible(fn (User $user): bool => $user->identity_document_status === IdentityDocumentStatusEnum::UPLOADED),
        ];
    }
}
