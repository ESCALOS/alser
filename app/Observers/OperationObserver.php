<?php

namespace App\Observers;

use App\Filament\Resources\OperationResource;
use App\Models\Operation;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class OperationObserver
{
    /**
     * Handle the Operation "created" event.
     */
    public function created(Operation $operation): void
    {
        //
    }

    /**
     * Handle the Operation "updated" event.
     */
    public function updated(Operation $operation): void
    {
        if ($operation->isUploaded()) {
            $admins = User::where('is_admin', true)->get();
            $message = 'Nueva operación';
            Notification::make()
                ->title('Nuevo usuario a validar')
                ->info()
                ->body($message)
                ->actions([
                    Action::make('view')
                        ->label('Ver')
                        ->url(OperationResource::getUrl('view', ['record' => $operation]))
                        ->markAsRead(),
                ])
                ->sendToDatabase($admins);
        }
    }

    /**
     * Handle the Operation "deleted" event.
     */
    public function deleted(Operation $operation): void
    {
        //
    }

    /**
     * Handle the Operation "restored" event.
     */
    public function restored(Operation $operation): void
    {
        //
    }

    /**
     * Handle the Operation "force deleted" event.
     */
    public function forceDeleted(Operation $operation): void
    {
        //
    }
}
