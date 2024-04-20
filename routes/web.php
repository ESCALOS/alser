<?php

use App\Livewire\Account;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/register', Register::class)->name('register')->middleware('guest');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/nueva-operacion', function () {
        return view('new-operation');
    })->name('new-operation');
    Route::get('/datos-del-perfil', Account::class)->name('account');

    Route::prefix('image')->name('image.')->group(function () {
        Route::get('identity_document/{type}', function ($type) {
            $ruta = 'identity-documents/personal-account/1/'.$type.'.png';
            $urlFirmada = Storage::temporaryUrl($ruta, now()->addMinutes(5)); // Genera una URL firmada válida por 5 minutos

            return redirect($urlFirmada);
        })->name('identity-document');
    });
});
