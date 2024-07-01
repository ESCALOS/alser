<?php

use App\Livewire\Account;
use App\Livewire\Auth\Register;
use App\Livewire\BankAccountList;
use App\Livewire\Operation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/register', Register::class)->name('register')->middleware('guest');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    // 'verified',
])->group(function () {
    Route::get('/nueva-operacion', Operation::class)->name('new-operation');
    Route::get('/datos-del-perfil', Account::class)->name('account');
    Route::get('/mis-operaciones', function () {
        return view('my-operations');
    })->name('my-operations');
    Route::get('/cuentas-bancarias', BankAccountList::class)->name('bank-account');

    //  Ruta de imagenes de Documento de identidad
    Route::prefix('image')->name('image.')->group(function () {
        Route::get('identity_document/{type}', function ($type) {
            $ruta = 'identity-documents/'.Auth::user()->id.'/'.$type.'.png';
            $urlFirmada = Storage::temporaryUrl($ruta, now()->addMinutes(5));

            return redirect($urlFirmada);
        })->name('identity-document-current-user');

        Route::get('identity_document/{type}/{userId}', function ($type, $userId) {
            $ruta = 'identity-documents/'.$userId.'/'.$type.'.png';
            $urlFirmada = Storage::temporaryUrl($ruta, now()->addMinutes(5));

            return redirect($urlFirmada);
        })->name('identity-document-by-user');

    });
    //Ruta de pdf PEP
    Route::prefix('pdf')->name('pdf.')->group(function () {
        Route::get('pep/{userId}', function ($userId) {
            $ruta = 'pdf-PEP/'.$userId.'.pdf';
            $urlFirmada = Storage::temporaryUrl($ruta, now()->addMinutes(5));

            return redirect($urlFirmada);
        })->name('pep-by-user');

        Route::get('ruc/{userId}', function ($userId) {
            $ruta = 'pdf-RUC/'.$userId.'.pdf';
            $urlFirmada = Storage::temporaryUrl($ruta, now()->addMinutes(5));

            return redirect($urlFirmada);
        })->name('ruc-by-user');
    });
});
