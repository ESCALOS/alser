<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ValidateIdentityDocumentResource\Pages;
use App\Models\PersonalAccount;
use Filament\Forms\Form;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\ImageEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ValidateIdentityDocumentResource extends Resource
{
    protected static ?string $model = PersonalAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-check';

    protected static ?string $modelLabel = 'Validar documento';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nombres'),
                TextColumn::make('first_surname')
                    ->label('Apellidos')
                    ->formatStateUsing(fn (PersonalAccount $record) => $record->first_surname.' '.$record->second_surname),
                ImageColumn::make('front')
                    ->label('Lado Frontal')
                    ->disk('s3')
                    ->defaultImageUrl(fn (PersonalAccount $record): string => url(route('image.identity-document-by-user', ['type' => 'front', 'userId' => $record->user->id])))
                    ->openUrlInNewTab(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->infolist([
                        Fieldset::make('Foto del Documento de Identidad')
                            ->schema([
                                ImageEntry::make('front')
                                    ->label('Lado Frontal')
                                    ->defaultImageUrl(fn (PersonalAccount $record): string => url(route('image.identity-document-by-user', ['type' => 'front', 'userId' => $record->user->id])))
                                    ->size('200')
                                    ->limitedRemainingText(size: 'lg'),
                                ImageEntry::make('back')
                                    ->label('Lado Posterior')
                                    ->defaultImageUrl(fn (PersonalAccount $record): string => url(route('image.identity-document-by-user', ['type' => 'back', 'userId' => $record->user->id]))),
                            ]),
                    ])
                    ->modalHeading('Datos del usuario'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListValidateIdentityDocuments::route('/'),
        ];
    }
}
