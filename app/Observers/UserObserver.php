<?php

namespace App\Observers;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->isDataUploaded()) {
            $admins = User::where('is_admin', true)->get();
            $accountType = $user->isPersonalAccount() ? '' : 'La empresa ';
            $message = $accountType.'<strong>'.$user->fullname.'</strong> ha subido sus datos.';
            Notification::make()
                ->title('Nuevo usuario a validar')
                ->info()
                ->body($message)
                ->actions([
                    Action::make('view')
                        ->label('Ver')
                        ->url(UserResource::getUrl('view', ['record' => $user]))
                        ->markAsRead(),
                ])
                ->sendToDatabase($admins);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
